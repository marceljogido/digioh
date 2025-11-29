<?php

namespace Modules\Post\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Modules\Post\Enums\PostStatus;
use Yajra\DataTables\Facades\DataTables;

class PostsController extends BackendBaseController
{
    use Authorizable;

    protected int $featuredLimit = 3;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Our Works';

        // module name
        $this->module_name = 'posts';

        // directory path of the module
        $this->module_path = 'post::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-file-lines';

        // module model name, path
        $this->module_model = "Modules\Post\Models\Post";
    }

    /**
     * Store a new resource in the database.
     *
     * @param  Request  $request  The request object containing the data to be stored.
     * @return RedirectResponse The response object that redirects to the index page of the module.
     *
     * @throws Exception If there is an error during the creation of the resource.
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $validated_data = $request->validate([
            'name' => 'required|max:191',
            'slug' => 'nullable|max:191',
            'intro' => 'required',
            'content' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'service_ids' => ['nullable', 'array'],
            'service_ids.*' => ['integer', 'exists:services,id'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['file', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_start_date',
            'event_location' => 'nullable|max:191',
            'scope_of_work' => 'nullable|string',
            'highlight_video_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
            'status' => Rule::enum(PostStatus::class),
            'published_at' => 'required|date',
        ]);

        $data = collect($validated_data)->except([
            'image',
            'service_ids',
            'gallery_images',
        ])->toArray();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_our_work'] = true;
        $data['our_work_sort_order'] = 0;
        $data['created_by_name'] = auth()->user()->name;
        $serviceIds = collect($request->input('service_ids', []))
            ->filter(function ($id) {
                return is_numeric($id) && (int) $id > 0;
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values()
            ->all();

        if ($data['is_featured'] && $module_model::where('is_featured', true)->count() >= $this->featuredLimit) {
            return back()
                ->withErrors(['is_featured' => __('Maksimal :max konten dapat ditampilkan di beranda. Nonaktifkan salah satunya terlebih dahulu.', ['max' => $this->featuredLimit])])
                ->withInput();
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images', []) as $galleryFile) {
                if ($galleryFile instanceof UploadedFile) {
                    $galleryPaths[] = $this->storeGalleryImage($galleryFile);
                }
            }
        }
        $data['gallery_images'] = $galleryPaths;

        $data['service_id'] = $serviceIds[0] ?? null;

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeFeaturedImage($request->file('image'));
        }

        $$module_name_singular = $module_model::create($data);
        $$module_name_singular->services()->sync($serviceIds);

        flash("New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect("admin/{$module_name}");
    }

    /**
     * Return DataTable JSON for Our Works listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index_data()
    {
        $request = request();
        $module_model = $this->module_model;

        $posts = $module_model::select([
            'id',
            'name',
            'slug',
            'sort_order',
            'event_start_date',
            'event_end_date',
            'published_at',
            'updated_at',
        ])
            ->orderBy('sort_order')
            ->orderBy('id');

        if ($year = (int) $request->get('year')) {
            $posts->where(function ($query) use ($year) {
                $query->whereYear('event_start_date', $year)
                    ->orWhere(function ($sub) use ($year) {
                        $sub->whereNull('event_start_date')->whereYear('published_at', $year);
                    });
            });
        }

        if ($month = (int) $request->get('month')) {
            $posts->where(function ($query) use ($month) {
                $query->whereMonth('event_start_date', $month)
                    ->orWhere(function ($sub) use ($month) {
                        $sub->whereNull('event_start_date')->whereMonth('published_at', $month);
                    });
            });
        }

        return DataTables::of($posts)
            ->addIndexColumn()
            ->editColumn('name', function ($post) {
                return '<strong>'.e($post->name).'</strong>';
            })
            ->addColumn('event_period', function ($post) {
                $start = $post->event_start_date;
                $end = $post->event_end_date;
                $fallback = $post->published_at;

                if ($start) {
                    if ($end && !$start->isSameDay($end)) {
                        return $start->isoFormat('D MMM YYYY').' - '.$end->isoFormat('D MMM YYYY');
                    }

                    return $start->isoFormat('D MMM YYYY');
                }

                if ($fallback) {
                    return $fallback->isoFormat('D MMM YYYY');
                }

                return '-';
            })
            ->editColumn('updated_at', function ($post) {
                $diff = Carbon::now()->diffInHours($post->updated_at);

                return $diff < 25
                    ? $post->updated_at->diffForHumans()
                    : $post->updated_at->isoFormat('llll');
            })
            ->orderColumn('event_period', function ($query, $direction) {
                $order = strtolower($direction) === 'asc' ? 'asc' : 'desc';
                $query->orderByRaw('COALESCE(event_start_date, published_at) '.$order);
            })
            ->addColumn('action', function ($post) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', [
                    'module_name' => $module_name,
                    'data' => $post,
                ]);
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    /**
     * Updates a resource.
     *
     * @param  int  $id
     * @param  Request  $request  The request object.
     * @param  mixed  $id  The ID of the resource to update.
     * @return Response
     * @return RedirectResponse The redirect response.
     *
     * @throws ModelNotFoundException If the resource is not found.
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $module_model::findOrFail($id);

        $validated_data = $request->validate([
            'name' => 'required|max:191',
            'slug' => 'nullable|max:191',
            'intro' => 'required',
            'content' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'service_ids' => ['nullable', 'array'],
            'service_ids.*' => ['integer', 'exists:services,id'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['file', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['string'],
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_start_date',
            'event_location' => 'nullable|max:191',
            'scope_of_work' => 'nullable|string',
            'highlight_video_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
            'status' => Rule::enum(PostStatus::class),
            'published_at' => 'required|date',
        ]);

        $data = collect($validated_data)->except([
            'image',
            'gallery_images',
            'remove_gallery',
            'service_ids',
        ])->toArray();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_our_work'] = true;
        $data['our_work_sort_order'] = $$module_name_singular->our_work_sort_order ?? 0;
        $serviceIds = collect($request->input('service_ids', []))
            ->filter(function ($id) {
                return is_numeric($id) && (int) $id > 0;
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values()
            ->all();

        if (
            $data['is_featured']
            && $module_model::where('id', '<>', $$module_name_singular->id)
                ->where('is_featured', true)
                ->count() >= $this->featuredLimit
        ) {
            return back()
                ->withErrors(['is_featured' => __('Maksimal :max konten dapat ditampilkan di beranda. Nonaktifkan salah satunya terlebih dahulu.', ['max' => $this->featuredLimit])])
                ->withInput();
        }

        $gallery = $$module_name_singular->gallery_images ?? [];
        $removeGallery = collect($request->input('remove_gallery', []))->filter();
        if ($removeGallery->count()) {
            foreach ($removeGallery as $removePath) {
                $relative = $this->normaliseGalleryPath($removePath);
                $gallery = array_values(array_filter($gallery, function ($existing) use ($relative) {
                    return $this->normaliseGalleryPath($existing) !== $relative;
                }));
                $this->deleteGalleryImage($relative);
            }
        }
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images', []) as $galleryFile) {
                if ($galleryFile instanceof UploadedFile) {
                    $gallery[] = $this->storeGalleryImage($galleryFile);
                }
            }
        }
        $data['gallery_images'] = array_values(array_unique($gallery));

        if ($request->hasFile('image')) {
            $this->deleteFeaturedImage($$module_name_singular->image);
            $data['image'] = $this->storeFeaturedImage($request->file('image'));
        }

        $data['service_id'] = $serviceIds[0] ?? null;

        $$module_name_singular->update($data);
        $$module_name_singular->services()->sync($serviceIds);

        flash(Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }

    protected function storeFeaturedImage(UploadedFile $file): string
    {
        $path = $file->store('uploads/posts', 'public');

        return Storage::url($path);
    }

    protected function deleteFeaturedImage(?string $path): void
    {
        if (empty($path) || ! Str::startsWith($path, '/storage/')) {
            return;
        }

        $relative = ltrim(Str::after($path, '/storage/'), '/');
        Storage::disk('public')->delete($relative);
    }

    protected function storeGalleryImage(UploadedFile $file): string
    {
        return $file->store('uploads/posts/gallery', 'public');
    }

    protected function deleteGalleryImage(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        $relative = $this->normaliseGalleryPath($path);
        Storage::disk('public')->delete($relative);
    }

    protected function normaliseGalleryPath(string $path): string
    {
        if (Str::startsWith($path, '/storage/')) {
            return ltrim(Str::after($path, '/storage/'), '/');
        }

        if (Str::startsWith($path, 'storage/')) {
            return ltrim(Str::after($path, 'storage/'), '/');
        }

        return ltrim($path, '/');
    }
}
