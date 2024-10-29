@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-primary-600 text-start text-base font-head font-medium text-primary-300 bg-primary-900/50 focus:outline-none focus:text-primary-200 focus:bg-primary-900 focus:border-primary-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-head font-medium text-muted hover:text-gray-200 hover:bg-gray-700 hover:border-divider focus:outline-none focus:text-gray-200 focus:bg-gray-700 focus:border-divider transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
