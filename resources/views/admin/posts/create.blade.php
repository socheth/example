<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Create Post') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <form enctype="multipart/form-data" class="w-full py-12 mx-auto lg:max-w-2xl" method="POST"
        action="{{ route('admin.posts.store') }}">
        @csrf

        <x-admin.form.card>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="title" :value="__('Title')" class="required" />
                <x-text-input id="title" name="title" type="text" class="block w-full" :value="old('title')"
                    autofocus autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="category" :value="__('Category')" class="required" />
                <x-admin.form.select name="category" id="category">
                    <option value="">Choose category</option>
                    <option value="CAT195">
                        CAT195 Australian Bushfire Season
                    </option>
                    <option value="CAT196">CAT196 SEQ Hailstorm (QLD)</option>
                    <option value="CAT201">
                        CAT201 January Hailstorms (VIC,ACT,QLD,NSW)
                    </option>
                    <option value="CAT202">
                        CAT202 East Coast Storms And Flooding
                    </option>
                    <option value="CAT203">CAT203 COVID-19 Virus</option>
                </x-admin.form.select>
                <x-input-error class="mt-2" :messages="$errors->get('category')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="body" :value="__('Body')" class="required" />
                <x-admin.form.textarea rows="10" name="body"
                    id="body">{{ old('body') }}</x-admin.form.textarea>
                <x-input-error class="mt-2" :messages="$errors->get('body')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="image" :value="__('Image')" />
                <x-admin.form.input-file name="image" id="image" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.posts.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    @push('scripts')
        <script>
            document.getElementById('category').value = '{{ old('category') }}';
        </script>
    @endpush
</x-app-layout>
