<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Models\Subscribe\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Subscribe\Subscribe as SubscribeResource;

class SubscribeController extends Controller {

    public function POST_Subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_address' => 'required|string|min:1|max:255',
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $subscribe = Subscribe::create([
            'contact_address' => $request->post('contact_address')
        ]);

        return response(new SubscribeResource($subscribe), Response::HTTP_CREATED);
    }
}