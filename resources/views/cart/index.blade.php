<x-layout>
    <x-slot:title>Shopping Cart - Manhitha Gift Shop</x-slot:title>

    <div class="container mx-auto py-8 px-4">
        <div class="relative w-full h-48 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg shadow-lg mb-8">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 rounded-lg">
                <h1 class="text-white text-4xl font-bold">Your Shopping Cart</h1>
                <p class="text-white text-lg">Review your items before checkout</p>
            </div>
        </div>


        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden p-6">

            @if (empty($cart))
                <p class="text-gray-600 dark:text-gray-400 text-center text-lg">Your cart is empty.</p>
                <div class="mt-6 text-center">
                    <a href="{{ route('products.index') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition-colors">
                        Start Shopping
                    </a>
                </div>
            @else
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Subtotal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @php $total = 0 @endphp
                            @foreach ($cart as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white flex items-center">
                                        @if (isset($details['image']) && $details['image'])
                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-12 h-12 object-cover mr-4 rounded-md shadow">
                                        @endif
                                        {{ $details['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        ₹{{ number_format($details['price'], 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="0" class="form-input w-20 text-center rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                                            <button type="submit" class="px-3 py-2 bg-pink-600 text-white rounded-md text-xs font-semibold hover:bg-pink-700 transition-colors">Update</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        ₹{{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-semibold transition-colors">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-right text-xl font-bold text-gray-900 dark:text-white">
                    Total: ₹{{ number_format($total, 2) }}
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-gray-300 rounded-lg font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Continue Shopping
                    </a>
                    <a href="{{ route('cart.payment') }}" class="inline-flex items-center px-6 py-3 bg-pink-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-900 focus:outline-none focus:border-pink-900 focus:ring focus:ring-pink-300 disabled:opacity-25 transition">
                        Proceed to Checkout
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layout>
