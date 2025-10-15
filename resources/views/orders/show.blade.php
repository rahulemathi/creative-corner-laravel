<x-layout>
    <x-slot:title>Order Details #{{ $order->id }} - Manhitha Gift Shop</x-slot:title>

    <div class="container mx-auto py-8 px-4">
        <div class="relative w-full h-48 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg shadow-lg mb-8">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 rounded-lg">
                <h1 class="text-white text-4xl font-bold">Order #{{ $order->id }} Details</h1>
                <p class="text-white text-lg">Information about your order</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden p-6 mb-8">
            <h3 class="text-2xl font-semibold text-pink-600 dark:text-pink-400 mb-4">Order Summary</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 dark:text-gray-300">
                <div>
                    <p class="mb-2"><strong>Order Date:</strong> {{ $order->order_date->format('M d, Y H:i') }}</p>
                    <p class="mb-2"><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    <p class="mb-2"><strong>Status:</strong> <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-{{ $order->status->name == 'Pending' ? 'yellow' : ($order->status->name == 'Completed' ? 'green' : 'red') }}-100 text-{{ $order->status->name == 'Pending' ? 'yellow' : ($order->status->name == 'Completed' ? 'green' : 'red') }}-800">
                        {{ $order->status->name }}
                    </span></p>
                </div>
                <div>
                    <p class="mb-2"><strong>Shipping Address:</strong></p>
                    <p>{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden p-6">
            <h4 class="text-2xl font-semibold text-pink-600 dark:text-pink-400 mb-4">Ordered Items</h4>
            <div class="overflow-x-auto mb-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $item->product->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    ₹{{ number_format($item->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    ₹{{ number_format($item->quantity * $item->price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center px-6 py-3 bg-pink-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-900 focus:outline-none focus:border-pink-900 focus:ring focus:ring-pink-300 disabled:opacity-25 transition">
                    Back to Orders
                </a>
            </div>
        </div>
    </div>
</x-layout>
