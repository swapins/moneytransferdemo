<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchange;
use App\Models\Nation;

class welcomeController extends Controller
{
    public function index(){
        $exchange = Exchange::where('flag',false)->get();
        $sendid = Exchange::where('flag',false)->pluck('sendCountry_id')->toArray();
        $sendList = Nation::whereIn('id',$sendid)->get();

        return view('welcome',compact('exchange','sendList'));
    }

    public function getOptions($selectedValue)
    {
        // Query the database or any other data source to fetch options based on the selected value
        
        $ids = Exchange::where('sendCountry_id', $selectedValue)->pluck('receiveCountry_id')->toArray();
        $options = Nation::whereIn('id',$ids)->get();
        // Return the options as JSON response
        return response()->json($options);
    }

    public function getResults($selectedValue , $selectedValue2)
    {
        // Query the database or any other data source to fetch options based on the selected value
        
        $result = Exchange::where('receiveCountry_id', $selectedValue)
            ->where('sendCountry_id',$selectedValue2)->first();
        // Return the options as JSON response
        return response()->json($result);
    }
}
