<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Support\Collection;
use Livewire\Component;

class CourseGroupRootView extends Component
{
    /** Collection<int,CourseGroup> */
    public Collection $courseGroups;
    /** Collection<int,Course> */
    public Collection $courses;

    public function mount()
    {
        $this->courseGroups = CourseGroup::root()->forUser()->get();
        $this->courses = Course::root()->forUser()->get();
    }

    public function render()
    {
        return view('courses::livewire.course-group-root');
    }
}
