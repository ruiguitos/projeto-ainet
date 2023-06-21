<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{

    public function index(){

        return view ('dashboard.index');
    }

    public function indexCharts(){
        return view ('dashboard.charts');
    }

    public function indexTables(){
        return view ('dashboard.tables');
    }
}
