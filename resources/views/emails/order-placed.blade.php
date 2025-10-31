<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your order has been placed</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #fdf2f8; margin: 0; padding: 0; color: #4b5563; }
    .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
    .header { background-color: #ec4899; color: white; padding: 24px; text-align: center; }
    .content { padding: 32px; }
    .footer { text-align: center; font-size: 0.75rem; color: #9ca3af; padding: 24px; }
    .list { padding-left: 18px; margin: 0; }
  </style>
  <!-- Uses welcome template's structure/styles -->
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Welcome to {{ config('app.name') }}!</h1>
    </div>
    <div class="content">
      <p>Hi {{ $user->name }},</p>
      <p>Thanks for shopping with {{ config('app.name') }}. Your order has been placed successfully.</p>

      <h2 style="font-size: 16px; margin: 20px 0 8px;">Your Order Details</h2>
      <p style="margin: 0 0 8px;">Order ID: <strong>#{{ $order->id }}</strong></p>
      <p style="margin: 0 0 8px;">Total: <strong>₹ {{ number_format($order->total_amount, 2) }}</strong></p>
      <p style="margin: 0 0 8px;">Shipping to: {{ $order->shipping_address }}</p>
      <p style="margin: 0 0 8px;">Placed on: {{ optional($order->order_date)->format('Y-m-d H:i') }}</p>

      @if($order->relationLoaded('items') && $order->items->count())
        <div style="margin-top: 12px;">
          <p style="margin: 0 0 6px; font-weight: bold;">Items:</p>
          <ul class="list">
            @foreach($order->items as $item)
              <li>{{ $item->product->name ?? 'Product' }} × {{ $item->quantity }} — ₹ {{ number_format($item->price, 2) }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <p style="margin-top: 20px;">We’ll notify you as your order status changes.</p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>


