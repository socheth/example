<x-app-layout>
    <x-slot name="headerTitle">
        {{ __('Create New Job') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create New Job') }}
        </h2>
    </x-slot>

    <form class="w-full py-12 mx-auto text-sm text-gray-700 lg:max-w-2xl" method="POST"
        action="{{ route('admin.jobs.store') }}">
        @csrf

        <x-admin.form.card>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="title" :value="__('Title')" class="required" />
                <x-text-input name="title" id="title" placeholder="PHP Developer" :value="old('title')" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="w-full gap-4 md:flex md:justify-between">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="title" :value="__('Experience')" class="required" />
                    <x-text-input name="experience" id="experience" placeholder="1 year" :value="old('experience')" />
                    <x-input-error class="mt-2" :messages="$errors->get('experience')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="salary" :value="__('Salary')" class="required" />
                    <x-text-input name="salary" id="salary" placeholder="Negotiable" :value="old('salary')" />
                    <x-input-error class="mt-2" :messages="$errors->get('salary')" />
                </div>
            </div>

            <div class="w-full gap-4 md:flex md:justify-between">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="type" :value="__('Type')" class="required" />
                    <x-admin.form.select name="type" id="type">
                        <option value="">Choose type</option>
                        <option value="Full Time" selected>Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                    </x-admin.form.select>
                    <x-input-error class="mt-2" :messages="$errors->get('type')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="category" :value="__('Category')" class="required" />
                    <x-admin.form.select name="category" id="category">
                        <option value="">Choose category</option>
                        <option value="IT">IT</option>
                        <option value="Marketing">Marketing</option>
                        <option value="HR">HR</option>
                    </x-admin.form.select>
                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                </div>
            </div>

            <div class="w-full gap-4 md:flex md:justify-between">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="category" :value="__('Status')" class="required" />
                    <x-admin.form.select name="status" id="status">
                        <option value="">Choose status</option>
                        <option value="Open" selected>Open</option>
                        <option value="Closed">Closed</option>
                    </x-admin.form.select>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="company" :value="__('Company')" class="required" />
                    <x-admin.form.select name="company" id="company">
                        <option value="">Choose company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </x-admin.form.select>
                    <x-input-error class="mt-2" :messages="$errors->get('company')" />
                </div>
            </div>

            <div class="w-full gap-4 md:flex md:justify-between">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2 md:mb-0">
                    <x-input-label for="location" :value="__('Location')" class="required" />
                    <x-text-input name="location" id="location" placeholder="Remote" :value="old('location')" />
                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                </div>

                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-input-label for="deadline" :value="__('Deadline')" class="required" />
                    <x-text-input type="date" name="deadline" id="deadline" :value="old('deadline') ?? date('Y-m-d', strtotime('+1 month'))" />
                    <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                </div>
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="apply_url" :value="__('Apply Url')" />
                <x-text-input type="url" name="apply_url" id="apply_url" :value="old('apply_url')" />
                <x-input-error class="mt-2" :messages="$errors->get('apply_url')" />
            </div>

            <div class="flex justify-between w-full gap-4">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-admin.form.checkbox id="is_active" name="is_active" :label="__('Is Active')" :checked="old('is_active')" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <x-admin.form.checkbox id="is_featured" name="is_featured" :label="__('Is Featured')" :checked="old('is_featured')" />
                </div>
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="description" :value="__('Description')" class="required" />
                <x-admin.form.textarea rows="10" name="description"
                    id="description">{{ old('description') }}</x-admin.form.textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="requirements" :value="__('Requirements')" class="required" />
                <x-admin.form.textarea rows="10" name="requirements"
                    id="requirements">{{ old('requirements') }}</x-admin.form.textarea>
                <x-input-error class="mt-2" :messages="$errors->get('requirements')" />
            </div>

            <div class="flex flex-col w-full field-group">
                <x-input-label for="benefits" :value="__('Benefits')" class="required" />
                <x-admin.form.textarea rows="10" name="benefits"
                    id="benefits">{{ old('benefits') }}</x-admin.form.textarea>
                <x-input-error class="mt-2" :messages="$errors->get('benefits')" />
            </div>

        </x-admin.form.card>

        <div class="sticky bottom-0 flex justify-center w-full pt-4 pb-5">
            <x-admin.button-link href="{{ route('admin.jobs.index') }}">Cancel</x-admin.button-link>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>

    </form>

    @push('scripts')
        <script>
            document.getElementById('category').value = '{{ old('category') }}';
            document.getElementById('status').value = '{{ old('status') }}';
            document.getElementById('company').value = '{{ old('company') }}';
            document.getElementById('type').value = '{{ old('type') }}';
        </script>
    @endpush
</x-app-layout>
