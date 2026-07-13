<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AnalyticsDashboard extends Component
{
    public function render()
    {
        // 📊 Metrics Calculation
        $totalRevenue = Order::where('status', 'Paid')->sum('total');
        $totalOrders = Order::count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $totalProducts = Product::count();

        // 🛍️ Recent Orders
        $recentOrders = Order::latest()->take(5)->get();

        // 🔥 Top Products (if order_items relation exists or mock calculation)
        $topProducts = Product::latest()->take(4)->get();

        return view('livewire.admin.analytics-dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'averageOrderValue' => $averageOrderValue,
            'totalProducts' => $totalProducts,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
        ])->layout('layouts.app');
    }
}