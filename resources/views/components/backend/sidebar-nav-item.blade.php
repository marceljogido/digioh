@props(["url" => "/", "icon" => "fa-solid fa-cube", "text" => "Menu", "permission" => "view_backend"])

@can($permission)
    <li class="nav-item">
        <a class="nav-link" href="{{ $url }}">
            <i class="nav-icon {{ $icon }} fa-fw"></i>
            <span class="ms-1">{{ $text }}</span>
        </a>
    </li>
@endcan

