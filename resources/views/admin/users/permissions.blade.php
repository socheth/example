<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Edit Permissions') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Permissions') }}
        </h2>
    </x-slot>

    <form method="POST" enctype="multipart/form-data" class="w-full py-12 mx-auto lg:max-w-2xl"
        action="{{ route('admin.assign.permissions.update', ['user' => $user]) }}">
        @csrf
        @method('PATCH')

        <x-admin.form.card>
            @if (session('status') === 'permissions-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-green-600">
                    {{ __('User permissions updated successfully.') }}</p>
            @elseif (session('status') === 'permissions-failed')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-red-600">
                    {{ __('User permissions updated failed.') }}</p>
            @endif
            <x-input-label for="permissions" :value="$user->name . __('\'s Permissions')" class="my-4 required" />

            <div class="lg:columns-3 md:columns-2">

                @foreach ($permissions as $permission)
                    @php
                        $checked = $user->permissions->pluck('id')->contains($permission->id);
                    @endphp
                    <div class="mb-4">
                        <x-admin.form.checkbox :checked="$checked" name="permissions[]" :id="$permission->name"
                            :value="$permission->id" :label="$permission->description" />
                    </div>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('permissions')" />

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.users.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

</x-app-layout>
