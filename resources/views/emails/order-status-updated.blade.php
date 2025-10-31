<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Status Updated</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #fdf2f8; margin: 0; padding: 0; color: #4b5563; }
    .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
    .header { background-color: #ec4899; color: white; padding: 24px; text-align: center; }
    .content { padding: 32px; }
    .footer { text-align: center; font-size: 0.75rem; color: #9ca3af; padding: 24px; }
  </style>
  <!-- Uses welcome template's structure/styles -->
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Order #{{ $order->id }} update</h1>
    </div>
    <div class="content">
      <p>Hi {{ $order->user->name }},</p>
      <p>Your order status is now: <strong>{{ $order->status->name }}</strong>.</p>
      <p>Total: ₹ {{ number_format($order->total_amount, 2) }}</p>
      <p>We’ll keep you posted as the status changes.</p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>


