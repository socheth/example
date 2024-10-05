<x-layout headerTitle="Create Job">
    <x-slot:heading>
        Create New Job
    </x-slot:heading>

    <form class="w-1/2 mx-auto text-sm text-gray-700" method="POST" action="{{ route('jobs.store') }}">
        @csrf
        <section class="flex flex-col w-full py-3">

            <div class="flex justify-between w-full gap-4 p-5 bg-white rounded-md dark:bg-gray-700 shadow-card ">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="title">Title</label>
                    <input required
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="text" name="title" id="title" placeholder="Engineer" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="salary">Salary</label>
                    <input required
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="number" name="salary" id="salary" placeholder="5000" />
                </div>

            </div>
        </section>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="flex justify-center w-full pt-4 pb-5">
            <a href="{{ route('jobs.index') }}" class="rounded-md btn">Cancel</a>
            <button type="submit" class="rounded-md btn btn-primary">Save</button>
        </div>

    </form>

</x-layout>
