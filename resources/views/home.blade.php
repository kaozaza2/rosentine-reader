<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-normal font-head leading-tight">
            {{ __('Latest Updates.') }}
        </h2>
    </x-slot>

    <div class="py-12 px-2 lg:px-0">
        <div class="grid grid-cols-4 md:grid-cols-6 items-start gap-2">

            @for($h=0;$h<8;$h++)
            <!-- Comic Item -->
            <a href="#" title="Your Majesty, Please Spare Me This Time" class="group flex flex-col overflow-hidden">
                <!-- Cover Image -->
                <img src="https://www.mangakimi.com/wp-content/uploads/2024/05/6a3d1a76b5e2eb8594abdd5d09f06ab4-1.jpg" alt="Shadows of the Abyss" class="rounded mb-1 w-full h-auto object-cover">

                <div class="px-1.5 py-1 flex-grow rounded group-hover:bg-component trasition-all duration-300">

                    <!-- Comic Title -->
                    <h2 class="text-sm text-normal font-medium line-clamp-2 break-all">Your Majesty, Please Spare Me This Time</h2>
                    <!-- Last Episode Name -->
                    <p class="text-sm text-muted line-clamp-1">Chapter 157</p>
                    <!-- Update Info -->
                    <p class="text-xs text-muted">2 weeks ago</p>
                    <!-- Stars Rating -->
                    <div class="flex justify-between items-center mt-2 text-yellow-500">
                        @for($i=0;$i<5;$i++)
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                        </svg>
                        @endfor
                    </div>
                </div>
            </a>
            @endfor

        </div>
    </div>
</x-app-layout>
