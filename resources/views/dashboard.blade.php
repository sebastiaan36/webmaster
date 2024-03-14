<x-app-layout>
       <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">

                <div class="basis-1/3">
                    @forelse($domains as $domain)
                        <div class="m-4">
                            <table class="table-auto w-full border-collapse border m-6">
                                <thead>
                                    <tr>
                                        <th class="bg-green-200 border border-slate-300">Domain</th>
                                        <th class="bg-green-200 border border-slate-300">Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ route('domain.link.index', $domain->id,) }}">{{$domain->domain}}</a></td>
                                        <td>{{$count[$domain->id]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @empty
                            <p>Please add your first domain</p>
                    @endforelse

                </div>

            </div>


        </div>
    </div>
</x-app-layout>
