<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        $module_name = 'services';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'List';

        return view('backend.services.index', compact('module_name', 'module_title', 'module_icon', 'module_action'));
    }

    public function create()
    {
        $service = new Service();
        $module_name = 'services';
        $module_path = 'backend';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'Create';
        return view('backend.services.create', compact('service', 'module_name', 'module_path', 'module_title', 'module_icon', 'module_action'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:191',
            'name_en' => 'nullable|max:191',
            'category' => 'nullable|string|max:120',
            'slug' => 'nullable|max:191',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'featured_on_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imageFile = $data['image'] ?? null;
        unset($data['image']);

        $data['is_active'] = $request->boolean('is_active');
        $data['featured_on_home'] = $request->boolean('featured_on_home');
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($imageFile) {
            $path = $imageFile->store('uploads/services', 'public');
            $data['image'] = Storage::url($path);
        }

        Service::create($data);

        return redirect()->route('backend.services.index')->with('status', 'Service created');
    }

    public function edit(Service $service)
    {
        $module_name = 'services';
        $module_path = 'backend';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'Edit';
        return view('backend.services.edit', compact('service', 'module_name', 'module_path', 'module_title', 'module_icon', 'module_action'));
    }

    public function show(Service $service)
    {
        $module_name = 'services';
        $module_path = 'backend';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'Show';

        return view('backend.services.show', compact('service', 'module_name', 'module_path', 'module_title', 'module_icon', 'module_action'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|max:191',
            'name_en' => 'nullable|max:191',
            'category' => 'nullable|string|max:120',
            'slug' => 'nullable|max:191',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'featured_on_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imageFile = $data['image'] ?? null;
        unset($data['image']);

        $data['is_active'] = $request->boolean('is_active');
        $data['featured_on_home'] = $request->boolean('featured_on_home');
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($imageFile) {
            if (! empty($service->image) && str_starts_with($service->image, '/storage/')) {
                $oldPath = ltrim(str_replace('/storage/', '', $service->image), '/');
                Storage::disk('public')->delete($oldPath);
            }

            $path = $imageFile->store('uploads/services', 'public');
            $data['image'] = Storage::url($path);
        }

        $service->update($data);

        return redirect()->route('backend.services.index')->with('status', 'Service updated');
    }

    public function destroy(Service $service)
    {
        if (! empty($service->image)) {
            $publicPrefix = '/storage/';

            if (Str::startsWith($service->image, $publicPrefix)) {
                $relativePath = ltrim(Str::after($service->image, $publicPrefix), '/');
                Storage::disk('public')->delete($relativePath);
            } elseif (Str::startsWith($service->image, 'storage/')) {
                $relativePath = ltrim(Str::after($service->image, 'storage/'), '/');
                Storage::disk('public')->delete($relativePath);
            }
        }

        $service->delete();
        return redirect()->route('backend.services.index')->with('status', 'Service deleted');
    }

    public function index_data()
    {
        $services = Service::select('id', 'name', 'category', 'is_active', 'sort_order', 'updated_at')
            ->orderBy('sort_order')
            ->orderBy('id');

        return DataTables::of($services)
            ->addIndexColumn()
            ->editColumn('name', function ($service) {
                return '<strong>'.e($service->name).'</strong>';
            })
            ->addColumn('category', function ($service) {
                return $service->category ? e($service->category) : '<span class="text-muted">-</span>';
            })
            ->addColumn('status', function ($service) {
                return $service->is_active
                    ? '<span class="badge bg-success">'.__('Active').'</span>'
                    : '<span class="badge bg-secondary">'.__('Inactive').'</span>';
            })
            ->editColumn('sort_order', function ($service) {
                return (int) $service->sort_order;
            })
            ->editColumn('updated_at', function ($service) {
                $diff = Carbon::now()->diffInHours($service->updated_at);

                return $diff < 25
                    ? $service->updated_at->diffForHumans()
                    : $service->updated_at->isoFormat('llll');
            })
            ->addColumn('action', function ($service) {
                $module_name = 'services';

                return view('backend.includes.action_column', [
                    'module_name' => $module_name,
                    'data' => $service,
                ]);
            })
            ->rawColumns(['name', 'category', 'status', 'action'])
            ->make(true);
    }
}
