<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_categories' => Category::count(),
            'active_categories' => Category::active()->count(),
            'total_users' => User::count(),
            'featured_products' => Product::featured()->count(),
            'low_stock_products' => Product::where('stock', '<', 10)->count(),
            'out_of_stock_products' => Product::where('stock', 0)->count(),
        ];

        $recent_products = Product::with('category')
            ->latest()
            ->limit(5)
            ->get();

        $recent_categories = Category::latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_products', 'recent_categories'));
    }
} 