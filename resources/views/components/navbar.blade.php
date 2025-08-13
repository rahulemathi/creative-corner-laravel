<!-- navbar component -->
<nav class="bg-white border-gray-200 dark:bg-red-100 shadow-lg">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://placehold.co/400" class="h-8" alt="Manhitha Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-pink-600 dark:text-pink-500">Manhitha</span>
    </a>
    
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-pink-600 rounded-lg md:hidden hover:bg-pink-100 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:text-pink-400 dark:hover:bg-pink-900 dark:focus:ring-pink-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent dark:bg-transparent dark:border-gray-700">
        <x-navlink href="{{ url('/') }}" :active="request()->is('/')">Home</x-navlink>
        <x-navlink href="{{ route('products.index') }}" :active="request()->is('products*')">Products</x-navlink>
        <x-navlink href="{{ url('/about') }}" :active="request()->is('/about')">About</x-navlink>
        <x-navlink href="{{ url('/contact') }}" :active="request()->is('/contact')">Contact</x-navlink>
        
        <!-- Authentication Links -->
        @auth
          <li class="relative">
            <div class="flex items-center space-x-4">
              @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-pink-600 hover:text-pink-700 dark:text-pink-400 dark:hover:text-pink-300 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                  Admin Dashboard
                </a>
              @endif
              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-pink-600 hover:text-pink-700 dark:text-pink-400 dark:hover:text-pink-300 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                  Logout
                </button>
              </form>
            </div>
          </li>
        @else
          <li>
            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
              </svg>
              Login
            </a>
          </li>
          @if (Route::has('register'))
            <li>
              <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Register
              </a>
            </li>
          @endif
        @endauth
      </ul>
    </div>
  </div>
</nav>
