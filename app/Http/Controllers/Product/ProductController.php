<?php

namespace App\Http\Controllers\Product;

use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection as ProductCollectionResource;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Image\Image;
use App\Models\Product\Product;
use App\Models\Season\Season;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller {
    public function POST_Product(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'discount' => 'integer|between:0,100',
            'price' => 'required|integer|min:0|max:1000000',
            'image_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'season_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product = new Product();
        $product->name = $request->post('name', $product->name);
        $product->description = $request->post('description', $product->description);
        $product->category_id = $request->post('category_id', $product->category_id);
        $product->brand_id = $request->post('brand_id', $product->brand_id);
        $product->season_id = $request->post('season_id', $product->season_id);
        $product->image_id = $request->post('image_id', $product->image_id);
        $product->price = $request->post('price', $product->price);
        $product->discount = $request->post('discount', $product->discount);

        $product->save();
        $product = $product->fresh();
//
//        // Persist files (if any)
//        foreach ($filesCollection as $file) {
//            $product->attachFile($file);
//        }
//
//        // Persist tags (if any)
//        foreach ($tagsCollection as $tag) {
//            $product->attachTag($tag);
//        }

        return response(new ProductResource($product->fresh()), Response::HTTP_CREATED);
    }
}