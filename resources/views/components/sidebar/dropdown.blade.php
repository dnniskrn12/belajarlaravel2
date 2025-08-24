@props([
    'title',
    'icon' => 'mdi mdi-circle',
    'id',
    'items' => []
])

<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#{{ $id }}" aria-expanded="false" aria-controls="{{ $id }}">
        <span class="menu-title">{{ $title }}</span>
        <i class="menu-arrow"></i>
        <i class="{{ $icon }} menu-icon"></i>
    </a>
    <div class="collapse" id="{{ $id }}" data-bs-parent="#sidebar">
        <ul class="nav flex-column sub-menu">
            @foreach ($items as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $item['url'] }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
