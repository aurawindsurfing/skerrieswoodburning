<div class="bg-gray-50 pt-12 mt-4 sm:pt-16">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto lg:text-center">
            <h1 class="text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10">
                Safety courses in Dublin
            </h1>
            <h2 class="mt-3 text-xl leading-7 text-gray-500 sm:mt-4">
                Safepass course Dublin, First Aid Course or MEWP courses in Blanchardstown, Dublin 15. We have over 100 quick safe pass courses and safety courses online as well as available in  vanues across Dublin such as
                <a href="{{route('venue', ['venue' => 'parslickstown-house-base-enterprise-centre-ladyswell-road-mulhuddart-dublin-15-dublin-d15-x2vw'])}}" class="text-gray-500 hover:text-gray-900">
                    Parslickstown House,
                </a>
                <a href="{{route('venue', ['venue' => 'carlton-hotel-tyrrelstown-dublin-15'])}}" class="text-gray-500 hover:text-gray-900">
                    Carlton Hotel,
                </a>
                <a href="{{route('venue', ['venue' => 'the-grasshopper-inn-main-street-clonee-meath'])}}" class="text-gray-500 hover:text-gray-900">
                    Grasshopper Inn,
                </a>
                <a href="{{route('venue', ['venue' => 'wynn-s-hotel'])}}" class="text-gray-500 hover:text-gray-900">
                    Wynn's Hotel
                </a> or
                <a href="{{route('venue', ['venue' => 'red-cow-moran-hotel'])}}" class="text-gray-500 hover:text-gray-900">
                    Red Cow Moran Hotel.
                </a>
                Please
                <a href="{{route('bespoke')}}" class="text-gray-500 hover:text-gray-900">
                    enquire
                </a>
                for any course not listed below, and we will help you find a solution to make. Safe ireland is our priotity.
            </h2>
        </div>
    </div>
    <div x-bind:class="{ 'relative': !show_modal }" class="mt-10 pb-12 bg-white sm:pb-16">
            <div x-bind:class="{ 'absolute': !show_modal }" class="inset-0 h-1/2 bg-gray-50"></div>
            <div x-bind:class="{ 'relative': !show_modal }" class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    @foreach($groups_chunks as $groups)
                        <div class="rounded-lg bg-white shadow-lg grid grid-cols-2 sm:grid-cols-4 m-0">
                            @foreach ($groups as $group)
                                <a href="{{route('group', ['group' => $group->slug])}}">
                                    <div class="min-h-full border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
{{--                                        <p class="text-5xl leading-none font-extrabold text-blue-600">--}}
{{--                                            ICONS--}}
{{--                                        </p>--}}
                                        <img class="w-32 h-32 flex-shrink-0 mx-auto bg-black rounded-full" src="{{ $group->image_url() }}" alt="{{$group->name}} in Dublin">
                                        <p class="mt-2 text-lg leading-6 font-medium text-gray-500">
                                            {{$group->name}}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
</div>
