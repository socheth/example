<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Edit Role') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <form enctype="multipart/form-data" class="w-full py-12 mx-auto lg:max-w-2xl" method="POST"
        action="{{ route('admin.roles.update', ['role' => $role]) }}">
        @csrf
        @method('PUT')

        <x-admin.form.card>

            <div class="w-full gap-4 md:flex md:justify-between">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="name" :value="__('Role Name')" class="required" />
                    <x-text-input id="name" name="name" type="text" class="block w-full" :value="$role->name"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="level" :value="__('Level')" class="required" />
                    <x-text-input type="number" id="level" name="level" class="block w-full" :value="$role->level"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('level')" />
                </div>
            </div>

            <x-input-label :value="__('Permissions')" class="required" />

            @foreach ($permissions as $permission)
                <x-admin.form.checkbox name="permissions[]" :id="$permission->name" :value="$permission->id" :label="$permission->name" />
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('permissions')" />

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.roles.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

</x-app-layout>
