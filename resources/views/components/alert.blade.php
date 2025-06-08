@props(['type' => 'info', 'dismissible' => true, 'icon' => null])

@php
    $typeClasses = [
        'success' => 'alert-success',
        'danger' => 'alert-danger',
        'warning' => 'alert-warning', 
        'info' => 'alert-info',
        'primary' => 'alert-primary',
        'secondary' => 'alert-secondary',
        'light' => 'alert-light',
        'dark' => 'alert-dark'
    ];
    
    $iconMap = [
        'success' => 'bi-check-circle-fill',
        'danger' => 'bi-exclamation-triangle-fill',
        'warning' => 'bi-exclamation-triangle-fill',
        'info' => 'bi-info-circle-fill',
        'primary' => 'bi-info-circle-fill',
        'secondary' => 'bi-info-circle-fill',
        'light' => 'bi-info-circle-fill',
        'dark' => 'bi-info-circle-fill'
    ];
    
    $alertClass = $typeClasses[$type] ?? 'alert-info';
    $iconClass = $icon ?? $iconMap[$type] ?? 'bi-info-circle-fill';
@endphp

<div class="alert {{ $alertClass }} {{ $dismissible ? 'alert-dismissible' : '' }} fade show" role="alert">
    @if($icon !== false)
        <i class="bi {{ $iconClass }} me-2"></i>
    @endif
    
    {{ $slot }}
    
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
