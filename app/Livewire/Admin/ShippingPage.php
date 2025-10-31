<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\OrderStatusUpdated;

class ShippingPage extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $statusFilter = null;

    #[On('order-status-updated')]
    public function refreshList(): void
    {
        // Just re-render
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updateStatus(int $orderId, int $statusId): void
    {
        $order = Order::with('user', 'status')->findOrFail($orderId);
        $order->update(['order_status_id' => $statusId]);
        $order->load('status');

        // Notify user via email with the updated status
        Mail::to($order->user->email)->send(new OrderStatusUpdated($order));

        $this->dispatch('order-status-updated');
        session()->flash('success', 'Order status updated and user notified.');
    }

    public function render()
    {
        // Ensure workflow statuses exist and fetch them, ignoring any payment-only statuses
        $workflowStatusNames = ['Order Placed', 'Processing', 'Shipping', 'Delivered', 'Cancelled'];
        foreach ($workflowStatusNames as $name) {
            OrderStatus::firstOrCreate(['name' => $name]);
        }

        $query = Order::with('user', 'status')
            ->when($this->search !== '', function ($q) {
                $q->whereHas('user', function ($uq) {
                    $uq->where('name', 'like', "%{$this->search}%")
                       ->orWhere('email', 'like', "%{$this->search}%");
                })->orWhere('id', $this->search);
            })
            ->when($this->statusFilter, function ($q) {
                $q->where('order_status_id', $this->statusFilter);
            })
            ->latest();

        return view('livewire.admin.shipping-page', [
            'orders' => $query->paginate(10),
            'statuses' => OrderStatus::whereIn('name', $workflowStatusNames)->get(),
        ]);
    }
}


