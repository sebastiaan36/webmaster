<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach($links as $link)
                <div class="m-4">
                <table class="table-auto w-full border-collapse border m-6">
                    <thead>
                        <tr>
                            <th class="bg-green-200 border border-slate-300">URL</th>
                            <th class="bg-green-200 border border-slate-300">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($link as $l)
                    <tr>
                        <td><a href="{{ route('link.show', $l->id) }}">{{$l->url}}</a></td>
                        <td>{{$l->created_at}}</td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
                </div>
            @endforeach

        </div>
    </div>

</x-app-layout>
