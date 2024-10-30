<section class="space-y-6">
    <header>
        <h2 class="text-lg font-head font-medium text-normal">
            {{ __('profile.delete.title') }}
        </h2>

        <p class="mt-1 text-sm text-muted">
            {{ __('profile.delete.description') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('profile.delete.delete') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-head font-medium text-normal">
                {{ __('profile.delete.confirm-title') }}
            </h2>

            <p class="mt-1 text-sm text-muted">
                {{ __('profile.delete.confirm-description') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('profile.delete.input-password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('profile.delete.input-password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('profile.delete.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('profile.delete.delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
