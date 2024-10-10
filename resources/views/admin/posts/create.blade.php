<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Create Post') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <form enctype="multipart/form-data" class="w-full py-12 mx-auto text-sm text-gray-700 lg:max-w-2xl" method="POST"
        action="{{ route('admin.posts.store') }}">
        @csrf
        <section class="flex flex-col p-5 bg-white rounded-md dark:bg-gray-700 shadow-card">

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="title">Title</label>
                <input class="border rounded-md text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    type="text" name="title" id="title" value="{{ old('title') }}" />
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('title') }}</span>
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="category">Category</label>
                <select name="category" id="category"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600">
                    <option value="">Choose category</option>
                    <option value="CAT195">
                        CAT195 Australian Bushfire Season (2019/20) NSW, QLD, SA, VIC
                    </option>
                    <option value="CAT196">CAT196 SEQ Hailstorm (QLD)</option>
                    <option value="CAT201">
                        CAT201 January Hailstorms (VIC,ACT,QLD,NSW)
                    </option>
                    <option value="CAT202">
                        CAT202 East Coast Storms And Flooding
                    </option>
                    <option value="CAT203">CAT203 COVID-19 Virus</option>
                </select>
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('category') }}</span>
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="body">Body</label>
                <textarea rows="10"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600" name="body"
                    id="body">{{ old('body') }}</textarea>
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('body') }}</span>
            </div>

            <div class="flex flex-col w-full field-group">
                <label class="mb-1 field-label dark:text-white" for="image">Image</label>
                <input type="file" name="image" id="image" multiple
                    class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400 ">
                <span class="mt-2 text-sm text-red-500">{{ $errors->first('image') }}</span>
            </div>

        </section>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <a href="{{ route('admin.posts.index') }}" class="rounded-md btn">Cancel</a>
            <button type="submit" class="rounded-md btn btn-primary">Save</button>
        </div>
    </form>

    @pushOnce('scripts')
        <script>
            document.getElementById('category').value = '{{ old('category') }}';
        </script>
    @endpushOnce
</x-app-layout>
