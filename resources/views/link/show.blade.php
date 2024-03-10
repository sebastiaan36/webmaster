<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!empty($data))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="bg-green-100 rounded p-2 flex flex-row flex-row-reverse">
                    <button class="bg-green-500 rounded font-lg font-black text-white p-2 ml-2 hover:bg-green-700" id="toggleButton">Toggle Graph/Table</button>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="?days=7">7 days</a></div>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="?days=14">14 days</a></div>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="?days=30">30 days</a></div>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="?days=90">90 days</a></div>
                </div>
                <h4 class="text-lg pt-4">Average Speed over last {{ $days }} days for: <br \> {{$link->url}}</h4>
                <div class="p-6 flex flex-row gap-2 flex-wrap md:flex-nowrap text-gray-900">
                    <div class="basis-1/4 p-6  sm:basis-2/5:m6 lg:basis-1/4:m6 text-center  rounded bg-green-200">
                        <p>Mobile Score</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['mobile_score'], 0) }}</p>
                    </div>
                    <div class="basis-1/4 p-6  sm:basis-2/5:m6 lg::basis-1/4:m6 text-center rounded bg-green-200">
                        <p>Mobile Speed</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['mobile_speed'],2) }} sec</p>
                    </div>
                    <div class="basis-1/4 p-6  sm:basis-2/5:m6 lg:basis-1/4:m6 text-center  rounded bg-green-200">
                        <p>Desktop Score</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['desktop_score'], 0) }}</p>
                    </div>
                    <div class="basis-1/4 p-6  sm:basis-2/5:m6 lg::basis-1/4:m6 text-center rounded bg-green-200">
                        <p>Desktop Speed</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['desktop_speed'],2) }} sec</p>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <div id="graph">
                    <div style="width: 100%; margin: auto;">
                        <canvas style="min-height: 300px;" id="scoreChart"></canvas>
                    </div>

                    <div style="width: 100%; margin: auto;">
                        <canvas id="speedChart"></canvas>
                    </div>
                </div>

                <div id="table" style="display: none">
                    <table class="table-auto w-full border-collapse border">
                        <thead>
                        <tr class="p-2">
                            <th class="bg-green-200 border border-slate-300">Date</th>
                            <th class="bg-green-200 border border-slate-300">Mobile Score</th>
                            <th class="bg-green-200 border border-slate-300">Mobile Speed</th>
                            <th class="bg-green-200 border border-slate-300">Desktop Score</th>
                            <th class="bg-green-200 border border-slate-300">Destkop Speed</th>
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
                    var ctx = document.getElementById('scoreChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($data['mobile_score']['labels']),
                            datasets: [{
                                label: 'Mobile Score',
                                data: @json($data['mobile_score']['data']),
                                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                borderColor: 'rgba(32, 132, 129, 1)',
                                borderWidth: 2,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointHoverRadius: 15,
                            },
                                {
                                    label: 'Desktop Score',
                                    data: @json($data['desktop_score']['data']),
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(249, 120, 58, 1)',
                                    borderWidth: 2,
                                    pointStyle: 'circle',
                                    pointRadius: 5,
                                    pointHoverRadius: 15,
                                }]
                        },
                        options: {
                            responsive: true,
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Page Speed Score',
                                }
                            },
                            animations: {
                                radius: {
                                    duration: 800,
                                    easing: 'linear',
                                    loop: (context) => context.active
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            }
                        },

                    });

                    var ctx = document.getElementById('speedChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($data['mobile_speed']['labels']),
                            datasets: [{
                                label: 'Mobile Speed',
                                data: @json($data['mobile_speed']['data']),
                                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                borderColor: 'rgba(32, 132, 129, 1)',
                                borderWidth: 2,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointHoverRadius: 15,
                            },
                                {
                                    label: 'Desktop Speed',
                                    data: @json($data['desktop_speed']['data']),
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(249, 120, 58, 1)',
                                    borderWidth: 2,
                                    pointStyle: 'circle',
                                    pointRadius: 5,
                                    pointHoverRadius: 15,
                                }]
                        },
                        options: {
                            responsive: true,
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Page Load Time in seconds',
                                }
                            },
                            animations: {
                                radius: {
                                    duration: 800,
                                    easing: 'linear',
                                    loop: (context) => context.active
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,

                                }
                            }
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                    });
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