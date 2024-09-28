<?php

namespace FossHaas\Courses\Livewire;

use FossHaas\Courses\Models\Course;
use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Database\Eloquent\Factories\Relationship;
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
        $this->courseGroups = CourseGroup::root()
            ->forUser()
            ->ordered()
            ->with([
                'recursiveCourses' => fn($query) => $query->forUser(),
                'recursiveCourses.states' => fn($query) => $query->forUser()->limit(1),
            ])
            ->get();
        $this->courses = Course::root()
            ->forUser()
            ->ordered()
            ->get();
    }

    public function render()
    {
        return view('courses::livewire.course-group-root-view');
    }
}
