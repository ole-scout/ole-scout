<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseState;
use FossHaas\Courses\Services\CourseStateService;
use Illuminate\Support\Collection;
use Livewire\Component;

class CourseView extends Component
{
    public Course $course;
    public ?CourseState $state;
    public Collection $activities;
    public Collection $activityGroups;

    public function mount(Course $course, CourseStateService $courseStateService)
    {
        $this->course = $course;
        $this->state = $course->states()->forUser()->first();
        $this->activities = new Collection();
        $this->activityGroups = new Collection();
        if ($this->state) {
            $this->course->setRelation('states', collect([$this->state]));
        } else {
            $courseStateService->createStatesForCourses(collect([$course]));
        }

        $activityGroups = $course->activityGroups()
            ->ordered()
            ->chaperone('course')
            ->get();
        $activities = $course->activities()->ordered()
            ->with(['content'])
            ->chaperone('course')
            ->get();
        foreach ($activities as $activity) {
            $activity->setRelation('course', $course);
            $activity->content->setRelation('activity', $activity);
            if ($activity->activity_group_id) {
                $group = $activityGroups->first(fn($g) => $g->id === $activity->activity_group_id);
                $activity->setRelation('activityGroup', $group);
                if (!$group->relationLoaded('activities')) {
                    $group->setRelation('activities', new Collection());
                }
                $group->activities->push($activity);
            } else {
                $this->activities->push($activity);
            }
        }
        foreach ($activityGroups as $group) {
            if (!$group->relationLoaded('activities')) {
                $group->setRelation('activities', new Collection());
            }
            if (!$group->relationLoaded('activityGroups')) {
                $group->setRelation('activityGroups', new Collection());
            }
            if ($group->parent_id) {
                $parent = $activityGroups->first(fn($g) => $g->id === $group->parent_id);
                $group->setRelation('parent', $parent);
                if (!$parent->relationLoaded('activityGroups')) {
                    $parent->setRelation('activityGroups', new Collection());
                }
                $parent->activityGroups->push($group);
            } else {
                $this->activityGroups->push($group);
            }
        }
        // Trim empty groups
        $todo = $this->activityGroups->filter(fn($group) => (
            (!$group->relationLoaded('activities') || $group->activities->isEmpty()) &&
            (!$group->relationLoaded('activityGroups') || $group->activityGroups->isEmpty())
        ))->all();
        while ($group = array_shift($todo)) {
            $isLeaf = (!$group->relationLoaded('activities') || $group->activities->isEmpty()) &&
                (!$group->relationLoaded('activityGroups') || $group->activityGroups->isEmpty());
            if (!$isLeaf) continue;
            if ($group->parent_id) {
                $parent = $activityGroups->first(fn($g) => $g->id === $group->parent_id);
                if ($parent) {
                    if ($parent->relationLoaded('activityGroups')) {
                        $parent->activityGroups->pull($group);
                    }
                    if (!in_array($parent, $todo)) {
                        $todo[] = $parent;
                    }
                }
            } else {
                $this->activityGroups->pull($group);
            }
        }
    }

    public function render()
    {
        return view('courses::livewire.course-view');
    }
}
