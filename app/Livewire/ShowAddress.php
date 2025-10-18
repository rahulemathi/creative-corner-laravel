<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowAddress extends Component
{
    public $address = [];
    public $defaultAddress;
    public $selectedAddressId;
    public $selectedAddress;



    public function mount(){
        $this->address = Address::where('user_id', Auth::id())->get();
        $this->defaultAddress = Address::where('user_id',Auth::id())->where('is_default',true)->first();
    }

    public function updatedSelectedAddressId($value){
        $this->selectedAddress = Address::find($value);
    }

    public function selectedAddress($id){
        $this->selectedAddress = Address::find($id);
    }
    public function render()
    {
        return view('livewire.show-address');
    }
}
