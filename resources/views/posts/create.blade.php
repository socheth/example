<x-layout headerTitle="Create Post">
    <x-slot:heading>
        Create Post
    </x-slot:heading>

    <form enctype="multipart/form-data" class="w-1/2 mx-auto text-sm text-gray-700" method="POST"
        action="{{ route('posts.store') }}">
        @csrf
        <section class="flex flex-col p-5 bg-white rounded-md dark:bg-gray-700 shadow-card">

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="title">Title</label>
                <input required
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                    type="text" name="title" id="title" />
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="category">Category</label>
                <select name="category" id="category" required
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
            </div>

            <div class="flex flex-col w-full mb-4 field-group">
                <label class="mb-1 field-label required dark:text-white" for="body">Body</label>
                <textarea required rows="10"
                    class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600" name="body"
                    id="body"></textarea>
            </div>

            <div class="flex flex-col w-full field-group">
                <label class="mb-1 field-label dark:text-white" for="body">Image</label>
                <input type="file" name="image" id="image"
                    class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400 ">
            </div>


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </section>

        <div class="flex justify-center w-full pt-4 pb-5">
            <a href="{{ route('posts.index') }}" class="rounded-md btn">Cancel</a>
            <button type="submit" class="rounded-md btn btn-primary">Save</button>
        </div>
    </form>

</x-layout>
