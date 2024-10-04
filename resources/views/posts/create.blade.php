<x-layout headerTitle="Create Post">
    <x-slot:heading>
        Create Post
    </x-slot:heading>

    <form class="w-1/2 mx-auto text-sm text-gray-700">
        @csrf
        <section class="flex flex-col w-full py-3">

            <div
                class="flex flex-wrap justify-between w-full px-4 pt-5 pb-1 bg-white shadow-card sm:rounded sm:m-0 sm:px-5">
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2">
                    <label class="mb-1 field-label required" for="business_name">Business name</label>
                    <input autocomplete="true" class="border rounded field md:mr-2 text-grey-700" type="text"
                        name="business_name" id="business_name" placeholder="Nook inc." />
                </div>
                <div class="flex flex-col w-full mb-4 field-group md:w-1/2">
                    <label class="mb-1 field-label md:ml-2" for="contact_name">Contact name</label>
                    <input autocomplete="true" class="border rounded field md:ml-2 text-grey-700" type="text"
                        name="contact_name" id="contact_name" placeholder="Johannes Blümel" />
                </div>
                <div class="flex flex-col w-1/2 mb-4 field-group">
                    <label class="mb-1 field-label required" for="first_name">First name</label>
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

        <section class="flex flex-col w-full py-3 md:flex-row">

            <div
                class="flex flex-wrap justify-between w-full px-4 pt-5 pb-1 bg-white shadow-card sm:rounded sm:m-0 sm:px-5">
                <div class="flex flex-col w-full mb-4 field-group">
                    <label class="mb-1 field-label required" for="pet-select">Catastrophe event</label>
                    <select name="pets" id="pet-select" class="border rounded field text-grey-700">
                        <option value="">Choose catastrophe event...</option>
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
            </div>
        </section>

        <section class="flex flex-col w-full py-3 md:flex-row">

            <div
                class="flex flex-wrap justify-between w-full px-4 pt-5 pb-1 bg-white shadow-card sm:rounded sm:m-0 sm:px-5">
                <div class="flex flex-col w-full mb-4 field-group">
                    <div class="flex items-center mb-4">
                        <input id="remember_me" type="checkbox"
                            class="w-4 h-4 text-blue-600 transition duration-150 ease-in-out form-checkbox" />
                        <label for="remember_me" class="ml-2">
                            Use policyholder address
                        </label>
                    </div>

                    <div class="flex flex-col w-full mb-4 field-group">
                        <label class="mb-1 field-label required" for="address-1">Address</label>

                        <div class="flex flex-col rounded sm:flex-row">
                            <div class="sm:w-1/2 sm:mr-2">
                                <input autocomplete="true" id="address-1" aria-label="Address 1" name="address-1"
                                    type="address-1" required
                                    class="relative block w-full rounded-b-none appearance-none sm:rounded focus:z-10"
                                    placeholder="Address line 1" />
                            </div>
                            <div class="-mt-px sm:mt-0 sm:w-1/2 sm:ml-2">
                                <input autocomplete="true" aria-label="Address 2" name="address-2" type="address-2"
                                    required
                                    class="relative block w-full rounded-t-none appearance-none sm:rounded focus:z-10"
                                    placeholder="Address line 2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex justify-center w-full pt-4 pb-5">
            <button type="submit" class="btn">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</x-layout>
