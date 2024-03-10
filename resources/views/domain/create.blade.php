<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('domain.store') }}"  enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div>
                    <div class="">
                        <h1 class="text-3xl my-7">Add new domain to track</h1>
                    </div>
                    <div class="flex">
                        <x-input-label class="mr-5 pt-2" for="url" :value="__('Url')" />
                        <div class="flex w-100 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <span class="flex select-none items-center pl-5 text-gray-500 sm:text-m">https://</span>
                            <x-text-input id="url" class="block flex-1 border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-" type="text" name="domain" :value="old('domain')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4 flex-2 bg-green-600 hover:bg-green-700">
                            {{ __('Add') }}
                        </x-primary-button>

                    </div>



                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                @endforeach
                @endif
            </form>
            <div class="mt-8">
                <p class="my-4">Url's you are already tracking</p>
                <table class="table-auto w-full border-collapse border">
                    <thead>
                    <tr class="p-2">
                        <th class="bg-green-200 border border-slate-300">URL</th>
                        <th class="bg-green-200 border border-slate-300">Added</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($domains as $domain)
                        <tr class="border hover:bg-green-100">
                            <td class="ml-2 p-2">{{$domain->domain}}</td>
                            <td>{{$domain->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    </div>

</x-app-layout>
