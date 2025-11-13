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
    
    protected $paginationTheme = 'bootstrap';

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

    public function clearFilters(): void
    {
        $this->reset(['search', 'statusFilter']);
        $this->resetPage();
    }

    public function updateStatus($orderId, $statusId): void
    {
        try {
            $order = Order::with('user', 'status')->findOrFail($orderId);
            $order->update(['order_status_id' => $statusId]);
            $order->load('status');

            // Notify user via email with the updated status
            Mail::to($order->user->email)->send(new OrderStatusUpdated($order));

            $this->dispatch('order-status-updated');
            session()->flash('success', 'Order status updated and user notified.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Ensure workflow statuses exist and fetch them, ignoring any payment-only statuses
        $workflowStatusNames = ['Order Placed', 'Processing', 'Shipping', 'Delivered', 'Cancelled'];
        foreach ($workflowStatusNames as $name) {
            OrderStatus::firstOrCreate(['name' => $name]);
        }

        $query = Order::with('user', 'status')
            ->when(trim($this->search) !== '', function ($q) {
                $search = trim($this->search);
                $q->where(function($subQ) use ($search) {
                    $subQ->whereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhere('id', 'like', "%{$search}%");
                });
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


