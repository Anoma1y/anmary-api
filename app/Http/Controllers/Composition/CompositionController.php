<?php
namespace App\Http\Controllers\Composition;

use App\Http\Controllers\Controller;
use App\Models\Composition\Composition;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Composition\Composition as CompositionResource;

class CompositionController extends Controller {
    public function GET_Composition(Request $request) {

        $composition = Composition::where('id', '!=', 0);
        if ($request->get('name', false)) {
            $composition = $composition->where('name', 'like', '%' . $request->get('name') . '%');
        }

        return response(CompositionResource::collection($composition->get()), Response::HTTP_OK);
    }

    public function POST_Composition(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $composition = Composition::create([
            'name' => $request->post('name'),
            'description' => $request->post('description', null)
        ]);

        return response(new CompositionResource($composition), Response::HTTP_CREATED);
    }

    public function PATCH_CompositionSingle(Request $request) {
        try {
            $composition = Composition::findOrFail((int)$request->route('composition_id'));
            $composition->name = $request->post('name', $composition->name);
            $composition->description = $request->post('description', $composition->description);
            $composition->save();

            return response(new CompositionResource($composition), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}