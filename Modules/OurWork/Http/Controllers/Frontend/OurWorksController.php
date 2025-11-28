<?php

namespace Modules\OurWork\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\Post\Models\Post;

class OurWorksController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'OurWorks';

        // module name
        $this->module_name = 'ourworks';

        // directory path of the module
        $this->module_path = 'ourwork::frontend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\OurWork\Models\OurWork";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        // Our Work page lists Posts (case studies/portfolio)
        $query = Post::query()
            ->where('is_our_work', true)
            ->with(['services'])
            ->orderByDesc('event_start_date')
            ->orderByDesc('published_at');

        // Filter: search text
        if ($request->filled('q')) {
            $q = trim($request->get('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('intro', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        // Filter: by service slug
        $activeService = null;
        if ($request->filled('service')) {
            $activeService = Service::where('slug', $request->get('service'))->first();
            if ($activeService) {
                $query->where('service_id', $activeService->id);
            }
        }

        if ($request->filled('year')) {
            $year = (int) $request->get('year');
            if ($year >= 2000 && $year <= (int) date('Y') + 1) {
                $query->where(function ($sub) use ($year) {
                    $sub->whereYear('event_start_date', $year)
                        ->orWhere(function ($inner) use ($year) {
                            $inner->whereNull('event_start_date')
                                ->whereYear('published_at', $year);
                        });
                });
            }
        }

        $perPageOptions = [6, 9, 12, 15];
        $perPage = (int) $request->input('per_page', 9);
        if (! in_array($perPage, $perPageOptions, true)) {
            $perPage = 9;
        }

        $posts = $query->paginate($perPage)->withQueryString();

        // For filter dropdown
        $services = Service::active()->sorted()->get(['id','name','slug']);
        $years = collect(range(Carbon::now()->year, Carbon::now()->year - 6, -1))->values();

        return view(
            "$module_path.$module_name.index",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', 'posts', 'services', 'activeService', 'years', 'perPage', 'perPageOptions')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Redirect to the corresponding Post show page using the decoded ID
        $decodedId = decode_id($id);
        $post = Post::find($decodedId);
        if (! $post) {
            abort(404);
        }
        return redirect()->route('frontend.posts.show', [encode_id($post->id), $post->slug]);
    }
}
