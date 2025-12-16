@extends("backend.layouts.app")

@section("title")
    @lang("Dashboard")
@endsection

@section("breadcrumbs")
    <x-backend.breadcrumbs />
@endsection

@section("content")
    {{-- Welcome Card --}}
    <div class="card mb-4 border-0" style="background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8b 50%, #3a7ab8 100%);">
        <div class="card-body py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1 d-flex align-items-center" style="color: #ffffff;">
                        <i class="fa-solid fa-hand-wave me-2" style="font-size: 1.2rem;"></i>
                        <span>Selamat Datang, {{ Auth::user()->name }}!</span>
                    </h3>
                    <p class="mb-0 ps-4" style="color: rgba(255,255,255,0.85); margin-left: 0.5rem;">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                </div>
                <div class="d-none d-md-block">
                    <img src="{{ asset('img/DIGIOH_Main Logo_Flat Color White.svg') }}" alt="digiOH" style="height: 50px; opacity: 0.9;">
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Stats Cards - 6 cards --}}
    <div class="row mb-4">
        @foreach($stats as $key => $stat)
            <div class="col-6 col-md-4 col-xl-2 mb-3">
                @php
                    $statRoute = Route::has($stat['route']) ? route($stat['route']) : '#';
                @endphp
                <a href="{{ $statRoute }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow" style="transition: all 0.3s ease;">
                        <div class="card-body text-center py-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 50px; height: 50px; background: var(--cui-{{ $stat['color'] }}-bg-subtle, #f0f0f0);">
                                <i class="{{ $stat['icon'] }} fa-lg text-{{ $stat['color'] }}"></i>
                            </div>
                            @if(isset($stat['is_icon']) && $stat['is_icon'])
                                <h3 class="mb-1 fw-bold">{{ $stat['count'] }}</h3>
                            @else
                                <h2 class="mb-1 fw-bold text-{{ $stat['color'] }}">{{ $stat['count'] }}</h2>
                            @endif
                            <p class="text-muted small mb-0">{{ $stat['label'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Quick Actions --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fa-solid fa-bolt me-2 text-warning"></i>
                Quick Actions
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach($quickActions as $action)
                    @if(Route::has($action['route']))
                        <div class="col-6 col-md-3">
                            <a href="{{ route($action['route']) }}" class="btn btn-{{ $action['color'] }} w-100 py-3">
                                <i class="{{ $action['icon'] }} me-2"></i>
                                {{ $action['label'] }}
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- Two Column Section --}}
    <div class="row">
        {{-- Recent Updates --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-clock-rotate-left me-2 text-info"></i>
                        Recent Updates
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(count($recentUpdates) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentUpdates as $update)
                                <a href="{{ $update['route'] }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 36px; height: 36px; background: var(--cui-{{ $update['color'] }}-bg-subtle, #f0f0f0);">
                                            <i class="{{ $update['icon'] }} text-{{ $update['color'] }}"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>{{ $update['name'] }}</strong>
                                                <span class="badge bg-{{ $update['color'] }}">{{ $update['type'] }}</span>
                                            </div>
                                            <small class="text-muted">{{ $update['time']->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa-solid fa-inbox fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No recent updates</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-link me-2 text-primary"></i>
                        Quick Links
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('frontend.index') }}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-globe me-2 text-success"></i> View Website</span>
                            <i class="fa-solid fa-external-link-alt text-muted"></i>
                        </a>
                        <a href="{{ route('backend.settings.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-cog me-2 text-secondary"></i> Settings</span>
                            <i class="fa-solid fa-chevron-right text-muted"></i>
                        </a>
                        <a href="{{ route('backend.backups.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-database me-2 text-info"></i> Backups</span>
                            <i class="fa-solid fa-chevron-right text-muted"></i>
                        </a>
                        <a href="{{ route('backend.users.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-users me-2 text-primary"></i> Manage Users</span>
                            <i class="fa-solid fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
