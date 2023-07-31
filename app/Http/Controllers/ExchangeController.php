<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Carbon\Factory;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function saveRate(Request $request){

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
            $exchange->fill($request->all());
            if($exchange->isDirty()){

                //find if factor is percentage or correction factor
                    $static = $exchange->staticrate;
                    $factor = $exchange->factor;
                    $coustomrate = $exchange->customrate;

                    if ($factor == "1"){
                        $finalrate = $static + $coustomrate;
                    }else{
                        $finalrate = $static + ($static / 100) * $coustomrate;
                    }
                // price has changed
                $exchange->update([
                    'finalrate' => $finalrate,
                ]);
            }
            $exchange->save();

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
