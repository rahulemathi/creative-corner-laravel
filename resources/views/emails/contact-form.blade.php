<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Message</title>
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
            border-bottom: 2px solid #ec4899;
        }
        .header h1 {
            color: #ec4899;
            margin: 0;
            font-size: 24px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .info-item {
            background-color: #fdf2f8;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #ec4899;
        }
        .info-label {
            font-weight: 600;
            color: #be185d;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            color: #374151;
            font-size: 14px;
        }
        .message-section {
            background-color: #f3f4f6;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .message-label {
            font-weight: 600;
            color: #be185d;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .message-content {
            color: #374151;
            line-height: 1.7;
            white-space: pre-line;
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
            <h1>New Contact Form Message</h1>
            <p style="margin: 5px 0 0 0; color: #6b7280;">Manhitha Gift Shop</p>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Full Name</div>
                <div class="info-value">{{ $contactData['first_name'] }} {{ $contactData['last_name'] }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Email Address</div>
                <div class="info-value">{{ $contactData['email'] }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Phone Number</div>
                <div class="info-value">{{ $contactData['phone'] ?? 'Not provided' }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Subject</div>
                <div class="info-value">{{ ucfirst(str_replace('_', ' ', $contactData['subject'])) }}</div>
            </div>
        </div>

        <div class="message-section">
            <div class="message-label">Message:</div>
            <div class="message-content">{{ $contactData['message'] }}</div>
        </div>

        <div class="footer">
            <p>This message was sent from the Manhitha Gift Shop contact form.</p>
            <p>Received on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>