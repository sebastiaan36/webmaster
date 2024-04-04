<x-app-layout>
    <div class="py-12 bg-theme-artic">

        <div class="px-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs page="dashboard" domain="1" domainid="1" link="1" />

            @forelse($domains as $domain)

                <div class="flex pb-20 border-b-2 border-theme-evergreen flex-wrap sm:flex-nowrap mb-20">

                    <div class="basis-1/1 sm:basis-1/2">
                        <div class="flex justify-between gap-x-3">
                            <h2 class="text-3xl text-theme-dark font-bold">{{preg_replace("(^https?://)", "", $domain->domain )}}</h2>
                            <a href="{{route('domain.link.index', $domain->id)}}"
                               class="bg-theme-evergreen hover:bg-theme-dark text-theme-light rounded-lg p-2 text-center">Details</a>
                        </div>
                        <div class="flex gap-x-1 sm:gap-x-5 my-4">
                            <div class="basis-1/3 p-4 bg-theme-teal rounded-lg">
                                <div
                                    class="flex items-center justify-center bg-theme-jade rounded-md size-12 text-15 text-green-50">
                                    <span class="material-symbols-outlined">link</span>
                                </div>
                                <h5 class="text-theme-light mt-5 mb-2"><span class="counter text-2xl font-bold"
                                                            data-target="{{$count[$domain->id]}}">{{$count[$domain->id]}}</span>
                                </h5>
                                <p class="text-theme-light">URL's tracked</p>
                            </div>
                            <div class="basis-1/3 p-4 bg-theme-teal rounded-lg">
                                <div
                                    class="flex items-center justify-center bg-theme-jade rounded-md size-12 text-15 text-green-50">
                                    <span class="material-symbols-outlined">avg_time</span>
                                </div>
                                <h5 class="mt-5 mb-2 text-theme-light">
                                    <div class="counter-value font-bold mb-1">
                                        <span
                                            class="material-symbols-outlined mr-2 align-bottom">phone_iphone</span>{{number_format($pagespeed[$domain->id]['mobile_speed'],2)}}
                                        sec
                                    </div>
                                    <div class="counter-value font-bold">
                                        <span
                                            class="material-symbols-outlined mr-2 align-bottom">desktop_windows</span>{{number_format($pagespeed[$domain->id]['desktop_speed'],2)}}
                                        sec
                                    </div>

                                </h5>


                            </div>
                            <div class="basis-1/3 p-4 bg-theme-teal rounded-lg">
                                <div
                                    class="flex items-center justify-center bg-theme-jade rounded-md size-12 text-15 text-green-50">
                                    <span class="material-symbols-outlined">construction</span>
                                </div>
                                <div class="mt-5 text-theme-light mb-2"><p>There are <a
                                            href="{{route('domain.link.index', $domain->id)}}"
                                            class="font-bold">{{$pagespeed[$domain->id]['need_work']}} page(s)</a> that
                                        need improvement</p></div>

                            </div>
                        </div>
                        <div class="bg-white rounded-lg" id="chart_days_{{$domain->id}}"></div>


                    </div>
                    <div class="basis-1/1 sm:basis-1/2 sm:ml-8">
                        <div class="mb-[14px]">
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
                                        color: '#013941',
                                        offsetY: 120
                                    },
                                    value: {
                                        offsetY: 76,
                                        fontSize: '22px',
                                        color: '#013941',
                                        formatter: function (val) {
                                            return Math.round(val) + "";
                                        }
                                    }
                                }
                            }
                        },
                        fill: {
                            type: 'gradient',
                            colors: ['#009156'],
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
                            colors: ['#009156'],
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
                <div class="flex">
                    <div class="basis-1 sm:basis-1/2">
                        <h1 class="">Welcome to Pagespeed Tracker</h1>
                        <p>Before we can start tracking your page it's time to add your first domain.</p>
                        <p class="mb-6">To add your first domain please pres this button</p>
                        <a href="{{route('domain.create')}}" class="px-4 py-2 mt-16 bg-blue-500 text-white rounded-lg">Add
                            Domain</a>
                    </div>
                </div>
            @endforelse
        </div>


    </div>
    </div>

</x-app-layout>
