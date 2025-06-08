@props(['title', 'value', 'icon', 'color' => 'primary', 'change' => null, 'changeType' => 'neutral'])

<div class="card text-{{ $color === 'primary' ? 'white' : 'dark' }} bg-{{ $color }} mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="card-title mb-1">{{ $title }}</h6>
                <h2 class="mb-0 fw-bold">{{ $value }}</h2>
                @if($change)
                    <small class="d-block mt-1">
                        @if($changeType === 'positive')
                            <i class="bi bi-arrow-up text-success"></i>
                        @elseif($changeType === 'negative')
                            <i class="bi bi-arrow-down text-danger"></i>
                        @else
                            <i class="bi bi-arrow-right"></i>
                        @endif
                        {{ $change }}
                    </small>
                @endif
            </div>
            @if($icon)
                <div class="opacity-75">
                    <i class="bi {{ $icon }} fs-1"></i>
                </div>
            @endif
        </div>
    </div>
</div>
