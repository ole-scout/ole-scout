<?php

namespace FossHaas\Consent\View\Components;

use Closure;
use FossHaas\Consent\Category;
use FossHaas\Consent\Models\ServiceDefinition;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ConsentForm extends Component
{

    protected Collection $services;

    protected array $selected = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->services = ServiceDefinition::with([
            'serviceProvider',
            'serviceCookies',
        ])->get()->groupBy('category');
        foreach ($this->services as $categoryName => $category) {
            if (!isset($this->selected[$categoryName])) {
                $this->selected[$categoryName] = [];
            }
            foreach ($category as $service) {
                $this->selected[$categoryName][$service->id] = $categoryName === 'essential';
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('consent::components.consent-form', [
            'categories' => Arr::mapWithKeys(
                Arr::where(
                    Category::cases(),
                    fn (Category $category) => $this->services->has($category->name)
                ),
                fn (Category $category) => [$category->name => $category->label()]
            ),
            'selected' => $this->selected,
            'services' => $this->services
        ]);
    }
}
