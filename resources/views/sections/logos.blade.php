<div class="bg-white">
    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <p class="text-center text-base leading-6 font-semibold uppercase text-gray-600 tracking-wider">
            Trusted by leading Irish companies
        </p>
        <div class="grid grid-cols-4 md:grid-cols-7 mt-6 lg:mt-8">
            @foreach($logos as $logo)
                <div class="justify-center m-auto py-2 px-2">
                    <img class="" src="{{ $logo }}"/>
                </div>
            @endforeach
        </div>
    </div>
</div>
