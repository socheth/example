<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Edit Permission') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Permission') }}
        </h2>
    </x-slot>

    <form enctype="multipart/form-data" class="w-full py-12 mx-auto lg:max-w-2xl" method="POST"
        action="{{ route('admin.permissions.update', ['permission' => $permission]) }}">
        @csrf
        @method('PUT')

        <x-admin.form.card>

            <div class="w-full gap-4 md:flex md:justify-between">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="name" :value="__('Permission Name')" class="required" />
                    <x-text-input id="name" name="name" type="text" class="block w-full" :value="$permission->name"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="description" :value="__('Description')" class="required" />
                    <x-text-input id="description" name="description" class="block w-full" :value="$permission->description" autofocus
                        autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
            </div>

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.permissions.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

</x-app-layout>
