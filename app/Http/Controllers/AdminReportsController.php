<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\Component;

class AdminReportsController extends Controller
{

    public function Piechart()
    {
        $time = time();
        $data['cur_month'] = date("m",$time);
        $sql = "SELECT * FROM [dbo].[orders] LEFT JOIN [dbo].[order_items] ON [dbo].[order_items].[order_id]=[dbo].[orders].[id] LEFT JOIN [dbo].[products] ON [dbo].[products].[id]=[dbo].[order_items].[product_id]
        LEFT JOIN [dbo].[categories] ON [dbo].[categories].[id]=[dbo].[products].[category_id] LEFT JOIN [dbo].[transactions] ON [dbo].[transactions].[order_id]=[dbo].[orders].[id]
        WHERE YEAR([dbo].[orders].[created_at]) = YEAR(getdate()) AND [dbo].[transactions].[status]='approved' AND [dbo].[orders].[status]='delivered'";
        $chartresult = DB::select($sql);
        $category = Category::all();
        $category_name = [];
        $setyor = [];
        $category_name[0] = "Category";
        $category_name[1] = "Total";
        $setyor[0] = $category_name;

        foreach ($category as $Mainkey => $value) {
        $total = 0.00;
        $result = [];
        foreach ($chartresult as $Secondkey => $value1) {
            if ($value->id == $value1->category_id) {
                $total += (float)$value1->price * (float)$value1->qty;
            }
        }
        $result[0] = $value->name;
        $result[1] = $total;
        $setyor[$Mainkey+1] = $result;
        $Default_piechart = $setyor;
        $data['chart_title'] = 'Report Current Year';
        $data['pie_check'] = count($chartresult);

        $year_groubby = "SELECT FORMAT([dbo].[orders].[created_at], 'yyyy') as yearlist
        FROM [dbo].[orders] LEFT JOIN [dbo].[transactions]
		ON [dbo].[transactions].[order_id]=[dbo].[orders].[id]
        WHERE [dbo].[transactions].[status]='pending'
        GROUP BY  FORMAT([dbo].[orders].[created_at], 'yyyy')
        ORDER BY FORMAT([dbo].[orders].[created_at], 'yyyy') DESC;";
        $year = DB::select($year_groubby);
        $yearlist = [];
        foreach($year as $index=>$item){
            $yearlist[$index]=$item->yearlist;
        }
        $data['yearlist'] = $yearlist;
        }

        $time = time();
        $data['cur_month'] = date("m",$time);
        $barsql = "SELECT * FROM [dbo].[orders] LEFT JOIN [dbo].[order_items] ON [dbo].[order_items].[order_id]=[dbo].[orders].[id] LEFT JOIN [dbo].[products] ON [dbo].[products].[id]=[dbo].[order_items].[product_id]
        LEFT JOIN [dbo].[categories] ON [dbo].[categories].[id]=[dbo].[products].[category_id] LEFT JOIN [dbo].[transactions] ON [dbo].[transactions].[order_id]=[dbo].[orders].[id]
        WHERE YEAR([dbo].[orders].[created_at]) = YEAR(getdate()) AND [dbo].[transactions].[status]='approved' AND [dbo].[orders].[status]='delivered';";
        $barresult = DB::select($barsql);
        $product = Product::all();
        $product_name = [];
        $warp = [];
        $product_name[0] = "Product";
        $product_name[1] = "Total";
        $warp[0] = $product_name;

        foreach ($product as $Mainkey => $value) {
        $total = 0.00;
        $result = [];
        foreach ($barresult as $Secondkey => $value1) {
            if ($value->id == $value1->product_id) {
                $total += (float)$value1->price * (float)$value1->qty;
            }
        }
        $result[0] = $value->name;
        $result[1] = $total;
        $warp[$Mainkey+1] = $result;
        $Default_barchart = $warp;
        $data['bar_title'] = 'Report Current Year';
        $data['bar_check'] = count($barresult);

        $year_groubby = "SELECT FORMAT([dbo].[orders].[created_at], 'yyyy') as yearlist
        FROM [dbo].[orders] LEFT JOIN [dbo].[transactions]
		ON [dbo].[transactions].[order_id]=[dbo].[orders].[id]
        WHERE [dbo].[transactions].[status]='pending'
        GROUP BY  FORMAT([dbo].[orders].[created_at], 'yyyy')
        ORDER BY FORMAT([dbo].[orders].[created_at], 'yyyy') DESC;";
        $year = DB::select($year_groubby);
        $yearlist = [];
        foreach($year as $index=>$item){
            $yearlist[$index]=$item->yearlist;
        }
        $data['yearlist'] = $yearlist;
        }

        return view('livewire.admin.admin-reports-component', compact('Default_piechart', 'Default_barchart'), $data)->layout('layouts.admin-dash');
    }

