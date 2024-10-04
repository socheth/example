<x-layout headerTitle="Create Job">
    <x-slot:heading>
        Create New Job
    </x-slot:heading>

    <form class="w-1/2 mx-auto text-sm text-gray-700" method="POST" action="{{ route('job.store') }}">
        @csrf
        <section class="flex flex-col w-full py-3">

            <div
                class="flex flex-wrap justify-between w-full px-4 pt-5 pb-1 bg-white shadow-card sm:rounded sm:m-0 sm:px-5">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2">
                    <label class="mb-1 field-label required" for="title">Title</label>
                    <input required class="border rounded field md:mr-2 text-grey-700" type="text" name="title"
                        id="title" placeholder="Engineer" />
                </div>
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2">
                    <label class="mb-1 field-label required md:ml-2" for="salary">Salary</label>
                    <input required class="border rounded field md:ml-2 text-grey-700" type="number" name="salary"
                        id="salary" placeholder="5000" />
                </div>
                <div class="flex flex-col w-1/2 mb-4 field-group">
                    <label class="mb-1 field-label" for="first_name">First name</label>
                    <input autocomplete="true" class="mr-2 border rounded field text-grey-700" type="text"
                        name="first_name" id="first_name" />
                </div>
                <div class="flex flex-col w-1/2 mb-4 field-group">
                    <label class="mb-1 ml-2 field-label" for="last_name">Last Name</label>
                    <input autocomplete="true" class="ml-2 border rounded field text-grey-700" type="text"
                        name="last_name" id="last_name" />
                </div>
            </div>
        </section>

        <div class="flex justify-center w-full pt-4 pb-5">
            <a href="{{ route('jobs') }}" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</x-layout>
