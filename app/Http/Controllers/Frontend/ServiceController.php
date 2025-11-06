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
        $posts = Post::published()
            ->whereHas('services', function ($query) use ($service) {
                $query->where('services.id', $service->id);
            })
            ->recentlyPublished()
            ->paginate(9);

        $relatedWorks = Post::published()
            ->where('is_our_work', true)
            ->whereHas('services', function ($query) use ($service) {
                $query->where('services.id', $service->id);
            })
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('frontend.services.show', compact('service', 'posts', 'relatedWorks'));
    }
}
