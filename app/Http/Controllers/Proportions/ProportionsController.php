<?php
namespace App\Http\Controllers\Proportions;

use App\Http\Controllers\Controller;
use App\Models\Proportion\Proportion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proportion\Proportion as ProportionsResource;

class ProportionsController extends Controller {

    public function POST_Proportions(Request $request)
    {
        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        $validator = Validator::make($request->all(), [
            'size_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product_proportion = Proportion::create([
            'size_id' => $request->post('size_id')
        ]);

        return response(new ProportionsResource($product_proportion), Response::HTTP_CREATED);
    }
}