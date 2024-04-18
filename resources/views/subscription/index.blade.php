<x-app-layout>
    <div class="py-12 bg-theme-artic">

        <div class="px-2 max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">


                    <div class="p-4 bg-theme-lemon rounded-lg">
                        <h2 class="text-2xl font-bold text-theme-jade">Free!</h2>
                        <h3 class="text-lg font-bold text-theme-jade">€ 0,-</h3>
                        <p>Test only your homepage for free.</p>

                    </div>

                    <div class="p-4 bg-theme-lemon rounded-lg">
                        <h2 class="text-2xl font-bold text-theme-jade">Company!</h2>
                        <h3 class="text-lg font-bold text-theme-jade">€ {{$plans['Company']['amount']['value']}}</h3>
                        <p>Test only your homepage for free.</p>
                        <a class="p-2 bg-theme-jade rounded-lg text-white" href="{{ route('subscription.subscribe', 'Company') }}">Subscribe</a>
                            @csrf
                            <input type="hidden" name="plan" value="">
                            <button class="">Subscribe</button>
                        </form>
                    </div>




            </div>

        </div>

</x-app-layout>
