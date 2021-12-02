<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Country;

class MainController extends Controller
{
    public function import(){
        Excel::import(new ExcelImport, '../Alon_price.xlsx');
    }
}
