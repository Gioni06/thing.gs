<?php

namespace App\Http\Controllers;

use App\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RedirectController extends Controller
{
    public function index(Request $request, $code)
    {

        $validator = Validator::make(['code' => $code], [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response('', 404);
        } else {
            $thing = Thing::where('code', $code)->firstOrFail();
            return redirect($thing->source, 301);
        }
    }
}
