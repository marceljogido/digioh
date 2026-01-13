<?php

namespace Modules\ClientLogo\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ClientLogosController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Client Logos';

        // module name
        $this->module_name = 'clientlogos';

        // directory path of the module
        $this->module_path = 'clientlogo::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\\ClientLogo\\Models\\ClientLogo";
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => ['nullable','string','max:150'],
            'logo' => ['required','file','mimes:jpg,jpeg,png,gif,webp,svg','max:2048'],
            'website_url' => ['nullable','url','max:255'],
            'is_active' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        $model = $this->module_model;
        $entity = $model::create([
            'client_name' => $validated['client_name'] ?? null,
            'logo' => $this->storeLogo($request->file('logo')),
            'website_url' => $validated['website_url'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        flash("New '".Str::singular($this->module_title)."' Added")->success()->important();
        return redirect()->route('backend.clientlogos.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_name' => ['nullable','string','max:150'],
            'logo' => ['nullable','file','mimes:jpg,jpeg,png,gif,webp,svg','max:2048'],
            'website_url' => ['nullable','url','max:255'],
            'is_active' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        $model = $this->module_model;
        $entity = $model::findOrFail($id);

        $updateData = [
            'client_name' => $validated['client_name'] ?? $entity->client_name,
            'website_url' => $validated['website_url'] ?? $entity->website_url,
            'is_active' => $request->boolean('is_active', $entity->is_active),
            'sort_order' => $validated['sort_order'] ?? $entity->sort_order,
        ];

        if ($request->hasFile('logo')) {
            $this->deleteLogoIfStored($entity->logo);
            $updateData['logo'] = $this->storeLogo($request->file('logo'));
        }

        $entity->update($updateData);

        flash(Str::singular($this->module_title)."' Updated Successfully")->success()->important();
        return redirect()->route('backend.clientlogos.show', $entity->id);
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

        $query_data = $module_model::where('client_name', 'LIKE', "%{$term}%")->active()->limit(7)->get();

        $$module_name = [];
        foreach ($query_data as $row) {
            $$module_name[] = [
                'id' => $row->id,
                'text' => $row->client_name ?? $row->id,
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

        $$module_name = $module_model::select('id', 'client_name as name', 'sort_order', 'updated_at');

        return DataTables::of($$module_name)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{$name}}</strong>')
            ->editColumn('updated_at', function ($data) {
                $diff = Carbon::now()->diffInHours($data->updated_at);
                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }
                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    protected function storeLogo(UploadedFile $file): string
    {
        $path = $file->store('uploads/client-logos', 'public');

        return Storage::url($path);
    }

    protected function deleteLogoIfStored(?string $path): void
    {
        if (empty($path) || ! Str::startsWith($path, '/storage/')) {
            return;
        }

        $relative = ltrim(Str::after($path, '/storage/'), '/');
        Storage::disk('public')->delete($relative);
    }
}
