<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use App\Imports\PricesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Country;
use App\Models\ServiceType;
use App\Models\Weight;
use App\Models\Price;
use App\Models\Area;

class MainController extends Controller
{
    public function import()
    {
        Excel::import(new ExcelImport, request()->file('excel-1'));
        Excel::import(new PricesImport, request()->file('excel-1'));
        return back();
    }

    public function main()
    {
        $countries = Country::all()->sortBy('name');
        $service_types = ServiceType::all()->sortByDesc('name');
        return view('main', [
            'countries'     => $countries,
            'service_types' => $service_types
        ]);
    }

    public function calc(Request $request)
    {
        $max_weight = Weight::max('weight');
        $validated = $request->validate([
            'weight' => "required|numeric|min:0.5|max:$max_weight",
            'length' => "required|numeric|min:1|max:120",
            'width' => "required|numeric|min:1|max:80",
            'height' => "required|numeric|min:1|max:69",
        ]);

        $countries = Country::all()->sortBy('name');
        $service_types = ServiceType::all()->sortByDesc('name');
        $cur_country = Country::find($request->country);
        $cur_service_type = ServiceType::find($request->service_type);
        $cur_weight = $request->weight;
        $cur_length = $request->length;
        $cur_width  = $request->width;
        $cur_height = $request->height;

        $area_id = $cur_country->area_id;
        $area = Area::find($area_id);
        $weight = $cur_weight;

        $calc_weight = $cur_length * $cur_width * $cur_height / 5000;
        $calc_weight = round($calc_weight, 2, PHP_ROUND_HALF_DOWN);

        if ($calc_weight > $weight) {
            $weight = $calc_weight;
        }

        $whole = floor($weight);
        $dec = $weight - $whole;
        if (($dec >= 0.1) && ($dec <= 0.5)) {
            $weight = $whole + 0.5;
        } elseif (($dec > 0.5) && ($dec <= 0.9)) {
            $weight = $whole + 1;
        }

        $weight_result = null;
        while ($weight_result === null && $weight <= $max_weight) {
            $weight_result = Weight::where('weight', $weight)->first();
            if ($weight_result === null) {
                $weight = $weight + 0.5;
            }
        }

        $price = null;
        if (isset($weight_result->id)) {
            $price = Price::where([
                'area_id'         => $area_id,
                'service_type_id' => $cur_service_type->id,
                'weight_id'       => $weight_result->id
            ])->first();
        }

        $start_price = $price->price;
        $debug = null;
        if(isset($price)) {
            $price = $price->price;
            if ($weight >=32 && $weight < 40) {
                $price = $price + 180;
                $debug = 1;
            }

            elseif (($cur_length > 100 || $cur_width > 76 ) && $weight < 40) {
                $price = $price + 180;
                $debug = 2;
            }

            if ($weight >= 40 && $weight <= 70) {
                $price = $price + 1560;
                $debug = 3;
            }
        }

        return view('main', [
            'countries'        => $countries,
            'service_types'    => $service_types,
            'cur_country'      => $cur_country,
            'cur_service_type' => $cur_service_type,
            'cur_weight' => $cur_weight,
            'cur_length' => $cur_length,
            'cur_width' => $cur_width,
            'cur_height' => $cur_height,
            'cur_lwh' => $cur_length * $cur_width * $cur_height,
            'weight' => $weight,
            'area'  => $area,
            'start_price' => $start_price,
            'debug' => $debug,
            'price' => $price,
        ]);
    }
}
