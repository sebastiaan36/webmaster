<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
            <x-breadcrumbs page="alllinks" :domain="$domain->domain" :domainid="$domain->id" link="" />

            <h1 class="text-2xl font-bold leading-none sm:text-4xl mb-3">Check the latest score per link</h1>
            <div class="flex justify-between">
            <p>Click the link if you want more detailed information and the historical graph. </p>
            <div class="block mb-2">
                <a class="float-right px-4 block py-2 bg-theme-jade text-theme-light rounded-lg" href="{{route('domain.link.create', $domain->id)}}">Add a new link</a>
            </div>
            </div>
            <div class="relative overflow-x-auto sm:overflow-hidden mt-2">
            <table class="table-auto w-full border-collapse border">
                <thead>
                <tr>
                    <th style="width:30%" class="text-left p-2 bg-theme-evergreen text-theme-light rounded-tl-lg"><span class="material-symbols-outlined text-3xl text-theme-light">phone_iphone</span> <span class="align-super">Mobile</span></th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">Score</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">Speed</th>

                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">FCP</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">TBT</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">LCP</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">TTI</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">CLS</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light rounded-tr-lg">Size</th>
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
                    <th style="width:30%" class="text-left p-2 bg-theme-evergreen text-theme-light rounded-tl-lg align-middle"><span class="material-symbols-outlined text-3xl text-theme-light">desktop_windows</span> <span class="align-super">Desktop</span></th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">Score</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">Speed</th>

                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">FCP</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">TBT</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">LCP</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">TTI</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light ">CLS</th>
                    <th class="text-center p-2 bg-theme-evergreen text-theme-light rounded-tr-lg ">Size</th>
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
