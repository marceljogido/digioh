<?php

namespace Modules\Slider\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SlidersController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Sliders';

        // module name
        $this->module_name = 'sliders';

        // directory path of the module
        $this->module_path = 'slider::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\\Slider\\Models\\Slider";
    }

    public function index_list(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }

        $query_data = $module_model::where('title', 'LIKE', "%{$term}%")->active()->limit(7)->get();

        $$module_name = [];
        foreach ($query_data as $row) {
            $$module_name[] = [
                'id' => $row->id,
                'text' => $row->title,
            ];
        }

        return response()->json($$module_name);
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading.' '.label_case($module_action);

        $$module_name = $module_model::select('id', 'title as name', 'is_active', 'button_link', 'sort_order', 'updated_at')
            ->orderBy('sort_order')
            ->orderBy('id');

        return DataTables::of($$module_name)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{$name}}</strong>')
            ->addColumn('status', function ($data) {
                if ($data->is_active) {
                    return '<span class="badge bg-success">Published</span>';
                }
                return '<span class="badge bg-secondary">Unpublished</span>';
            })
            ->addColumn('link', function ($data) {
                if ($data->button_link) {
                    return '<a href="'.$data->button_link.'" target="_blank" class="text-truncate d-inline-block" style="max-width:150px;" title="'.$data->button_link.'">'.$data->button_link.'</a>';
                }
                return '<span class="text-muted">-</span>';
            })
            ->editColumn('updated_at', function ($data) {
                $diff = Carbon::now()->diffInHours($data->updated_at);
                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }
                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['name', 'status', 'link', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'array'],
            'title.id' => ['required', 'string', 'max:191'],
            'title.en' => ['nullable', 'string', 'max:191'],
            'subtitle' => ['nullable', 'array'],
            'subtitle.id' => ['nullable', 'string', 'max:191'],
            'subtitle.en' => ['nullable', 'string', 'max:191'],
            'button_text' => ['nullable', 'array'],
            'button_text.id' => ['nullable', 'string', 'max:191'],
            'button_text.en' => ['nullable', 'string', 'max:191'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data = collect($data)->except('image')->toArray();
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);
        $data['image'] = $this->storeImage($request->file('image'));

        $slider = $this->module_model::create($data);

        flash("New '".Str::singular($this->module_title)."' Added")->success()->important();

        logUserAccess($this->module_title.' Store | Id: '.$slider->id);

        return redirect()->route('backend.sliders.index');
    }

    public function update(Request $request, $id)
    {
        $slider = $this->module_model::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'array'],
            'title.id' => ['required', 'string', 'max:191'],
            'title.en' => ['nullable', 'string', 'max:191'],
            'subtitle' => ['nullable', 'array'],
            'subtitle.id' => ['nullable', 'string', 'max:191'],
            'subtitle.en' => ['nullable', 'string', 'max:191'],
            'button_text' => ['nullable', 'array'],
            'button_text.id' => ['nullable', 'string', 'max:191'],
            'button_text.en' => ['nullable', 'string', 'max:191'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data = collect($validated)->except('image')->toArray();
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', $slider->sort_order ?? 0);

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($slider->image);
            $data['image'] = $this->storeImage($request->file('image'));
        }

        $slider->update($data);

        flash(Str::singular($this->module_title)."' Updated Successfully")->success()->important();

        logUserAccess($this->module_title.' Update | Id: '.$slider->id);

        return redirect()->route('backend.sliders.show', $slider->id);
    }

    protected function storeImage(UploadedFile $file): string
    {
        $path = $file->store('uploads/sliders', 'public');

        return Storage::url($path);
    }

    protected function deleteStoredImage(?string $path): void
    {
        if (empty($path) || ! Str::startsWith($path, '/storage/')) {
            return;
        }

        $relative = ltrim(Str::after($path, '/storage/'), '/');
        Storage::disk('public')->delete($relative);
    }
}
