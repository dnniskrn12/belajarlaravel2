<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="{{ $icon }}"></i>
        </span> {{ $title }}
    </h3>

    {{-- Breadcrumbs --}}
    <ol class="breadcrumb">
    @foreach ($breadcrumbs as $crumb)
        @if ($loop->last)
            <li class="breadcrumb-item active" aria-current="page">{{ $crumb['label'] }}</li>
        @else
            <li class="breadcrumb-item">
                <a href="{{ isset($crumb['route']) ? route($crumb['route']) : ($crumb['url'] ?? '#') }}">
                    {{ $crumb['label'] }}
                </a>
            </li>
        @endif
    @endforeach
</ol>

</div>
