<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-breadcrumbs page="link" :domain="$domain->domain" :domainid="$domain->id" :link="$link->url"/>
            @if(!empty($data))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2 sm:p-6 text-center">
                <div class="p-2 flex border-b-2 border-theme-evergreen flex-row flex-row-reverse">
                    <button class="bg-theme-jade rounded font-lg font-bold text-white p-2 ml-2 hover:bg-green-700" id="toggleButton">Toggle Graph/Table</button>
                    <div class="rounded ml-2 p-2 bg-theme-teal text-theme-light hover:bg-blue-500"><a href="?days=7">7 days</a></div>
                    <div class="rounded ml-2 p-2 bg-theme-teal text-theme-light"><a href="?days=14">14 days</a></div>
                    <div class="rounded ml-2 p-2 bg-theme-teal text-theme-light"><a href="?days=30">30 days</a></div>
                    <div class="rounded ml-2 p-2 bg-theme-teal text-theme-light"><a href="?days=90">90 days</a></div>
                </div>
                <h4 class="text-lg pt-4">Average Speed over last {{ $days }} days for: <br \> <span class="text-3xl break-all font-bold text-theme-jade">{{$link->url}}</span></h4>
                <div class=" p-2 sm:p-6 flex flex-row gap-2 flex-nowrap text-gray-900">
                    <div class="basis-1/4 p-2 sm:p-6 sm:basis-2/5 lg:basis-1/4:m6 text-center  rounded bg-theme-evergreen">
                        <p class="text-theme-light">Mobile Score</p>
                        <p class="font-lg font-black text-theme-light">{{ round($pagespeedAvg['mobile_score'], 0) }}</p>
                    </div>
                    <div class="basis-1/4 p-2 sm:p-6  sm:basis-2/5  lg::basis-1/4:m6 text-center rounded bg-theme-evergreen">
                        <p class="text-theme-light">Mobile Speed</p>
                        <p class="font-lg font-black text-theme-light">{{ round($pagespeedAvg['mobile_speed'],2) }} sec</p>
                    </div>
                    <div class="basis-1/4 p-2 sm:p-6  sm:basis-2/5  lg:basis-1/4:m6 text-center  rounded bg-theme-evergreen">
                        <p class="text-theme-light">Desktop Score</p>
                        <p class="font-lg font-black text-theme-light">{{ round($pagespeedAvg['desktop_score'], 0) }}</p>
                    </div>
                    <div class="basis-1/4 p-2 sm:p-6  sm:basis-2/5 lg::basis-1/4:m6 text-center rounded bg-theme-evergreen">
                        <p class="text-theme-light">Desktop Speed</p>
                        <p class="font-lg  font-black text-theme-light">{{ round($pagespeedAvg['desktop_speed'],2) }} sec</p>
                    </div>
                </div>


                <div id="graph">
                    <div class="flex my-3 flex-row w-full justify-center">
                        <button id="pageScoreButton" class="p-3 mx-1 rounded-lg bg-theme-lemon">Score</button>
                        <button id="pageSpeedButton" class="p-3 mx-1 rounded-lg bg-theme-lemon">Speed</button>
                        <button id="clsButton" class="p-3 mx-1 rounded-lg bg-theme-lemon">CLS</button>
                        <button id="sizeButton" class="p-3 mx-1 rounded-lg bg-theme-lemon">Size</button>
                    </div>
                    <div id="pageScore" style="width: 100%; margin: auto;">
                        <div style="min-height: 300px;" id="chart_days_score"></div>
                    </div>

                    <div id="pageSpeed" style="display: none; width: 100%; margin: auto;">
                        <div id="chart_days_speed"></div>
                    </div>
                    <div id="cls" style="display: none; width: 100%; margin: auto;">
                        <div id="chart_days_cls"></div>
                    </div>
                    <div id="size" style="display: none; width: 100%; margin: auto;">
                        <div id="chart_days_size"></div>
                    </div>
                </div>

                <div id="table" style="display: none">

                    <div class="flex flex-row justify-center gap-2 pb-3">
                        <button id="mobileButton" class="p-3 mx-1 rounded-lg bg-theme-lemon">Mobile</button>
                        <button id="desktopButton" class="p-3 mx-1 rounded-lg bg-theme-lemon">Desktop</button>
                    </div>
                    <div class="overflow-x-auto sm:overflow-hidden">
                    <table id="mobile" class="table-auto w-full border-collapse border">
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

                        @foreach($datatable as $d)
                            <tr class="border hover:bg-green-100">
                                <td>{{ date('d-m-Y', strtotime($d->created_at)) }} </td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->mobile_score }}</span>
                                        @if($pagespeedAvg['mobile_score'] < $d->mobile_score)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" heigth="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" heigth="15px">
                                        @endif
                                        </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->mobile_speed }}</span>
                                        @if($pagespeedAvg['mobile_speed'] < $d->mobile_speed)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->FCP_mobile }}</span>
                                        @if($pagespeedAvg['FCP_mobile'] < $d->FCP_mobile)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->TBT_mobile }}</span>
                                                @if($pagespeedAvg['TBT_mobile'] < $d->TBT_mobile)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->LCP_mobile }}</span>
                                                @if($pagespeedAvg['LCP_mobile'] < $d->LCP_mobile)
                                        <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                    @else
                                        <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                    @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->TTI_mobile }}</span>
                                                @if($pagespeedAvg['TTI_mobile'] < $d->TTI_mobile)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->CLS_mobile }}</span>
                                                @if($pagespeedAvg['CLS_mobile'] < $d->CLS_mobile)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->size_mobile }}</span>
                                                @if($pagespeedAvg['size_mobile'] < $d->size_mobile)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>

                            </tr>


                        @endforeach
                        <tr class="border-theme-teal border-t-2">
                            <td>Avarage</td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['mobile_score'],0)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['mobile_speed'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['FCP_mobile'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['TBT_mobile'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['LCP_mobile'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['TTI_mobile'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['CLS_mobile'],4)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['size_mobile'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                        </tr>
                        </tbody>
                    </table>
                        </div>
                    <div class="overflow-x-auto sm:overflow-hidden">
                    <table id="desktop" style="display: none" class="table-auto w-full border-collapse border">
                        <thead>
                        <tr>
                            <th style="width:30%" class="text-left p-2 bg-theme-evergreen text-theme-light rounded-tl-lg"><span class="material-symbols-outlined text-3xl text-theme-light">desktop_windows</span> <span class="align-super">Desktop</span></th>
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

                        @foreach($datatable as $d)
                            <tr class="border hover:bg-green-100">
                                <td>{{ date('d-m-Y', strtotime($d->created_at)) }} </td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->desktop_score }}</span>
                                        @if($pagespeedAvg['desktop_score'] < $d->desktop_score)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" heigth="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" heigth="15px">
                                        @endif
                                        </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->desktop_speed }}</span>
                                        @if($pagespeedAvg['desktop_speed'] < $d->desktop_speed)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->FCP_desktop }}</span>
                                        @if($pagespeedAvg['FCP_desktop'] < $d->FCP_desktop)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->TBT_desktop }}</span>
                                                @if($pagespeedAvg['TBT_desktop'] < $d->TBT_desktop)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->LCP_desktop }}</span>
                                                @if($pagespeedAvg['LCP_desktop'] < $d->LCP_desktop)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->TTI_desktop }}</span>
                                                @if($pagespeedAvg['TTI_desktop'] < $d->TTI_desktop)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->CLS_desktop }}</span>
                                                @if($pagespeedAvg['CLS_desktop'] < $d->CLS_desktop)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->size_desktop }}</span>
                                                @if($pagespeedAvg['size_desktop'] < $d->size_desktop)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>

                            </tr>


                        @endforeach
                        <tr class="border-theme-teal border-t-2">
                            <td>Avarage</td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['desktop_score'],0)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['desktop_speed'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['FCP_desktop'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['TBT_desktop'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['LCP_desktop'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['TTI_desktop'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['CLS_desktop'],4)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                            <td class="min-w-20"><span class="flex flex-row justify-center"><span class="basis-1/4">{{round($pagespeedAvg['size_desktop'],2)}}</span><span style="font-size: 15px;" class="ml-2 h-full pt-1 material-symbols-outlined">all_inclusive</span></span></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="mt-32 text-left">
                    <x-legend/>
                    </div>

                </div>



                <script>
                    var options = {
                        series: [
                            {
                                name: "Mobile",
                                data: @json($data['mobile_score']['data'])
                            },
                            {
                                name: "Desktop",
                                data: @json($data['desktop_score']['data'])
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'line',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        colors: ['#77B6EA', '#545454'],
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        title: {
                            text: 'Pagescore',
                            align: 'left'
                        },
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 1
                        },
                        xaxis: {
                            categories: @json($data['mobile_score']['labels']),
                            title: {
                                text: 'Days'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Score'
                            },
                            min: 0,
                            max: 100,
                            stepSize: 10,
                            decimalsInFloat: 0,
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                    };

                    var chart_days_score = new ApexCharts(document.querySelector("#chart_days_score"), options);
                    chart_days_score.render();

                    var options = {
                        series: [
                            {
                                name: "Mobile",
                                data: @json($data['mobile_speed']['data'])
                            },
                            {
                                name: "Desktop",
                                data: @json($data['desktop_speed']['data'])
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'line',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        colors: ['#77B6EA', '#545454'],
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        title: {
                            text: 'Pagespeed',
                            align: 'left'
                        },
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 1
                        },
                        xaxis: {
                            categories: @json($data['mobile_speed']['labels']),
                            title: {
                                text: 'Days'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Seconds'
                            },
                            min: 0,
                            max: {{max($data['mobile_speed']['data'])+2}},
                            stepSize: 1,
                            decimalsInFloat: 2,
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                    };

                    var chart_days_speed = new ApexCharts(document.querySelector("#chart_days_speed"), options);
                    chart_days_speed.render();

                    var options = {
                        series: [
                            {
                                name: "Mobile",
                                data: @json($data['CLS_mobile']['data'])
                            },
                            {
                                name: "Desktop",
                                data: @json($data['CLS_desktop']['data'])
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'line',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        colors: ['#77B6EA', '#545454'],
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        title: {
                            text: 'CLS - cumulative layout shift',
                            align: 'left'
                        },
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 1
                        },
                        xaxis: {
                            categories: @json($data['CLS_mobile']['labels']),
                            title: {
                                text: 'Days'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Score'
                            },
                            min: 0,
                            max: 0.5,
                            stepSize: 0.1,
                            decimalsInFloat: 2,
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                    };

                    var chart_days_cls = new ApexCharts(document.querySelector("#chart_days_cls"), options);
                    chart_days_cls.render();

                    var options = {
                        series: [
                            {
                                name: "Mobile",
                                data: @json($data['size_mobile']['data'])
                            },
                            {
                                name: "Desktop",
                                data: @json($data['size_desktop']['data'])
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'line',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        colors: ['#77B6EA', '#545454'],
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        title: {
                            text: 'Size in MB',
                            align: 'left'
                        },
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 1
                        },
                        xaxis: {
                            categories: @json($data['size_mobile']['labels']),
                            title: {
                                text: 'Days'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'MB'
                            },
                            min: 0,
                            max: {{max($data['size_desktop']['data'])+2}},
                            stepSize: 1,
                            decimalsInFloat: 2,
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                    };

                    var chart_days_size = new ApexCharts(document.querySelector("#chart_days_size"), options);
                    chart_days_size.render();
                </script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var toggleButton = document.getElementById('toggleButton');
                        var graph = document.getElementById('graph');
                        var table = document.getElementById('table');

                        toggleButton.addEventListener('click', function() {
                            // Controleert de huidige display status van de graph div
                            if (graph.style.display === 'none') {
                                graph.style.display = 'block';
                                table.style.display = 'none';
                            } else {
                                graph.style.display = 'none';
                                table.style.display = 'block';
                            }
                        });

                        var mobileButton = document.getElementById('mobileButton');
                        var desktopButton = document.getElementById('desktopButton');
                        var mobile = document.getElementById('mobile');
                        var desktop = document.getElementById('desktop');

                        mobileButton.addEventListener('click', function() {

                            if (mobile.style.display === 'none') {
                                mobile.style.display = 'table';
                                desktop.style.display = 'none';
                            } else {
                                mobile.style.display = 'table';
                                desktop.style.display = 'none';
                            }
                        });
                        desktopButton.addEventListener('click', function() {
                            if (desktop.style.display === 'none') {
                                mobile.style.display = 'none';
                                desktop.style.display = 'table';
                            } else {
                                mobile.style.display = 'none';
                                desktop.style.display = 'table';
                            }
                        });

                        var pageSpeed = document.getElementById('pageSpeed');
                        var pageSpeedButton = document.getElementById('pageSpeedButton');
                        var pageScore = document.getElementById('pageScore');
                        var pageScoreButton = document.getElementById('pageScoreButton');
                        var cls = document.getElementById('cls');
                        var clsButton = document.getElementById('clsButton');
                        var size = document.getElementById('size');
                        var sizeButton = document.getElementById('sizeButton');
                        // write a script that wil show the correct graph based on the button clicked. If pagescore is clicked, show the pagescore graph, if pagespeed is clicked, show the pagespeed graph, if cls is clicked, show the cls graph
                        // if pageSpeed is clicked, show the pagespeed graph
                        pageSpeedButton.addEventListener('click', function() {
                            // Controleert de huidige display status van de graph div
                            if (pageSpeed.style.display === 'none') {
                                pageSpeed.style.display = 'block';
                                pageScore.style.display = 'none';
                                cls.style.display = 'none';
                                size.style.display = 'none';
                            } else {
                                pageSpeed.style.display = 'block';
                                pageScore.style.display = 'none';
                                cls.style.display = 'none';
                                size.style.display = 'none';
                            }
                        });
                        pageScoreButton.addEventListener('click', function() {
                            // Controleert de huidige display status van de graph div
                            if (pageScore.style.display === 'none') {
                                pageSpeed.style.display = 'none';
                                pageScore.style.display = 'block';
                                cls.style.display = 'none';
                                size.style.display = 'none';
                            } else {
                                pageSpeed.style.display = 'none';
                                pageScore.style.display = 'block';
                                cls.style.display = 'none';
                                size.style.display = 'none';
                            }
                        });
                        clsButton.addEventListener('click', function() {
                            // Controleert de huidige display status van de graph div
                            if (cls.style.display === 'none') {
                                pageSpeed.style.display = 'none';
                                pageScore.style.display = 'none';
                                cls.style.display = 'block';
                                size.style.display = 'none';
                            } else {
                                pageSpeed.style.display = 'none';
                                pageScore.style.display = 'none';
                                cls.style.display = 'block';
                                size.style.display = 'none';
                            }
                        });
                        sizeButton.addEventListener('click', function() {
                            // Controleert de huidige display status van de graph div
                            if (size.style.display === 'none') {
                                pageSpeed.style.display = 'none';
                                pageScore.style.display = 'none';
                                cls.style.display = 'none';
                                size.style.display = 'block';
                            } else {
                                pageSpeed.style.display = 'none';
                                pageScore.style.display = 'none';
                                cls.style.display = 'none';
                                size.style.display = 'block';
                            }
                        });
                    });
                </script>
                @else
                    <h3>At this moment there is no data available. Please come back tommorow when the first results will be in.</h3>
                    <p><a href="{{route('domain.index')}}">Back to overview</a></p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
