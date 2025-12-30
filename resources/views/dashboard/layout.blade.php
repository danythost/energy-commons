<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Energy Commons') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center" x-data="{ sidebarOpen: false }">

    <div class="w-full max-w-md h-full bg-white shadow-xl relative flex">
        
        <!-- Sidebar -->
        <div 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="absolute inset-y-0 left-0 z-40 w-64 bg-blue-900 text-white transition-transform duration-300 ease-in-out flex flex-col h-full shadow-lg"
        >
            <div class="p-4 flex items-center justify-between flex-shrink-0 border-b border-blue-800">
                <div class="whitespace-nowrap overflow-hidden">
                    <h2 class="text-2xl font-bold tracking-tight">Menu</h2>
                </div>
                <!-- Close Button (X icon) -->
                <button @click="sidebarOpen = false" class="text-blue-300 hover:text-white focus:outline-none ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Profile Summary in Sidebar -->
            <div class="p-4 border-b border-blue-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center text-lg font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-blue-300 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <nav class="mt-2 flex-1 overflow-y-auto py-2">
                <!-- Dashboard Link -->
                <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100">
                    Dashboard
                </a>

                <!-- Profile Link -->
                <a href="{{ route('profile.edit') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100">
                    Profile
                </a>

                <!-- Buy Link -->
                <a href="{{ route('buy') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100">
                    Buy
                </a>

                <!-- Zones Link -->
                <a href="{{ route('zones') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100">
                    Zones
                </a>

                <!-- EST/PAT Link -->
                <a href="{{ route('est-pat') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100">
                    EST/PAT
                </a>

                <!-- NFT Link -->
                <a href="{{ route('nft') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100 {{ request()->routeIs('nft') ? 'bg-blue-800 text-white' : '' }}">
                    NFT
                </a>

                <!-- Upgrade Link -->
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-800 hover:text-white text-blue-100">
                    Upgrade
                </a>
            </nav>
            
            <!-- Logout Button -->
            <div class="p-4 border-t border-blue-800 flex-shrink-0">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-red-600 text-red-300 hover:text-white group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Overlay -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-black bg-opacity-50 z-30"
        ></div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-full overflow-y-auto w-full">
            
            <!-- Mobile Header with Hamburger -->
            <div class="bg-blue-900 text-white p-4 flex items-center justify-between shrink-0 shadow-md z-20">
                 <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none p-1 rounded hover:bg-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-lg tracking-wide">Energy Commons</span>
                
                <!-- Spacer or additional icon (e.g. notifications) could go here -->
                <div class="w-8"></div> 
            </div>

            <!-- Scrollable Content Area -->
            <div class="flex-1 overflow-y-auto bg-gray-50 p-4 relative">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
