<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pagespeed - Monitor your pagespeed</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,600,0,0"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-family: "Epilogue", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }
        h2{
            font-size: 2rem;
            font-weight: 600;
            line-height: 1.25;
            margin-top: 2.8rem;
            margin-bottom: 1rem;
        }
        h3{
            font-size: 1.6rem;
            font-weight: 600;
            line-height: 1.25;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        p{
            font-family: "Manrope", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            font-size: 20px;
            color: #1d1d1f
        }
        blockquote {
            font-family: "Epilogue", sans-serif;
            margin-left: 30px;
            font-size: 35px;
            margin-top: 25px;
            margin-bottom: 25px;
            padding: 10px;
            border-left: 3px solid #ccc;
        }
        blockquote > p {
            display:inline;
        }
        blockquote:before {
            content: '“';
        }
        blockquote:after {
            content: '”';
        }
    </style>
</head>
<body>
<x-navigation/>

<div class="py-12">
    <div class="mt-20  mx-auto px-8 md:px-auto">
        <div class="w-full">
            <div class="my-2">
                <div class=""><a href="/blog">home</a> <span class="align-top text-base material-symbols-outlined">navigate_next</span> <a href="/blog/{{$post->topic[0]->slug}}">{{$post->topic[0]->name}}</a> <span class="align-top text-base material-symbols-outlined">navigate_next</span> {{$post->title}}</div>
            </div>
            <div class="bg-black h-96 relative">
                <img class="w-full h-full object-cover opacity-50" src="{{$post->featured_image}}"> <!-- This line is new -->
                <div class="flex absolute top-6 left-3 sm:left-8">
                    <div class="text-white">by<img width="40" class="rounded-full inline mx-2" src="{{$post->user->avatar}}">{{$post->user->name}} | {{$post->published_at->format('d-m-Y')}}</div>
                </div>
                <div class="flex flex-col absolute bottom-4 sm:bottom-12 left-3 sm:left-8">
                    <h1 class="text-4xl max-w-96 sm:max-w-2xl mb-8 text-white">{{$post->title}}</h1>
                    <div class="text-white hidden sm:block max-w-3xl text-2xl mt-2">{{$post->summary}}</div>
                </div>
            </div>
        </div>
        <div id="content" class="flex flex-wrap sm:flex-nowrap sm:gap-6 mt-12">
            <div class="basis-full sm:basis-2/3 px-0 sm:px-10">
                {!! $post->body !!}
            </div>
            <div class="basis-full sm:basis-1/3">
                <div class="sticky top-20">
                    <div class="bg-theme-arctic p-4 rounded-lg">
                        <x-application-logo/>
                        <h2 class="">Keep track of your pagespeed</h2>
                        <p>Monitor your pagespeed with our free tool. Get insights on the impact of the changes you have made. Receive a weekly report on you page performance.</p>
                        <a class="text-theme-light w-full p-3 text-xl mt-4 rounded-lg bg-theme-jade hover:bg-theme-evergreen block align-middle text-center" href="{{route('register')}}"><span class="mr-4 align-middle text-4xl material-symbols-outlined">monitoring</span>Start for free</a>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
</body>
</html>
