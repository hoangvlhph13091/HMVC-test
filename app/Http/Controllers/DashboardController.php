<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
   public function index()
   {
    $chart_options = [
        'chart_title' => 'Số Lượng Bạn Đọc Mới Mỗi Tháng',
        'report_type' => 'group_by_date',
        'model' => 'Modules\Customer\Entities\Customer',
        'group_by_field' => 'created_at',
        'group_by_period' => 'month',
        'chart_type' => 'bar',
    ];

    $chart1 = new LaravelChart($chart_options);


    $chart_options = [
        'chart_title' => 'Số Lượng Sách Đang Được Mượn',
        'report_type' => 'group_by_relationship',
        'chart_type' => 'pie',
        'model' => 'Modules\BorrowHistory\Entities\HistoryDetail',

        'relationship_name' => 'Book',
        'group_by_field' => 'name',

        'aggregate_function' => 'sum',
        'aggregate_field' => 'amount',

        'where_raw' => 'status = 0',
    ];

    $chart2 = new LaravelChart($chart_options);


    return view('dashboard', compact('chart1', 'chart2'));
   }
}
