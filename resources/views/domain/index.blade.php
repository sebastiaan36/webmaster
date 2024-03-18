<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse($links as $link)
                <div class="m-4">
                <table class="table-fixed w-full border-collapse m-6">
                    <thead>
                        <tr>
                            <th class="text-left p-2 bg-green-500 text-white rounded-tl-lg">URL</th>
                            <th class="text-left p-2 bg-green-500 text-white rounded-tr-lg">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                @forelse($link as $l)
                    <tr class="border hover:bg-green-100">
                        <td class="p-2"><a href="{{ route('domain.link.show',  [$l->domain, $l->id]) }}">{{$l->url}}</a></td>
                        <td>{{$l->created_at}}</td>
                    </tr>
                    @empty
                @endforelse


                    </tbody>
                </table>
                </div>
            @empty
                <p>Please add your first url</p>
            @endforelse

        </div>
    </div>

</x-app-layout>
