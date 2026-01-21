<?php

namespace App\Http\Controllers\Backend;

use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
        $translationRules = array_merge(
            $this->translatableRules('name', true, 191),
            $this->translatableRules('description', false),
            $this->translatableRules('button_text', false, 50),
            $this->translatableRules('features', false), 
            $this->translatableRules('price', false, 100),
            $this->translatableRules('price_note', false, 255)
        );

        $data = $request->validate($translationRules + [
            'slug' => 'nullable|string|max:191',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status' => ['required', Rule::enum(ServiceStatus::class)],
            'featured_on_home' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'video_url' => 'nullable|url|max:255',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'remove_gallery' => 'nullable|array',
        ]);

        $imageFile = $data['image'] ?? null;
        $imageFile = $data['image'] ?? null;
        $galleryFiles = $request->file('gallery_images');
        
        unset($data['image'], $data['video_path'], $data['gallery_images'], $data['remove_gallery']);

        $data['name'] = normalize_translations($request->input('name', []));
        $data['description'] = normalize_translations($request->input('description', []), allowEmpty: true);
        $data['button_text'] = normalize_translations($request->input('button_text', []), allowEmpty: true);
        $data['price'] = normalize_translations($request->input('price', []), allowEmpty: true);
        $data['price_note'] = normalize_translations($request->input('price_note', []), allowEmpty: true);
        $data['featured_on_home'] = $request->boolean('featured_on_home');
        $data['status'] = $data['status'] ?? ServiceStatus::Draft->value;
        $data['is_active'] = $data['status'] === ServiceStatus::Published->value;
        $data['slug'] = filled($data['slug'])
            ? $data['slug']
            : Str::slug($this->primaryTranslation($data['name']));

        // Process features input (Textarea per locale) -> Array
        $featuresInput = $request->input('features', []);
        $processedFeatures = [];
        foreach (available_locales() as $locale) {
            $raw = $featuresInput[$locale] ?? '';
            if (empty($raw)) continue;
            
            $lines = preg_split('/\r\n|\r|\n/', $raw);
            $cleanLines = [];
            foreach ($lines as $line) {
                // Split each line by comma too is removed to support simpler text based list. 
                // Wait, I should keep it for safety in case they paste comma separated? 
                // The previous legacy logic did. But "One per line" is the instruction.
                // Let's stick to newline for cleanliness.
                $trimmed = trim($line);
                if ($trimmed !== '') {
                    $cleanLines[] = $trimmed;
                }
            }
            if (!empty($cleanLines)) {
                $processedFeatures[$locale] = array_values($cleanLines);
            }
        }
        $data['features'] = $processedFeatures;

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



        // Handle Gallery Uploads
        $galleryPaths = [];
        if ($galleryFiles && is_array($galleryFiles)) {
            foreach ($galleryFiles as $gFile) {
                if ($gFile) {
                    $path = $gFile->store('uploads/services/gallery', 'public');
                    $galleryPaths[] = Storage::url($path);
                }
            }
        }
        $data['gallery_images'] = $galleryPaths;

        if ($videoFile) {
            $path = $videoFile->store('uploads/services/videos', 'public');
            $data['video_path'] = Storage::url($path);
        }

        // Handle Gallery Uploads
        $galleryPaths = [];
        if ($galleryFiles && is_array($galleryFiles)) {
            foreach ($galleryFiles as $gFile) {
                if ($gFile) {
                    $path = $gFile->store('uploads/services/gallery', 'public');
                    $galleryPaths[] = Storage::url($path);
                }
            }
        }
        $data['gallery_images'] = $galleryPaths;

        if ($videoFile) {
            $path = $videoFile->store('uploads/services/videos', 'public');
            $data['video_path'] = Storage::url($path);
        }

        // Handle Gallery Uploads
        $galleryPaths = [];
        if ($galleryFiles && is_array($galleryFiles)) {
            foreach ($galleryFiles as $gFile) {
                if ($gFile) {
                    $path = $gFile->store('uploads/services/gallery', 'public');
                    $galleryPaths[] = Storage::url($path);
                }
            }
        }
        $data['gallery_images'] = $galleryPaths; // For new create, simply set the array

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
        $translationRules = array_merge(
            $this->translatableRules('name', true, 191),
            $this->translatableRules('description', false),
            $this->translatableRules('button_text', false, 50),
            $this->translatableRules('features', false),
            $this->translatableRules('price', false, 100),
            $this->translatableRules('price_note', false, 255)
        );

        $data = $request->validate($translationRules + [
            'slug' => 'nullable|string|max:191',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status' => ['required', Rule::enum(ServiceStatus::class)],
            'featured_on_home' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'video_url' => 'nullable|url|max:255',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'remove_gallery' => 'nullable|array',
        ]);

        $imageFile = $data['image'] ?? null;
        $galleryFiles = $request->file('gallery_images');
        $removeGallery = $request->input('remove_gallery', []);
        
        unset($data['image'], $data['gallery_images'], $data['remove_gallery']);

        $data['name'] = normalize_translations($request->input('name', []));
        $data['description'] = normalize_translations($request->input('description', []), allowEmpty: true);
        $data['button_text'] = normalize_translations($request->input('button_text', []), allowEmpty: true);
        $data['price'] = normalize_translations($request->input('price', []), allowEmpty: true);
        $data['price_note'] = normalize_translations($request->input('price_note', []), allowEmpty: true);
        $data['featured_on_home'] = $request->boolean('featured_on_home');
        $data['status'] = $data['status'] ?? ServiceStatus::Draft->value;
        $data['is_active'] = $data['status'] === ServiceStatus::Published->value;
        $data['slug'] = filled($data['slug'])
            ? $data['slug']
            : Str::slug($this->primaryTranslation($data['name']));

        // Process features input (Textarea per locale) -> Array
        $featuresInput = $request->input('features', []);
        $processedFeatures = [];
        foreach (available_locales() as $locale) {
            $raw = $featuresInput[$locale] ?? '';
            if (empty($raw)) continue;
            
            $lines = preg_split('/\r\n|\r|\n/', $raw);
            $cleanLines = [];
            foreach ($lines as $line) {
                $trimmed = trim($line);
                if ($trimmed !== '') {
                    $cleanLines[] = $trimmed;
                }
            }
            if (!empty($cleanLines)) {
                $processedFeatures[$locale] = array_values($cleanLines);
            }
        }
        $data['features'] = $processedFeatures;

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



        // Handle Gallery
        $currentGallery = $service->gallery_images ?? [];
        
        // Remove deleted items
        if (!empty($removeGallery)) {
            $currentGallery = array_diff($currentGallery, $removeGallery);
        }

        // Add new items
        if ($galleryFiles && is_array($galleryFiles)) {
            foreach ($galleryFiles as $gFile) {
                if ($gFile) {
                    $path = $gFile->store('uploads/services/gallery', 'public');
                    $currentGallery[] = Storage::url($path);
                }
            }
        }
        
        $data['gallery_images'] = array_values($currentGallery);

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
            ->select('id', 'name', 'slug', 'status', 'featured_on_home', 'sort_order', 'updated_at');

        return DataTables::of($services)
            ->addIndexColumn()
            ->editColumn('name', function ($service) {
                $sourceLocale = config('translatable.source_locale', 'id');
                $secondaryLocale = $this->secondaryLocale();

                $primary = e($service->getTranslation('name', $sourceLocale));
                $html = '<strong>'.$primary.'</strong>';

                if ($secondaryLocale !== $sourceLocale) {
                    $secondary = $service->getTranslation('name', $secondaryLocale, false);
                    if ($secondary && $secondary !== $service->getTranslation('name', $sourceLocale, false)) {
                        $html .= '<div class="text-muted small">'.strtoupper($secondaryLocale).': '.e($secondary).'</div>';
                    }
                }

                return $html;
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

    private function translatableRules(string $field, bool $fieldRequired = true, ?int $maxLength = null): array
    {
        $rules = [
            $field => [$fieldRequired ? 'required' : 'nullable', 'array'],
        ];

        $sourceLocale = config('translatable.source_locale', 'id');

        foreach (available_locales() as $locale) {
            $localeRules = [
                ($fieldRequired && $locale === $sourceLocale) ? 'required' : 'nullable',
                'string',
            ];

            if ($maxLength) {
                $localeRules[] = 'max:'.$maxLength;
            }

            $rules["{$field}.{$locale}"] = $localeRules;
        }

        return $rules;
    }

    private function primaryTranslation(array $translations): string
    {
        $sourceLocale = config('translatable.source_locale', 'id');

        return $translations[$sourceLocale] ?? Arr::first($translations) ?? '';
    }

    private function secondaryLocale(): string
    {
        $sourceLocale = config('translatable.source_locale', 'id');

        foreach (available_locales() as $locale) {
            if ($locale !== $sourceLocale) {
                return $locale;
            }
        }

        return $sourceLocale;
    }
}
