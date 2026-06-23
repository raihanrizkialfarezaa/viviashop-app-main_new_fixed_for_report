@props([
    'kicker' => null,
    'title' => null,
    'subtitle' => null,
    'titleClass' => '',
    'link' => null,        // ['url' => string, 'label' => string, 'icon' => string|null]
    'align' => 'start',     // 'start' | 'center'
    'row' => false,         // if true, renders in row layout with CTA on right
])

<div class="v-section-header {{ $align === 'center' ? 'text-center align-items-center' : '' }} mb-5">
    @if($kicker)
        <span class="v-kicker mb-2">{!! $kicker !!}</span>
    @endif

    <div class="{{ $row ? 'd-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4' : '' }}">
        <div class="v-section-header-content">
            @if($title)
                <h2 class="v-section-title title-gradient {{ $titleClass }}" style="font-size: clamp(1.35rem, 2.5vw, 1.65rem);">
                    {{ $title }}
                </h2>
            @endif

            @if($subtitle)
                <p class="v-section-subtitle {{ $align === 'center' ? 'mx-auto' : '' }}" style="max-width: 480px;">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        @if($link)
            <div class="v-section-header-cta">
                <a href="{{ $link['url'] }}" class="btn-glass product-section-cta">
                    {{ $link['label'] }}
                    @if(isset($link['icon']))
                        <i class="{{ $link['icon'] }}"></i>
                    @else
                        <i class="fas fa-arrow-right"></i>
                    @endif
                </a>
            </div>
        @endif
    </div>
</div>
