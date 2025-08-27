<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $totalSales = Order::get()->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
        $todaySales = Order::where('status', 'delivered')->whereDate('delivered_date',Carbon::today())->count();
        $todayRevenue = Order::where('status', 'delivered')->whereDate('delivered_date',Carbon::today())->sum('total');
        return view('livewire.admin.admin-dashboard-component',[
            'orders'=>$orders,
            'totalSales'=>$totalSales,
            'totalRevenue'=>$totalRevenue,
            'todaySales'=>$todaySales,
            'todayRevenue'=>$todayRevenue
        ])->layout('layouts.admin-dash');
    }
}
