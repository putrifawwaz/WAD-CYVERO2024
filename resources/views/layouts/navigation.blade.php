<nav x-data="{ open: false }" class="fixed top-0 w-full bg-white z-50 border-b border-gray-100 dark:border-gray-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('photos/logo.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
            </div>


            <div class="flex items-center space-x-8 justify-center">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-700 hover:text-blue-900">
                    {{ __('Home') }}
                </x-nav-link>

                <x-nav-link :href="route('subevents.index')" :active="request()->routeIs('subevents.index')" class="text-gray-700 hover:text-blue-900">
                    {{ __('Sub-Events') }}
                </x-nav-link>

                @if(Auth::check() && Auth::user()->email === 'admin@gmail.com')
                    <x-nav-link :href="route('participants.index')" :active="request()->routeIs('participants.index')" class="text-gray-700 hover:text-blue-900">
                        {{ __('Participants') }}
                    </x-nav-link>
                @endif

                <x-nav-link :href="route('schedules.index')" :active="request()->routeIs('schedules.index')" class="text-gray-700 hover:text-blue-900">
                    {{ __('Schedule') }}
                </x-nav-link>

                <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.index')" class="text-gray-700 hover:text-blue-900">
                    {{ __('Documentation') }}
                </x-nav-link>

                <x-nav-link :href="route('news.index')" :active="request()->routeIs('news.index')" class="text-gray-700 hover:text-blue-900">
                    {{ __('News') }}
                </x-nav-link>
            </div>

            <div class="flex items-center space-x-4">
                @if(Auth::check() && Auth::user())
                    <div x-data="{ openDropdown: false }" class="relative">
                        <button @click="openDropdown = ! openDropdown" class="inline-flex items-center px-2 py-2 border-1 border-blue-600 text-sm leading-4 font-medium rounded-full text-blue-500 bg-white hover:text-blue-600 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-2">
                            </div>
                        </button>

                        <div x-show="openDropdown" x-transition @click.away="openDropdown = false" class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                            <x-dropdown-link :href="route('profile.edit')" class="text-blue-900 hover:bg-blue-400 hover:text-white hover:scale-105 transition-transform">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-gray-500 hover:bg-blue-400 hover:text-white hover:scale-105 transition-transform" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Hamburger Menu for Small Screens -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-blue-600 hover:text-white focus:outline-none transition duration-150 hover:scale-105">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
