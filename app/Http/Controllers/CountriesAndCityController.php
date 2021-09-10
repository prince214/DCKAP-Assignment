<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CountriesAndCityController extends Controller
{
    public function getCities($cid){
        $cities = Cities::where('country_id',$cid)->get();
        if($cities->count()){
            $view['cities'] = $cities;
            $cities = view('users.partial.city-list',$view)->render();
            return response()->json(['status' => true,'data' => $cities]);
        }else{
            return response()->json(['status' => false,'data' => 'No Cities Found !']);
        }

    }
}
