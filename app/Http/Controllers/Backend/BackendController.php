<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\User;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Quick Stats - 6 cards
        $stats = [
            'sliders' => [
                'count' => $this->safeCount('Modules\\Slider\\Models\\Slider', 'is_active', true),
                'label' => 'Sliders',
                'icon' => 'fa-solid fa-images',
                'color' => 'primary',
                'route' => 'backend.sliders.index',
            ],
            'ourworks' => [
                'count' => $this->safeCount('Modules\\Post\\Models\\Post', 'status', 'Published'),
                'label' => 'Our Works',
                'icon' => 'fa-solid fa-briefcase',
                'color' => 'danger',
                'route' => 'backend.posts.index',
            ],
            'services' => [
                'count' => $this->safeCount('App\\Models\\Service', 'is_active', true),
                'label' => 'Services',
                'icon' => 'fa-solid fa-cogs',
                'color' => 'warning',
                'route' => 'backend.services.index',
            ],
            'faq' => [
                'count' => Faq::count(),
                'label' => 'FAQ',
                'icon' => 'fa-regular fa-circle-question',
                'color' => 'info',
                'route' => 'backend.faq.index',
            ],
            'clientlogos' => [
                'count' => $this->safeCount('Modules\\ClientLogo\\Models\\ClientLogo', 'is_active', true),
                'label' => 'Client Logos',
                'icon' => 'fa-solid fa-building',
                'color' => 'secondary',
                'route' => 'backend.clientlogos.index',
            ],
            'users' => [
                'count' => User::count(),
                'label' => 'Users',
                'icon' => 'fa-solid fa-users',
                'color' => 'dark',
                'route' => 'backend.users.index',
            ],
        ];

        // Quick Actions
        $quickActions = [
            [
                'label' => 'Settings Profile',
                'icon' => 'fa-solid fa-user-pen',
                'route' => 'frontend.users.profileEdit',
                'color' => 'secondary',
            ],
            [
                'label' => 'Add Slider',
                'icon' => 'fa-solid fa-plus',
                'route' => 'backend.sliders.create',
                'color' => 'primary',
            ],
            [
                'label' => 'Add Our Work',
                'icon' => 'fa-solid fa-plus',
                'route' => 'backend.posts.create',
                'color' => 'danger',
            ],
            [
                'label' => 'Add Service',
                'icon' => 'fa-solid fa-plus',
                'route' => 'backend.services.create',
                'color' => 'warning',
            ],
        ];

        // Recent Updates
        $recentUpdates = $this->getRecentUpdates();

        return view('backend.index', compact('stats', 'quickActions', 'recentUpdates'));
    }

    /**
     * Safely count records from a model with optional where clause
     */
    private function safeCount(string $modelClass, ?string $column = null, $value = null): int
    {
        try {
            if (!class_exists($modelClass)) {
                return 0;
            }
            
            $query = $modelClass::query();
            
            if ($column !== null) {
                $query->where($column, $value);
            }
            
            return $query->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get recent updates from various modules
     */
    private function getRecentUpdates(): array
    {
        $updates = [];

        // Recent Sliders
        if (class_exists('Modules\\Slider\\Models\\Slider')) {
            try {
                $sliders = \Modules\Slider\Models\Slider::orderBy('updated_at', 'desc')->take(2)->get();
                foreach ($sliders as $item) {
                    $updates[] = [
                        'type' => 'Slider',
                        'name' => $item->title ?? 'Slider #'.$item->id,
                        'time' => $item->updated_at,
                        'icon' => 'fa-solid fa-images',
                        'color' => 'primary',
                        'route' => route('backend.sliders.edit', $item->id),
                    ];
                }
            } catch (\Exception $e) {}
        }

        // Recent Services
        if (class_exists('Modules\\Service\\Models\\Service')) {
            try {
                $services = \Modules\Service\Models\Service::orderBy('updated_at', 'desc')->take(2)->get();
                foreach ($services as $item) {
                    $updates[] = [
                        'type' => 'Service',
                        'name' => $item->name ?? 'Service #'.$item->id,
                        'time' => $item->updated_at,
                        'icon' => 'fa-solid fa-cogs',
                        'color' => 'warning',
                        'route' => route('backend.services.edit', $item->id),
                    ];
                }
            } catch (\Exception $e) {}
        }

        // Recent FAQ
        try {
            $faqs = Faq::orderBy('updated_at', 'desc')->take(2)->get();
            foreach ($faqs as $item) {
                $updates[] = [
                    'type' => 'FAQ',
                    'name' => \Str::limit($item->question ?? 'FAQ #'.$item->id, 30),
                    'time' => $item->updated_at,
                    'icon' => 'fa-regular fa-circle-question',
                    'color' => 'info',
                    'route' => route('backend.faq.edit', $item->id),
                ];
            }
        } catch (\Exception $e) {}

        // Sort by time and take latest 5
        usort($updates, fn($a, $b) => $b['time'] <=> $a['time']);
        
        return array_slice($updates, 0, 5);
    }
}
