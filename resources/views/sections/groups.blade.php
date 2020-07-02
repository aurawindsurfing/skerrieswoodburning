<div class="bg-gray-50 pt-12 mt-4 sm:pt-16">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10">
                Training courses
            </h2>
            <p class="mt-3 text-xl leading-7 text-gray-500 sm:mt-4">
                We have over 100 safety courses available, please enquire for any course not listed below, and we will
                help you find a solution.
            </p>
        </div>
    </div>
    <div class="mt-10 pb-12 bg-white sm:pb-16">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
            <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    @foreach($groups_chunks as $groups)
                        <div class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-4 m-0">
                            @foreach ($groups as $group)
                                <a href="{{route('group', ['group' => $group->id])}}">
                                    <div class="border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                        <p class="text-5xl leading-none font-extrabold text-blue-600">
                                            ICONS
                                        </p>
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
</div>
