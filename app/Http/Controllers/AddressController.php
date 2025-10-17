<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        return view('profile.addresses', compact('addresses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'nullable|string|max:50',
            'line1' => 'required|string|max:255',
            'line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:120',
            'state' => 'nullable|string|max:120',
            'postcode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'is_default' => 'sometimes|boolean',
        ]);

        $data['user_id'] = Auth::id();
        $address = Address::create($data);

        // if first address or requested default, set default exclusively
        if ($request->boolean('is_default') || Auth::user()->addresses()->count() === 1) {
            $this->setDefaultInternal($address);
        }

        alert()->success('Success', 'Address added');
        return back();
    }

    public function update(Request $request, Address $address)
    {
        $this->authorizeAddress($address);

        $data = $request->validate([
            'label' => 'nullable|string|max:50',
            'line1' => 'required|string|max:255',
            'line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:120',
            'state' => 'nullable|string|max:120',
            'postcode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'is_default' => 'sometimes|boolean',
        ]);

        $address->update($data);

        if ($request->has('is_default')) {
            if ($request->boolean('is_default')) {
                $this->setDefaultInternal($address);
            } else if ($address->is_default) {
                $address->update(['is_default' => false]);
            }
        }

        alert()->success('Success', 'Address updated');
        return back();
    }

    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        $wasDefault = $address->is_default;
        $address->delete();

        if ($wasDefault) {
            $next = Auth::user()->addresses()->whereNull('deleted_at')->first();
            if ($next) {
                $this->setDefaultInternal($next);
            }
        }

        alert()->success('Success', 'Address removed');
        return back();
    }

    public function setDefault(Address $address)
    {
        $this->authorizeAddress($address);
        $this->setDefaultInternal($address);
        alert()->success('Success', 'Default address updated');
        return back();
    }

    private function setDefaultInternal(Address $address): void
    {
        DB::transaction(function () use ($address) {
            Address::where('user_id', $address->user_id)->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        });
    }

    private function authorizeAddress(Address $address): void
    {
        abort_unless($address->user_id === Auth::id(), 403);
    }
}
