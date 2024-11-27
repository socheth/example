<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Create User') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <form method="POST" enctype="multipart/form-data" class="w-full py-12 mx-auto lg:max-w-2xl"
        action="{{ route('admin.users.store') }}">
        @csrf

        <x-admin.form.card>

            @if (session('status') === 'user-created')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-green-600">
                    {{ __('User created successfully.') }}</p>
            @elseif (session('status') === 'user-failed')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-red-600">
                    {{ __('User created failed.') }}</p>
            @endif

            <div class="w-full gap-4 md:justify-between md:flex">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="name" :value="__('Full Name')" class="required" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name"
                        :value="old('name')" autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="password" :value="__('Password')" class="required" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password"
                        :value="old('password')" autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
            </div>

            <div class="w-full gap-4 md:justify-between md:flex">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="gender" :value="__('Gender')" class="required" />
                    <x-admin.form.select name="gender" id="gender">
                        <option value="">Choose gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </x-admin.form.select>
                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                </div>

                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="role" :value="__('Role')" class="required" />
                    <x-admin.form.select name="role" id="role">
                        <option value="">Choose role</option>
                        <option value="1">Super Admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Manager</option>
                        <option value="4">Author</option>
                        <option value="5">User</option>
                    </x-admin.form.select>
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
            </div>

            <div class="w-full gap-4 md:justify-between md:flex">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="phone" :value="__('Phone')" class="required" />
                    <x-text-input id="phone" class="block w-full mt-1" type="tel" name="phone"
                        :value="old('phone')" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="email" :value="__('Email')" class="required" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                        :value="old('email')" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-admin.form.checkbox id="is_active" name="is_active" :label="__('Is Active')" :checked="true" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-admin.form.checkbox id="is_admin" name="is_admin" :label="__('Is Admin')" :checked="old('is_admin')" />
                </div>
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="address" :value="__('Address')" class="required" />
                <x-text-input id="address" name="address" type="text" class="block w-full" :value="old('address')"
                    autofocus autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="photo" :value="__('User photo')" class="required" />
                <x-admin.form.input-file name="photo" id="photo" value="{{ old('photo') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.users.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    @push('scripts')
        <script>
            document.getElementById('gender').value = '{{ old('gender') }}';
            document.getElementById('role').value = '{{ old('role') }}';
        </script>
    @endpush
</x-app-layout>
