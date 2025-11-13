<x-layout>
    <x-slot:title>Home - Manhitha Gift Shop</x-slot:title>
    <div class="container mx-auto py-4 px-4">
        <div x-data="carousel" x-init="startAutoplay" @mouseenter="pauseAutoplay" @mouseleave="startAutoplay"
            class="relative w-full h-[700px] overflow-hidden rounded-xl">
            <!-- Carousel slides -->
            <div class="relative h-full">
                <div x-show="currentSlide === 0" class="absolute inset-0 transition-opacity duration-500"
                    x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100">
                    <img class="w-full h-full object-cover" src="{{ asset('images/carousel/mug.png') }}" alt="Mug">
                    {{-- <div class="absolute bottom-20 left-0 right-0 text-center">
                        <h1 class="text-pink-600 md:text-5xl font-bold text-lg mb-2 text-stroke-pink">Welcome to Manhitha</h1>
                        <p class="text-pink-600 md:text-2xl text-lg text-stroke-pink">Discover Our Beautiful Mugs</p>
                    </div> --}}
                </div>
                <div x-show="currentSlide === 1" class="absolute inset-0 transition-opacity duration-500"
                    x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100">
                    <img class="w-full h-full object-cover" src="{{ asset('images/carousel/mug-1.png') }}"
                        alt="Special Mug">
                    {{-- <div class="absolute bottom-20 left-0 right-0 text-center">
                        <h1 class="text-pink-600 md:text-5xl font-bold text-lg mb-2 text-stroke-pink">Personalized Gifts</h1>
                        <p class="text-pink-600 md:text-2xl text-lg text-stroke-pink">Make Every Moment Special</p>
                    </div> --}}
                </div>
                <div x-show="currentSlide === 2" class="absolute inset-0 transition-opacity duration-500"
                    x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100">
                    <img class="w-full h-full object-cover" src="{{ asset('images/carousel/photo frame.png') }}"
                        alt="Photo Frame">
                    {{-- <div class="absolute bottom-20 left-0 right-0 text-center">
                        <h1 class="text-pink-600 md:text-5xl font-bold text-lg mb-2 text-stroke-pink">Capture Memories</h1>
                        <p class="text-pink-600 md:text-2xl text-lg text-stroke-pink">Beautiful Photo Frames</p>
                    </div> --}}
                </div>
            </div>

            <!-- Carousel controls -->
            <div class="absolute inset-0 flex items-center justify-between p-4">
                <button @click="currentSlide = (currentSlide - 1 + 3) % 3"
                    class="p-2 rounded-full bg-black/50 text-white hover:bg-black/75 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button @click="currentSlide = (currentSlide + 1) % 3"
                    class="p-2 rounded-full bg-black/50 text-white hover:bg-black/75 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Carousel indicators -->
            <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                <button @click="currentSlide = 0"
                    :class="{ 'bg-white': currentSlide === 0, 'bg-white/50': currentSlide !== 0 }"
                    class="w-3 h-3 rounded-full transition-colors"></button>
                <button @click="currentSlide = 1"
                    :class="{ 'bg-white': currentSlide === 1, 'bg-white/50': currentSlide !== 1 }"
                    class="w-3 h-3 rounded-full transition-colors"></button>
                <button @click="currentSlide = 2"
                    :class="{ 'bg-white': currentSlide === 2, 'bg-white/50': currentSlide !== 2 }"
                    class="w-3 h-3 rounded-full transition-colors"></button>
            </div>

            <!-- Shop Now button -->
            <div class="absolute bottom-8 left-0 right-0 flex justify-center">
                {{-- <a href="{{ route('products.index') }}"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition-colors">
                    Shop Now
                </a> --}}
                <p class="text-pink-600">* Due to the nature of personalization, product results may vary slightly from
                    images.</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto py-8 px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-600 dark:text-pink-400 mb-4">Why Us</h2>
            <p class="text-lg text-pink-500 dark:text-pink-300">Because every gift deserves a personal touch</p>
        </div>

        {{-- why choose us section --}}
        <div class="grid grid-cols-1 grid-rows-1 gap-4 md:grid-cols-2 sm:grid-cols-1 py-8">
            <div class="bg-pink-600 text-white grid grid-cols-1 grid-rows-1 p-4 rounded-lg w-full">
                <div class="flex items-center gap-4">
                    <x-heroicon-o-sparkles class="w-24 h-24"></x-heroicon-o-sparkles>
                    <div>
                        <p class="text-2xl font-bold">Unique Creations</p>
                        <p>Custom gifts that are as one-of-a-kind as your loved ones.</p>
                    </div>
                </div>

            </div>

            <div class="bg-pink-600 text-white grid grid-cols-1 grid-rows-1 p-4 rounded-lg w-full">
                <div class="flex items-center gap-4">
                    <x-heroicon-o-check-circle class="w-24 h-24"></x-heroicon-o-check-circle>
                    <div>
                        <p class="text-2xl font-bold">Quality Craftsmanship</p>
                        <p>Custom gifts that are as one-of-a-kind as your loved ones.</p>
                    </div>
                </div>

            </div>

            <div class="bg-pink-600 text-white grid grid-cols-1 grid-rows-1 p-4 rounded-lg w-full">
                <div class="flex items-center gap-4">
                    <x-heroicon-o-truck class="w-24 h-24"></x-heroicon-o-truck>
                    <div>
                        <p class="text-2xl font-bold">Fast & Reliable Delivery</p>
                        <p>Get your personalized gifts on time, every time.</p>
                    </div>
                </div>

            </div>

            <div class="bg-pink-600 text-white grid grid-cols-1 grid-rows-1 p-4 rounded-lg w-full">
                <div class="flex items-center gap-4">
                    <x-heroicon-o-heart class="w-24 h-24"></x-heroicon-o-heart>
                    <div>
                        <p class="text-2xl font-bold">Customer Satisfaction</p>
                        <p>We go the extra mile to ensure you love your purchase.</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-600 dark:text-pink-400 mb-4">
                Find the Perfect Gift
            </h2>
            <p class="text-lg text-pink-500 dark:text-pink-300">
                Thoughtful surprises for every season and every smile
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 py-8">
            <!-- Top Left -->
            <div class="relative aspect-video">
                <img src="./images/carousel/mug-1.jpeg" alt="mugs" class="w-full h-full object-cover rounded-lg">
                <div
                    class="absolute inset-0 flex items-center justify-center text-white text-2xl font-bold bg-black/40 rounded-lg">
                    Personalized Mugs
                </div>
            </div>

            <!-- Top Right -->
            <div class="relative aspect-video">
                <img src="./images/carousel/aluminium frame.jpeg" alt="Frame Gifts"
                    class="w-full h-full object-cover rounded-lg">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center text-white text-2xl font-bold bg-black/40 rounded-lg">
                    <span>Frame Gifts</span>
                    <span class="text-sm font-normal">best of all</span>
                </div>
            </div>

            <!-- Bottom Left -->
            <div class="relative aspect-video">
                <img src="./images/carousel/key chain.jpeg" alt="key chain gift"
                    class="w-full h-full object-cover rounded-lg">
                <div
                    class="absolute inset-0 flex items-center justify-center text-white text-2xl font-bold bg-black/40 rounded-lg">
                    Personalized Key Chains
                </div>
            </div>

            <!-- Bottom Right -->
            <div class="relative aspect-video">
                <img src="./images/carousel/table frame.jpeg" alt="table frames"
                    class="w-full h-full object-cover rounded-lg">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center text-white text-2xl font-bold bg-black/40 rounded-lg">
                    <span>Table Frame</span>
                    <span class="text-sm font-normal">Best for couple</span>
                </div>
            </div>
        </div>





        <!-- Featured Categories -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-600 dark:text-pink-400 mb-4">Shop by Category</h2>
            <p class="text-lg text-pink-500 dark:text-pink-300">Discover our wide range of gifts and accessories</p>
        </div>

        <div class="swiper mySwiper max-w-5xl mx-auto py-12 h-[500px] perspective-1000">
            <div class="swiper-wrapper">
                @foreach (\App\Models\Category::active()->ordered()->take(6)->get() as $category)
                    <div class="swiper-slide flex justify-center" style="background: none">
                        <div
                            class="w-80 bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden hover:shadow-2xl transition-shadow p-6">
                            <h3 class="text-xl font-semibold text-pink-600 dark:text-pink-400 mb-3">
                                {{ $category->name }}</h3>
                            <p class="text-pink-500 dark:text-pink-300 mb-4">
                                {{ Str::limit($category->description, 100) }}</p>
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="inline-flex items-center px-4 py-2 bg-pink-600 text-white font-medium rounded-lg hover:bg-pink-700 transition-colors">
                                View Products
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>




        <!-- Featured Products -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-pink-600 dark:text-pink-400 mb-4">Featured Products</h2>
            <p class="text-lg text-pink-500 dark:text-pink-300">Handpicked items for special occasions</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach (\App\Models\Product::featured()->active()->with('category')->take(4)->get() as $product)
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://placehold.co/400x300"
                            alt="{{ $product->name }}">
                        @if ($product->sale_price)
                            <div
                                class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                {{ $product->discount_percentage }}% OFF
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-pink-600 dark:text-pink-400 mb-2">{{ $product->name }}
                        </h3>
                        <p class="text-sm text-pink-500 dark:text-pink-300 mb-3">
                            {{ Str::limit($product->description, 80) }}</p>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                @if ($product->sale_price)
                                    <span
                                        class="text-lg font-bold text-red-600">{{ $product->formatted_sale_price }}</span>
                                    <span
                                        class="text-sm text-pink-400 line-through">{{ $product->formatted_price }}</span>
                                @else
                                    <span
                                        class="text-lg font-bold text-pink-600 dark:text-pink-400">{{ $product->formatted_price }}</span>
                                @endif
                            </div>
                            <span
                                class="text-sm text-pink-500 dark:text-pink-300">{{ $product->category->name }}</span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="flex-1 bg-pink-600 hover:bg-pink-700 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                View Details
                            </a>
                            <a href="https://wa.me/9194494372550?text=I'm interested in {{ urlencode($product->name) }}"
                                class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" />
                                    <path
                                        d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg p-8 text-center text-white">
            <h3 class="text-2xl font-bold mb-4">Ready to Find the Perfect Gift?</h3>
            <p class="text-lg mb-6">Browse our complete collection and discover something special for your loved ones.
            </p>
            <a href="{{ route('products.index') }}"
                class="bg-white text-pink-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition-colors">
                Explore All Products
            </a>
        </div>
    </div>
</x-layout>
