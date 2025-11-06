<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Settings';

        // module name
        $this->module_name = 'settings';

        // directory path of the module
        $this->module_path = 'settings';

        // module icon
        $this->module_icon = 'fas fa-cogs';

        // module model name, path
        $this->module_model = "App\Models\Setting";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::paginate();
        $settingSections = collect(config('setting_fields', []))->except(['about'])->toArray();
        $selectedSection = request('section');

        if (empty($settingSections)) {
            $selectedSection = null;
        } elseif (! $selectedSection || ! array_key_exists($selectedSection, $settingSections)) {
            $selectedSection = array_key_first($settingSections);
        }

        Log::info(label_case($module_title.' '.$module_action).' | User:'.Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.{$module_path}.index",
            compact('module_title', 'module_name', "{$module_name}", 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'selectedSection', 'settingSections')
        );
    }

    public function store(Request $request)
    {
        $activeSection = $request->input('active_section');
        $sections = $activeSection ? Arr::wrap($activeSection) : null;

        $rules = Setting::getValidationRules($sections);

        $rules = array_merge($rules, [
            'about_founders' => 'nullable|array',
            'about_founders.*.name' => 'nullable|string|max:100',
            'about_founders.*.title' => 'nullable|string|max:150',
            'about_founders.*.linkedin' => 'nullable|string|max:191',
            'about_founders.*.existing_photo' => 'nullable|string|max:255',
            'about_founders.*.photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->validate($rules);

        $definedFields = collect(config('setting_fields', []))->pluck('elements')->flatten(1)->keyBy('name');
        $validSettings = array_keys($rules);

        foreach ($definedFields as $name => $field) {
            if (($field['type'] ?? null) === 'image') {
                if ($request->hasFile($name)) {
                    $path = $request->file($name)->store('uploads/settings', 'public');
                    $data[$name] = Storage::url($path);
                } else {
                    unset($data[$name]);
                }
            }
        }

        if (! array_key_exists('about_founders', $data)) {
            $data['about_founders'] = [];
        }

        if (isset($data['about_founders']) && is_array($data['about_founders'])) {
            $processedFounders = [];
            foreach ($data['about_founders'] as $index => $founder) {
                $name = trim($founder['name'] ?? '');
                $title = trim($founder['title'] ?? '');
                $linkedin = trim($founder['linkedin'] ?? '');
                $photoPath = $founder['existing_photo'] ?? null;

                if ($request->hasFile("about_founders.$index.photo")) {
                    $photoPath = Storage::url($request->file("about_founders.$index.photo")->store('uploads/settings', 'public'));
                }

                if ($name === '' && $title === '' && $linkedin === '' && empty($photoPath)) {
                    continue;
                }

                $processedFounders[] = [
                    'name' => $name,
                    'title' => $title,
                    'linkedin' => $linkedin,
                    'photo' => $photoPath,
                ];
            }

            $data['about_founders'] = $processedFounders;
        }

        foreach ($data as $key => $val) {
            if (! in_array($key, $validSettings)) {
                continue;
            }

            $type = Setting::getDataType($key);
            $value = $val;

            if (in_array($type, ['json', 'array'], true)) {
                $value = json_encode($val ?? []);
            }

            Setting::add($key, $value, $type);
        }

        return redirect()->back()->with('status', 'Settings has been saved.');
    }

    public function about()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_action = 'About Us';
        $module_name_singular = Str::singular($module_name);

        $fields = config('setting_fields.about.elements') ?? [];

        return view('backend.settings.about', compact(
            'module_title',
            'module_name',
            'module_path',
            'module_icon',
            'module_action',
            'module_name_singular',
            'fields'
        ));
    }
}
