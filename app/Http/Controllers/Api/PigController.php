<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pig;

class PigController extends Controller
{
    //
    public function index(Request $request){
        $pigs = Pig::getPigs($request);
        return response()->json([
            'success' => true, 
            'data' => $pigs, 
            'msg' => 'ok'
        ]);
    }

    public function show(Request $request){
        $pig = Pig::with('vaccines', 'healths')->findOrFail($request->id);
        return response()->json([
            'success' => true, 
            'data' => $pig, 
            'msg' => 'ok'
        ]);
    }
}
