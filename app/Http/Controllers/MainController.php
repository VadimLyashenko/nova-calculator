<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use App\Imports\PricesImport;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function import(){
        Excel::import(new ExcelImport, '../Alon_price.xlsx');
        Excel::import(new PricesImport, '../Alon_price.xlsx');
    }
}
