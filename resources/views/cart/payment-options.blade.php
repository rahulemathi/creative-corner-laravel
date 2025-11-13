<x-layout>
    <x-slot:title>Choose Payment Method - Manhitha Gift Shop</x-slot:title>

    <div class="container mx-auto py-8 px-4">
        <div class="relative w-full h-48 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg shadow-lg mb-8">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 rounded-lg">
                <h1 class="text-white text-4xl font-bold">Choose Payment Method</h1>
                <p class="text-white text-lg">Select how you'd like to pay for your order</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Order Summary -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-semibold text-pink-600 dark:text-pink-400">Order Summary</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($cart as $productId => $item)
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                                <div>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $item['name'] }}</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">× {{ $item['quantity'] }}</span>
                                </div>
                                <span class="font-semibold text-gray-900 dark:text-white">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                        <div class="flex justify-between items-center pt-4 text-xl font-bold text-pink-600 dark:text-pink-400">
                            <span>Total Amount:</span>
                            <span>₹{{ number_format($total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Selection -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-pink-600 dark:text-pink-400">Delivery Address</h3>
                </div>
                <div class="p-6">
                    @livewire('show-address')
                </div>
            </div>

            <!-- Payment Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cash on Delivery -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Cash on Delivery</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Pay when your order arrives</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                No advance payment required
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Pay with cash to delivery person
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Easy cancellation (2 hour window)
                            </div>
                        </div>

                        <form action="{{ route('cart.cod.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                Place Order - COD
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Online Payment -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Online Payment</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Pay now with card, UPI, or wallet</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Secure payment gateway
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Instant payment confirmation
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Automatic refund on cancellation
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <img src="https://razorpay.com/assets/razorpay-logo.svg" alt="Razorpay" class="h-6">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Supports: UPI, Cards, Wallets, Net Banking</span>
                        </div>

                        <form action="{{ route('cart.razorpay.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                Pay ₹{{ number_format($total_amount, 2) }} Online
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Back to Cart -->
            <div class="text-center mt-8">
                <a href="{{ route('cart.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Cart
                </a>
            </div>
        </div>
    </div>
</x-layout>