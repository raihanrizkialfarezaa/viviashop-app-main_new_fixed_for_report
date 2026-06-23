@props([
    'icon' => 'boxes',
    'number' => '0',
    'label' => 'Items',
    'color' => 'green',     // 'green' | 'teal' | 'amber' | 'blue'
])

<div class="stat-card h-100">
    <div class="stat-icon stat-icon--{{ $color }}">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div class="stat-number">{{ $number }}</div>
    <div class="text-muted fw-semibold">{{ $label }}</div>
</div>
