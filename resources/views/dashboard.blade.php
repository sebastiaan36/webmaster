<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="bg-green-100 rounded p-2 flex flex-row flex-row-reverse">
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="/dashboard?days=7">7 days</a></div>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="/dashboard?days=14">14 days</a></div>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="/dashboard?days=30">30 days</a></div>
                    <div class="rounded ml-2 p-2 bg-blue-300 hover:bg-blue-500"><a href="/dashboard?days=90">90 days</a></div>
                </div>
                <h4 class="text-lg pt-4">Average Speed over last {{ $days }} days for {{auth()->user()->domain}}</h4>
                <div class="p-6 flex flex-row text-gray-900">
                    <div class="basis-1/4 text-center p-6 m-4 rounded bg-green-200">
                        <p>Mobile Score</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['mobile_score'], 0) }}</p>
                    </div>
                    <div class="basis-1/4 text-center p-6 m-4 rounded bg-green-200">
                        <p>Mobile Score</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['mobile_speed'],2) }} sec</p>
                    </div>
                    <div class="basis-1/4 text-center p-6 m-4 rounded bg-green-200">
                        <p>Desktop Score</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['desktop_score'], 0) }}</p>
                    </div>
                    <div class="basis-1/4 text-center p-6 m-4 rounded bg-green-200">
                        <p>Desktop Speed</p>
                        <p class="font-lg font-black">{{ round($pagespeedAvg['desktop_speed'],2) }} sec</p>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <div style="width: 100%; margin: auto;">
                    <canvas id="scoreChart"></canvas>
                </div>

                <div style="width: 100%; margin: auto;">
                    <canvas id="speedChart"></canvas>
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
            </div>
        </div>
    </div>
</x-app-layout>
