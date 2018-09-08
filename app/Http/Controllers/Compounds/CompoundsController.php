<?php
namespace App\Http\Controllers\Compounds;

use App\Http\Controllers\Controller;
use App\Models\Compounds\Compounds;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Compounds\Compounds as CompoundsResource;

class CompoundsController extends Controller {

    public function POST_Compounds(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'composition_id' => 'required|integer',
            'value' => 'required|integer|between:0,100'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product_composition = Compounds::create([
            'composition_id' => $request->post('composition_id'),
            'value' => $request->post('value')
        ]);

        return response(new CompoundsResource($product_composition), Response::HTTP_CREATED);
    }
}