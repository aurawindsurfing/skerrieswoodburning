@if (count(Nova::availableResources(request())))


    <?php
        $resources_ordered = collect(Nova::availableResources(request()))
            ->sortBy(function ($resource) {
                return $resource::$group_index;
            })
            ->groupBy(function ($resource) {
                return $resource::$group;
            });
    ?>



    {{-- @foreach(Nova::groupedResources(request()) as $group => $resources)
        @if (count($resources) > 0)
            @if (count(Nova::groups(request())) > 1)
                <h4 class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide">{{ $group }}</h4>
            @endif

            <ul class="list-reset mb-8">
                @foreach($resources as $resource)
                    @if (! $resource::$displayInNavigation)
                        @continue
                    @endif

                    <li class="leading-tight mb-4 ml-8 text-sm">
                        <router-link :to="{
                            name: 'index',
                            params: {
                                resourceName: '{{ $resource::uriKey() }}'
                            }
                        }" class="text-white text-justify no-underline dim">
                            {{ $resource::label() }}
                        </router-link>
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach --}}


    @foreach ($resources_ordered as $group => $resources)
        <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
            {{ ucwords($group) }}
        </h3>
        <ul class="list-reset mb-8">
            @foreach ($resources as $resource)
                @if (! $resource::$displayInNavigation)
                    @continue
                @endif

                <li class="leading-wide mb-4 text-sm">
                    <router-link :to="{
                    name: 'index',
                    params: {
                        resourceName: '{{ $resource::uriKey() }}'
                    }
                }" class="text-white ml-8 no-underline dim">
                        {{ $resource::label() }}
                    </router-link>
                </li>
            @endforeach
        </ul>
    @endforeach


@endif

