<x-layout>
    <x-slot:title>My Address - Manhitha Gift Shop</x-slot:title>

    <div class="container mx-auto py-8 px-4">
        <div class="relative w-full h-40 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg shadow-lg mb-8">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 rounded-lg">
                <h1 class="text-white text-3xl font-bold">Address</h1>
                <p class="text-white text-base">Manage your personal information</p>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Add Address</h3>
                    <form method="POST" action="{{ route('profile.addresses.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        @csrf
                        <input class="form-input rounded-md" name="label" placeholder="Label (Home/Office)">
                        <input class="form-input rounded-md" name="phone" placeholder="Phone">
                        <input class="form-input rounded-md md:col-span-2" name="line1" placeholder="Address line 1" required>
                        <input class="form-input rounded-md md:col-span-2" name="line2" placeholder="Address line 2">
                        <input class="form-input rounded-md" name="city" placeholder="City" required>
                        <input class="form-input rounded-md" name="state" placeholder="State">
                        <input class="form-input rounded-md" name="postcode" placeholder="Postcode">
                        <input class="form-input rounded-md" name="country" placeholder="Country" value="India">
                        <label class="inline-flex items-center space-x-2 md:col-span-2">
                            <input type="checkbox" name="is_default" class="form-checkbox">
                            <span>Set as default</span>
                        </label>
                        <div class="md:col-span-2">
                            <x-button>Add Address</x-button>
                        </div>
                    </form>
        
                    <h3 class="text-lg font-semibold mb-4">Saved Addresses</h3>
                    <div class="space-y-4">
                        @forelse ($addresses as $address)
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-700 dark:text-gray-300">
                                        <div class="font-semibold">{{ $address->label ?? 'Address' }} @if($address->is_default)<span class="ml-2 text-xs text-green-600">(Default)</span>@endif</div>
                                        <div>{{ $address->line1 }}</div>
                                        @if($address->line2)<div>{{ $address->line2 }}</div>@endif
                                        <div>{{ $address->city }}, {{ $address->state }} {{ $address->postcode }}</div>
                                        <div>{{ $address->country }}</div>
                                        @if($address->phone)<div>Phone: {{ $address->phone }}</div>@endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if(!$address->is_default)
                                        <form method="POST" action="{{ route('profile.addresses.default', $address) }}">
                                            @csrf
                                            @method('PATCH')
                                            <x-button type="submit">Make Default</x-button>
                                        </form>
                                        @endif
                                        <form method="POST" action="{{ route('profile.addresses.destroy', $address) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit">Delete</x-danger-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">No addresses added yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
      
</x-layout>


