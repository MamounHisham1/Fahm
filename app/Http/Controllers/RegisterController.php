<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //
    }
}
