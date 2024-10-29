@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-border bg-input text-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm']) }}>
