<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Nation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Foreach_;

class NationController extends Controller
{
    public function updateNationsDb(){
        $response = Http::get('https://restcountries.com/v3.1/all');
        $countries = json_decode($response, true);

        if($countries){
            Nation::truncate();
        }
        foreach ($countries as $country) {
           
            $commonName = $country['name']['common'];
            $flag = $country['flag'];
            $flagpng = $country['flags']['png'];
            $officalName = $country['name']['official'];
            $region = $country['region'];
            if (isset($country['subregion'])){
                $subregion = $country['subregion'];;
            }else{
                $subregion = "";
            }

            Nation::create([
                'name' => $commonName,
                'officalname' => $officalName,
                'region' => $region,
                'subregion' => $subregion,
                'flag' => $flag,
                'flagpng' => $flagpng

            ]);
        }
        return redirect()->back()->with('success', 'Database updated successfully');
    }

    public function toggleStatusSend($id)
    {
        
        
        // Find the record
        $record = Nation::find($id);

        if (!$record) {
            // Record not found
            return redirect()->back()->with('error', 'Record not found');
        }


        // Toggle the status
        $record->enable_send = !$record->enable_send;
        $record->save();

        //find in Exchange table and disable 

        $exchanges = Exchange::where('sendCountry_id',$id)->get();

        foreach($exchanges as $exchange){
            
            $exchange->flag = !$exchange->flag;
            $exchange->save();
            
        }

        return redirect()->back()->with('success', 'Record status updated successfully');
    }

    public function toggleStatusReceive($id)
    {
        
        
        // Find the record
        $record = Nation::find($id);

        if (!$record) {
            // Record not found
            return redirect()->back()->with('error', 'Record not found');
        }

        // Toggle the status
        $record->enable_receive= !$record->enable_receive;
        $record->save();

        return redirect()->back()->with('success', 'Record status updated successfully');
    }
}
