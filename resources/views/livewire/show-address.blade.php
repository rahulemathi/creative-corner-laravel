<div>
    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        Choose an address
    </label>
    <select wire:model="selectedAddressId" id="address" name="address" wire:change="$refresh"
        class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        <option value="">-- Select --</option>
        @foreach ($address as $address)
            <option value="{{ $address->id }}" class="truncate">
                {{ $address->line1 . ',' . $address->line2 . ',' . $address->city . ',' . $address->state . ',' . $address->postcode . ' ' . $address->phone }}
            </option>
        @endforeach
    </select>

    @if ($selectedAddress)
        <p class="text-xl font-bold text-pink-600 dark:text-pink-400 mb-4">Selected Address</p>
        <p class="text-base font-medium text-gray-400 dark:text-gray-400 mb-4">
            {{ "{$selectedAddress->line1}, {$selectedAddress->line2}, {$selectedAddress->city}, {$selectedAddress->state}, {$selectedAddress->postcode} {$selectedAddress->phone}" }}

            {{ session()->put('selected_address', "{$selectedAddress->line1}, {$selectedAddress->line2}, {$selectedAddress->city}, {$selectedAddress->state}, {$selectedAddress->postcode} {$selectedAddress->phone}") }}
        </p>
    @else
        <p class="text-xl font-bold text-pink-600 dark:text-pink-400 mt-4 mb-4">Default Address</p>
        <p class="text-base font-medium text-gray-400 dark:text-gray-400 mb-4">
            {{ "{$defaultAddress->line1}, {$defaultAddress->line2}, {$defaultAddress->city}, {$defaultAddress->state}, {$defaultAddress->postcode} {$defaultAddress->phone}" }}
            
            {{ session()->put('selected_address',"{$defaultAddress->line1}, {$defaultAddress->line2}, {$defaultAddress->city}, {$defaultAddress->state}, {$defaultAddress->postcode} {$defaultAddress->phone}" ) }}
        </p>
    @endif
    


</div>
