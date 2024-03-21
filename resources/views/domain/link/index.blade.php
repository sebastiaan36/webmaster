<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold leading-none sm:text-6xl mb-3">Check the latest score per link</h1>
            <p>Click the link if you want more detailed information and the historical graph. </p>
            <div class="block mb-10">
                <a class="float-right px-4 block py-2 bg-blue-500 text-white rounded-lg" href="{{route('domain.link.create', $domain->id)}}">Add a new link</a>
            </div>
            <div class="relative overflow-x-auto sm:overflow-hidden mt-2">
            <table class="table-auto w-full border-collapse border">
                <thead>
                <tr>
                    <th style="width:30%" class="text-left p-2 bg-green-500 text-white rounded-tl-lg"><span class="material-symbols-outlined text-3xl text-white">phone_iphone</span> <span class="align-super">Mobile</span></th>
                    <th class="text-center p-2 bg-green-500 text-white ">Score</th>
                    <th class="text-center p-2 bg-green-500 text-white ">Speed</th>

                    <th class="text-center p-2 bg-green-500 text-white ">FCP</th>
                    <th class="text-center p-2 bg-green-500 text-white ">TBT</th>
                    <th class="text-center p-2 bg-green-500 text-white ">LCP</th>
                    <th class="text-center p-2 bg-green-500 text-white ">TTI</th>
                    <th class="text-center p-2 bg-green-500 text-white ">CLS</th>
                    <th class="text-center p-2 bg-green-500 text-white rounded-tr-lg">Size</th>
                </tr>
                </thead>
                <tbody>
                @forelse($links as $link)
                    <tr class="
                    @if($link->pagespeeds && $link->pagespeeds->first())
                        @if($link->pagespeeds->mobile_score < 50 && $link->pagespeeds->mobile_score > 35) bg-yellow-100 @elseif($link->pagespeeds->mobile_score < 40) bg-orange-100 @else bg-green-100 @endif
                    @endif
                    border hover:bg-green-100">
                        <td class="p-2"><a href="{{ route('domain.link.show',  [$link->domain, $link->id]) }}">{{ $link->url }}</a></td>

                    @if($link->pagespeeds && $link->pagespeeds->first())
                            <td class="p-2 text-center">{{$link->pagespeeds->mobile_score}}</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->mobile_speed}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->FCP_mobile}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->TBT_mobile}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->LCP_mobile}} <span class="text-xs">sec<span</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->TTI_mobile}} <span class="text-xs">sec</span></td>

                            <td class="p-2 text-center">{{$link->pagespeeds->CLS_mobile}}</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->size_mobile}} <span class="text-xs">MB</span></td>
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
            <div class="relative overflow-x-auto sm:overflow-hidden mt-10">
            <table class="table-auto w-full border-collapse border">
                <thead>
                <tr>
                    <th style="width:30%" class="text-left p-2 bg-green-500 text-white rounded-tl-lg align-middle"><span class="material-symbols-outlined text-3xl text-white">desktop_windows</span> <span class="align-super">Desktop</span></th>
                    <th class="text-center p-2 bg-green-500 text-white ">Score</th>
                    <th class="text-center p-2 bg-green-500 text-white ">Speed</th>

                    <th class="text-center p-2 bg-green-500 text-white ">FCP</th>
                    <th class="text-center p-2 bg-green-500 text-white ">TBT</th>
                    <th class="text-center p-2 bg-green-500 text-white ">LCP</th>
                    <th class="text-center p-2 bg-green-500 text-white ">TTI</th>
                    <th class="text-center p-2 bg-green-500 text-white ">CLS</th>
                    <th class="text-center p-2 bg-green-500 text-white rounded-tr-lg ">Size</th>
                </tr>
                </thead>
                <tbody>
                @forelse($links as $link)
                    <tr class="
                    @if($link->pagespeeds && $link->pagespeeds->first())
                        @if($link->pagespeeds->desktop_score < 65 && $link->pagespeeds->desktop_score > 40) bg-yellow-100 @elseif($link->pagespeeds->desktop_score <= 40) bg-orange-100 @else bg-green-100 @endif

                    @endif
                    border hover:bg-white">
                        <td class="p-2"><a href="{{ route('domain.link.show',  [$link->domain, $link->id]) }}">{{ $link->url }}</a></td>

                        @if($link->pagespeeds && $link->pagespeeds->first())
                            <td class="p-2 text-center">{{$link->pagespeeds->desktop_score}}</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->desktop_speed}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->FCP_desktop}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->TBT_desktop}} <span class="text-xs">sec</span></td>
                            <td class="p-2 text-center">{{$link->pagespeeds->LCP_desktop}} <span class="text-xs">sec<span</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->TTI_desktop}} <span class="text-xs">sec</span></td>

                            <td class="p-2 text-center">{{$link->pagespeeds->CLS_desktop}}</td>
                            <td class="p-2 text-center">{{$link->pagespeeds->size_desktop}} <span class="text-xs">MB</span></td>
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
            <div class="mt-20">
            <x-legend />
            </div>
        </div>

    </div>

</x-app-layout>
