<x-app-layout>
       <div class="py-12">
        <div class="px-2 max-w-7xl mx-auto sm:px-6 lg:px-8">

                    @forelse($domains as $domain)

                <div class="flex flex-wrap sm:flex-nowrap mb-20">

                    <div class="basis-1/1 sm:basis-1/2">
                        <div class="flex justify-between gap-x-3">
                        <h2 class="text-3xl font-black">{{preg_replace("(^https?://)", "", $domain->domain )}}</h2>
                            <a href="{{route('domain.link.index', $domain->id)}}" class="bg-blue-500 text-white rounded-lg p-2 text-center">Details</a>
                        </div>
                        <div class="flex gap-x-1 sm:gap-x-5 my-4">
                            <div class="basis-1/3 p-4 bg-green-200 rounded-lg">
                                 <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                                     <span class="material-symbols-outlined">link</span>
                                 </div>
                                <h5 class="mt-5 mb-2"><span class="counter text-2xl font-bold" data-target="{{$count[$domain->id]}}">{{$count[$domain->id]}}</span></h5>
                                <p class="text-slate-500 dark:text-slate-200">URL's tracked</p>
                            </div>
                            <div class="basis-1/3 p-4 bg-green-200 rounded-lg">
                                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                                    <span class="material-symbols-outlined">avg_time</span>
                                </div>
                                <h5 class="mt-5 mb-2">
                                    <div class="counter-value font-bold mb-1">
                                        <span class="material-symbols-outlined mr-2 align-bottom">phone_iphone</span>{{number_format($pagespeed[$domain->id]['mobile_speed'],2)}} sec</div>
                                    <div class="counter-value font-bold">
                                        <span class="material-symbols-outlined mr-2 align-bottom">desktop_windows</span>{{number_format($pagespeed[$domain->id]['desktop_speed'],2)}} sec</div>

                                </h5>
                                <p class="text-slate-500 dark:text-slate-200"></p>

                            </div>
                            <div class="basis-1/3 p-4 bg-green-200 rounded-lg">
                                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                                <span class="material-symbols-outlined">construction</span>
                            </div>
                                <div class="mt-5 mb-2"><p>There are <a href="{{route('domain.link.index', $domain->id)}}" class="font-bold">{{$pagespeed[$domain->id]['need_work']}} page(s)</a> that need improvement</p></div>

                            </div>
                        </div>
                        <div id="chart_days_{{$domain->id}}"></div>



                    </div>
                        <div class="basis-1/1 sm:basis-1/2 sm:ml-8">
                            <div class="">
                                <p class="text-center">Average of all tracked pages over the last 7 days</p>
                            </div>
                            <div class="flex flex-wrap sm:flex-nowrap">

                                <div class="basis-1/1 sm:basis-1/2 m-4 bg-white rounded-lg drop-shadow-lg">
                                    <div id="average-mobile-chart-{{$domain->id}}"></div>
                                </div>
                                <div class="basis-1/1 sm:basis-1/2 m-4 bg-white rounded-lg drop-shadow-lg">
                                    <div id="average-desktop-chart-{{$domain->id}}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-20 border-solid">


                    <script>
                        var options = {
                            series: [
                                {
                                    name: "Mobile",
                                    data: @json($graph[$domain->id]['mobile_days']['data'])
                                },
                                {
                                    name: "Desktop",
                                    data: @json($graph[$domain->id]['desktop_days']['data'])
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
                                text: 'Average page load time in seconds',
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
                                categories: @json($graph[$domain->id]['mobile_days']['labels']),
                                title: {
                                    text: 'Days'
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Sec'
                                },
                                min: 0,
                                max: {{max($graph[$domain->id]['mobile_days']['data']) + 2}},
                                stepSize: 1,
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

                        var chart_days_{{$domain->id}} = new ApexCharts(document.querySelector("#chart_days_{{$domain->id}}"), options);
                        chart_days_{{$domain->id}}.render();

                        var options = {
                            series: [{{$pagespeed[$domain->id]['mobile_score']}}],
                            chart: {
                                height: 350,
                                type: 'radialBar',
                                offsetY: -10
                            },
                            plotOptions: {
                                radialBar: {
                                    startAngle: -135,
                                    endAngle: 135,
                                    dataLabels: {
                                        name: {
                                            fontSize: '16px',
                                            color: '#000',
                                            offsetY: 120
                                        },
                                        value: {
                                            offsetY: 76,
                                            fontSize: '22px',
                                            color: '#000',
                                            formatter: function (val) {
                                                return Math.round(val) + "";
                                            }
                                        }
                                    }
                                }
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shade: 'dark',
                                    shadeIntensity: 0.15,
                                    inverseColors: false,
                                    opacityFrom: 1,
                                    opacityTo: 1,
                                    stops: [0, 50, 65, 91]
                                },
                            },
                            stroke: {
                                dashArray: 6
                            },
                            labels: ['Mobile Score'],
                        };

                        var chart_mobile = new ApexCharts(document.querySelector("#average-mobile-chart-{{$domain->id}}"), options);
                        chart_mobile.render();

                        var options = {
                            series: [{{$pagespeed[$domain->id]['desktop_score']}}],
                            chart: {
                                height: 350,
                                type: 'radialBar',
                                offsetY: -10
                            },
                            plotOptions: {
                                radialBar: {
                                    startAngle: -135,
                                    endAngle: 135,
                                    dataLabels: {
                                        name: {
                                            fontSize: '16px',
                                            color: '#000',
                                            offsetY: 120
                                        },
                                        value: {
                                            offsetY: 76,
                                            fontSize: '22px',
                                            color: undefined,
                                            formatter: function (val) {
                                                return Math.round(val) + "";
                                            }
                                        }
                                    }
                                }
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shade: 'dark',
                                    shadeIntensity: 0.15,
                                    inverseColors: false,
                                    opacityFrom: 1,
                                    opacityTo: 1,
                                    stops: [0, 50, 65, 91]
                                },
                            },
                            stroke: {
                                dashArray: 6
                            },
                            labels: ['Desktop Score'],
                        };

                        var chart_desktop = new ApexCharts(document.querySelector("#average-desktop-chart-{{$domain->id}}"), options);
                        chart_desktop.render();
                    </script>
                    @empty
                            <p>Please add your first domain</p>
                    @endforelse
                    </div>





        </div>
    </div>

</x-app-layout>
