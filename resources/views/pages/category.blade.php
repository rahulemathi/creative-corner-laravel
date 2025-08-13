<x-layout>
    <x-slot:title>{{ $category->name }} - Manhitha Gift Shop</x-slot:title>
    
    <div class="container mx-auto py-8 px-4">
        <!-- Category Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $category->name }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">{{ $category->description }}</p>
        </div>

        <!-- Breadcrumb -->
        <nav class="flex mb-8 justify-center" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-pink-600 dark:text-gray-300 dark:hover:text-pink-400">
                        Products
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 dark:text-gray-400">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Products Count -->
        <div class="text-center mb-8">
            <p class="text-gray-600 dark:text-gray-300">
                Showing {{ $products->total() }} product{{ $products->total() != 1 ? 's' : '' }} in {{ $category->name }}
            </p>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://placehold.co/400x300" alt="{{ $product->name }}">
                        @if($product->sale_price)
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                            {{ $product->discount_percentage }}% OFF
                        </div>
                        @endif
                        @if($product->is_featured)
                        <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                            Featured
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="mb-3">
                            @if($product->sale_price)
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-red-600">{{ $product->formatted_sale_price }}</span>
                                <span class="text-sm text-gray-500 line-through">{{ $product->formatted_price }}</span>
                            </div>
                            @else
                            <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $product->formatted_price }}</span>
                            @endif
                        </div>

                        @if($product->dimensions || $product->material)
                        <div class="text-xs text-gray-500 mb-3">
                            @if($product->dimensions)
                            <div>Size: {{ $product->dimensions }}</div>
                            @endif
                            @if($product->material)
                            <div>Material: {{ $product->material }}</div>
                            @endif
                        </div>
                        @endif

                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->slug) }}" 
                               class="flex-1 bg-pink-600 hover:bg-pink-700 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                View Details
                            </a>
                            @if($product->stock > 0)
                            <a href="https://wa.me/919876543210?text=I'm interested in {{ urlencode($product->name) }} - {{ route('products.show', $product->slug) }}" 
                               class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"/>
                                    <path d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No products found in this category</h3>
                <p class="text-gray-500 dark:text-gray-400">We're working on adding more products to this category.</p>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Browse All Products
                    </a>
                </div>
            </div>
        @endif

        <!-- Back to Categories -->
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 dark:text-pink-400 dark:hover:text-pink-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to All Categories
            </a>
        </div>
    </div>
</x-layout> 