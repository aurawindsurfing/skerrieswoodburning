<div :class="{'block': open_navbar, 'hidden': !open_navbar}" class="fixed top-0 inset-x-0 p-2 hidden md:hidden">
    <div x-show="open_navbar" x-transition:enter="duration-150 ease-out" x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in"
         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="rounded-lg shadow-md transition transform origin-top-right">
        <div class="rounded-lg bg-white shadow-xs overflow-hidden justify-between">
            <div class="px-5 pt-4 flex items-center justify-between">
                <div>
                    <img class="h-8 w-auto" src="/images/cit_logo2.svg" alt=""/>
                </div>
                <div class="-mr-2">
                    <button @click="open_navbar = false" type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
