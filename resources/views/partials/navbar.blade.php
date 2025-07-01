<!-- Top Information Bar -->
<div class="bg-[#1d3557] text-white py-2 px-4 text-sm">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div class="mb-2 md:mb-0 text-center md:text-left">
            <span class="font-bold">TVF</span>
            <span class="mx-2">|</span>
            <span>Transforming Lives Through The Word Of God</span>
        </div>
        <div class="flex flex-col md:flex-row items-center space-y-1 md:space-y-0 md:space-x-4">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>info@tvf.org</span>
            </div>
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Nnaji Park Street New Haven, Enugu</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="bg-gradient-to-br from-[#1d3557] to-[#394967] text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo - Hidden on desktop (shown in top bar), visible on mobile -->
        <a href="/" class="text-2xl font-bold text-gold hover:text-gold-dark transition duration-300 md:hidden">
            TVF
        </a>

        <!-- Menu Links -->
        <div class="hidden md:flex space-x-8 text-lg">
            <a href="/" class="hover:text-gold transition duration-300">Home</a>
            <a href="/about" class="hover:text-gold transition duration-300">About</a>
            <a href="/events" class="hover:text-gold transition duration-300">Events</a>
            <a href="/sermons" class="hover:text-gold transition duration-300">Sermons</a>
            <a href="/blog" class="hover:text-gold transition duration-300">Blog</a>
            <a href="/contact" class="hover:text-gold transition duration-300">Contact</a>
        </div>

        <!-- Right side navigation elements -->
        <div class="flex items-center space-x-6">
    <!-- Authentication Links -->
    @auth
        <!-- User Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center focus:outline-none">
                @if(Auth::user()->profile_photo_path)
                    <img class="h-8 w-8 rounded-full object-cover" 
                         src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                         alt="{{ Auth::user()->name }}">
                @else
                    <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
            </button>
            
            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="hidden md:flex space-x-4">
            <a href="{{ url('/login') }}" class="text-white hover:text-gold transition duration-300">
                Log In
            </a>
            <a href="{{ url('/register') }}" class="text-white hover:text-gold transition duration-300">
                Register
            </a>
        </div>
    @endauth

            <!-- Live TV Button - Now at the far right -->
            <div class="hidden md:block">
                <a href="/live" class="bg-red-600 text-white px-4 py-2 rounded-md font-bold hover:bg-red-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    TVF
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 bg-[#1d3557]">
        <a href="/" class="block py-2 hover:text-gold">Home</a>
        <a href="/about" class="block py-2 hover:text-gold">About</a>
        <a href="/events" class="block py-2 hover:text-gold">Events</a>
        <a href="/sermons" class="block py-2 hover:text-gold">Sermons</a>
        <a href="/blog" class="block py-2 hover:text-gold">Blog</a>
        <a href="/contact" class="block py-2 hover:text-gold">Contact</a>
        
        @auth
            <a href="{{ route('profile.edit') }}" class="block py-2 hover:text-gold">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left py-2 hover:text-gold">
                    Log Out
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block py-2 hover:text-gold">Log In</a>
            <a href="{{ route('register') }}" class="block py-2 hover:text-gold">Register</a>
        @endauth
        
        <a href="/live" class="block py-2 text-red-400 hover:text-red-300 font-bold flex items-center mt-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            TVF 
        </a>
    </div>
</nav>

<script>
    // Mobile menu toggle
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // User dropdown toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    if (userMenuButton && userDropdown) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });
        
        // Close when clicking outside
        document.addEventListener('click', () => {
            userDropdown.classList.add('hidden');
        });
    }
</script>