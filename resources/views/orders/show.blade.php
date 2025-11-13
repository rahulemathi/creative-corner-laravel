<x-layout>
    <x-slot:title>Order Details #{{ $order->id }} - Manhitha Gift Shop</x-slot:title>

    <style>
        @media print {
            .no-print { display: none !important; }
            .print-friendly { page-break-inside: avoid; }
            body { font-size: 12px; }
            .container { max-width: 100% !important; padding: 0 !important; }
        }
    </style>

    <div class="container mx-auto py-8 px-4">
        <div class="relative w-full h-48 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg shadow-lg mb-8 no-print">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 rounded-lg">
                <h1 class="text-white text-4xl font-bold">Order #{{ $order->id }} Details</h1>
                <p class="text-white text-lg">Information about your order</p>
            </div>
        </div>
        
        <!-- Print-only header -->
        <div class="hidden print:block mb-8">
            <div class="text-center border-b-2 border-pink-600 pb-4">
                <h1 class="text-3xl font-bold text-pink-600">Manhitha Gift Shop</h1>
                <p class="text-gray-600">Order #{{ $order->id }} Details</p>
                <p class="text-sm text-gray-500">365 Kengeri Bazaar Street, Kuvempu Rd, Kengeri, Karnataka 560060</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl font-semibold text-pink-600 dark:text-pink-400">Order Summary</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 6l-2 2a4 4 0 01-5.656 0L4 13a4 4 0 010-5.656l2-2L4 7l2-2a4 4 0 015.656 0L14 7l2 2a4 4 0 010 5.656L14 15l-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Order Date</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $order->order_date->format('M d, Y \a\t H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Amount</p>
                                <p class="font-semibold text-2xl text-pink-600 dark:text-pink-400">₹{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Order Status</p>
                                @php
                                    $statusColors = [
                                        'Order Placed' => 'blue',
                                        'Processing' => 'yellow',
                                        'Shipping' => 'purple',
                                        'Delivered' => 'green',
                                        'Cancelled' => 'red',
                                        'Paid' => 'green',
                                        'Pending' => 'yellow',
                                        'Completed' => 'green'
                                    ];
                                    $color = $statusColors[$order->status->name] ?? 'gray';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $color }}-100 text-{{ $color }}-800 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200">
                                    <div class="w-2 h-2 bg-{{ $color }}-400 rounded-full mr-2"></div>
                                    {{ $order->status->name === 'Paid' ? 'Order Placed' : $order->status->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        @if($order->payment_method)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Payment Method</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $order->formatted_payment_method }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Refund Information -->
                        @if($order->status->name === 'Cancelled' && $order->refund_status)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Refund Status</p>
                                @php
                                    $refundStatusColors = [
                                        'initiated' => 'yellow',
                                        'processing' => 'blue',
                                        'completed' => 'green',
                                        'failed' => 'red',
                                    ];
                                    $refundColor = $refundStatusColors[$order->refund_status] ?? 'gray';
                                @endphp
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $refundColor }}-100 text-{{ $refundColor }}-800 dark:bg-{{ $refundColor }}-900 dark:text-{{ $refundColor }}-200">
                                        <div class="w-2 h-2 bg-{{ $refundColor }}-400 rounded-full mr-2"></div>
                                        {{ ucfirst($order->refund_status) }}
                                    </span>
                                    @if($order->refund_amount)
                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                            ₹{{ number_format($order->refund_amount, 2) }}
                                        </span>
                                    @endif
                                </div>
                                @if($order->refund_processed_at)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Processed: {{ $order->refund_processed_at->format('M d, Y \a\t H:i') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Items</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $order->items->sum('quantity') }} item(s)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Shipping Address</p>
                                <div class="text-gray-900 dark:text-white whitespace-pre-line">{{ $order->shipping_address }}</div>
                            </div>
                        </div>

                        @if($order->notes)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Order Notes</p>
                                    <p class="text-gray-900 dark:text-white">{{ $order->notes }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-medium text-gray-900 dark:text-white">Need Help?</span>
                            </div>
                            <div class="mt-2 flex space-x-3">
                                <a href="https://wa.me/919449437255?text=I need help with Order #{{ $order->id }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-3 py-2 border border-green-600 text-green-600 text-sm font-medium rounded-md hover:bg-green-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                                <a href="tel:+919449437255" 
                                   class="inline-flex items-center px-3 py-2 border border-pink-600 text-pink-600 text-sm font-medium rounded-md hover:bg-pink-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    Call
                                </a>
                            </div>
                        </div>
                    </div>
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
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $productImage = null;
                                            if ($item->product && is_array($item->product->images) && !empty($item->product->images)) {
                                                $productImage = asset('storage/' . $item->product->images[0]);
                                            }
                                        @endphp
                                        
                                        @if($productImage)
                                            <div class="flex-shrink-0">
                                                <img class="h-16 w-16 rounded-lg object-cover shadow-md" 
                                                     src="{{ $productImage }}" 
                                                     alt="{{ $item->product->name }}"
                                                     onerror="this.src='https://placehold.co/64x64/ec4899/ffffff?text={{ urlencode(substr($item->product->name, 0, 1)) }}'">
                                            </div>
                                        @else
                                            <div class="flex-shrink-0">
                                                <div class="h-16 w-16 rounded-lg bg-pink-100 dark:bg-pink-900 flex items-center justify-center">
                                                    <svg class="h-8 w-8 text-pink-500 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white truncate">
                                                {{ $item->product->name }}
                                            </p>
                                            @if($item->product->category)
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $item->product->category->name }}
                                                </p>
                                            @endif
                                            @if($item->product->sku)
                                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                                    SKU: {{ $item->product->sku }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    ₹{{ number_format($item->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                                    ₹{{ number_format($item->quantity * $item->price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900 dark:text-white">
                                Total:
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-pink-600 dark:text-pink-400">
                                ₹{{ number_format($order->total_amount, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-between items-center no-print">
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Orders
                    </a>
                    
                    @if(in_array($order->status->name, ['Order Placed', 'Processing', 'Paid']) && $order->created_at->diffInHours() < 2)
                        @php
                            $totalMinutesLeft = 120 - $order->created_at->diffInMinutes();
                            $hoursLeft = floor($totalMinutesLeft / 60);
                            $minutesLeft = $totalMinutesLeft % 60;
                        @endphp
                        <button onclick="if(confirm('Are you sure you want to cancel this order? This action cannot be undone. You will receive a refund within 3-5 business days.')) { document.getElementById('cancel-order-form').submit(); }" 
                                class="inline-flex items-center px-6 py-3 bg-red-100 border border-red-300 rounded-lg font-semibold text-red-700 hover:bg-red-200 transition-colors"
                                id="cancel-order-btn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel Order
                            @if($totalMinutesLeft > 0)
                                <span class="ml-2 text-xs text-red-600" id="countdown-timer">
                                    ({{ $hoursLeft > 0 ? $hoursLeft . 'h ' : '' }}{{ $minutesLeft }}m left)
                                </span>
                            @endif
                        </button>
                        
                        <script>
                            // Live countdown timer
                            @if($totalMinutesLeft > 0)
                                let minutesLeft = {{ $totalMinutesLeft }};
                                const timer = setInterval(() => {
                                    minutesLeft--;
                                    if (minutesLeft <= 0) {
                                        clearInterval(timer);
                                        location.reload(); // Refresh page to show expired state
                                        return;
                                    }
                                    
                                    const hours = Math.floor(minutesLeft / 60);
                                    const mins = minutesLeft % 60;
                                    const timerElement = document.getElementById('countdown-timer');
                                    if (timerElement) {
                                        timerElement.textContent = `(${hours > 0 ? hours + 'h ' : ''}${mins}m left)`;
                                    }
                                }, 60000); // Update every minute
                            @endif
                        </script>
                        
                        <!-- Hidden form for order cancellation -->
                        <form id="cancel-order-form" action="{{ route('orders.cancel', $order) }}" method="POST" class="hidden">
                            @csrf
                            @method('PATCH')
                        </form>
                    @elseif(in_array($order->status->name, ['Order Placed', 'Processing', 'Paid']))
                        <div class="inline-flex items-center px-6 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 cursor-not-allowed">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Cancellation window expired (2 hours limit)
                        </div>
                    @endif
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="window.print()" class="inline-flex items-center px-6 py-3 bg-blue-100 border border-blue-300 rounded-lg font-semibold text-blue-700 hover:bg-blue-200 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Order
                    </button>
                    
                    <a href="https://wa.me/919449437255?text=I need help with Order #{{ $order->id }}" 
                       target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-white hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"/>
                        </svg>
                        Get Help
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
