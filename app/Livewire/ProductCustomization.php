<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Services\CustomizationService;
use Illuminate\Support\Facades\Storage;

class ProductCustomization extends Component
{
    use WithFileUploads;

    public Product $product;
    public $customImage;
    public $customText = '';
    public $customDimensions = [];
    public $specialInstructions = '';
    public $previewImage = null;

    public function updatedCustomImage()
    {
        $this->validate([
            'customImage' => 'image|max:10240', // 10MB max
        ]);

        // Create preview URL
        if ($this->customImage) {
            $this->previewImage = $this->customImage->temporaryUrl();
        }
    }

    public function removeImage()
    {
        $this->customImage = null;
        $this->previewImage = null;
    }

    public function getCustomizationData()
    {
        $data = [];

        // Handle image upload
        if ($this->customImage) {
            $imagePath = $this->customImage->store('customizations', 'public');
            $data['image'] = $imagePath;
        }

        // Handle text customization
        if ($this->product->supportsTextCustomization() && $this->customText) {
            $data['text'] = $this->customText;
        }

        // Handle dimensions
        if ($this->product->supportsDimensionCustomization()) {
            $dimensions = array_filter($this->customDimensions);
            if (!empty($dimensions)) {
                $data['dimensions'] = $dimensions;
            }
        }

        // Special instructions
        if ($this->specialInstructions) {
            $data['instructions'] = $this->specialInstructions;
        }

        return $data;
    }

    public function resetCustomization()
    {
        $this->customImage = null;
        $this->customText = '';
        $this->customDimensions = array_fill_keys(['length', 'width', 'height'], '');
        $this->specialInstructions = '';
        $this->previewImage = null;

        // Remove from session
        $customizationService = new CustomizationService();
        $customizationService->removeCustomization($this->product->id);
    }

    public function saveCustomization()
    {
        $customizationData = $this->getCustomizationData();
        
        if (!empty($customizationData)) {
            $customizationService = new CustomizationService();
            $customizationService->storeCustomization($this->product->id, $customizationData);
            
            $this->dispatch('customization-saved', [
                'message' => 'Customization saved successfully!'
            ]);
        }
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        
        // Initialize dimension fields if supported
        if ($this->product->supportsDimensionCustomization()) {
            $this->customDimensions = [
                'length' => '',
                'width' => '',
                'height' => ''
            ];
        }

        // Load existing customizations if any
        $customizationService = new CustomizationService();
        $existingData = $customizationService->getCustomization($this->product->id);
        
        if ($existingData) {
            if (isset($existingData['text'])) {
                $this->customText = $existingData['text'];
            }
            if (isset($existingData['dimensions'])) {
                $this->customDimensions = array_merge($this->customDimensions, $existingData['dimensions']);
            }
            if (isset($existingData['instructions'])) {
                $this->specialInstructions = $existingData['instructions'];
            }
            // Note: We can't restore the file upload, user will need to re-upload
        }
    }

    public function render()
    {
        return view('livewire.product-customization');
    }
}
