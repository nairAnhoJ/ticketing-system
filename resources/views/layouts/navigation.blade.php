<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('storage\images\logo\logo.png') }}" class="block h-auto w-28" alt="">
                        {{-- <x-application-logo class="block w-auto text-gray-800 fill-current h-14" /> --}}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('ticket.index')" :active="request()->routeIs('ticket.index') || request()->routeIs('ticket.reports') || request()->routeIs('ticket.genReports')">
                        {{ __('Ticketing') }}
                    </x-nav-link>

                    @php
                        $x = 0;
                    @endphp

                    @if ($x == 1)
                    {{-- @if (auth()->user()->role == 'admin' || auth()->user()->dept_id == 2) --}}
                        <button id="ddInventoryLink" data-dropdown-toggle="ddInventory" class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium md:hover:bg-transparent text-sm md:hover:text-gray-200 md:p-0 md:w-auto text-gray-400 hover:text-gray-200 focus:text-white border-b-2 border-transparent hover:border-blue-300 text-center
                        @php
                            if ( request()->routeIs('item.index') || request()->routeIs('computer.index') || request()->routeIs('item.index') || request()->routeIs('item.add') || request()->routeIs('phoneSim.index') || request()->routeIs('phoneSim.add') || request()->routeIs('phoneSim.edit') || request()->routeIs('defectivePhone.index') || request()->routeIs('defectiveIndex.index') ) {
                                echo 'border-blue-500 text-gray-100';
                            }
                        @endphp
                        ">Inventory<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                        <!-- Dropdown menu -->
                        <div id="ddInventory" class="z-10 hidden font-normal bg-gray-700 divide-y divide-gray-600 rounded shadow w-44">
                            <ul class="px-2 py-2 text-sm text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('item.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('item.index') || request()->routeIs('item.add') || request()->routeIs('item.edit') || request()->routeIs('defectiveIndex.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Items</a>
                                </li>
                                <li>
                                    <a href="{{ route('computer.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('computer.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Computer</a>
                                </li>
                                <li>
                                    <a href="{{ route('phoneSim.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('phoneSim.index') || request()->routeIs('phoneSim.add') || request()->routeIs('phoneSim.edit') || request()->routeIs('defectivePhone.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Phone / SIM</a>
                                </li>
                            </ul>
                        </div>

                        <button id="ddRequestLink" data-dropdown-toggle="ddRequest" class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium md:hover:bg-transparent text-sm md:hover:text-gray-200 md:p-0 md:w-auto text-gray-400 hover:text-gray-200 focus:text-white border-b-2 border-transparent hover:border-blue-300 text-center
                        @php
                            if ( request()->routeIs('reqItem.index') || request()->routeIs('reqItem.add') || request()->routeIs('reqItem.edit') || request()->routeIs('reqItem.del') || request()->routeIs('reqPhoneSim.index') || request()->routeIs('reqPhoneSim.add') || request()->routeIs('reqPhoneSim.edit') || request()->routeIs('reqPhoneSim.del')) {
                                echo 'border-blue-500 text-gray-100';
                            }
                        @endphp
                        ">Request<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                        <!-- Dropdown menu -->
                        <div id="ddRequest" class="z-10 hidden font-normal bg-gray-700 divide-y divide-gray-600 rounded shadow w-44">
                            <ul class="px-2 py-2 text-sm text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('reqItem.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('reqItem.index') || request()->routeIs('reqItem.add') || request()->routeIs('reqItem.edit') || request()->routeIs('reqItem.del')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Items</a>
                                </li>
                                <li>
                                    <a href="{{ route('reqPhoneSim.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('reqPhoneSim.index') || request()->routeIs('reqPhoneSim.add') || request()->routeIs('reqPhoneSim.edit') || request()->routeIs('reqPhoneSim.del')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Phone / SIM</a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('item.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('printer.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Printer</a>
                                </li> --}}
                            </ul>
                        </div>
                    @endif





                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                        <button id="ddSystemLink" data-dropdown-toggle="ddSystem"
                        class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium md:hover:bg-transparent text-sm md:hover:text-gray-200 md:p-0 md:w-auto text-gray-400 hover:text-gray-200 focus:text-white border-b-2 border-transparent hover:border-blue-300 text-center
                            @php
                                if (request()->routeIs('user.index') || request()->routeIs('department.index') || request()->routeIs('category.index') || request()->routeIs('settings.index') || request()->routeIs('itemType.index') || request()->routeIs('site.index') ) {
                                    echo 'border-blue-500 text-gray-100';
                                }
                            @endphp
                        ">System Management<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                        
                        <!-- Dropdown menu -->
                        <div id="ddSystem" class="z-10 hidden font-normal bg-gray-700 divide-y divide-gray-600 rounded shadow w-44">
                            <ul class="px-2 py-2 text-sm text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('user.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('user.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Users</a>
                                </li>
                                <li>
                                    <a href="{{ route('department.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('department.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Departments</a>
                                </li>
                                <li>
                                    <a href="{{ route('category.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('category.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Ticket Category</a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('itemType.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('itemType.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Item Types</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('site.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('site.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Sites</a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('settings.index') }}" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-900 hover:text-gray-200
                                    @php
                                        if (request()->routeIs('settings.index')) {
                                            echo 'bg-gray-800 text-gray-100 hover:bg-gray-800 hover:text-gray-100';
                                        }   
                                    @endphp
                                    ">Settings</a>
                                </li> --}}
                            </ul>
                        </div>
                    @endif


                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-400 transition duration-150 ease-in-out border border-transparent rounded-md hover:text-gray-200 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link> --}}

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                {{-- <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div> --}}
            </div>

            <div class="mt-3 space-y-1">
                {{-- <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> --}}

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
