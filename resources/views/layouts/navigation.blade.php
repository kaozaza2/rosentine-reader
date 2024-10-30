<nav x-data="{ open: false }" class="sticky top-0 bg-component border-b border-border">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Hamburger -->
            <div class="-ms-2 flex items-center sm:hidden">
                <button @click="open = !open" class="group inline-flex flex-col items-center justify-center px-2.5 py-3 rounded-md hover:bg-gray-900 focus:outline-none focus:bg-gray-900 transition duration-150 ease-in-out">
                    <span :class="{'rotate-225 translate-y-1.5': open}" class="block w-5 h-0.5 transition-all duration-300 rounded bg-gray-500 group-hover:bg-gray-400 group-focus:bg-gray-200"></span>
                    <span :class="{'opacity-0': open}" class="block w-5 h-0.5 transition-all duration-300 my-1 rounded bg-gray-500 group-hover:bg-gray-400 group-focus:bg-gray-200"></span>
                    <span :class="{'-rotate-225 -translate-y-1.5': open}" class="block w-5 h-0.5 transition-all duration-300 rounded bg-gray-500 group-hover:bg-gray-400 group-focus:bg-gray-200"></span>
                </button>
            </div>

            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a class="animate-fadeInTop" href="{{ route('home') }}">
                        <span class="block h-9 w-auto fill-current uppercase text-4xl text-normal font-head font-bold">
                            {{ config('app.name', 'Rosentine') }}
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('front.menu.home') }}
                    </x-nav-link>

                    <x-nav-link href="#" :active="false">
                        {{ __('front.menu.list') }}
                    </x-nav-link>

                    <x-nav-link href="#" :active="false">
                        {{ __('front.menu.bookmark') }}
                    </x-nav-link>

                    <x-nav-link href="#" :active="false">
                        {{ __('front.menu.completed') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-head font-medium rounded-md text-muted bg-component hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('front.menu.profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('front.menu.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
           @endauth

            <div class="-me-2 w-10 flex items-center sm:hidden">
                @auth
                <a href="#" class="inline-flex items-center justify-center p-2 rounded-md text-red-600 hover:text-red-700 hover:bg-gray-900 focus:outline-none focus:bg-gray-900 focus:text-red-500 transition duration-150 ease-in-out">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 hover:animate-pulse focus:animate-pulse">
                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                    </svg>
                </a>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-muted hover:bg-gray-900 focus:outline-none focus:bg-gray-900 focus:text-gray-200 transition duration-150 ease-in-out">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="-translate-x-2"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-2"
        style="display: none;"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('front.menu.home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#" :active="false">
                {{ __('front.menu.list') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#" :active="false">
                {{ __('front.menu.bookmark') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#" :active="false">
                {{ __('front.menu.completed') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-divider">
            <div class="px-4">
                <div class="font-head font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-head font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('front.menu.profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('front.menu.logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
