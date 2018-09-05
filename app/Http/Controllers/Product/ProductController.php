<?php

namespace App\Http\Controllers\Product;

use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection as ProductCollectionResource;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Brand\Brand;
use App\Models\Image\Image;
use App\Models\Compounds\Compounds;
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
            'image_id' => 'required|integer',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'season_id' => 'required|integer',
            'composition' => 'required|array|min:1'
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

        if ($request->post('composition', false)) {
            $compoundsCollection = [];

            if (!is_array($request->post('composition', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $compounds = array_unique($request->post('composition', []));
            try {
                foreach ($compounds as $compoundId) {
                    $compound = Compounds::findOrFail((int)$compoundId);
                    $compoundsCollection[] = $compound;
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product->compounds()->detach();

            foreach ($compoundsCollection as $compound) {
                $product->attachCompounds($compound);
            }
        }

        return response(new ProductResource($product->fresh()), Response::HTTP_CREATED);
    }

    public function PATCH_ProductSingle(Request $request) {
        $product = null;
        try {
            $product = Product::findOrFail((int)$request->route('product_id'));
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|min:3',
            'discount' => 'integer|between:0,100',
            'price' => 'integer|min:0|max:1000000',
            'image_id' => 'integer',
            'category_id' => 'integer',
            'brand_id' => 'integer',
            'season_id' => 'integer',
            'composition' => 'array|min:1'
        ]);

        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product->name = $request->post('name', $product->name);
        $product->description = $request->post('description', $product->description);
        $product->category_id = $request->post('category_id', $product->category_id);
        $product->brand_id = $request->post('brand_id', $product->brand_id);
        $product->season_id = $request->post('season_id', $product->season_id);
        $product->image_id = $request->post('image_id', $product->image_id);
        $product->price = $request->post('price', $product->price);
        $product->discount = $request->post('discount', $product->discount);

        if ($request->post('composition', false)) {
            $compoundsCollection = [];

            if (!is_array($request->post('composition', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $compounds = array_unique($request->post('composition', []));
            try {
                foreach ($compounds as $compoundId) {
                    $compound = Compounds::findOrFail((int)$compoundId);
                    $compoundsCollection[] = $compound;
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product->compounds()->detach();

            foreach ($compoundsCollection as $compound) {
                $product->attachCompounds($compound);
            }
        }

        $product->save();
        return response(new ProductResource($product->fresh()), Response::HTTP_OK);
    }

    public function GET_Product(Request $request) {
        $validator = Validator::make($request->all(), [
            'sum_from' => 'integer|min:1|nullable',
            'sum_to' => 'integer|min:1|nullable',
            'price' => 'integer|min:0|max:1000000|nullable',
            'discount' => 'boolean|nullable'
        ]);

        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $products = Product::where('id', '!=', 0);
        $input = $request->query();

        if ($request->query('sum_from', false)) {
            $products = $products->where('price', '>=', (int)$input['sum_from']);
        }

        if ($request->query('sum_to', false)) {
            $products = $products->where('price', '<=', (int)$input['sum_to']);
        }

        if ($request->query('is_discount', false)) {
            $products = $products->where('discount', '>', 0);
        }

        if ($request->query('categories', false)) {
            $categories = array_map(function ($element) {
                return (int)$element;
            }, explode(',', $input['categories']));
            $products = $products->whereIn('category_id', $categories);
        }

        if ($request->query('seasons', false)) {
            $seasons = array_map(function ($element) {
                return (int)$element;
            }, explode(',', $input['seasons']));
            $products = $products->whereIn('season_id', $seasons);
        }

        if ($request->query('brands', false)) {
            $brands = array_map(function ($element) {
                return (int)$element;
            }, explode(',', $input['brands']));
            $products = $products->whereIn('brand_id', $brands);
        }

        $numOnPage = (int)$request->query('num_on_page', 10);
        $page = (int)$request->query('page', 0);

        $productsTotal = $products->count();

        $products = $products->orderBy('created_at', 'desc')
            ->skip(($page) * $numOnPage)
            ->take($numOnPage);

        return response([
            'records' => new ProductCollectionResource($products->get()),
            'total_records' => $productsTotal,
            'page' => $page,
            'num_on_page' => $numOnPage
        ], Response::HTTP_OK);

    }

    public function GET_ProductSingle(Request $request) {
        try {
            $product = Product::findOrFail((int)$request->route('product_id'));
            return response(new ProductResource($product), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}