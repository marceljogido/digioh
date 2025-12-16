<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class StatController extends Controller
{
    protected string $module_title = 'Statistics';
    protected string $module_name = 'stats';
    protected string $module_path = 'stats';
    protected string $module_icon = 'fa-solid fa-chart-simple';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_action = 'List';

        return view('backend.stats.index', compact(
            'module_title',
            'module_name',
            'module_path',
            'module_icon',
            'module_action'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        return view('backend.stats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        $data = $request->validate(array_merge(
            $this->translatableRules('label', true, 255),
            [
                'value' => 'required|string|max:255',
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'boolean',
            ]
        ));

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['label'] = normalize_translations($request->input('label', []));

        Stat::create($data);

        return redirect()->route('backend.stats.index')->with('message', 'Statistik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stat $stat)
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        return view('backend.stats.edit', compact('stat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stat $stat)
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        $data = $request->validate(array_merge(
            $this->translatableRules('label', true, 255),
            [
                'value' => 'required|string|max:255',
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'boolean',
            ]
        ));

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['label'] = normalize_translations($request->input('label', []));

        $stat->update($data);

        return redirect()->route('backend.stats.index')->with('message', 'Statistik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stat $stat)
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        $stat->delete();

        return redirect()->route('backend.stats.index')->with('message', 'Statistik berhasil dihapus.');
    }

    public function show(Stat $stat)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_action = 'Show';

        return view('backend.stats.show', compact(
            'stat',
            'module_title',
            'module_name',
            'module_path',
            'module_icon',
            'module_action'
        ));
    }

    public function index_data()
    {
        $stats = Stat::select('id', 'value', 'label', 'sort_order', 'is_active', 'updated_at')
            ->orderBy('sort_order')
            ->orderBy('id');

        return DataTables::of($stats)
            ->addIndexColumn()
            ->editColumn('label', function ($stat) {
                $sourceLocale = config('translatable.source_locale', 'id');
                $secondaryLocale = $this->secondaryLocale();

                $primary = e($stat->getTranslation('label', $sourceLocale));
                $html = '<strong>'.$primary.'</strong>';

                if ($secondaryLocale !== $sourceLocale) {
                    $secondary = $stat->getTranslation('label', $secondaryLocale, false);
                    if ($secondary && $secondary !== $stat->getTranslation('label', $sourceLocale, false)) {
                        $html .= '<div class="text-muted small">'.strtoupper($secondaryLocale).': '.e($secondary).'</div>';
                    }
                }

                return $html;
            })
            ->addColumn('status', function ($stat) {
                return $stat->is_active
                    ? '<span class="badge bg-success">'.__('Active').'</span>'
                    : '<span class="badge bg-secondary">'.__('Inactive').'</span>';
            })
            ->editColumn('updated_at', function ($stat) {
                if (! $stat->updated_at) {
                    return 'N/A';
                }

                $diff = Carbon::now()->diffInHours($stat->updated_at);

                return $diff < 25
                    ? $stat->updated_at->diffForHumans()
                    : $stat->updated_at->isoFormat('llll');
            })
            ->addColumn('action', function ($stat) {
                return view('backend.stats.partials.actions', compact('stat'))->render();
            })
            ->rawColumns(['label', 'status', 'action'])
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

    /**
     * Display a list of trashed items.
     */
    public function trashed()
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_action = 'Trash';

        $$module_name = Stat::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        return view('backend.stats.trash', compact(
            'module_title',
            'module_name',
            'module_path',
            'module_icon',
            'module_action',
            $module_name
        ));
    }

    /**
     * Restore a trashed item.
     */
    public function restore($id)
    {
        if (! Auth::check() || ! Auth::user()->can('view_backend')) {
            abort(403);
        }

        $stat = Stat::onlyTrashed()->findOrFail($id);
        $stat->restore();

        return redirect()->route('backend.stats.trashed')->with('message', 'Statistik berhasil dikembalikan.');
    }
}
