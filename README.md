# Manhitha Gift Shop - Laravel Application

A complete, feature-rich gift shop web application built with Laravel, featuring product management, categories, admin dashboard, and beautiful responsive design.

## 🎁 Features

### Customer-Facing Features
- **Product Catalog**: Browse all products with search and filtering
- **Category Navigation**: Organized product categories (Glass Frames, Wall Clocks, Fridge Magnets, LED Frames, etc.)
- **Product Details**: Comprehensive product information with images, pricing, and specifications
- **Responsive Design**: Mobile-friendly interface built with Tailwind CSS
- **WhatsApp Integration**: Direct ordering via WhatsApp
- **Search & Filter**: Find products by name, description, or category

### Admin Features
- **Dashboard**: Overview statistics and quick actions
- **Product Management**: Full CRUD operations for products
- **Category Management**: Organize products into categories
- **Image Upload**: Support for multiple product images
- **Inventory Tracking**: Stock management and low stock alerts
- **Featured Products**: Highlight special items

### Technical Features
- **Laravel 10**: Modern PHP framework
- **Jetstream**: Authentication and user management
- **Tailwind CSS**: Utility-first CSS framework
- **Responsive Design**: Mobile-first approach
- **Database Seeding**: Sample data included
- **Image Storage**: File upload and management

## 🚀 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd manhitha
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database in .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=manhitha_gifts
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 📊 Database Structure

### Categories Table
- `id` - Primary key
- `name` - Category name
- `slug` - URL-friendly identifier
- `description` - Category description
- `image` - Category image
- `is_active` - Active status
- `sort_order` - Display order

### Products Table
- `id` - Primary key
- `category_id` - Foreign key to categories
- `name` - Product name
- `slug` - URL-friendly identifier
- `description` - Product description
- `price` - Regular price
- `sale_price` - Sale price (optional)
- `sku` - Stock keeping unit
- `stock` - Available quantity
- `dimensions` - Product dimensions
- `weight` - Product weight
- `material` - Product material
- `images` - JSON array of image paths
- `is_featured` - Featured product flag
- `is_active` - Active status
- `sort_order` - Display order

## 🎯 Usage

### For Customers
1. **Browse Products**: Visit the homepage to see featured products and categories
2. **Search & Filter**: Use the search bar and category filters to find specific items
3. **View Details**: Click on any product to see full information
4. **Order**: Use the WhatsApp button to place orders directly

### For Administrators
1. **Access Admin Panel**: Login and navigate to `/admin/dashboard`
2. **Manage Categories**: Add, edit, or remove product categories
3. **Manage Products**: Create, update, or delete products with images
4. **Monitor Inventory**: Track stock levels and featured products

## 🔧 Customization

### Adding New Categories
1. Go to Admin → Categories → Add New Category
2. Fill in name, description, and upload image
3. Set sort order and active status

### Adding New Products
1. Go to Admin → Products → Add New Product
2. Select category and fill in product details
3. Upload product images
4. Set pricing, stock, and other attributes

### Modifying Design
- Edit Tailwind classes in Blade templates
- Modify CSS in `resources/css/app.css`
- Update JavaScript in `resources/js/app.js`

## 📱 Responsive Design

The application is built with a mobile-first approach using Tailwind CSS:
- **Mobile**: Single column layout with touch-friendly buttons
- **Tablet**: Two-column grid layout
- **Desktop**: Multi-column grid with hover effects

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure production database
3. Set up file storage (consider using S3 or similar)
4. Configure caching and optimization
5. Set up SSL certificate
6. Configure web server (Apache/Nginx)

### Performance Optimization
- Enable Laravel caching
- Use Redis for sessions
- Optimize images
- Enable compression
- Use CDN for static assets

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Email: info@manhitha.com
- WhatsApp: +91 98765 43210

## 🔮 Future Enhancements

- Shopping cart functionality
- User reviews and ratings
- Advanced search filters
- Email notifications
- Payment gateway integration
- Multi-language support
- Mobile app development

---

**Built with ❤️ using Laravel and Tailwind CSS**
