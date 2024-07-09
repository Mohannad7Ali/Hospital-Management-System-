<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\AdminLoginRequest;



class AdminController extends Controller
{




    public function store(AdminLoginRequest $request)
    {

        if($request->authenticate()){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::Admin);
        }

        return redirect()->back()->withErrors(['name' => (trans('dashboard/auth.failed'))]);
    }




    public function destroy(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
