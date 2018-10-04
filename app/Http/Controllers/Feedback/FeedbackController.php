<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Feedback\Feedback as FeedbackResource;

class FeedbackController extends Controller {

    public function POST_Feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_name' => 'nullable|string|max:100',
            'contact_address' => 'required|string|min:1|max:255',
            'text' => 'required|string|min:5',
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $subscribe = Feedback::create([
            'contact_name' => $request->post('contact_name', ''),
            'contact_address' => $request->post('contact_address'),
            'text' => $request->post('text'),
        ]);

        return response(new FeedbackResource($subscribe), Response::HTTP_CREATED);
    }

    public function GET_Feedback(Request $request) {

        $feedback = Feedback::where('id', '!=', 0);

        if ($request->get('contact_name', false)) {
            $feedback = $feedback->where('contact_name', 'like', '%' . $request->get('contact_name') . '%');
        }

        if ($request->get('contact_address', false)) {
            $feedback = $feedback->where('contact_address', 'like', '%' . $request->get('contact_address') . '%');
        }

        return response(FeedbackResource::collection($feedback->get()), Response::HTTP_OK);
    }
}