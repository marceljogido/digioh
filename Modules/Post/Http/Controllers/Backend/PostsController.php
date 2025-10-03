<?php

namespace Modules\Post\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Post\Enums\PostStatus;

class PostsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Posts';

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
            'image' => 'nullable|max:191',
            'service_id' => 'nullable|integer',
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_start_date',
            'event_location' => 'nullable|max:191',
            'is_featured' => 'boolean',
            'status' => Rule::enum(PostStatus::class),
            'published_at' => 'required|date',
        ]);

        $data = $validated_data;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['created_by_name'] = auth()->user()->name;

        $$module_name_singular = $module_model::create($data);

        flash("New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect("admin/{$module_name}");
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

        $validated_data = $request->validate([
            'name' => 'required|max:191',
            'slug' => 'nullable|max:191',
            'intro' => 'required',
            'content' => 'required',
            'image' => 'nullable|max:191',
            'service_id' => 'nullable|integer',
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_start_date',
            'event_location' => 'nullable|max:191',
            'is_featured' => 'boolean',
            'status' => Rule::enum(PostStatus::class),
            'published_at' => 'required|date',
        ]);

        $data = $validated_data;
        $data['is_featured'] = $request->boolean('is_featured');

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->update($data);

        flash(Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }
}