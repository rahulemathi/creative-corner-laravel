<div class="space-y-6">
    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div class="flex items-center gap-3">
            <input type="text" wire:model.debounce.400ms="search" placeholder="Search by user or order id" class="border rounded px-3 py-2 w-64">
            <select wire:model="statusFilter" class="border rounded px-3 py-2">
                <option value="">All Statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Placed</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-4 py-3 font-medium">#{{ $order->id }}</td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                        </td>
                        <td class="px-4 py-3">₹ {{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-pink-100 text-pink-800">{{ $order->status->name === 'Paid' ? 'Order Placed' : $order->status->name }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Paid</span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $order->order_date?->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                @php
                                    $mappedCurrentStatusId = $order->status->name === 'Paid'
                                        ? optional($statuses->firstWhere('name', 'Order Placed'))->id
                                        : $order->order_status_id;
                                @endphp
                                <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" class="border rounded px-2 py-1">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" @selected($status->id === $mappedCurrentStatusId)>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-4 py-3">{{ $orders->links() }}</div>
    </div>
</div>


