<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table-auto w-full border-collapse border m-6">
                <thead>
                <tr>
                    <th class="bg-green-200 border border-slate-300">URL</th>
                    <th class="bg-green-200 border border-slate-300">Mobile Score</th>
                    <th class="bg-green-200 border border-slate-300">Mobile Speed</th>
                    <th class="bg-green-200 border border-slate-300">Desktop Score</th>
                    <th class="bg-green-200 border border-slate-300">Desktop Speed</th>
                </tr>
                </thead>
                <tbody>
                @forelse($links as $link)
                    <tr class="hover:bg-green-100">
                        <td><a href="{{ route('domain.link.show',  [$link->domain, $link->id]) }}">{{ $link->url }}</a></td>

                    @if($link->pagespeeds && $link->pagespeeds->first())
                            <td class="text-center">{{$link->pagespeeds->first()->mobile_score}}</td>
                            <td class="text-center">{{$link->pagespeeds->first()->mobile_speed}} <span class="text-xs">sec</span></td>
                            <td class="text-center">{{$link->pagespeeds->first()->desktop_score}}</td>
                            <td class="text-center">{{$link->pagespeeds->first()->desktop_speed}} <span class="text-xs">sec<span</td>
                        @else
                            <td class="text-center text-gray-400">No data</td>
                            <td class="text-center text-gray-400">No data</td>
                            <td class="text-center text-gray-400">No data</td>
                            <td class="text-center text-gray-400">No data</td>

                        @endif

                        </a></tr>

                    @empty
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
