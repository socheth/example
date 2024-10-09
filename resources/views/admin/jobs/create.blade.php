<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Create New Job') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create New Job') }}
        </h2>
    </x-slot>

    <form class="w-1/2 py-12 mx-auto text-sm text-gray-700" method="POST" action="{{ route('admin.jobs.store') }}">
        @csrf

        <section class="flex flex-col w-full gap-4 p-5 bg-white rounded-md dark:bg-gray-700 shadow-card">

            <div class="flex flex-col w-full field-group">
                <label class="mb-1 field-label required dark:text-white" for="title">Title</label>
                <input
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    type="text" name="title" id="title" placeholder="PHP Developer" />
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('title') }}</span>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="experience">Experience</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="text" name="experience" id="experience" placeholder="1 year" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('experience') }}</span>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="salary">Salary</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="number" name="salary" id="salary" placeholder="Negotiable" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('salary') }}</span>
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="type">Type</label>
                    <select name="type" id="type"
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600">
                        <option value="">Choose type</option>
                        <option value="Full Time" selected>Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                    </select>
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('type') }}</span>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="category">Category</label>
                    <select name="category" id="category"
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600">
                        <option value="">Choose category</option>
                        <option value="IT">IT</option>
                        <option value="Marketing">Marketing</option>
                        <option value="HR">HR</option>
                    </select>
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('category') }}</span>
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="status">Status</label>
                    <select name="status" id="status"
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600">
                        <option value="">Choose status</option>
                        <option value="Open" selected>Open</option>
                        <option value="Closed">Closed</option>
                    </select>
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('status') }}</span>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="company">Company</label>
                    <select name="company_id" id="company"
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600">
                        <option value="">Choose company</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                    </select>
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('company_id') }}</span>
                </div>

            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="location">Location</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="text" name="location" id="location" placeholder="Remote" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('location') }}</span>
                </div>

                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="deadline">Deadline</label>
                    <input type="date" name="deadline" id="deadline"
                        value="{{ old('deadline') ?? date('Y-m-d', strtotime('+1 month')) }}"
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('deadline') }}</span>
                </div>

                <div class="flex-col hidden w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="apply_url">Apply Url</label>
                    <input
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="url" name="apply_url" id="apply_url" />
                    <span class="mt-2 text-sm text-red-500">{{ $errors->first('apply_url') }}</span>
                </div>
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label for="is_active" class="inline-flex items-center">
                        <input id="is_active" type="checkbox"
                            class="text-blue-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                            name="is_active">
                        <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Is Active') }}</span>
                    </label>
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label for="is_featured" class="inline-flex items-center">
                        <input id="is_featured" type="checkbox"
                            class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="is_featured">
                        <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Is Featured') }}</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="description">Description</label>
                <textarea rows="10"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    name="description" id="description">{{ old('description') }}</textarea>
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('description') }}</span>
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="requirements">Requirements</label>
                <textarea rows="10"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    name="requirements" id="requirements">{{ old('requirements') }}</textarea>
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('requirements') }}</span>
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label dark:text-white" for="benefits">Benefits</label>
                <textarea rows="10"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    name="benefits" id="benefits">{{ old('benefits') }}</textarea>
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('benefits') }}</span>
            </div>

        </section>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <a href="{{ route('admin.jobs.index') }}" class="rounded-md btn">Cancel</a>
            <button type="submit" class="rounded-md btn btn-primary">Save</button>
        </div>

    </form>

</x-app-layout>
