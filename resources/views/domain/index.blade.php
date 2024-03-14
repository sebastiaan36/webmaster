<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse($links as $link)
                <div class="m-4">
                <table class="table-auto w-full border-collapse border m-6">
                    <thead>
                        <tr>
                            <th class="bg-green-200 border border-slate-300">URL</th>
                            <th class="bg-green-200 border border-slate-300">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                @forelse($link as $l)
                    <tr>
                        <td><a href="{{ route('domain.link.show',  [$l->domain, $l->id]) }}">{{$l->url}}</a></td>
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
