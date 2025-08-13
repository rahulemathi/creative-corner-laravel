# Admin System Setup Guide

## Overview
This guide explains how to set up and use the admin system for the Manhitha Gift Shop application.

## Features
- **Admin-only access** to product and category management
- **Role-based access control** using middleware and policies
- **Custom admin dashboard** with statistics and quick actions
- **Secure admin routes** protected by authentication and admin checks

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Run Seeders
```bash
php artisan db:seed
```

This will create:
- Sample categories and products
- An admin user (admin@manhitha.com / password)
- A regular user (user@manhitha.com / password)

### 3. Create Additional Admin Users (Optional)
```bash
php artisan make:admin admin@example.com --name="Admin Name" --password="securepassword"
```

Or interactively:
```bash
php artisan make:admin admin@example.com
```

## Admin Access

### Admin Routes
All admin routes are prefixed with `/admin` and require:
- User authentication
- Admin privileges (`is_admin = true`)

**Available Admin Routes:**
- `/admin/dashboard` - Admin dashboard
- `/admin/categories` - Category management
- `/admin/products` - Product management

### Admin Features
- **Dashboard**: View statistics, recent products/categories, quick actions
- **Categories**: Create, edit, delete product categories
- **Products**: Create, edit, delete products with image uploads
- **User Management**: View user statistics

## Security Features

### Middleware
- `AdminMiddleware`: Checks if user is authenticated and has admin privileges
- Applied to all admin routes automatically

### Policies
- `ProductPolicy`: Controls access to product operations
- `CategoryPolicy`: Controls access to category operations
- Only admins can create, edit, or delete

### Blade Directives
- `@admin`: Content only visible to admin users
- `@notadmin`: Content only visible to non-admin users

## User Roles

### Admin Users (`is_admin = true`)
- Access to admin dashboard
- Full CRUD operations on products and categories
- View all application statistics

### Regular Users (`is_admin = false`)
- Access to public catalog
- User dashboard (Jetstream default)
- No access to admin features

## Testing

### Login as Admin
```
Email: admin@manhitha.com
Password: password
```

### Login as Regular User
```
Email: user@manhitha.com
Password: password
```

## Troubleshooting

### Access Denied Errors
If you get a 403 "Access Denied" error:
1. Ensure you're logged in
2. Check if your user has `is_admin = true` in the database
3. Verify the admin middleware is properly registered

### Admin Routes Not Working
1. Check if the `AdminMiddleware` is registered in `bootstrap/app.php`
2. Ensure the middleware alias is set to `'admin'`
3. Verify the routes are using the `admin` middleware

### Policies Not Working
1. Check if policies are registered in `JetstreamServiceProvider`
2. Ensure the `registerPolicies()` method is called
3. Verify the policy classes exist and are properly namespaced

## Customization

### Adding New Admin Features
1. Create new admin routes in the admin group
2. Apply the `admin` middleware
3. Use the `@admin` blade directive in views
4. Create policies if needed

### Modifying Admin Permissions
1. Edit the respective policy files
2. Update the `AdminMiddleware` if needed
3. Modify the `User::isAdmin()` method if custom logic is required

## File Structure
```
app/
├── Http/
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Controllers/
│       └── Admin/
│           ├── DashboardController.php
│           ├── CategoryController.php
│           └── ProductController.php
├── Models/
│   ├── User.php (with isAdmin() method)
│   ├── Product.php
│   └── Category.php
├── Policies/
│   ├── ProductPolicy.php
│   └── CategoryPolicy.php
└── Providers/
    ├── AppServiceProvider.php (with blade directives)
    └── JetstreamServiceProvider.php (with policies)
```

## Support
For issues or questions about the admin system, check:
1. Laravel logs in `storage/logs/`
2. Database migrations and seeders
3. Middleware registration
4. Policy registration 