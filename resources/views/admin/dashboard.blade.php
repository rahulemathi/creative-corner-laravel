<x-layout>
    <x-slot:title>Admin Dashboard - Manhitha</x-slot:title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-2xl text-pink-600 dark:text-pink-400 leading-tight mb-6">Dashboard</h2>
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-pink-100 dark:bg-pink-900 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-pink-500 dark:text-pink-300">Total Products</p>
                                <p class="text-2xl font-semibold text-pink-600 dark:text-pink-400">{{ $stats['total_products'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-pink-100 dark:bg-pink-900 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-pink-500 dark:text-pink-300">Total Categories</p>
                                <p class="text-2xl font-semibold text-pink-600 dark:text-pink-400">{{ $stats['total_categories'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-pink-100 dark:bg-pink-900 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-pink-500 dark:text-pink-300">Total Users</p>
                                <p class="text-2xl font-semibold text-pink-600 dark:text-pink-400">{{ $stats['total_users'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-pink-100 dark:bg-pink-900 w-12 h-12 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-pink-500 dark:text-pink-300">Active Products</p>
                                <p class="text-2xl font-semibold text-pink-600 dark:text-pink-400">{{ $stats['active_products'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Products -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-pink-600 dark:text-pink-400">Recent Products</h3>
                            <a href="{{ route('admin.products.index') }}" class="text-sm text-pink-500 hover:text-pink-600 dark:text-pink-400 dark:hover:text-pink-300">
                                View All
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_products as $product)
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex-shrink-0">
                                    <img class="w-12 h-12 object-cover rounded" src="https://placehold.co/100x100" alt="{{ $product->name }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-pink-600 dark:text-pink-400 truncate">
                                        {{ $product->name }}
                                    </p>
                                    <p class="text-xs text-pink-500 dark:text-pink-300">
                                        {{ $product->category->name }} • {{ $product->formatted_price }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-pink-500 hover:text-pink-600 dark:text-pink-400 dark:hover:text-pink-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @empty
                            <p class="text-pink-500 dark:text-pink-300 text-center py-4">No products yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Categories -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-pink-600 dark:text-pink-400">Recent Categories</h3>
                            <a href="{{ route('admin.categories.index') }}" class="text-sm text-pink-500 hover:text-pink-600 dark:text-pink-400 dark:hover:text-pink-300">
                                View All
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_categories as $category)
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900 rounded flex items-center justify-center">
                                        <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-pink-600 dark:text-pink-400 truncate">
                                        {{ $category->name }}
                                    </p>
                                    <p class="text-xs text-pink-500 dark:text-pink-300">
                                        {{ $category->products_count ?? 0 }} products
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-pink-500 hover:text-pink-600 dark:text-pink-400 dark:hover:text-pink-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @empty
                            <p class="text-pink-500 dark:text-pink-300 text-center py-4">No categories yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-pink-600 dark:text-pink-400 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.products.create') }}" 
                           class="flex items-center p-4 bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <div>
                                <p class="font-medium">Add New Product</p>
                                <p class="text-sm opacity-90">Create a new product listing</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.categories.create') }}" 
                           class="flex items-center p-4 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <div>
                                <p class="font-medium">Add New Category</p>
                                <p class="text-sm opacity-90">Create a new product category</p>
                            </div>
                        </a>

                        <a href="{{ route('products.index') }}" 
                           class="flex items-center p-4 bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <div>
                                <p class="font-medium">View Store</p>
                                <p class="text-sm opacity-90">See how customers view your store</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout> 