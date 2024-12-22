<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/Order.php
class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'total_amount', 'discount', 'coupon_id', 'status'];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Coupon
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    // Quan hệ với OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Quan hệ với Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public static function getTopCustomers()
    {
        // Lấy top 5 khách hàng có tổng số lượng sản phẩm và giá trị đơn hàng lớn nhất
        $topCustomers = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.user_id', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.quantity * order_items.price) as total_value'))
            ->groupBy('orders.user_id')
            ->orderByDesc(DB::raw('SUM(order_items.quantity * order_items.price)'))  // Sắp xếp theo tổng giá trị giảm dần
            ->orderByDesc(DB::raw('SUM(order_items.quantity)')) // Nếu tổng giá trị bằng nhau, sắp xếp theo tổng số lượng giảm dần
            ->limit(5) // Giới hạn kết quả lấy 5 khách hàng
            ->get(); // Lấy tất cả các khách hàng

        // Lấy thông tin chi tiết của từng khách hàng
        foreach ($topCustomers as $customer) {
            $user = User::find($customer->user_id); // Tìm thông tin khách hàng
            $customer->name = $user->name; // Lấy tên khách hàng từ bảng User
            $customer->email = $user->email; // Lấy email khách hàng từ bảng User
        }
        return $topCustomers;
    }

    public static function getWeeklyRevenueData()
    {
        // Lấy ngày hiện tại và ngày cách đây 6 ngày, định dạng chính xác
        $today = Carbon::now()->startOfDay()->format('Y-m-d');
        $weekAgo = Carbon::now()->subDays(6)->startOfDay()->format('Y-m-d');
        // Truy vấn tổng doanh thu theo ngày từ database
        $rawData = DB::table('orders')
            ->selectRaw('DAYNAME(created_at) as day_of_week, SUM(total_amount) as total_revenue')
            ->whereBetween(DB::raw('DATE(created_at)'), [$weekAgo, $today])
            ->groupByRaw('DAYNAME(created_at), DAYOFWEEK(created_at)')
            ->orderByRaw('DAYOFWEEK(created_at)')
            ->get();

        // Tạo kết quả trả về với labels và data
        return [
            'labels' => $rawData->pluck('day_of_week')->values(),
            'data' => $rawData->pluck('total_revenue')->values(),
        ];
    }

    public static function getMonthlyRevenueData()
    {
        // Các tháng trong năm
        $monthsOfYear = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Lấy năm hiện tại
        $currentYear = Carbon::now()->year;

        // Truy vấn tổng doanh thu theo tháng
        $rawData = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('month')
            ->get();

        // Khởi tạo mảng mặc định với giá trị doanh thu là 0 cho các tháng
        $monthlyRevenue = array_fill(1, 12, 0);

        // Map dữ liệu từ database vào mảng
        foreach ($rawData as $record) {
            $monthlyRevenue[(int)$record->month] = (float)$record->total_revenue;
        }

        // Tạo kết quả trả về với labels và data
        return [
            'labels' => $monthsOfYear,
            'data' => array_values($monthlyRevenue),
        ];
    }
    public static function getAnnualRevenueData()
    {
        // Truy vấn tổng doanh thu theo năm
        $rawData = DB::table('orders')
            ->selectRaw('YEAR(created_at) as year, SUM(total_amount) as total_revenue')
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year')
            ->get();

        // Tạo labels và data từ dữ liệu truy vấn
        $labels = [];
        $data = [];
        foreach ($rawData as $record) {
            $labels[] = (string)$record->year; // Năm
            $data[] = (float)$record->total_revenue; // Doanh thu
        }

        // Tạo kết quả trả về
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
    public static function getTotalOrderCountData()
    {
        // Tổng số lượng hóa đơn theo ngày
        $orderCountByDay = DB::table('orders')
            ->selectRaw('COUNT(*) as total_orders')  // Chỉ đếm số lượng đơn hàng
            ->whereDate('created_at', Carbon::today())  // Lọc các đơn hàng có ngày tạo là hôm nay
            ->first();  // Lấy một kết quả duy nhất (vì chỉ có một ngày)
        $orderCountYesterday = DB::table('orders')
            ->selectRaw('COUNT(*) as total_orders')  // Chỉ đếm số lượng đơn hàng
            ->whereDate('created_at', Carbon::yesterday())  // Lọc các đơn hàng có ngày tạo là hôm qua
            ->first();  // Lấy một kết quả duy nhất (vì chỉ có một ngày)

        // Tổng số lượng hóa đơn theo tháng
        $orderCountByMonth = DB::table('orders')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total_orders")
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(created_at, '%Y-%m')")
            ->get();
        $orderCountLastMonth = DB::table('orders')
            ->selectRaw("COUNT(*) as total_orders")  // Chỉ đếm số lượng đơn hàng
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)  // Lọc các đơn hàng có tháng tạo là tháng trước
            ->whereYear('created_at', Carbon::now()->subMonth()->year)  // Lọc các đơn hàng có năm tạo là năm trước
            ->first();  // Lấy một kết quả duy nhất (vì chỉ có một tháng)
        // Tổng số lượng hóa đơn theo năm
        $orderCountByYear = DB::table('orders')
            ->selectRaw('YEAR(created_at) as year, COUNT(*) as total_orders')
            ->groupByRaw('YEAR(created_at)')
            ->orderByRaw('YEAR(created_at)')
            ->get();
        $orderCountLastYear = DB::table('orders')
            ->selectRaw('COUNT(*) as total_orders')  // Chỉ đếm số lượng đơn hàng
            ->whereYear('created_at', Carbon::now()->subYear()->year)  // Lọc các đơn hàng có năm tạo là năm trước
            ->first();  // Lấy một kết quả duy nhất (vì chỉ có một năm)

        // Trả về mảng chứa kết quả theo ngày, tháng, năm
        return [
            'daily' => $orderCountByDay,
            'yesterday' => $orderCountYesterday,
            'monthly' => $orderCountByMonth,
            'lastmonth' => $orderCountLastMonth,
            'yearly' => $orderCountByYear,
            'lastyear' => $orderCountLastYear,
        ];
    }
}
