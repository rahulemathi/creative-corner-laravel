<x-layout>
    <x-slot:title>{{ $product->name }} - Manhitha Gift Shop</x-slot:title>
    
    <div class="container mx-auto py-8 px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-pink-600 dark:text-gray-300 dark:hover:text-pink-400">
                        Products
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.category', $product->category->slug) }}" class="text-gray-700 hover:text-pink-600 dark:text-gray-300 dark:hover:text-pink-400">
                            {{ $product->category->name }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 dark:text-gray-400">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    <img src="https://placehold.co/600x600" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover rounded-lg shadow-lg">
                </div>
                @if($product->images && count($product->images) > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach($product->images as $image)
                    <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}" 
                         class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75">
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">{{ $product->description }}</p>
                </div>

                <!-- Price Section -->
                <div class="space-y-2">
                    @if($product->sale_price)
                    <div class="flex items-center space-x-3">
                        <span class="text-3xl font-bold text-red-600">{{ $product->formatted_sale_price }}</span>
                        <span class="text-xl text-gray-500 line-through">{{ $product->formatted_price }}</span>
                        <span class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                            {{ $product->discount_percentage }}% OFF
                        </span>
                    </div>
                    @else
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product->formatted_price }}</span>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Category:</span>
                        <span class="font-medium">{{ $product->category->name }}</span>
                    </div>
                    @if($product->sku)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">SKU:</span>
                        <span class="font-medium">{{ $product->sku }}</span>
                    </div>
                    @endif
                    @if($product->dimensions)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Dimensions:</span>
                        <span class="font-medium">{{ $product->dimensions }}</span>
                    </div>
                    @endif
                    @if($product->weight)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Weight:</span>
                        <span class="font-medium">{{ $product->weight }}</span>
                    </div>
                    @endif
                    @if($product->material)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Material:</span>
                        <span class="font-medium">{{ $product->material }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Stock:</span>
                        <span class="font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    @if($product->stock > 0)
                    <a href="https://wa.me/919876543210?text=I'm interested in {{ urlencode($product->name) }} - {{ url()->current() }}" 
                       class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"/>
                            <path d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
                        </svg>
                        Order via WhatsApp
                    </a>
                    @else
                    <div class="w-full bg-gray-400 text-white font-bold py-3 px-6 rounded-lg text-center cursor-not-allowed">
                        Out of Stock
                    </div>
                    @endif
                    
                    <a href="{{ route('products.category', $product->category->slug) }}" 
                       class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-lg transition-colors text-center">
                        View More {{ $product->category->name }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Related Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="https://placehold.co/400x300" alt="{{ $relatedProduct->name }}">
                        @if($relatedProduct->sale_price)
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                            {{ $relatedProduct->discount_percentage }}% OFF
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $relatedProduct->name }}</h3>
                        <div class="mb-3">
                            @if($relatedProduct->sale_price)
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-red-600">{{ $relatedProduct->formatted_sale_price }}</span>
                                <span class="text-sm text-gray-500 line-through">{{ $relatedProduct->formatted_price }}</span>
                            </div>
                            @else
                            <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $relatedProduct->formatted_price }}</span>
                            @endif
                        </div>
                        <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                           class="w-full bg-pink-600 hover:bg-pink-700 text-white text-center py-2 px-4 rounded-lg transition-colors block">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-layout> 