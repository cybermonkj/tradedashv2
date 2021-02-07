<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class exchange extends Controller
{
    //

    public function show($id)
    {
        return view('user.exchange', [
            'user' => User::findOrFail($id)
        ]);
    }

}
