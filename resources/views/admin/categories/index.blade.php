<x-layout>
	<x-slot:title>Admin Categories - Manhitha</x-slot:title>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-between items-center mb-6">
				<h2 class="font-semibold text-2xl text-pink-600 dark:text-pink-400 leading-tight">Categories</h2>
				<a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
					Add New Category
				</a>
			</div>
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6">
					@if(session('success'))
						<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
							{{ session('success') }}
						</div>
					@endif

					@if(session('error'))
						<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
							{{ session('error') }}
						</div>
					@endif

					@if($categories->count() > 0)
						<div class="overflow-x-auto">
							<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
								<thead class="bg-gray-50 dark:bg-gray-700">
									<tr>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Products</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sort Order</th>
										<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
									</tr>
								</thead>
								<tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
									@foreach($categories as $category)
									<tr>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</div>
											<div class="text-sm text-gray-500 dark:text-gray-400">{{ $category->slug }}</div>
										</td>
										<td class="px-6 py-4">
											<div class="text-sm text-gray-900 dark:text-white">{{ Str::limit($category->description, 100) }}</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
												{{ $category->is_active ? 'Active' : 'Inactive' }}
											</span>
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
											{{ $category->products_count ?? $category->products()->count() }}
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
											{{ $category->sort_order }}
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
											<div class="flex space-x-2">
												<a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
													Edit
												</a>
												<form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
							{{ $categories->links() }}
						</div>
					@else
						<div class="text-center py-12">
							<svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
							</svg>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No categories yet</h3>
							<p class="text-gray-500 dark:text-gray-400">Get started by creating your first category.</p>
							<div class="mt-4">
								<a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
									Create Category
								</a>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-layout> 