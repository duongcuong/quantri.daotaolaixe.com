<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        return response()->json([
            'success' => true, 
            'data' =>   [
                'user' => Auth::user()
            ], 
            'msg' => 'ok'
        ]);
    }
}
