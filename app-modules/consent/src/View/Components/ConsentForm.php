<?php

namespace FossHaas\Consent\View\Components;

use Closure;
use FossHaas\Consent\Enums\Category;
use FossHaas\Consent\Models\ServiceDefinition;
use FossHaas\Consent\Settings\ServiceProviderSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
    public function __construct(
        ServiceProviderSettings $settings,
        Request $request,
    ) {
        $selected = $request->consentCookie() ?: [];
        $operator = $settings->asServiceProvider();
        $this->services = ServiceDefinition::with([
            'serviceProvider',
            'serviceCookies',
        ])->get()->groupBy('category');
        foreach ($this->services as $categoryName => $category) {
            if (!isset($this->selected[$categoryName])) {
                $this->selected[$categoryName] = [];
            }
            foreach ($category as $service) {
                if (!$service->serviceProvider) {
                    $service->serviceProvider = $operator;
                }
                $this->selected[$categoryName][$service->id] = (
                    $categoryName === 'essential'
                    ?: array_key_exists($service->id, $selected)
                );
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
                    fn(Category $category) => $this->services->has($category->name)
                ),
                fn(Category $category) => [$category->name => $category->label()]
            ),
            'selected' => $this->selected,
            'services' => $this->services
        ]);
    }
}
