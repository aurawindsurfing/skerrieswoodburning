<div class="bg-white">
    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <p class="text-center text-base leading-6 font-semibold uppercase text-gray-600 tracking-wider">
            Trusted by leading Irish companies
        </p>
        <div class="mt-6 grid grid-cols-2 gap-0.5 md:grid-cols-3 lg:mt-8">
            @foreach($logos as $logo)
                <div class="col-span-1 flex justify-center py-8 px-8 bg-gray-50">
                    <img src="{{ $logo }}"/>
                    {{--                    <img src="{{ Cloudder::secureShow('cit/'.$logo, config('settings.cloudinary_logo')) }}" />--}}
                    {{--                    <img class="w-full" src="{{ Cloudder::secureShow('cit/pictures/digger-safety', config('settings.cloudinary_logo')) }}" alt="Digger Safety" />--}}
                </div>
            @endforeach
        </div>
    </div>
</div>
