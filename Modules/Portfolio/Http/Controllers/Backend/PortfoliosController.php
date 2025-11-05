<?php

namespace Modules\Portfolio\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortfoliosController extends BackendBaseController
{
    use Authorizable;

    protected array $module_validation_rules = [
        'store' => [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['nullable', 'string', 'max:191'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', 'integer', 'in:0,1'],
        ],
        'update' => [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['nullable', 'string', 'max:191'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', 'integer', 'in:0,1'],
        ],
    ];

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Portfolios';

        // module name
        $this->module_name = 'portfolios';

        // directory path of the module
        $this->module_path = 'portfolio::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Portfolio\Models\Portfolio";
    }

    protected function resolveValidationRules(Request $request, string $context, $model = null): array
    {
        $rules = parent::resolveValidationRules($request, $context, $model);

        if (array_key_exists('slug', $rules)) {
            $uniqueRule = Rule::unique('portfolios', 'slug');

            if ($context === 'update' && $model) {
                $uniqueRule = $uniqueRule->ignore($model->id);
            }

            $rules['slug'][] = $uniqueRule;
        }

        return $rules;
    }
}
