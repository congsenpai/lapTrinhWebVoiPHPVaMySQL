<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $weeklyRevenueData = Order::getWeeklyRevenueData();
        $monthlyRevenueData = Order::getMonthlyRevenueData();
        $annualRevenueData = Order::getAnnualRevenueData();
        $totalOrderDataByPeriod = Order::getTotalOrderCountData();
        $topProducts = $this->getTopProducts();
        $topCustomers = $this->getTopCustomers();
        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'weeklyRevenueData' => $weeklyRevenueData,
            'monthlyRevenueData' => $monthlyRevenueData,
            'annualRevenueData' => $annualRevenueData,
            'totalOrderDataByPeriod' => $totalOrderDataByPeriod,
            'topProducts' => $topProducts,
            'topCustomers' => $topCustomers,
        ]);
    }
    public function getTopCustomers()
    {
        return Order::getTopCustomers();
    }
    public function getTopProducts()
    {
        return Product::getTopProducts();
    }

}
