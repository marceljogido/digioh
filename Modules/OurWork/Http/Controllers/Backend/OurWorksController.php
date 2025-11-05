<?php

namespace Modules\OurWork\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OurWorksController extends BackendBaseController
{
    use Authorizable;

    protected array $module_validation_rules = [
        'store' => [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['nullable', 'string', 'max:191'],
            'icon_class' => ['nullable', 'string', 'max:191'],
            'excerpt' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'featured_on_home' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ],
        'update' => [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['nullable', 'string', 'max:191'],
            'icon_class' => ['nullable', 'string', 'max:191'],
            'excerpt' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'featured_on_home' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ],
    ];

    public function __construct()
    {
        // Page Title
        $this->module_title = 'OurWorks';

        // module name
        $this->module_name = 'ourworks';

        // directory path of the module
        $this->module_path = 'ourwork::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\OurWork\Models\OurWork";
    }

    protected function resolveValidationRules(Request $request, string $context, $model = null): array
    {
        $rules = parent::resolveValidationRules($request, $context, $model);

        if (array_key_exists('slug', $rules)) {
            $uniqueRule = Rule::unique('our_works', 'slug');

            if ($context === 'update' && $model) {
                $uniqueRule = $uniqueRule->ignore($model->id);
            }

            $rules['slug'][] = $uniqueRule;
        }

        return $rules;
    }
}
