@extends('layouts.app')

@section('title', 'BOOK NOW! ')
{{--@section('description', '')--}}

@section('body')
    <div class="relative min-h-screen">
    <div x-data="{ open_navbar: false, show_modal: false }"
        x-init="show_modal = @json(Session::has('overbooked'))" class="max-w-screen-xl mx-auto">
        @if (session('overbooked'))
            <div class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
                <div class="fixed inset-0 transition-opacity"
                     x-show="show_modal == true"
{{--                     x-transition:enter="ease-out duration-300"--}}
{{--                     x-transition:enter-start="opacity-0"--}}
{{--                     x-transition:enter-end="opacity-100"--}}
{{--                     x-transition:leave="ease-in duration-200"--}}
{{--                     x-transition:leave-start="opacity-100"--}}
{{--                     x-transition:leave-end="opacity-0"--}}
                >
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline"
                     x-show="show_modal == true"
{{--                     x-transition:enter="ease-out duration-300"--}}
{{--                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"--}}
{{--                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"--}}
{{--                     x-transition:leave="ease-in duration-200"--}}
{{--                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"--}}
{{--                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"--}}
                >
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                {{ session('overbooked') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Please give us a call if you think there has been an error on our end.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button @click="show_modal = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            I understand
                        </button>
                        <a href="tel: +35318097266">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Call us now
                            </button>
                        </a>
                    </div>
                </div>

            </div>
        @endif
        @include('sections.hero')
        @include('sections.our_principles')
        @include('sections.groups')
        @include('sections.public-courses-list')
        @include('sections.logos')
    </div>

    @include('sections.footer')
    </div>
@endsection
