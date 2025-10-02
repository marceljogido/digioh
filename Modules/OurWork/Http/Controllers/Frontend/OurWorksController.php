<?php

namespace Modules\OurWork\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\Post\Models\Post;
use App\Models\Service;

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
        $query = Post::published()->recentlyPublished()->with('service');

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

        $posts = $query->paginate(9)->withQueryString();

        // For filter dropdown
        $services = Service::active()->sorted()->get(['id','name','slug']);

        return view(
            "$module_path.$module_name.index",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', 'posts', 'services', 'activeService')
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
