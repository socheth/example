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

        <section class="flex flex-col gap-4 p-5 bg-white rounded-md dark:bg-gray-700 shadow-card">

            <div class="flex flex-col w-full field-group">
                <label class="mb-1 field-label required dark:text-white" for="name">Name</label>
                <input class="border rounded-md text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    type="text" name="name" id="name" value="{{ $company->name }}" />
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('name') }}</span>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="email">Email</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="email" name="email" id="email" value="{{ $company->email }}" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('email') }}</span>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="phone">Phone</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="tel" name="phone" id="phone" value="{{ $company->phone }}" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('phone') }}</span>
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="website">Website</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="url" name="website" id="website" value="{{ $company->website }}" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('website') }}</span>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="phone">Address</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="text" name="address" id="address" value="{{ $company->address }}" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('address') }}</span>
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label for="is_active" class="inline-flex items-center">
                        <input id="is_active" type="checkbox" {{ $company->is_active ? 'checked' : '' }}
                            class="text-blue-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                            name="is_active">
                        <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Is Active') }}</span>
                    </label>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label for="is_published" class="inline-flex items-center">
                        <input id="is_published" type="checkbox" {{ $company->is_published ? 'checked' : '' }}
                            class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="is_published">
                        <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Is Published') }}</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col w-full field-group">
                <label class="mb-1 field-label required dark:text-white" for="description">Description</label>
                <textarea rows="10"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    name="description" id="description">{{ $company->description }}</textarea>
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('description') }}</span>
            </div>

            <div class="flex flex-col w-full field-group">
                <label class="mb-1 field-label dark:text-white required" for="logo">Company Logo</label>
                <input type="file" name="logo" id="logo"
                    class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400 ">
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('logo') }}</span>
                <img src="{{ $company->logo }}" alt="Company Logo" class="w-full mt-4">
            </div>

        </section>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <a href="{{ route('admin.companies.index') }}" class="rounded-md btn">Cancel</a>
            <button type="submit" class="rounded-md btn btn-primary">Update</button>
        </div>
    </form>

</x-app-layout>
