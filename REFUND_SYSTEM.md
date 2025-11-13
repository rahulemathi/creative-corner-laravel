# Payment Refund System

## Overview
The application includes a comprehensive payment refund system that automatically processes refunds for cancelled orders when online payment methods are used.

## Features

### Automatic Refund Processing
- **Supported Gateways**: Razorpay, PayU, Stripe
- **Eligibility Check**: Only online payments are eligible for automatic refunds
- **Status Tracking**: Real-time refund status updates
- **Fallback Handling**: Manual processing for unsupported gateways

### Refund Statuses
- `initiated`: Refund request sent to payment gateway
- `processing`: Gateway is processing the refund
- `completed`: Refund successfully processed
- `failed`: Refund failed, requires manual intervention

## Configuration

### 1. Environment Variables
Copy the payment gateway credentials to your `.env` file:
```bash
# See .env.payment.example for complete configuration
RAZORPAY_KEY_ID=your_key_id
RAZORPAY_KEY_SECRET=your_secret
# ... other gateway configs
```

### 2. Database Migration
Run the migration to add payment tracking fields:
```bash
php artisan migrate
```

### 3. Payment Gateway Setup
Configure webhook URLs in your payment gateway dashboards to receive status updates.

## Usage

### Order Cancellation with Refunds
When a user cancels an order:

1. **Validation**: System checks if order is cancellable (within 2 hours)
2. **Status Update**: Order status changed to 'Cancelled'
3. **Stock Restoration**: Product quantities restored to inventory  
4. **Refund Processing**: 
   - Online payments: Automatic refund via gateway API
   - Cash on Delivery: No refund needed
5. **Email Notification**: User receives cancellation confirmation with refund details

### Refund Status Monitoring
```bash
# Check all pending refunds
php artisan refunds:check-status

# Check specific order
php artisan refunds:check-status --order-id=123
```

## Database Schema

### Orders Table - Payment Fields
```sql
payment_method VARCHAR(50)      -- cod, online, card, upi, etc.
payment_gateway VARCHAR(50)     -- razorpay, payu, stripe
payment_id VARCHAR(100)         -- Gateway transaction ID
payment_status VARCHAR(50)      -- pending, paid, failed
payment_details JSON            -- Gateway response data
refund_amount DECIMAL(10,2)     -- Amount to refund
refund_status VARCHAR(50)       -- initiated, processing, completed, failed
refund_id VARCHAR(100)          -- Gateway refund ID  
refund_processed_at TIMESTAMP   -- When refund was processed
```

## API Integration

### RefundService Methods
```php
// Process refund for an order
$refundService->processRefund($order);

// Check refund status  
$status = $refundService->checkRefundStatus($order);

// Update order with latest gateway status
$refundService->updateRefundStatus($order);
```

### Gateway-Specific Processing
Each payment gateway has dedicated methods:
- `processRazorpayRefund()`: Razorpay API integration
- `processPayURefund()`: PayU API integration  
- `processStripeRefund()`: Stripe API integration
- `processFallbackRefund()`: Manual processing fallback

## Error Handling

### Automatic Retry Logic
- Failed refunds marked for manual review
- Logs detailed error information
- Email notifications for failed automatic refunds

### Manual Intervention
When automatic refunds fail:
1. Order marked with `refund_status = 'failed'`
2. Admin receives notification
3. Manual refund processed through gateway dashboard
4. Status updated manually in system

## Security Considerations

### Webhook Validation
- Verify webhook signatures from payment gateways
- Validate request authenticity before processing
- Log all webhook interactions for audit

### Data Protection
- Store minimal sensitive payment data
- Use encrypted fields for sensitive information
- Implement proper access controls

## Testing

### Test Mode Configuration
Use sandbox/test credentials for development:
```bash
RAZORPAY_KEY_ID=rzp_test_xxx
PAYU_ENVIRONMENT=test  
STRIPE_KEY=pk_test_xxx
```

### Mock Refund Testing
The system includes test methods to simulate refund scenarios without actual API calls.

## Monitoring & Analytics

### Refund Metrics
Track refund success rates, processing times, and failure reasons through:
- Application logs
- Database queries  
- Payment gateway dashboards

### Scheduled Jobs
Set up cron jobs to regularly check refund statuses:
```bash
# Add to crontab
0 */2 * * * cd /path/to/app && php artisan refunds:check-status
```

## Troubleshooting

### Common Issues
1. **Invalid Gateway Credentials**: Check environment variables
2. **Webhook Not Received**: Verify URL configuration in gateway
3. **Refund API Limits**: Check gateway rate limits and quotas
4. **Network Timeouts**: Implement retry logic with exponential backoff

### Debug Mode
Enable detailed logging by setting `APP_DEBUG=true` in development.

## Support

For payment gateway specific issues:
- **Razorpay**: [Developer Documentation](https://razorpay.com/docs/)
- **PayU**: [Integration Guide](https://docs.payu.in/)
- **Stripe**: [API Reference](https://stripe.com/docs/api)

For application issues, check the logs in `storage/logs/laravel.log`.