<x-layout>
	<x-slot:title>Admin Products - Manhitha</x-slot:title>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-between items-center mb-6">
				<h2 class="font-semibold text-2xl text-pink-600 dark:text-pink-400 leading-tight">Products</h2>
				<a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
					Add New Product
				</a>
			</div>
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6">
					@if(session('success'))
						<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
							{{ session('success') }}
						</div>
					@endif

					@if($products->count() > 0)
						<div class="overflow-x-auto">
							<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
								<thead class="bg-gray-50 dark:bg-gray-700">
									<tr>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
									</tr>
								</thead>
								<tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
									@foreach($products as $product)
									<tr>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<div class="flex-shrink-0 h-10 w-10">
													<img class="h-10 w-10 rounded-lg object-cover" src="https://placehold.co/100x100" alt="{{ $product->name }}">
												</div>
												<div class="ml-4">
													<div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
													<div class="text-sm text-gray-500 dark:text-gray-400">{{ $product->sku }}</div>
												</div>
											</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="text-sm text-gray-900 dark:text-white">{{ $product->category->name }}</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											@if($product->sale_price)
												<div class="text-sm text-red-600 font-medium">{{ $product->formatted_sale_price }}</div>
												<div class="text-xs text-gray-500 line-through">{{ $product->formatted_price }}</div>
											@else
												<div class="text-sm text-gray-900 dark:text-white font-medium">{{ $product->formatted_price }}</div>
											@endif
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
												{{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
											</span>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex space-x-2">
												@if($product->is_active)
													<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
														Active
													</span>
												@else
													<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
														Inactive
													</span>
												@endif
												@if($product->is_featured)
													<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
														Featured
													</span>
												@endif
											</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
											<div class="flex space-x-2">
												<a href="{{ route('products.show', $product->slug) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
													View
												</a>
												<a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
													Edit
												</a>
												<form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
													@csrf
													@method('DELETE')
													<button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
														Delete
													</button>
												</form>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>

						<div class="mt-6">
							{{ $products->links() }}
						</div>
					@else
						<div class="text-center py-12">
							<svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
							</svg>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No products yet</h3>
							<p class="text-gray-500 dark:text-gray-400">Get started by creating your first product.</p>
							<div class="mt-4">
								<a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
									Create Product
								</a>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-layout> 