    public function PieChange(Request $request)
    {
        if ($request->spie == '0')
        {
            $time = time();
            $data['cur_month'] = date("m",$time);
            $sql = "SELECT * FROM [dbo].[orders] LEFT JOIN [dbo].[order_items]
            ON [dbo].[order_items].[order_id]=[dbo].[orders].[id]
            LEFT JOIN [dbo].[products] ON [dbo].[products].[id]=[dbo].[order_items].[product_id]
            LEFT JOIN [dbo].[categories] ON [dbo].[categories].[id]=[dbo].[products].[category_id]
            LEFT JOIN [dbo].[transactions] ON [dbo].[transactions].[order_id]=[dbo].[orders].[id]
            WHERE FORMAT([dbo].[orders].[created_at], 'yyyy-MM-dd') = '$request->Sdate1'
            AND [dbo].[transactions].[status]='approved' AND [dbo].[orders].[status]='delivered';";
            $chartresult = DB::select($sql);
            $category = Category::all();
            $category_name = [];
            $setyor = [];
            $category_name[0] = "Category";
            $category_name[1] = "Total";
            $setyor[0] = $category_name;
            $data['chart_title'] = 'Report Date : '.$request->Sdate1;
        }
        else if($request->spie == '1')
        {
            $time = time();
            $data['cur_month'] = date("m",$time);
            $month = $data['cur_month'] - $request->Mdate1;
            $sql = "SELECT *
            FROM dbo.orders
            LEFT JOIN dbo.order_items ON dbo.order_items.order_id = dbo.orders.id
            LEFT JOIN dbo.products ON dbo.products.id = dbo.order_items.product_id
            LEFT JOIN dbo.categories ON dbo.categories.id = dbo.products.category_id
            LEFT JOIN dbo.transactions ON dbo.transactions.order_id = dbo.orders.id
            WHERE DATEPART(year, dbo.orders.created_at) = DATEPART(year, GETDATE())
            AND DATEPART(month, dbo.orders.created_at) = DATEPART(month, DATEADD(month, -$month, GETDATE()))
            AND dbo.transactions.status = 'approved'
            AND dbo.orders.status = 'delivered';";
            $chartresult = DB::select($sql);
            $category = Category::all();
            $category_name = [];
            $setyor = [];
            $category_name[0] = "Category";
            $category_name[1] = "Total";
            $setyor[0] = $category_name;
            $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            $data['chart_title'] = 'Report Month : '.$month[$request->Mdate1-1];
        }
        else if($request->spie == '2')
        {
            $time = time();
            $data['cur_month'] = date("m",$time);
            $sql = "SELECT *
            FROM dbo.orders
            LEFT JOIN dbo.order_items ON order_items.order_id = orders.id
            LEFT JOIN dbo.products ON products.id = order_items.product_id
            LEFT JOIN dbo.categories ON categories.id = products.category_id
            LEFT JOIN dbo.transactions ON transactions.order_id = orders.id
            WHERE DATEPART(year, orders.created_at) = '$request->Ydate1'
            AND transactions.status = 'approved'
            AND orders.status = 'delivered';";
            $chartresult = DB::select($sql);
            $category = Category::all();
            $category_name = [];
            $setyor = [];
            $category_name[0] = "Category";
            $category_name[1] = "Total";
            $setyor[0] = $category_name;
            $data['chart_title'] = 'Report Year : '.$request->Ydate1;
        }

        foreach ($category as $Mainkey => $value) {
            $total = 0.00;
            $result = [];
            foreach ($chartresult as $Secondkey => $value1) {
                if ($value->id == $value1->category_id) {
                    $total += (float)$value1->price * (float)$value1->qty;
                }
            }
            $result[0] = $value->name;
            $result[1] = $total;
            $setyor[$Mainkey+1] = $result;
            $Default_piechart = $setyor;
            $data['pie_check'] = count($chartresult);
        }
            $year_groubby = "SELECT FORMAT(orders.created_at, 'yyyy') as yearlist
            FROM dbo.orders
            LEFT JOIN dbo.transactions ON transactions.order_id = orders.id
            WHERE transactions.status = 'approved' AND orders.status = 'delivered'
            GROUP BY FORMAT(orders.created_at, 'yyyy')
            ORDER BY FORMAT(orders.created_at, 'yyyy') DESC;";
            $year = DB::select($year_groubby);
            $yearlist = [];
            foreach($year as $index=>$item){
                $yearlist[$index]=$item->yearlist;
            }
            $data['yearlist'] = $yearlist;

            $time = time();
            $data['cur_month'] = date("m",$time);
            $barsql = "SELECT *
            FROM dbo.orders
            LEFT JOIN dbo.order_items ON dbo.order_items.order_id = dbo.orders.id
            LEFT JOIN dbo.products ON dbo.products.id = dbo.order_items.product_id
            LEFT JOIN dbo.categories ON dbo.categories.id = dbo.products.category_id
            LEFT JOIN dbo.transactions ON dbo.transactions.order_id = dbo.orders.id
            WHERE YEAR(dbo.orders.created_at) = YEAR(getdate())
            AND dbo.transactions.status = 'approved'
            AND dbo.orders.status = 'delivered';
            ";
            $barresult = DB::select($barsql);
            $product = Product::all();
            $product_name = [];
            $warp = [];
            $product_name[0] = "Product";
            $product_name[1] = "Total";
            $warp[0] = $product_name;

            foreach ($product as $Mainkey => $value) {
            $total = 0.00;
            $result = [];
            foreach ($barresult as $Secondkey => $value1) {
                if ($value->id == $value1->product_id) {
                    $total += (float)$value1->price * (float)$value1->qty;
                }
            }
            $result[0] = $value->name;
            $result[1] = $total;
            $warp[$Mainkey+1] = $result;
            $Default_barchart = $warp;
            $data['bar_title'] = 'Report Current Year';
            $data['bar_check'] = count($barresult);
            }

        return view('livewire.admin.admin-reports-component', compact('Default_piechart', 'Default_barchart'), $data)->layout('layouts.admin-dash');
    }

