<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pagespeed - Monitor your pagespeed</title>
    <link rel="icon" type="image/png" href="storage/images/favicon.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,600,0,0"/>

    <x-styles/>
    <!-- Styles -->
    <style>

        /* custom css BEWAREN */
        #hero{
            background-image: url('data:image/svg+xml,<svg version="1.2" baseProfile="tiny" id="Laag_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 1080" overflow="visible" xml:space="preserve"><g><rect x="0.5" y="0.5" fill="%23FBFBFB" width="1236" height="1079"/><path d="M1236,1v1078H1V1H1236 M1237,0H0v1080h1237V0L1237,0z"/></g><g><rect x="1237.5" y="0.5" fill="%2306606B" width="682" height="1079"/><path d="M1919,1v1078h-681V1H1919 M1920,0h-683v1080h683V0L1920,0z"/></g></svg>');
            background-size: cover;
            background-repeat: no-repeat;
            background-position-x: center;
        }
        #how{
            background-image: url('data:image/svg+xml,<svg version="1.2" baseProfile="tiny" id="Laag_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 1080" overflow="visible" xml:space="preserve"><rect x="-1" fill="%23013941" width="1921" height="1083"/><g><path fill="%23009156" d="M1924.9,955.9c-90.8,0-181.7,0-272.7,0c-0.1-2.8,1.5-4.2,2.6-5.8c24.6-37,49.2-74,73.9-111c18.8-28.2,37.6-56.4,56.4-84.7c3.5-5.2,3.5-5.2,7,0c42.7,64.1,85.3,128.2,128,192.3c1.6,2.3,3.2,4.7,4.8,7C1924.9,954.5,1924.9,955.2,1924.9,955.9z"/><path fill="%23009156" d="M740.4,0c-0.6,2.5,1.4,4,2.5,5.7c26.1,39.2,52.2,78.4,78.3,117.6c1.1,1.6,2.5,3.1,2.8,6c-91.2,0-182.2,0-273.1,0l0.1,0.1c-0.4-2.3,1.3-3.7,2.4-5.3c26.2-39.5,52.5-78.9,78.7-118.4c1.2-1.8,2.9-3.3,3-5.7C670.1,0,705.2,0,740.4,0z"/><path fill="%23009156" d="M-0.9,749.2c45.4,0,90.8,0,136.3,0c0.6,2.7-1.2,4.1-2.2,5.6c-13.5,20.3-27,40.6-40.5,60.9c-29.7,44.6-59.4,89.2-89.2,133.8c-1.1,1.7-1.6,4.2-4.3,4.3C-0.9,885.6-0.9,817.4-0.9,749.2z"/><path fill="%23009156" d="M360.2,0c-1.8,3.8-4.4,7.1-6.7,10.6c-25.1,37.7-50.2,75.3-75.3,113c-1.1,1.6-1.8,3.6-3.7,4.5c-1.4-0.6-2-1.8-2.7-2.9C244.5,84,217.1,42.9,189.7,1.7c-0.4-0.6-0.7-1.2-1-1.7C245.9,0,303,0,360.2,0z"/><path fill="%23009156" d="M190.7,1083.2c-0.2-1.9,1.2-3.1,2-4.4c26.1-39.3,52.3-78.7,78.5-118c0.9-1.4,1.6-3,3.2-3.8c1.6,0.5,2.2,2,3,3.2c27,40.4,53.9,80.8,80.8,121.3c0.4,0.6,0.7,1.2,1,1.7C303,1083.2,246.9,1083.2,190.7,1083.2z"/><path fill="%23009156" d="M1016.2,1083.2c0.2-1.8,1.4-3,2.3-4.4c26.1-39.3,52.2-78.5,78.3-117.7c3.5-5.2,3.5-5.2,7,0.1c26.1,39.2,52.3,78.4,78.4,117.7c0.9,1.4,2.1,2.6,2.4,4.3C1128.5,1083.2,1072.3,1083.2,1016.2,1083.2z"/><path fill="%23009156" d="M1649.4,955.1c-3.8,1-267.1,1.2-272.2,0.2c-0.1-0.2-0.2-0.3-0.2-0.5c0-0.2,0-0.4,0-0.5c44.2-67.3,89.1-134.1,133.7-201.2c0.6-1,1.4-1.8,2-2.6c0.4-0.1,0.6-0.1,0.7-0.1c0.2,0,0.4,0,0.5,0.1c1.1,1.5,2.3,2.9,3.3,4.4c44.1,66.4,88.2,132.8,132.3,199.2C1649.6,954.4,1649.4,954.8,1649.4,955.1z"/><path fill="%23009156" d="M1650.8,543.7c1.8,0.6,2.4,2.3,3.3,3.6c43.7,65.5,87.3,131,130.9,196.5c0.5,0.7,1,1.4,1.4,2.1c1.4,2.5,1.1,3-1.9,3.2c-1.3,0.1-2.7,0-4,0c-86.2,0-172.5,0-258.7,0c-2.2,0-5.4,1.2-6.5-0.9c-1.2-2.2,1.5-4.1,2.8-5.9c43.1-64.9,86.3-129.7,129.4-194.5C1648.4,546.4,1649,544.6,1650.8,543.7z"/><path fill="%23009156" d="M1238.4,749.8c45.6,68.4,91,136.6,136.6,205.1c-2.5,1.3-4.5,0.9-6.4,0.9c-24.4,0-48.8,0-73.2,0c-62.3,0-124.6,0-187-0.1c-2.2,0-5.3,1.2-6.4-1c-0.9-1.8,1.6-3.8,2.8-5.5c43-64.7,86.1-129.3,129.2-194C1235.1,753.5,1236.1,751.6,1238.4,749.8z"/></g></svg>');

            background-position-x: center;
        }
        p{
            color: #013941;
        }
        nav{
            font-family: "Epilogue", sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">


<x-navigation/>


<div
    class="relative pt-24 sm:pt-0 sm:items-center sm:min-h-screen bg-center">

    <div id="hero" class="">
        <section class="bg-theme-light sm:bg-transparent">
            <div
                class="container sm:min-h-screen flex flex-col justify-center p-6 mx-auto sm:py-12 lg:py-24 lg:flex-row lg:justify-between">
                <div
                    class="flex flex-col justify-center p-6 text-center rounded-sm lg:max-w-md xl:max-w-lg lg:text-left">
                    <h1 class="text-5xl font-bold leading-none sm:text-6xl">Track your
                        <span class="text-theme-evergreen">Pagespeed</span> every day.
                    </h1>
                    <p class="mt-6 mb-4 text-lg sm:mb-4">The speed of your website is important.
                        <br class="hidden md:inline lg:hidden">Get the metrics you need and get notified when something
                        is wrong.
                    </p>
                    <ul class="mt-1 mb-4 text-lg sm:mb-4">
                        <li class="mb-2">
                            <x-check/>
                            Track multiple links
                        </li>
                        <li class="mb-2">
                            <x-check/>
                            Weekly updates
                        </li>
                        <li class="mb-2">
                            <x-check/>
                            30 day free trial
                        </li>
                    </ul>
                    <div
                        class="flex flex-col space-y-4 sm:items-center sm:justify-center sm:flex-row sm:space-y-0 sm:space-x-4 lg:justify-start">
                        <a rel="noopener noreferrer" href="/register"
                           class="bg-theme-jade hover:bg-theme-evergreen text-white px-8 py-3 text-lg font-semibold rounded ">Start
                            for free</a>
                        <a rel="noopener noreferrer" href="#price"
                           class="px-8 py-3 text-lg text-theme-dark font-semibold border-theme-jade border rounded">Check price</a>
                    </div>
                </div>
                <div class="flex flex-col justify-center py-6 px-0 sm:p-6 text-center rounded-sm">
                    <div class="flex justify-center flex-row">
                    <div class="relative hidden sm:block rounded-lg max-w-72 mt-32 mr-[-100px] z-10">
                        <img class="rounded-lg" src="storage/images/pagespeed-tracker-happy.webp">
                    </div>
                    <div class="bg-theme-jade p-3 sm:p-12 rounded-lg sm:ml-[-60px]">
                        <p class="text-theme-teal text-center font-bold text-2xl"><span class="border-b-2 border-theme-teal">Digital dashboard to check your page scores</span></p>
                    <img width="600" height="400" src="storage/images/homebanner.webp" alt=""
                         class="object-contain mt-6 h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="how" class="sm:h-screen bg-repeat bg-contain sm:bg-cover sm:bg-no-repeat content-center">
        <div class="container p-6 mx-auto sm:py-12 lg:py-24 ">
            <h2 class="text-4xl text-theme-jade text-center font-bold">How to track your pagespeed over time</h2>
            <div class="my-10 flex min-h-[40vh] flex-col justify-center lg:flex-row lg:justify-between">
                <div class="basis-1 flex flex-col justify-center bg-theme-jade rounded-lg m-6 py-4 px-8 md:basis-1/3">
                    <p class="py-4 text-center"><span class="text-8xl  material-symbols-outlined">add_chart</span>
                    </p>
                    <p class="text-lg py-2"><span class="font-semibold">Step 1:</span> Add your domain.</p>
                    <p class="text-lg py-2"><span class="font-semibold">Step 2:</span> Add de url's you want to track
                    </p>
                    <p class="text-lg py-2"><span class="font-semibold">Step 3:</span> Get some sleep and get back the
                        next day.</p>
                </div>
                <div class="basis-1 bg-theme-jade flex flex-col justify-center rounded-lg m-6 py-4 px-8 md:basis-1/3">
                    <p class="py-4 text-center"><span
                            class="text-8xl material-symbols-outlined">sensors</span></p>
                    <p class="text-lg">We will start tracking your url's automaticaly. Every url will be checked once a
                        day. And you will be able to see the results the next day. If you want we can notify you when
                        something is wrong.</p>
                </div>
                <div class="basis-1 flex flex-col justify-center bg-theme-jade rounded-lg m-6 py-4 px-8 md:basis-1/3">
                    <p class="py-4 text-center"><span class="text-8xl  material-symbols-outlined">monitoring</span>
                    </p>
                    <p class="text-lg">Monitor your pages and the changes you make to your site over time. Make sure
                        your website is always as fast and you can keep your core web vitals where you want them to be.</p>
                </div>

            </div>

        </div>
    </div>
    <div id="price">
        <section class="sm:h-screen content-center">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 ">Stay on top of
                        your pagespeed</h2>
                    <p class="mb-5 font-light text-gray-500 sm:text-xl ">Pagespeed is one of the more
                        import metrics for your SEO score. Stay up to date on your page performance and see the results
                        in a simple overview. You can start for free. That's <strong class="font-weight-700">forever
                            free</strong> if you just want to track your homepage!</p>
                </div>
                <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                    <!-- Pricing Card -->
                    <div
                        class="flex justify-between flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 transition duration-500 hover:scale-110 shadow">
                        <h3 class="mb-4 text-2xl font-semibold">Free</h3>
                        <p class="font-light text-gray-500 sm:text-lg ">Best option for personal use
                            or small business if you just want to track your homepage</p>
                        <div class="flex justify-center items-baseline my-8">
                            <span class="mr-2 text-5xl font-extrabold">€0</span>
                            <span class="text-gray-500">/month</span>
                        </div>
                        <!-- List -->
                        <ul role="list" class="mb-8 space-y-4 text-left">
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Forever free!</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500 "
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>No setup, or hidden fees</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Track your <span
                                        class="font-semibold">homepage</span></span></span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500 "
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Premium support: <span class="font-semibold">trough e-mail</span></span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>History going back <span class="font-semibold">90 days</span></span>
                            </li>
                        </ul>
                        <a href="/register"
                           class="text-white bg-theme-jade hover:bg-theme-evergreen focus:ring-4 focus:ring-indigo-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Get
                            started</a>
                    </div>
                    <!-- Pricing Card -->
                    <div
                        class="flex justify-between flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white transition duration-500 hover:scale-110 rounded-lg border border-gray-100 shadow xl:p-8">
                        <h3 class="mb-4 text-2xl font-semibold">Company</h3>
                        <p class="font-light sm:text-lg">Track <span
                                class="font-semibold">1 domain</span> and <span
                                class="font-semibold">max. 25 pages</span>. Ideal if you want to track your important pages</p>
                        <div class="flex justify-center items-baseline my-8">
                            <span class="mr-2 text-5xl font-extrabold">€4,99</span>
                            <span class="text-gray-500">/month</span>
                        </div>
                        <!-- List -->
                        <ul role="list" class="mb-8 space-y-4 text-left">
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>We can help you set it up</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>No setup, or hidden fees</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500 "
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Get CLS metric and pagesize</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Premium support: <span class="font-semibold">Phone, chat and e-mail</span></span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Trial <span class="font-semibold">30 days free!</span></span>
                            </li>
                        </ul>
                        <a href="/register"
                           class="text-white bg-theme-jade hover:bg-theme-evergreen focus:ring-4 focus:ring-indigo-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Get
                            started</a>
                    </div>
                    <!-- Pricing Card -->
                    <div
                        class="flex flex-col justify-between p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow  xl:p-8  transition duration-500 hover:scale-110">
                        <h3 class="mb-4 text-2xl font-semibold">Agency</h3>
                        <p class="font-light text-gray-500 sm:text-lg">Ideel for agencies who want to
                            track their customers website. Pay per tracked domain (min 10 domains)</p>
                        <div class="flex justify-center items-baseline my-8">
                            <span class="mr-2 text-5xl font-extrabold">€0,99</span>
                            <span class="text-gray-500 ">/domain</span>
                        </div>
                        <!-- List -->
                        <ul role="list" class="mb-8 space-y-4 text-left">
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500 "
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Cheap and easy tracking</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500 "
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>No setup, or hidden fees</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span><span class="font-semibold">25 pages</span> per domain</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Premium support: <span class="font-semibold">Phone, chat and e-mail</span></span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Import: <span class="font-semibold">csv, excel, xml</span></span>
                            </li>
                        </ul>
                        <a href="/register"
                           class="text-white bg-theme-jade hover:bg-theme-evergreen focus:ring-4 focus:ring-indigo-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Get
                            started</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="contact">
        <section class="mt-20 bg-theme-evergreen text-white py-20">
            <div class="grid max-w-6xl grid-cols-1 px-6 mx-auto lg:px-8 md:grid-cols-2 md:divide-x">
                <div class="py-6 md:py-0 md:px-6">
                    <h1 class="text-4xl text-theme-light font-bold">Get in touch</h1>
                    <p class="pt-2 pb-4 text-theme-light">Fill in the form to start a conversation. If you need custom amounts of quantities to check or you need help setting up your account let use know. Here to help</p>
                    <div class="space-y-4 ">
                        <p class="flex items-center text-theme-light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 sm:mr-6">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Schoorlstraat 16,<br \> Amsterdam NL</span>
                        </p>
                        <p class="flex hidden items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 sm:mr-6">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            <span>123456789</span>
                        </p>
                        <p class="flex items-center text-theme-light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 sm:mr-6">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span>info@been-vandam.nl</span>
                        </p>
                        <span class="pt-4 block text-xs">CoC NL: 85506656 | VAT:NL004107194B87 </span>
                    </div>
                </div>
                <form action="{{route('contact.sendmail')}}" novalidate="" class="flex flex-col py-6 space-y-6 md:py-0 md:px-6">
                    {{ csrf_field() }}
                    <label class="block">
                        <span class="mb-1">Full name</span>
                        <input type="text" name="name" placeholder="Leroy Jenkins" class="text-theme-dark block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-75 ">
                    </label>
                    <label class="block">
                        <span class="mb-1">E-mail address</span>
                        <input type="email" name="email" placeholder="leroy@jenkins.com" class="text-theme-dark block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-75 ">
                    </label>
                    <label class="block">
                        <span class="mb-1">Message</span>
                        <textarea rows="3" name="message" class="block text-theme-dark w-full rounded-md focus:ring focus:ring-opacity-75 "></textarea>
                    </label>
                    @if ( session('success'))
                        {{ session('success') }}
                    @endif
                    <button type="submit" class=" bg-theme-jade text-white px-8 py-3 text-lg rounded focus:ring hover:ring focus:ring-opacity-75 ">Submit</button>
                </form>
            </div>
        </section>
    </div>
</div>
</body>
</html>
