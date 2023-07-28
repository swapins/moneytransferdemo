<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Illuminate\Http\Request;
use App\Models\Nation;

class dashboardController extends Controller
{
    public function index($region = null){

       
        $count = Nation::count();

        
        $regions = Nation::pluck('region')->unique();

        if ($region === null) {

            $nations = Nation::paginate(10);

        }else{
            $nations = Nation::where('region',$region)->paginate(10);
        }

        return view('dashboard',compact('nations','regions','count'));
    }

    public function rates(){

       
        $count = Exchange::count();

        
        $regions = Nation::pluck('region')->unique();

        $nations = Nation::all();

        $sendNations = Nation::where('enable_send',true)->get();
        $receiveNations = Nation::where('enable_receive',true)->get();

        $exchange = Exchange::all();

        return view('rates',compact('nations','regions','count','sendNations','receiveNations','exchange'));
    }
}
