@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-head font-medium text-sm text-green-400']) }}>
        {{ $status }}
    </div>
@endif
