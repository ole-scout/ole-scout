<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('view', $courseGroup);
        $this->courseGroup = $courseGroup;
        $this->courseGroups = $courseGroup->courseGroups()->forUser()->get();
        $this->courses = $courseGroup->courses()->forUser()->get();
    }

    public function render()
    {
        return view('courses::livewire.course-group');
    }
}
