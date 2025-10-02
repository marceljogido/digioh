<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Post\Models\Post;

class OurWorkIndex extends Component
{
    use WithPagination;

    public string $q = '';
    public string $service = '';
    public string $sort = 'newest';
    public int $perPage = 9;
    public string $year = '';
    public string $month = '';

    protected $queryString = [
        'q' => ['except' => ''],
        'service' => ['except' => ''],
        'sort' => ['except' => 'newest'],
        'year' => ['except' => ''],
        'month' => ['except' => ''],
    ];

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::published()->with('service');

        if ($this->q !== '') {
            $q = trim($this->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('intro', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        if ($this->service !== '') {
            $service = Service::where('slug', $this->service)->first();
            if ($service) {
                $query->where('service_id', $service->id);
            }
        }

        // Filter by year/month (use event_* if present, otherwise published_at)
        if ($this->year !== '') {
            $y = (int) $this->year;
            $query->where(function ($sub) use ($y) {
                $sub->whereYear('event_start_date', $y)
                    ->orWhere(function ($q) use ($y) {
                        $q->whereNull('event_start_date')->whereYear('published_at', $y);
                    });
            });
        }
        if ($this->month !== '') {
            $m = (int) $this->month;
            if ($m >= 1 && $m <= 12) {
                $query->where(function ($sub) use ($m) {
                    $sub->whereMonth('event_start_date', $m)
                        ->orWhere(function ($q) use ($m) {
                            $q->whereNull('event_start_date')->whereMonth('published_at', $m);
                        });
                });
            }
        }

        // Sorting
        switch ($this->sort) {
            case 'oldest':
                $query->orderByRaw('COALESCE(event_start_date, published_at) asc');
                break;
            case 'az':
                $query->orderBy('name', 'asc');
                break;
            case 'za':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->orderByRaw('COALESCE(event_start_date, published_at) desc');
                break;
        }

        $posts = $query->paginate($this->perPage);
        $services = Service::active()->sorted()->get(['name','slug']);
        $years = range(now()->year, now()->year - 5);
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return view('livewire.our-work-index', [
            'posts' => $posts,
            'services' => $services,
            'years' => $years,
            'months' => $months,
        ]);
    }

    public function clearFilters(): void
    {
        $this->q = '';
        $this->service = '';
        $this->sort = 'newest';
        $this->resetPage();
    }
}
