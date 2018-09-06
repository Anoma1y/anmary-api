<?php
namespace App\Http\Controllers\Size;

use App\Http\Controllers\Controller;
use App\Models\Size\Size;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Size\Size as SizeResource;

class SizeController extends Controller {
    public function GET_Size(Request $request) {

        $size = Size::where('id', '!=', 0);

        return response(SizeResource::collection($size->get()), Response::HTTP_OK);
    }

    public function POST_Size(Request $request) {
        $validator = Validator::make($request->all(), [
            'international' => 'required|string',
            'ru' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $size = Size::create([

            'international' => $request->post('international', null),
            'ru' => $request->post('ru', null),
            'uk' => $request->post('uk', null),
            'us' => $request->post('us', null),
            'eu' => $request->post('eu', null),
            'it' => $request->post('it', null),
            'jp' => $request->post('jp', null),
            'chest' => $request->post('chest', null),
            'waist' => $request->post('waist', null),
            'thigh' => $request->post('thigh', null),
            'sleeve' => $request->post('sleeve', null)
        ]);

        return response(new SizeResource($size), Response::HTTP_CREATED);
    }

    public function PATCH_SizeSingle(Request $request) {
        try {
            $size = Size::findOrFail((int)$request->route('size_id'));

            $size->international = $request->post('international', $size->international);
            $size->ru = $request->post('ru', $size->ru);
            $size->uk = $request->post('uk', $size->uk);
            $size->us = $request->post('us', $size->us);
            $size->eu = $request->post('eu', $size->eu);
            $size->it = $request->post('it', $size->it);
            $size->jp = $request->post('jp', $size->jp);
            $size->chest = $request->post('chest', $size->chest);
            $size->waist = $request->post('waist', $size->waist);
            $size->thigh = $request->post('thigh', $size->thigh);
            $size->sleeve = $request->post('sleeve', $size->sleeve);

            $size->save();

            return response(new SizeResource($size), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}