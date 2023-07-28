<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReconfirmPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.confirm-password');
    }

    public function reconfirm(Request $request)
    {
        $request->validate([
            'password' => 'required|CurrentPassword',
        ]);

        // Set a session flag to indicate successful reconfirmation
        session(['reconfirming_password' => true]);

        // Redirect to the original intended URL after successful reconfirmation
        return redirect()->intended('/dashboard');
    }
}
