<div>
    <ol class="breadcrumb">
        @foreach ($items as $crumb)
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
