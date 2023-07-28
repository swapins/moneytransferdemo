<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Carbon\Factory;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function saveRate(Request $request){
    //     "sendingcountry" => "2"
    //   "recevingcountry" => "21"
    //   "staticrate" => "188"
    //   "customrate" => "10"
    //   "factor" => "Factor"

    $validatedData = $request->validate([
        'sendingcountry' => 'required|integer',
        'recevingcountry' => 'required|integer',
        'staticrate' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'customrate' => 'required|string',
        'factor' => 'required|string',
    ]);
    
        if ($request->input('sendingcountry') === $request->input('recevingcountry')){
            return redirect()->back()->with('error', 'Exchange between same countries is not permitted');
        }

        $existingRecord = Exchange::where('sendCountry_id', $request->input('sendingcountry'))
                            ->where('receiveCountry_id', $request->input('recevingcountry'))
                            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Exchange Pair alardy exists');
        } 


        //covert custom rate  to float 

        $coustomrate = floatval($request->input('customrate'));


        //find if factor is percentage or correction factor
        if ($request->input('factor') == "1"){
            $finalrate = $request->input('staticrate') + $coustomrate;
        }else{
            $finalrate = $request->input('staticrate') + ($request->input('staticrate') / 100) * $coustomrate;
        }

        Exchange::create([
            'sendCountry_id' => $request->input('sendingcountry'),
            'sendCountryCurrancy' => 'INR' ,
            'receiveCountry_id' => $request->input('recevingcountry'),
            'receiveCountryCurrancy' => 'USD',
            'staticrate' => $request->input('staticrate'),
            'customrate' => $coustomrate,
            'factor' => $request->input('factor'),
            'finalrate' => $finalrate
        ]);

        
        
        return redirect()->back()->with('success', 'Record created successfully');
    }

    public function updateRate(Request $request, $id){
        try {
            $exchange = Exchange::findOrFail($id);
            $exchange->update($request->all());
            return back()->with('success', 'Exchange record updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating Exchange record');
        }
    }

    public function deleteRate($id){ 
        Exchange::find($id)->delete();

        // Redirect to a specific page after successful deletion
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}
