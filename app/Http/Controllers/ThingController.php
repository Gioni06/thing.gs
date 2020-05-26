<?php

namespace App\Http\Controllers;

use App\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThingController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $thing = Thing::create([
                'source' => strip_tags($request->query('url'))
            ]);
            return response()->json([
                'status' => 'Ok',
                'source_url' => $thing->source,
                'short_code' => $thing->code
            ]);
        }
    }
}
