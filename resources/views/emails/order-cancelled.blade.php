<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancelled</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #dc2626;
        }
        .header h1 {
            color: #ec4899;
            margin: 0;
            font-size: 24px;
        }
        .status-badge {
            background-color: #fef2f2;
            color: #dc2626;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            margin: 10px 0;
        }
        .order-info {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .order-info h3 {
            color: #374151;
            margin-top: 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 15px 0;
        }
        .info-item {
            padding: 10px;
            background-color: white;
            border-radius: 4px;
        }
        .info-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            font-weight: 600;
            color: #374151;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th,
        .items-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        .refund-info {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .refund-info h3 {
            color: #065f46;
            margin-top: 0;
        }
        .contact-info {
            background-color: #fdf2f8;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Manhitha Gift Shop</h1>
            <p style="margin: 5px 0 0 0; color: #6b7280;">Order Cancellation Confirmation</p>
            <div class="status-badge">ORDER CANCELLED</div>
        </div>

        <p>Dear {{ $order->user->name }},</p>

        <p>We're writing to confirm that your order has been successfully cancelled as requested.</p>

        <div class="order-info">
            <h3>Cancelled Order Details</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Order Number</div>
                    <div class="info-value">#{{ $order->id }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Order Date</div>
                    <div class="info-value">{{ $order->created_at->format('M d, Y \a\t H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Cancellation Date</div>
                    <div class="info-value">{{ now()->format('M d, Y \a\t H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Amount</div>
                    <div class="info-value">₹{{ number_format($order->total_amount, 2) }}</div>
                </div>
            </div>
        </div>

        <h3>Cancelled Items</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($order->isPaidOnline())
        <div class="refund-info">
            <h3>💰 Refund Information</h3>
            <p><strong>Payment Method:</strong> {{ $order->formatted_payment_method }}</p>
            <p><strong>Refund Amount:</strong> ₹{{ number_format($order->refund_amount ?? $order->total_amount, 2) }}</p>
            
            @if($order->refund_status)
                <p><strong>Refund Status:</strong> 
                    <span style="color: {{ $order->refund_status === 'completed' ? '#10b981' : ($order->refund_status === 'failed' ? '#dc2626' : '#f59e0b') }};">
                        {{ ucfirst($order->refund_status) }}
                    </span>
                </p>
                
                @if($order->refund_status === 'initiated' || $order->refund_status === 'processing')
                    <p><strong>Processing Time:</strong> 3-5 business days</p>
                    <p>Your refund has been {{ $order->refund_status }} and will be processed to your original payment method. You'll receive updates on the refund progress.</p>
                @elseif($order->refund_status === 'completed')
                    <p>Your refund has been successfully processed to your original payment method.</p>
                    @if($order->refund_processed_at)
                        <p><strong>Processed On:</strong> {{ $order->refund_processed_at->format('M d, Y \a\t H:i') }}</p>
                    @endif
                @elseif($order->refund_status === 'failed')
                    <p style="color: #dc2626;">There was an issue processing your refund automatically. Our team will process it manually within 24 hours.</p>
                @endif
            @else
                <p><strong>Processing Time:</strong> 3-5 business days</p>
                <p>Your refund will be processed to your original payment method. You'll receive a separate confirmation once the refund has been initiated.</p>
            @endif
        </div>
        @else
        <div class="refund-info" style="background-color: #fef3c7; border-color: #f59e0b;">
            <h3>📋 Payment Information</h3>
            <p><strong>Payment Method:</strong> Cash on Delivery</p>
            <p>Since this was a Cash on Delivery order, no refund processing is required.</p>
        </div>
        @endif

        <div class="contact-info">
            <h3>Need Help?</h3>
            <p>If you have any questions about your cancellation or refund, please don't hesitate to contact us:</p>
            <p>
                <strong>Phone:</strong> +91 94494 37255<br>
                <strong>Email:</strong> info@manhitha.com<br>
                <strong>WhatsApp:</strong> +91 94494 37255
            </p>
        </div>

        <p>We're sorry to see you cancel your order, but we understand that circumstances can change. We hope to serve you again in the future!</p>

        <p>Thank you for choosing Manhitha Gift Shop.</p>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>Manhitha Gift Shop | 365 Kengeri Bazaar Street, Kuvempu Rd, Kengeri, Karnataka 560060</p>
            <p>© {{ date('Y') }} Manhitha Gift Shop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>