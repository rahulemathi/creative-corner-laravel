<x-layout>
	<x-slot:title>Create Product - Manhitha</x-slot:title>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-between items-center mb-6">
				<h2 class="font-semibold text-2xl text-pink-600 dark:text-pink-400 leading-tight">Create Product</h2>
				<a href="{{ route('admin.products.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
					Back to Products
				</a>
			</div>
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6">
					<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
						@csrf
						
						<div>
							<label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category *</label>
							<select name="category_id" id="category_id" required 
									class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								<option value="">Select a category</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
										{{ $category->name }}
									</option>
								@endforeach
							</select>
							@error('category_id')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name *</label>
							<input type="text" name="name" id="name" value="{{ old('name') }}" required 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('name')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
							<textarea name="description" id="description" rows="4" required 
								  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
							@error('description')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div>
								<label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price *</label>
								<input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('price')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="sale_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sale Price</label>
								<input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" step="0.01" min="0" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sale_price')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock *</label>
								<input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" required 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('stock')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div>
								<label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SKU</label>
								<input type="text" name="sku" id="sku" value="{{ old('sku') }}" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sku')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="dimensions" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dimensions</label>
								<input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions') }}" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('dimensions')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="weight" class="block text sm font-medium text-gray-700 dark:text-gray-300 mb-2">Weight</label>
								<input type="text" name="weight" id="weight" value="{{ old('weight') }}" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('weight')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>
						</div>

						<div>
							<label for="material" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Material</label>
							<input type="text" name="material" id="material" value="{{ old('material') }}" 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('material')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Images</label>
							<input type="file" name="images[]" id="images" accept="image/*" multiple 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('images')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
							<p class="text-sm text-gray-500 mt-1">You can select multiple images. Hold Ctrl/Cmd to select multiple files.</p>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div>
								<label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort Order</label>
								<input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sort_order')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div class="flex items-center">
								<input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
									   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="is_featured" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Featured Product</label>
							</div>

							<div class="flex items-center">
								<input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
									   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
							</div>
						</div>

						<div class="flex justify-end space-x-4">
							<a href="{{ route('admin.products.index') }}" 
							   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors">
								Cancel
							</a>
							<button type="submit" 
									class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-lg transition-colors">
								Create Product
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-layout> 