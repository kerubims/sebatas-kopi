<nav x-data="{ open: false }" class="absolute top-0 left-0 w-full bg-black z-50 h-20 py-1 px-6 md:px-12" style="font-family: 'Joan', serif;">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        
        {{-- Logo --}}
        <div class="flex-shrink-0">
            <a href="{{ url('/') }}" class="text-2xl md:text-3xl font-bold tracking-widest uppercase" style="font-family: 'Playfair Display', serif;">
                <img src="{{ asset('images/logo.png') }}" alt="Sebatas Kopi">
            </a>
        </div>

        {{-- Desktop Navigation --}}
        <div class="hidden md:flex items-center space-x-8 text-gray-200 font-medium text-lg tracking-wide">
            
            @auth
            {{-- Menu untuk user yang sudah login --}}
            <a href="{{ route('home') }}" class="hover:text-white transition duration-300">Home</a>
            <a href="{{ route('menu') }}" class="hover:text-white transition duration-300">Menu</a>
            <a href="{{ route('about') }}" class="hover:text-white transition duration-300">About</a>
            <a href="{{ route('history') }}" class="hover:text-white transition duration-300">History</a>            
            <a href="{{ route('cart') }}" class="border border-[#C5A880] text-white px-6 py-1.5 rounded-full hover:bg-[#532E1C] hover:text-white transition duration-300 text-sm tracking-wider">
                Order
            </a>
            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 flex items-center">
                @csrf
                <button type="submit" class="hover:text-red-400 transition duration-300">
                    Logout
                </button>
            </form>
            @else
                {{-- Menu untuk guest (belum login) - semua diarahkan ke login --}}
                <a href="{{ route('login') }}" class="hover:text-white transition duration-300">Home</a>
                <a href="{{ route('login') }}" class="hover:text-white transition duration-300">Menu</a>
                <a href="{{ route('login') }}" class="hover:text-white transition duration-300">About</a>
                <a href="{{ route('login') }}" class="hover:text-white transition duration-300">History</a>                
                <a href="{{ route('login') }}" class="border border-[#C5A880] text-white px-6 py-1.5 rounded-full hover:bg-[#532E1C] hover:text-white transition duration-300 text-sm tracking-wider">Order</a>
            @endauth
        </div>

        {{-- Mobile Menu Button --}}
        <div class="md:hidden flex items-center">
            <button @click="open = ! open" class="text-white focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Navigation Menu --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         @click.away="open = false"
         class="md:hidden absolute top-20 left-0 w-full bg-black/95 backdrop-blur-lg text-center py-4 space-y-4 shadow-lg border-t border-white/10">
        
        <a href="{{ url('/') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">Home</a>
        
        @auth
            {{-- Mobile Menu untuk user yang sudah login --}}
            <a href="{{ route('dashboard') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">Menu</a>
            <a href="{{ url('/about') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">About</a>
            <a href="{{ url('/history') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">History</a>
            <a href="{{ route('dashboard') }}" class="block text-amber-500 font-bold py-2 transition duration-300">Order Now</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-center text-white hover:text-red-500 py-2 transition duration-300">
                    Logout
                </button>
            </form>
        @else
            {{-- Mobile Menu untuk guest (belum login) - semua diarahkan ke login --}}
            <a href="{{ route('login') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">Menu</a>
            <a href="{{ route('login') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">About</a>
            <a href="{{ route('login') }}" class="block text-white hover:text-amber-500 py-2 transition duration-300">History</a>
            <a href="{{ route('login') }}" class="block text-amber-500 font-bold py-2 transition duration-300">Order Now</a>
        @endauth
    </div>
</nav>