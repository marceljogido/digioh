<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Modules\Post\Models\Post;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->sorted()->get();
        return view('frontend.services.index', compact('services'));
    }

    public function show(Service $service)
    {
        $posts = Post::published()->where('service_id', $service->id)->recentlyPublished()->paginate(9);
        return view('frontend.services.show', compact('service', 'posts'));
    }
}

