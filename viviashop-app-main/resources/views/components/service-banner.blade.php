@props([
    'color' => 'emerald',       // 'emerald' | 'amber' | 'blue'
    'icon' => 'boxes',
    'iconColor' => 'text-success',
    'title' => 'Service',
    'description' => '',
    'badge' => null,
    'badgeStyle' => 'sun',      // 'sun' | 'mint' | 'rose'
    'watermark' => null,
    'watermarkPos' => 'bottom-right', // 'bottom-right' | 'top-left' | 'top-right'
    'offset' => false,
    'meta' => [],               // array of ['icon' => string, 'text' => string]
])

<div class="service-banner service-banner--{{ $color }} {{ $offset ? 'service-banner--offset' : '' }}">
    @if($watermark)
        <i class="fas fa-{{ $watermark }} service-watermark service-watermark--{{ $watermarkPos }}"></i>
    @endif
    <div class="service-banner-body">
        <div class="service-banner-top">
            <div class="service-icon-orb">
                <div class="service-icon-inner">
                    <i class="fas fa-{{ $icon }} {{ $iconColor }}"></i>
                </div>
            </div>
            @if($badge)
                <span class="service-badge service-badge--{{ $badgeStyle }}">{{ $badge }}</span>
            @endif
        </div>
        <div class="service-copy">
            <h3 class="service-title">{{ $title }}</h3>
            <p class="service-description">{{ $description }}</p>
        </div>
        @if(count($meta) > 0)
            <div class="service-meta">
                @foreach($meta as $m)
                    <span class="service-meta-item">
                        <i class="fas fa-{{ $m['icon'] }}"></i> {{ $m['text'] }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
</div>
