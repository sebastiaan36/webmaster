<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <h1 class="text-3xl my-7">Add new domain to track</h1>
                <div class="flex gap-16">

                    <div class="flex-1 basis-1/1 sm:basis-1/2">

                        @if($domains->count() < 3 )
                            <form method="POST" action="{{ route('domain.store') }}" enctype="multipart/form-data">
                                @csrf
                            <x-input-label class="" for="url" :value="__('Domain')"/>

                            <x-text-input id="url" class="w-full" type="text" name="domain" :value="old('domain')"
                                          required autofocus placeholder="https://been-vandam.nl"/>
                            <x-input-error :messages="$errors->get('url')" class="mt-2"/>
                            <small class="block">Please make sure your domain starts with https:// and links to your
                                homepage</small>
                            <div class="flex items-center mt-4">
                                <x-primary-button class="bg-green-500">
                                    {{ __('Add Domain') }}
                                </x-primary-button>
            </form>
                            </div>
                    </div>

                    @else
                        <p>You have reached the maximum amount of Domains you can add.</p>
                    @endif
                    <div class="flex-2 basis-1/1 sm:basis-1/2">
                        <ul class="list-disc">
                            <li>Every Domain can be tracked once. So please only track your own website</li>
                            <li>For this beta test it's only possible to track a maximum of 3 domains and 25 links per domain</li>
                            <li>Start your domain with https:// and end without trailing / for example: https://google.nl</li>
                        </ul>

                    </div>
        </div>





                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                @endforeach
                @endif

            <div class="mt-8">
                <p class="my-4">Domains you are already tracking</p>
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
