<x-layout>
	<x-slot:title>Create Category - Manhitha</x-slot:title>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-between items-center mb-6">
				<h2 class="font-semibold text-2xl text-pink-600 dark:text-pink-400 leading-tight">Create Category</h2>
				<a href="{{ route('admin.categories.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
					Back to Categories
				</a>
			</div>
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6">
					<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
						@csrf
						
						<div>
							<label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Name *</label>
							<input type="text" name="name" id="name" value="{{ old('name') }}" required 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('name')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
							<textarea name="description" id="description" rows="4" 
								  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
							@error('description')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Image</label>
							<input type="file" name="image" id="image" accept="image/*" 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('image')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
							<div>
								<label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort Order</label>
								<input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sort_order')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div class="flex items-center">
								<input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
									   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
							</div>
						</div>

						<div class="flex justify-end space-x-4">
							<a href="{{ route('admin.categories.index') }}" 
							   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors">
								Cancel
							</a>
							<button type="submit" 
									class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-lg transition-colors">
								Create Category
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-layout> 