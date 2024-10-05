<x-layout headerTitle="Edit Job">
    <x-slot:heading>
        Edit Job
    </x-slot:heading>

    <form class="w-1/2 mx-auto text-sm text-gray-700" method="POST" action="{{ route('jobs.update', ['job' => $job]) }}">
        @csrf
        @method('PATCH')
        <section class="flex flex-col w-full py-3">

            <div class="flex justify-between w-full gap-4 p-5 bg-white rounded-md dark:bg-gray-700 shadow-card">
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="title">Title</label>
                    <input required
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="text" name="title" id="title" placeholder="Engineer"
                        value="{{ $job->title }}" />
                </div>
                <div class="flex flex-col w-full field-group md:w-1/2">
                    <label class="mb-1 field-label required dark:text-white" for="salary">Salary</label>
                    <input required
                        class="border rounded-md field text-grey-700 dark:text-white dark:bg-gray-800 dark:border-gray-600"
                        type="number" name="salary" id="salary" placeholder="5000" value="{{ $job->salary }}" />
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
            <button type="submit" form="delete-job-form" class="rounded-md btn btn-danger">Trash</button>
            <button type="submit" class="rounded-md btn btn-primary">Update</button>
        </div>

    </form>

    <form class="hidden" method="POST" id="delete-job-form" action="{{ route('jobs.destroy', ['job' => $job]) }}">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
