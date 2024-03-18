<x-app-layout>
       <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">

                <div class="basis-1/2">
                    @forelse($domains as $domain)
                        <div class="m-4">
                            <table class="table-auto w-full border-collapse border m-6">
                                <thead>
                                    <tr>
                                        <th class="text-left p-2 bg-green-500 text-white rounded-tl-lg">Domain</th>
                                        <th class="text-left p-2 bg-green-500 text-white">Mobile score</th>
                                        <th class="text-left p-2 bg-green-500 text-white">Desktop score</th>
                                        <th class="text-left p-2 bg-green-500 text-white rounded-tr-lg">URL's Tracked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border hover:bg-green-100">

                                        <td class="p-2"><a href="{{ route('domain.link.index', $domain->id,) }}">{{$domain->domain}}</a></td>
                                        <td class="p-2"></td>
                                        <td class="p-2"></td>
                                        <td class="p-2">{{$count[$domain->id]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @empty
                            <p>Please add your first domain</p>
                    @endforelse

                </div>

            </div>


        </div>
    </div>
</x-app-layout>
