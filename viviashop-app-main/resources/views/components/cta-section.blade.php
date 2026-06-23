@props([
    'kicker' => null,
    'kickerIcon' => null,
    'title' => 'CTA Title',
    'description' => '',
    'actionText' => 'Get Started',
    'actionUrl' => '#',
    'actionIcon' => null,
    'extra' => null,        // extra HTML/content after description
])

<div class="social-section shadow-lg">
    <div class="row align-items-center position-relative z-2">
        <div class="col-lg-6 mb-5 mb-lg-0">
            @if($kicker)
                <div class="social-kicker">
                    @if($kickerIcon)<i class="{{ $kickerIcon }} fs-5"></i>@endif
                    {{ $kicker }}
                </div>
            @endif
            <h2 class="fw-bold mb-3 text-white" style="font-size: clamp(1.4rem, 2.5vw, 1.8rem);">{!! $title !!}</h2>
            <p class="mb-4 pe-lg-5" style="color: rgba(255,255,255,0.8); font-size: 0.95rem;">
                {!! $description !!}
            </p>
            {!! $extra !!}
            <a href="{{ $actionUrl }}" target="_blank" class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-sm" style="color: var(--v-primary); font-size: 0.9rem;">
                @if($actionIcon)<i class="{{ $actionIcon }} me-2"></i>@endif
                {{ $actionText }}
            </a>
        </div>
        <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end">
            {{ $slot }}
        </div>
    </div>
</div>
