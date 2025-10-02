<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::sorted()->paginate(20);
        $module_name = 'services';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'List';

        return view('backend.services.index', compact('services', 'module_name', 'module_title', 'module_icon', 'module_action'));
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

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|max:191',
            'name_en' => 'nullable|max:191',
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
        $service->delete();
        return redirect()->route('backend.services.index')->with('status', 'Service deleted');
    }
}
