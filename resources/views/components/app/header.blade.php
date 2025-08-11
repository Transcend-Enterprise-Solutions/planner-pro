<header class="sticky top-0 bg-gray-100/80 dark:bg-[#182235]/80 backdrop-blur-sm border-b border-slate-200 dark:border-slate-700 z-30 shadow-b">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 -mb-px">

            <!-- Header: Left side -->
            <div class="flex">

                <!-- Hamburger button -->
                <button
                    class="text-slate-500 hover:text-slate-600 lg:hidden"
                    @click.stop="sidebarOpen = !sidebarOpen"
                    aria-controls="sidebar"
                    :aria-expanded="sidebarOpen"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button>

                <style>
                    @media (max-width: 1024px){
                        .headerNav{
                            display: none;
                        }
                    }
                </style>
                <ul class="flex items-center headerNav">
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0">
                        <div class="flex justify-left" style="width: 200px;">
                            <!-- Logo -->
                            <a class="flex items-center" href="{{ route('dashboard') }}">
                                <img class="mx-auto rounded-full" src="/images/logo.png" alt="mgar logo" width="45">
                                <span
                                    class="text-black dark:text-white ml-2 duration-200">PlannerPro</span>
                            </a>
                        </div>
                    </li>
                    
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] 
                        @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-gray-200 dark:bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition 
                        @if (Route::is('dashboard')) {{ '!text-blue-500' }} @endif"
                            href="{{ route('dashboard') }}" wire:navigate>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="bi bi-speedometer2 text-slate-400 dark:text-slate-300 mr-3"></i>
                                    <span
                                        class="text-sm font-medium duration-200">
                                        Dashboard
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>

                    {{-- <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] 
                        @if (in_array(Request::segment(1), ['project-management'])) {{ 'bg-gray-200 dark:bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['project-management']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition 
                        @if (Route::is('project-management')) {{ '!text-blue-500' }} @endif"
                            href="{{ route('project-management') }}" wire:navigate>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="bi bi-people text-slate-400 dark:text-slate-300 mr-3"></i>
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        Project Management
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li> --}}
                </ul>

            </div>

            <!-- Header: Right side -->
            <div class="flex items-center space-x-3">

                <!-- Search Button with Modal -->
                {{-- <x-modal-search /> --}}




                <!-- Info button -->
                <x-dropdown-help align="right" />


                <!-- Dark mode toggle -->
                <x-theme-toggle />
                

                <!-- Divider -->
                <hr class="w-px h-6 bg-slate-200 dark:bg-slate-700 border-none" />


                <!-- User button -->
                <x-dropdown-profile align="right"/>

            </div>

        </div>
    </div>
</header>
