@props([
    'icon' => 'map-marker-alt',
    'title' => 'Alamat',
    'detail' => '',
])

<div class="contact-item">
    <div class="contact-icon"><i class="fas fa-{{ $icon }}"></i></div>
    <div>
        <h6 class="fw-bold mb-1" style="color: var(--v-dark);">{{ $title }}</h6>
        <p class="text-muted mb-0 small">{{ $detail }}</p>
    </div>
</div>
