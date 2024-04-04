<x-app-layout>
    <div class="py-12 h-full" >

        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">

            <x-breadcrumbs page="domain" domain="0" domainid="0" link="0"/>
            <div class="flex sm:flex-nowrap flex-col">
                @forelse ($domains as $domain)

                    <div class="flex flex-row bg-theme-dark mb-6 rounded-lg">
                        <div class="basis-1/1 flex p-8 flex-col justify-between sm:basis-1/3 text-theme-jade">
                            <h3 class="text-xl font-semibold">{{ $domain->domain }}</h3>
                            <p class=""><span class="material-symbols-outlined align-bottom mr-2">link</span>Links tracked: {{ count($domain->link) }}</p>
                            <a href="{{ route('domain.link.index', $domain->id) }}" class="bg-theme-jade hover:bg-theme-evergreen p-4 rounded-lg w-32 text-center text-theme-light">Details</a>
                        </div>
                        <div class="basis-1/1 sm:basis-2/3 p-6 bg-theme-pearl rounded-tr-lg rounded-br-lg">

                            <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                                <div class="rounded-lg overflow-hidden h-[156px] md:h-[278px] bg-white dark:bg-gray-800">
                                    <img src="{{url('/storage/screenshots/' . $domain->id . '.jpg')}}" class="dark:hidden h-[156px] md:h-[278px] w-full rounded-xl" alt="">
                                    <img src="https://flowbite.s3.amazonaws.com/docs/device-mockups/laptop-screen-dark.png" class="hidden dark:block h-[156px] md:h-[278px] w-full rounded-lg" alt="">
                                </div>
                            </div>
                            <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                                <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
                            </div>


                        </div>

                    </div>

                @empty
                    <p>Please add your first url</p>
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>
