<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\Course;
use Illuminate\Support\Collection;
use Livewire\Component;

class CourseView extends Component
{
    public Course $course;
    public Collection $activities;
    public Collection $activityGroups;
    public Collection $activityStates;

    public function mount(Course $course)
    {
        $this->course = $course;
        // TODO: activityGroups can recurse
        $this->activityGroups = $course->activityGroups()->ordered()->get();
        $this->activities = $course->activities()->ordered()->with([
            'content',
            'states' => fn($query) => $query->forUser(),
        ])->chaperone('course')->get();
    }

    public function render()
    {
        return view('courses::livewire.course-view');
    }
}
