<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Support\Collection;
use Livewire\Component;

class CourseGroupView extends Component
{
    public CourseGroup $courseGroup;
    /** Collection<int,CourseGroup> */
    public Collection $courseGroups;
    /** Collection<int,Course> */
    public Collection $courses;

    public function mount(CourseGroup $courseGroup)
    {
        $this->courseGroup = $courseGroup;
        $this->courseGroups = $courseGroup->courseGroups()
            ->forUser()
            ->ordered()
            ->with([
                'recursiveCourses' => fn($query) => $query->forUser(),
                'recursiveCourses.states' => fn($query) => $query->forUser()->limit(1),
            ])
            ->get();
        $this->courses = $courseGroup->courses()
            ->forUser()
            ->ordered()
            ->get();
    }

    public function render()
    {
        return view('courses::livewire.course-group-view');
    }
}