    public function BarChange(Request $request)
    {
        if ($request->sbar == '0')
        {
            $time = time();
            $data['cur_month'] = date("m",$time);
            $barsql = "SELECT * FROM dbo.orders
            LEFT JOIN dbo.order_items ON dbo.order_items.order_id = dbo.orders.id
            LEFT JOIN dbo.products ON dbo.products.id = dbo.order_items.product_id
            LEFT JOIN dbo.categories ON dbo.categories.id = dbo.products.category_id
            LEFT JOIN dbo.transactions ON dbo.transactions.order_id = dbo.orders.id
            WHERE FORMAT(dbo.orders.created_at, 'yyyy-MM-dd') = '$request->sdate2'
            AND dbo.transactions.status='approved'
            AND dbo.orders.status='delivered';";
            $barresult = DB::select($barsql);
            $product = Product::all();
            $product_name = [];
            $warp = [];
            $product_name[0] = "Product";
            $product_name[1] = "Total";
            $warp[0] = $product_name;
            $data['bar_title'] = 'Report Date : '.$request->sdate2;
        }
        else if($request->sbar == '1')
        {
            $time = time();
            $data['cur_month'] = date("m",$time);
            $month = $data['cur_month'] - $request->Mdate2;
            $barsql = "SELECT * FROM dbo.orders
            LEFT JOIN dbo.order_items ON dbo.order_items.order_id = dbo.orders.id
            LEFT JOIN dbo.products ON dbo.products.id = dbo.order_items.product_id
            LEFT JOIN dbo.categories ON dbo.categories.id = dbo.products.category_id
            LEFT JOIN dbo.transactions ON dbo.transactions.order_id = dbo.orders.id
            WHERE YEAR(dbo.orders.created_at) = YEAR(CURRENT_DATE)
            AND MONTH(dbo.orders.created_at) = MONTH(CURRENT_DATE - INTERVAL $month MONTH)
            AND dbo.transactions.status='approved'
            AND dbo.orders.status='delivered';";
            $barresult = DB::select($barsql);
            $product = Product::all();
            $product_name = [];
            $warp = [];
            $product_name[0] = "Product";
            $product_name[1] = "Total";
            $warp[0] = $product_name;
            $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            $data['bar_title'] = 'Report Month : '.$month[$request->Mdate2-1];
        }
        else if($request->sbar == '2')
        {
            $time = time();
            $data['cur_month'] = date("m",$time);
            $barsql = "SELECT *
            FROM dbo.orders
            LEFT JOIN dbo.order_items
            ON dbo.order_items.order_id = dbo.orders.id
            LEFT JOIN dbo.products
            ON dbo.products.id = dbo.order_items.product_id
            LEFT JOIN dbo.categories
            ON dbo.categories.id = dbo.products.category_id
            LEFT JOIN dbo.transactions
            ON dbo.transactions.order_id = dbo.orders.id
            WHERE DATEPART(year, dbo.orders.created_at) = $request->syear2
            AND dbo.transactions.status = 'approved'
            AND dbo.orders.status = 'delivered';";
            $barresult = DB::select($barsql);
            $product = Product::all();
            $product_name = [];
            $warp = [];
            $product_name[0] = "Product";
            $product_name[1] = "Total";
            $warp[0] = $product_name;
            $data['bar_title'] = 'Report Year : '.$request->syear2;
        }

        foreach ($product as $Mainkey => $value) {
            $total = 0.00;
            $result = [];
            foreach ($barresult as $Secondkey => $value1) {
                if ($value->id == $value1->product_id) {
                    $total += (float)$value1->price * (float)$value1->qty;
                }
            }
            $result[0] = $value->name;
            $result[1] = $total;
            $warp[$Mainkey+1] = $result;
            $Default_barchart = $warp;
            $data['bar_check'] = count($barresult);
        }

        $year_groubby = "SELECT
        FORMAT(orders.created_at, 'yyyy') as yearlist
        FROM dbo.orders
        LEFT JOIN dbo.transactions ON transactions.order_id = orders.id
        WHERE transactions.status = 'approved'
        GROUP BY FORMAT(orders.created_at, 'yyyy')
        ORDER BY FORMAT(orders.created_at, 'yyyy') DESC;";
        $year = DB::select($year_groubby);
        $yearlist = [];
        foreach($year as $index=>$item){
            $yearlist[$index]=$item->yearlist;
        }
        $data['yearlist'] = $yearlist;

        $time = time();
        $data['cur_month'] = date("m",$time);
        $sql = "SELECT *
        FROM dbo.orders
        LEFT JOIN dbo.order_items
        ON dbo.order_items.order_id = dbo.orders.id
        LEFT JOIN dbo.products
        ON dbo.products.id = dbo.order_items.product_id
        LEFT JOIN dbo.categories
        ON dbo.categories.id = dbo.products.category_id
        LEFT JOIN dbo.transactions
        ON dbo.transactions.order_id = dbo.orders.id
        WHERE DATEPART(year, dbo.orders.created_at) = DATEPART(year, CURRENT_TIMESTAMP)
        AND dbo.transactions.status = 'approved'
        AND dbo.orders.status = 'delivered';";
        $chartresult = DB::select($sql);
        $category = Category::all();
        $category_name = [];
        $setyor = [];
        $category_name[0] = "Category";
        $category_name[1] = "Total";
        $setyor[0] = $category_name;

        foreach ($category as $Mainkey => $value) {
        $total = 0.00;
        $result = [];
        foreach ($chartresult as $Secondkey => $value1) {
            if ($value->id == $value1->category_id) {
                $total += (float)$value1->price * (float)$value1->qty;
            }
        }
        $result[0] = $value->name;
        $result[1] = $total;
        $setyor[$Mainkey+1] = $result;
        $Default_piechart = $setyor;
        $data['chart_title'] = 'Report Current Year';
        $data['pie_check'] = count($chartresult);
        }

        return view('livewire.admin.admin-reports-component', compact('Default_barchart', 'Default_piechart'), $data)->layout('layouts.admin-dash');
    }
}
