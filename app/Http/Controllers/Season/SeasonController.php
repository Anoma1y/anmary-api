<?php
namespace App\Http\Controllers\Season;

use App\Http\Controllers\Controller;
use App\Season;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Season\Season as SeasonResource;

class SeasonController extends Controller {
    public function GET_Season(Request $request) {

        $seasons = Season::where('id', '!=', 0);
        if ($request->get('name', false)) {
            $seasons = $seasons->where('name', 'like', '%' . $request->get('name') . '%');
        }

        return response(SeasonResource::collection($seasons->get()), Response::HTTP_OK);
    }

    public function POST_Season(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category = Season::create([
            'name' => $request->post('name'),
            'description' => $request->post('description', null)
        ]);

        return response(new SeasonResource($category), Response::HTTP_CREATED);
    }

    public function PATCH_SeasonSingle(Request $request) {
        try {
            $category = Season::findOrFail((int)$request->route('season_id'));
            $category->name = $request->post('name', $category->name);
            $category->description = $request->post('description', $category->description);
            $category->save();

            return response(new SeasonResource($category), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}