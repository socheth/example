<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Edit Company') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Company') }}
        </h2>
    </x-slot>

    <form enctype="multipart/form-data" class="w-full py-12 mx-auto text-sm text-gray-700 lg:max-w-2xl" method="POST"
        action="{{ route('admin.companies.update', ['company' => $company]) }}">
        @csrf
        @method('PUT')

        <x-admin.form.card>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="name" :value="__('Name')" class="required" />
                <x-text-input id="name" name="name" type="text" class="block w-full" :value="$company->name"
                    autofocus autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="email" :value="__('Email')" class="required" />
                    <x-text-input id="email" name="email" type="email" class="block w-full" :value="$company->email"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="phone" :value="__('Phone')" class="required" />
                    <x-text-input id="phone" name="phone" type="tel" class="block w-full" :value="$company->phone"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="website" :value="__('Website')" class="required" />
                    <x-text-input id="website" name="website" type="url" class="block w-full" :value="$company->website"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('website')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="address" :value="__('Address')" class="required" />
                    <x-text-input id="address" name="address" type="text" class="block w-full" :value="$company->address"
                        autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-admin.form.checkbox id="is_active" name="is_active" :label="__('Is Active')" :checked="$company->is_active" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-admin.form.checkbox id="is_published" name="is_published" :label="__('Is Published')"
                        :checked="$company->is_published" />
                </div>
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="website" :value="__('Description')" class="required" />
                <x-admin.form.textarea rows="10" name="description"
                    id="description">{{ $company->description }}</x-admin.form.textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="logo" :value="__('Company Logo')" class="required" />
                <x-admin.form.input-file name="logo" id="logo" />
                <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                <img src="{{ $company->logo }}" alt="Company Logo" class="w-full mt-4">
            </div>

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.companies.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

</x-app-layout>
