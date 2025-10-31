<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #111827;">
    <h1 style="font-size: 20px;">Welcome, {{ $user->name }}!</h1>
    <p>Thanks for signing up with {{ config('app.name') }}.</p>
    <p>We’re excited to have you on board.</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to {{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Tailwind-like utility styles for email clients */
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fdf2f8; /* pink-50 */
      margin: 0;
      padding: 0;
      color: #4b5563; /* gray-700 */
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 0.5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .header {
      background-color: #ec4899; /* pink-500 */
      color: white;
      padding: 24px;
      text-align: center;
    }
    .content {
      padding: 32px;
    }
    .cta-button {
      display: inline-block;
      margin-top: 24px;
      padding: 12px 24px;
      background-color: #db2777; /* pink-600 */
      color: white;
      text-decoration: none;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }
    .cta-button:hover {
      background-color: #be185d; /* pink-700 */
    }
    .footer {
      text-align: center;
      font-size: 0.75rem;
      color: #9ca3af; /* gray-400 */
      padding: 24px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Welcome to {{ config('app.name') }}!</h1>
    </div>
    <div class="content">
      <p>Hi {{ $user->name }},</p>
      <p>We're thrilled to have you join our community of gift lovers! 🎉</p>
      <p>At {{ config('app.name') }}, we believe every gift tells a story. Whether you're shopping for a friend, a celebration, or just because—you'll find something special here.</p>
      <p>To get started, explore our latest collections and discover curated surprises waiting for you.</p>
      <a href="{{ route('products.index') }}" class="cta-button">Shop Now</a>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>