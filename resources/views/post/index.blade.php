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
    </style>
</head>
<body>
<x-navigation/>

    <div class="py-12">
        <div class="px-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div class="basis-2/3">
                    @forelse($posts as $post)
                    <div class="flex mt-6 min-h-64">
                        <div class="basis-1/2 mr-12">
                            <div style="" class="w-full h-full">

                                <a href="{{ route('post.show', [$post->topic[0]->slug, $post->slug]) }}"><img class="object-cover w-full h-full" src="{{$post->featured_image}}"></a>
                            </div>
                        </div>
                        <div class="basis-1/2">
                            <div class="flex flex-col h-full justify-between">
                                <p class="order-1">By <span class="font-bold">{{$post->user->name}}</span>, published {{$post->published_at->format('d-m-Y');}}</p>
                                <h2 class="order-2 text-4xl mt-2">{{$post->title}}</h2>
                                    <p class="order-3">{{$post->summary}}</p>

                                <div class="order-4 flex flex-row">
                                    @forelse($post->tags as $tag)
                                        <span class="bg-gray-200 px-2 py-1 rounded-lg">{{$tag->name}}</span>
                                        @empty
                                        <p>No tags found</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No posts found</p>
                @endforelse
                </div>
            </div>

@forelse($posts as $post)

    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
                <p>{{ $post->user_id }}</p>

    @empty
    <p>No posts found</p>
@endforelse

        </div>
    </div>
</body>
</html>
```
