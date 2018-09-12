<?php
namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Brand\Brand as BrandResource;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller {
    public function GET_Brand(Request $request) {

        $brands = Brand::where('id', '!=', 0);

        if ($request->query('country', false)) {
            $brands = $brands->where('country', '=', $request->get('country'));
        }

        if ($request->get('name', false)) {
            $brands = $brands->where('name', 'like', '%' . $request->get('name') . '%');
        }

        return response(BrandResource::collection($brands->get()), Response::HTTP_OK);
    }

    public function POST_Brand(Request $request) {

        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'string|nullable',
            'country' => 'required|string|size:2'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $brand = Brand::create([
            'name' => $request->post('name'),
            'description' => $request->post('description', null),
            'country' => $request->post('country')
        ]);

        return response(new BrandResource($brand), Response::HTTP_CREATED);
    }

    public function PATCH_BrandSingle(Request $request) {

        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        try {
            $brand = Brand::findOrFail((int)$request->route('brand_id'));
            $brand->name = $request->post('name', $brand->name);
            $brand->description = $request->post('description', $brand->description);
            $brand->country = $request->post('country', $brand->country);
            $brand->save();

            return response(new BrandResource($brand), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}