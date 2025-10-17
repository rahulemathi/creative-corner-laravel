<x-layout>
    <x-slot:title>My Profile - Manhitha Gift Shop</x-slot:title>

    <div class="container mx-auto py-8 px-4">
        <div class="relative w-full h-40 bg-gradient-to-r from-pink-500 to-purple-600 rounded-lg shadow-lg mb-8">
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 rounded-lg">
                <h1 class="text-white text-3xl font-bold">My Profile</h1>
                <p class="text-white text-base">Manage your personal information</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-pink-600 dark:text-pink-400 mb-4">Profile Details</h2>
                <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input w-full rounded-md dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input w-full rounded-md dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-input w-full rounded-md dark:bg-gray-700 dark:text-white" placeholder="+91xxxxxxxxxx">
                    </div>
                    <div class="md:col-span-2">
                        <x-button>Save Changes</x-button>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-pink-600 dark:text-pink-400 mb-3">Addresses</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Manage your shipping addresses and default address.</p>
                <a href="{{ route('profile.addresses') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 text-white font-medium rounded-lg hover:bg-pink-700 transition-colors">Manage Addresses</a>
            </div>
        </div>
    </div>
</x-layout>
