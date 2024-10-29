<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-normal leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-component overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-normal">
                    {{ __('Welcome to admin dashboard.') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
