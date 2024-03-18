<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold leading-none sm:text-6xl mb-3">Check the latest score per link</h1>
            <p>Click the link if you want more detailed information and the historical graph. </p>
            <a class="float-right px-4 py-2 mb-2 bg-blue-500 text-white rounded-lg" href="{{route('domain.link.create', $domain->id)}}">Create a new link</a>
            <table class="table-auto w-full border-collapse border m-6">
                <thead>
                <tr>
                    <th class="text-left p-2 bg-green-500 text-white rounded-tl-lg">URL</th>
                    <th class="text-center p-2 bg-green-500 text-white ">Mobile Score</th>
                    <th class="text-center p-2 bg-green-500 text-white ">Mobile Speed</th>
                    <th class="text-center p-2 bg-green-500 text-white ">Desktop Score</th>
                    <th class="text-center p-2 bg-green-500 text-white rounded-tr-lg">Desktop Speed</th>
                </tr>
                </thead>
                <tbody>
                @forelse($links as $link)
                    <tr class="border hover:bg-green-100">
                        <td><a href="{{ route('domain.link.show',  [$link->domain, $link->id]) }}">{{ $link->url }}</a></td>

                    @if($link->pagespeeds && $link->pagespeeds->first())
                            <td class="p-2 text-center">{{$link->pagespeeds->mobile_score}}</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->mobile_speed}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->desktop_score}}</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->desktop_speed}} <span class="text-xs">sec<span</td>
                        @else
                            <td class="p-2 text-center text-gray-400">No data</td>
                            <td class="p-2 text-center text-gray-400">No data</td>
                            <td class="p-2 text-center text-gray-400">No data</td>
                            <td class="p-2 text-center text-gray-400">No data</td>

                        @endif

                        </a></tr>

                    @empty
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
