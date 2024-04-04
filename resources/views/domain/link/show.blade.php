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
                <h4 class="text-lg pt-4">Average Speed over last {{ $days }} days for: <br \> <span class="text-3xl font-bold text-theme-jade">{{$link->url}}</span></h4>
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
                    <div style="width: 100%; margin: auto;">
                        <div style="min-height: 300px;" id="chart_days_score"></div>
                    </div>

                    <div style="width: 100%; margin: auto;">
                        <div id="chart_days_speed"></div>
                    </div>
                </div>

                <div id="table" style="display: none">
                    <table class="table-auto w-full border-collapse">
                        <thead>
                        <tr class="p-2">
                            <th class="bg-theme-evergreen p-2 rounded-tl-lg text-theme-light border-slate-300">Date</th>
                            <th class="bg-theme-evergreen p-2  text-theme-light border-slate-300">Mobile Score</th>
                            <th class="bg-theme-evergreen p-2  text-theme-light border-slate-300">Mobile Speed</th>
                            <th class="bg-theme-evergreen p-2  text-theme-light border-slate-300">Desktop Score</th>
                            <th class="bg-theme-evergreen p-2 rounded-tr-lg text-theme-light border-slate-300">Destkop Speed</th>
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
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->desktop_score }}</span>
                                        @if($pagespeedAvg['desktop_score'] < $d->desktop_score)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @endif
                                            </span></td>
                                <td><span class="flex flex-row justify-center"><span class="basis-1/4">{{ $d->desktop_speed }}</span>
                                                @if($pagespeedAvg['desktop_speed'] < $d->desktop_speed)
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-red-down.png" width="15px" height="15px">
                                        @else
                                            <img class="ml-2 h-full pt-1" src="/storage/images/arrow-green-up.png" width="15px" height="15px">
                                        @endif
                                            </span></td>

                            </tr>


                        @endforeach
                        </tbody>
                    </table>

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
