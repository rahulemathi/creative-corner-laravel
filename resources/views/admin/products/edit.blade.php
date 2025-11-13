<x-layout>
	<x-slot:title>Edit Product - Manhitha</x-slot:title>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-between items-center mb-6">
				<h2 class="font-semibold text-2xl text-pink-600 dark:text-pink-400 leading-tight">Edit Product</h2>
				<a href="{{ route('admin.products.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
					Back to Products
				</a>
			</div>
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6">
					<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
						@csrf
						@method('PUT')
						
						<div>
							<label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category *</label>
							<select name="category_id" id="category_id" required 
									class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								<option value="">Select a category</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
							<input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('name')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
							<textarea name="description" id="description" rows="4" required 
								  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $product->description) }}</textarea>
							@error('description')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div>
								<label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price *</label>
								<input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('price')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="sale_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sale Price</label>
								<input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sale_price')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock *</label>
								<input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" required 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('stock')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div>
								<label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SKU</label>
								<input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sku')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Weight</label>
								<input type="text" name="weight" id="weight" value="{{ old('weight', $product->weight) }}" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('weight')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div>
								<label for="dimension_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dimension Unit</label>
								<select name="dimension_unit" id="dimension_unit" 
									    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
									<option value="cm" {{ old('dimension_unit', $product->dimension_unit ?? 'cm') == 'cm' ? 'selected' : '' }}>Centimeters (cm)</option>
									<option value="mm" {{ old('dimension_unit', $product->dimension_unit) == 'mm' ? 'selected' : '' }}>Millimeters (mm)</option>
									<option value="in" {{ old('dimension_unit', $product->dimension_unit) == 'in' ? 'selected' : '' }}>Inches (in)</option>
								</select>
								@error('dimension_unit')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>
						</div>

						<!-- Admin-defined Dimensions Section -->
						<div id="admin_dimensions_section" class="border-t border-gray-200 dark:border-gray-700 pt-6">
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Product Dimensions</h3>
							<p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
								Define the fixed dimensions for this product. These will be hidden if "Custom Dimensions" customization is enabled.
							</p>
							
							<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
								<div>
									<label for="length" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Length</label>
									<input type="number" name="length" id="length" value="{{ old('length', $product->length) }}" step="0.01" min="0" 
										   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
									@error('length')
										<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
									@enderror
								</div>

								<div>
									<label for="width" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Width</label>
									<input type="number" name="width" id="width" value="{{ old('width', $product->width) }}" step="0.01" min="0" 
										   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
									@error('width')
										<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
									@enderror
								</div>

								<div>
									<label for="height" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Height</label>
									<input type="number" name="height" id="height" value="{{ old('height', $product->height) }}" step="0.01" min="0" 
										   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
									@error('height')
										<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
									@enderror
								</div>

								<div>
									<label for="dimensions" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alternative Description</label>
									<input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions', $product->dimensions) }}" 
										   placeholder="e.g., Standard mug size"
										   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
									@error('dimensions')
										<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
									@enderror
									<p class="text-sm text-gray-500 mt-1">Optional text description if specific dimensions are not available</p>
								</div>
							</div>
						</div>

						<div>
							<label for="material" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Material</label>
							<input type="text" name="material" id="material" value="{{ old('material', $product->material) }}" 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('material')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
						</div>

						<!-- Current Images Display -->
						@if($product->images && count($product->images) > 0)
							<div>
								<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Images</label>
								<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
									@foreach($product->images as $image)
										<div class="relative">
											<img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="w-full h-32 object-cover rounded-lg">
										</div>
									@endforeach
								</div>
							</div>
						@endif

						<div>
							<label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Images</label>
							<input type="file" name="images[]" id="images" accept="image/*" multiple 
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
							@error('images')
								<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
							@enderror
							<p class="text-sm text-gray-500 mt-1">Upload new images to replace existing ones. You can select multiple images.</p>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div>
								<label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort Order</label>
								<input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $product->sort_order) }}" min="0" 
									   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
								@error('sort_order')
									<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
								@enderror
							</div>

							<div class="flex items-center">
								<input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} 
									   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="is_featured" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Featured Product</label>
							</div>

							<div class="flex items-center">
								<input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} 
									   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
							</div>
						</div>

						<!-- Customization Section -->
						<div class="border-t border-gray-200 dark:border-gray-700 pt-6">
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Product Customization</h3>
							
							<div class="space-y-6">
								<div class="flex items-center">
									<input type="checkbox" name="is_customizable" id="is_customizable" value="1" {{ old('is_customizable', $product->is_customizable) ? 'checked' : '' }} 
										   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
										   onchange="toggleCustomizationFields()">
									<label for="is_customizable" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Allow Customization</label>
								</div>

								<div id="customization_fields" class="space-y-4" style="display: {{ old('is_customizable', $product->is_customizable) ? 'block' : 'none' }};">
									<div>
										<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customization Options</label>
										<div class="space-y-2">
											<div class="flex items-center">
												<input type="checkbox" name="customization_options[]" id="image_upload" value="image_upload" 
													   {{ in_array('image_upload', old('customization_options', $product->customization_options ?? [])) ? 'checked' : '' }}
													   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:bg-gray-700 dark:border-gray-600">
												<label for="image_upload" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Image Upload</label>
											</div>
											<div class="flex items-center">
												<input type="checkbox" name="customization_options[]" id="text_input" value="text_input" 
													   {{ in_array('text_input', old('customization_options', $product->customization_options ?? [])) ? 'checked' : '' }}
													   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:bg-gray-700 dark:border-gray-600">
												<label for="text_input" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Text Input</label>
											</div>
											<div class="flex items-center">
												<input type="checkbox" name="customization_options[]" id="dimensions" value="dimensions" 
													   {{ in_array('dimensions', old('customization_options', $product->customization_options ?? [])) ? 'checked' : '' }}
													   class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:bg-gray-700 dark:border-gray-600">
												<label for="dimensions" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Custom Dimensions</label>
											</div>
										</div>
									</div>

									<div>
										<label for="customization_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customization Fee</label>
										<input type="number" name="customization_price" id="customization_price" value="{{ old('customization_price', $product->customization_price) }}" step="0.01" min="0" 
											   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
										@error('customization_price')
											<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
										@enderror
									</div>

									<div>
										<label for="customization_instructions" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customization Instructions</label>
										<textarea name="customization_instructions" id="customization_instructions" rows="3" 
												  placeholder="Guidelines for customers when customizing this product..."
												  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('customization_instructions', $product->customization_instructions) }}</textarea>
										@error('customization_instructions')
											<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
										@enderror
									</div>
								</div>
							</div>
						</div>

						<div class="flex justify-end space-x-4">
							<a href="{{ route('admin.products.index') }}" 
							   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors">
								Cancel
							</a>
							<button type="submit" 
									class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-lg transition-colors">
								Update Product
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script>
function toggleCustomizationFields() {
	const checkbox = document.getElementById('is_customizable');
	const fields = document.getElementById('customization_fields');
	
	if (checkbox.checked) {
		fields.style.display = 'block';
		// Check if custom dimensions option changes
		toggleDimensionFields();
	} else {
		fields.style.display = 'none';
		// Clear all customization options when hiding
		const customizationCheckboxes = document.querySelectorAll('input[name="customization_options[]"]');
		customizationCheckboxes.forEach(cb => cb.checked = false);
		document.getElementById('customization_price').value = 0;
		document.getElementById('customization_instructions').value = '';
		// Show admin dimensions when customization is disabled
		document.getElementById('admin_dimensions_section').style.display = 'block';
	}
}

function toggleDimensionFields() {
	const customDimensionsCheckbox = document.getElementById('dimensions');
	const adminDimensionsSection = document.getElementById('admin_dimensions_section');
	
	if (customDimensionsCheckbox && customDimensionsCheckbox.checked) {
		// Hide admin dimension fields when customer can customize dimensions
		adminDimensionsSection.style.display = 'none';
	} else {
		// Show admin dimension fields when dimensions are fixed
		adminDimensionsSection.style.display = 'block';
	}
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
	toggleCustomizationFields();
	
	// Add event listeners for customization options
	const dimensionsCheckbox = document.getElementById('dimensions');
	if (dimensionsCheckbox) {
		dimensionsCheckbox.addEventListener('change', toggleDimensionFields);
	}
});
</script>
</x-layout>