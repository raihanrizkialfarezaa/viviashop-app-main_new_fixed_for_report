@props([
    'icon' => 'star',
    'title' => 'Feature',
    'description' => '',
    'tag' => null,
    'index' => null,
    'foot' => null,         // single text or array
    'delay' => 0,
])

<div class="feature-box animate-up {{ $delay > 0 ? 'delay-'.$delay : '' }}">
    <div class="feature-card-top">
        @if($tag)
            <span class="feature-tag">{{ $tag }}</span>
        @endif
        @if($index)
            <span class="feature-index">{{ $index }}</span>
        @endif
    </div>
    <div class="feature-icon-wrapper">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <h4 class="feature-title fw-bold">{{ $title }}</h4>
    <p class="feature-copy mb-0">{!! $description !!}</p>
    @if($foot)
        <div class="feature-foot">
            @if(is_array($foot))
                @foreach($foot as $item)
                    <span><i class="fas fa-check-circle"></i> {{ $item }}</span>
                @endforeach
            @else
                <span><i class="fas fa-check-circle"></i> {{ $foot }}</span>
            @endif
        </div>
    @endif
</div>
