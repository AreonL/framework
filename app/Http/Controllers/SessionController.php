<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function session(Request $request)
    {
        return view('session', [
            'session' => $request->session()->all(),
        ]);
    }

    public function destroy(Request $request)
    {
        $request->session()->flush();

        return redirect("/session");
    }
}
