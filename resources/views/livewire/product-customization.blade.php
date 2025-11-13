<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-semibold text-pink-600 dark:text-pink-400 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Customize Your Product
        </h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Make this {{ $product->name }} uniquely yours!
        </p>
    </div>

    <div class="p-6 space-y-6">
        @if($product->customization_price > 0)
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-blue-800 dark:text-blue-200 text-sm">
                        <strong>Customization Fee:</strong> +₹{{ number_format($product->customization_price, 2) }}
                    </span>
                </div>
            </div>
        @endif

        @if($product->customization_instructions)
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                <h4 class="font-medium text-yellow-800 dark:text-yellow-200 mb-2">Customization Guidelines:</h4>
                <p class="text-sm text-yellow-700 dark:text-yellow-300">{{ $product->customization_instructions }}</p>
            </div>
        @endif

        <!-- Image Upload Section -->
        @if($product->supportsImageUpload())
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upload Your Design
                    </label>
                </div>

                @if($previewImage)
                    <div class="relative">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <div class="flex flex-col items-center space-y-4">
                                <!-- Preview Image -->
                                <div class="relative">
                                    <img src="{{ $previewImage }}" 
                                         alt="Preview" 
                                         class="max-w-64 max-h-64 rounded-lg shadow-lg object-contain">
                                    
                                    <!-- Product Mockup Overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-30">
                                        <div class="bg-white/80 backdrop-blur-sm rounded-lg px-3 py-1 text-xs text-gray-600">
                                            Preview on {{ $product->name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <p class="text-sm text-green-600 dark:text-green-400 font-medium">✓ Image uploaded successfully!</p>
                                    <button type="button" 
                                            wire:click="removeImage"
                                            class="mt-2 text-sm text-red-600 hover:text-red-700 underline">
                                        Remove image
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-pink-400 transition-colors">
                        <input type="file" 
                               wire:model="customImage" 
                               accept="image/*"
                               class="hidden" 
                               id="customImage">
                        
                        <label for="customImage" class="cursor-pointer">
                            <div class="flex flex-col items-center space-y-3">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Click to upload your design</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 10MB</p>
                                </div>
                            </div>
                        </label>
                    </div>
                @endif

                @error('customImage')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <!-- Text Customization Section -->
        @if($product->supportsTextCustomization())
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Custom Text
                    </label>
                </div>

                <div class="space-y-3">
                    <textarea wire:model.live="customText" 
                              rows="3" 
                              placeholder="Enter your custom text here..."
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:text-white"></textarea>
                    
                    @if($customText)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Preview:</p>
                            <div class="font-bold text-lg text-pink-600 dark:text-pink-400" style="font-family: 'Times New Roman', serif;">
                                {{ $customText }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Custom Dimensions Section -->
        @if($product->supportsDimensionCustomization())
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Custom Dimensions
                    </label>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                            Length ({{ $product->dimension_unit ?? 'cm' }})
                        </label>
                        <input type="number" 
                               wire:model="customDimensions.length" 
                               step="0.1" 
                               min="0"
                               placeholder="0"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                            Width ({{ $product->dimension_unit ?? 'cm' }})
                        </label>
                        <input type="number" 
                               wire:model="customDimensions.width" 
                               step="0.1" 
                               min="0"
                               placeholder="0"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                            Height ({{ $product->dimension_unit ?? 'cm' }})
                        </label>
                        <input type="number" 
                               wire:model="customDimensions.height" 
                               step="0.1" 
                               min="0"
                               placeholder="0"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                </div>

                @if(!empty(array_filter($customDimensions)))
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 border border-blue-200 dark:border-blue-700">
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            <strong>Custom Size:</strong>
                            {{ $customDimensions['length'] ?? 0 }} x {{ $customDimensions['width'] ?? 0 }} x {{ $customDimensions['height'] ?? 0 }} {{ $product->dimension_unit ?? 'cm' }}
                        </p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Special Instructions -->
        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Special Instructions (Optional)
                </label>
            </div>
            
            <textarea wire:model="specialInstructions" 
                      rows="3" 
                      placeholder="Any special requirements or instructions for your customization..."
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:text-white"></textarea>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
            <button type="button" 
                    wire:click="resetCustomization"
                    class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Reset All
            </button>
            
            <button type="button" 
                    wire:click="saveCustomization"
                    class="px-6 py-2 text-sm bg-pink-600 hover:bg-pink-700 text-white rounded-lg transition-colors font-medium">
                Save Customization
            </button>
        </div>
    </div>

    <!-- Loading States -->
    <div wire:loading wire:target="customImage" class="absolute inset-0 bg-white/80 dark:bg-gray-800/80 flex items-center justify-center rounded-lg">
        <div class="flex items-center space-x-2 text-pink-600">
            <svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <span class="text-sm font-medium">Processing image...</span>
        </div>
    </div>
</div>
