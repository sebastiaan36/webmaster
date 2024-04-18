<div class="w-full p-4 sm:p-8 bg-theme-lemon rounded-lg">
    @if(auth()->user()->onGenericTrial())
        <h2>Your on your trial period. Like what you see? <a class="p-2 bg-theme-jade rounded-lg text-white" href="">Subscribe now</a></h2>
    @else
        @if(auth()->user()->subscribed('free') || auth()->user()->subscribed('company') || auth()->user()->subscribed('agency'))
            <h2>You have subscription</h2>
        @else

        <h2>Your trial period has ended. <a href="">Subscribe now</a></h2>
            @endif
    @endif
</div>
