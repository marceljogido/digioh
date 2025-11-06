<?php

namespace App\Http\Controllers\Backend;

use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    protected int $featuredHomeLimit = 4;

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
        $service = new Service([
            'status' => ServiceStatus::Draft->value,
            'featured_on_home' => false,
        ]);
        $module_name = 'services';
        $module_path = 'backend';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'Create';
        $featuredLimitReached = Service::where('featured_on_home', true)->count() >= $this->featuredHomeLimit;
        $statusOptions = ServiceStatus::options();

        return view('backend.services.create', compact(
            'service',
            'module_name',
            'module_path',
            'module_title',
            'module_icon',
            'module_action',
            'featuredLimitReached',
            'statusOptions'
        ) + [
            'featuredLimit' => $this->featuredHomeLimit,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:191',
            'slug' => 'nullable|max:191',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status' => ['required', Rule::enum(ServiceStatus::class)],
            'featured_on_home' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imageFile = $data['image'] ?? null;
        unset($data['image']);

        $data['featured_on_home'] = $request->boolean('featured_on_home');
        $data['status'] = $data['status'] ?? ServiceStatus::Draft->value;
        $data['is_active'] = $data['status'] === ServiceStatus::Published->value;
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($data['featured_on_home']) {
            $featuredCount = Service::where('featured_on_home', true)->count();
            if ($featuredCount >= $this->featuredHomeLimit) {
                return back()
                    ->withErrors(['featured_on_home' => __('Maksimal :max layanan dapat tampil di home. Nonaktifkan salah satunya terlebih dahulu.', ['max' => $this->featuredHomeLimit])])
                    ->withInput();
            }
        }

        if ($imageFile) {
            $path = $imageFile->store('uploads/services', 'public');
            $data['image'] = Storage::url($path);
        }

        Service::create($data);

        return redirect()->route('backend.services.index')->with('status', 'Service created');
    }

    public function edit(Service $service)
    {
        $service->loadCount('posts');
        $module_name = 'services';
        $module_path = 'backend';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'Edit';
        $featuredLimitReached = Service::where('featured_on_home', true)
            ->where('id', '!=', $service->id)
            ->count() >= $this->featuredHomeLimit;
        $statusOptions = ServiceStatus::options();

        return view('backend.services.edit', compact(
            'service',
            'module_name',
            'module_path',
            'module_title',
            'module_icon',
            'module_action',
            'featuredLimitReached',
            'statusOptions'
        ) + [
            'featuredLimit' => $this->featuredHomeLimit,
        ]);
    }

    public function show(Service $service)
    {
        $service->loadCount('posts');
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
            'slug' => 'nullable|max:191',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status' => ['required', Rule::enum(ServiceStatus::class)],
            'featured_on_home' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imageFile = $data['image'] ?? null;
        unset($data['image']);

        $data['featured_on_home'] = $request->boolean('featured_on_home');
        $data['status'] = $data['status'] ?? ServiceStatus::Draft->value;
        $data['is_active'] = $data['status'] === ServiceStatus::Published->value;
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($data['featured_on_home']) {
            $featuredCount = Service::where('featured_on_home', true)
                ->where('id', '!=', $service->id)
                ->count();
            if ($featuredCount >= $this->featuredHomeLimit) {
                return back()
                    ->withErrors(['featured_on_home' => __('Maksimal :max layanan dapat tampil di home. Nonaktifkan salah satunya terlebih dahulu.', ['max' => $this->featuredHomeLimit])])
                    ->withInput();
            }
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
        if ($service->posts()->exists()) {
            return redirect()
                ->route('backend.services.index')
                ->withErrors(['service' => __('Layanan ini sedang dipakai pada Our Work dan tidak dapat dihapus.')]);
        }

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

    public function trashed()
    {
        $module_name = 'services';
        $module_path = 'backend';
        $module_title = 'Services';
        $module_icon = 'fa-solid fa-briefcase';
        $module_action = 'Trash';

        $services = Service::onlyTrashed()
            ->orderByDesc('deleted_at')
            ->paginate(15);

        $$module_name = $services;

        return view('backend.services.trashed', [
            $module_name => $$module_name,
            'module_name' => $module_name,
            'module_path' => $module_path,
            'module_title' => $module_title,
            'module_icon' => $module_icon,
            'module_action' => $module_action,
        ]);
    }

    public function restore($id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore();

        if ($service->featured_on_home) {
            $featuredCount = Service::where('featured_on_home', true)->count();
            if ($featuredCount > $this->featuredHomeLimit) {
                $service->featured_on_home = false;
            }
        }

        // Ensure legacy is_active flag stays in sync with status.
        $service->is_active = $service->status === ServiceStatus::Published->value;
        $service->save();

        return redirect()
            ->route('backend.services.index')
            ->with('status', __('Service restored'));
    }

    public function index_data()
    {
        $services = Service::query()
            ->withCount('posts')
            ->select('id', 'name', 'slug', 'status', 'featured_on_home', 'sort_order', 'updated_at')
            ->orderBy('sort_order')
            ->orderBy('id');

        return DataTables::of($services)
            ->addIndexColumn()
            ->editColumn('name', function ($service) {
                return '<strong>'.e($service->name).'</strong>';
            })
            ->addColumn('usage', function ($service) {
                $count = (int) $service->posts_count;
                $label = $count === 1 ? __('Our Work') : __('Our Works');
                return '<span class="badge bg-info">'.$count.'</span> <span class="text-muted small">'.$label.'</span>';
            })
            ->addColumn('status', function ($service) {
                $status = ServiceStatus::tryFrom($service->status ?? '') ?? ServiceStatus::Draft;
                return match ($status) {
                    ServiceStatus::Published => '<span class="badge bg-success">'.$status->label().'</span>',
                    ServiceStatus::Draft => '<span class="badge bg-warning text-dark">'.$status->label().'</span>',
                    ServiceStatus::Unpublished => '<span class="badge bg-secondary">'.$status->label().'</span>',
                };
            })
            ->addColumn('featured', function ($service) {
                return $service->featured_on_home
                    ? '<span class="badge bg-primary">'.__('Ya').'</span>'
                    : '<span class="badge bg-secondary">'.__('Tidak').'</span>';
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
            ->rawColumns(['name', 'usage', 'status', 'featured', 'action'])
            ->make(true);
    }
}
