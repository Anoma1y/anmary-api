<?php

namespace App\Http\Controllers\Product;

use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection as ProductCollectionResource;
use App\Http\Controllers\Controller;
use App\Models\Compounds\Compounds;
use App\Models\Product\Product;
use App\Models\Proportion\Proportion;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller {
    public function POST_Product(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'discount' => 'integer|between:0,100',
            'price' => 'required|integer|min:0|max:100000000',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'season_id' => 'required|integer',
            'composition' => 'required|array|min:1',
            'image' => 'required|array|min:1',
            'size' => 'required|array|min:1'
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
        $product->price = $request->post('price', $product->price);
        $product->discount = $request->post('discount', $product->discount);

        $product->save();
        $product = $product->fresh();

        if ($request->post('image', false)) {
            $imagesCollection = [];

            if (!is_array($request->post('image', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $images = array_unique($request->post('image', []));
            try {
                foreach ($images as $imageId) {
                    $image = Image::findOrFail((int)$imageId);
                    $imagesCollection[] = $image;
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product->images()->detach();

            foreach ($imagesCollection as $image) {
                $product->attachImages($image);
            }
        }

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

        if ($request->post('size', false)) {
            $proportionsCollection = [];

            if (!is_array($request->post('size', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $proportions = array_unique($request->post('size', []));


            try {
                foreach ($proportions as $proportionId) {
                    $proportion = Proportion::findOrFail((int)$proportionId);
                    $proportionsCollection[] = $proportion;
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product->proportions()->detach();

            foreach ($proportionsCollection as $proportion) {
                $product->attachProportions($proportion);
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
            'name' => 'required|string|min:3',
            'discount' => 'integer|between:0,100',
            'price' => 'required|integer|min:0|max:100000000',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'season_id' => 'required|integer',
            'composition' => 'required|array|min:1',
            'image' => 'required|array|min:1',
            'size' => 'required|array|min:1'
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
        $product->price = $request->post('price', $product->price);
        $product->discount = $request->post('discount', $product->discount);


        if ($request->post('image', false)) {
            $imagesCollection = [];

            if (!is_array($request->post('image', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $images = array_unique($request->post('image', []));
            try {
                foreach ($images as $imageId) {
                    $image = Image::findOrFail((int)$imageId);
                    $imagesCollection[] = $image;
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product->images()->detach();

            foreach ($imagesCollection as $image) {
                $product->attachImages($image);
            }
        }

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

        if ($request->post('size', false)) {
            $proportionsCollection = [];

            if (!is_array($request->post('size', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $proportions = array_unique($request->post('size', []));

            try {
                foreach ($proportions as $proportionId) {
                    $proportion = Proportion::findOrFail((int)$proportionId);
                    $proportionsCollection[] = $proportion;
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product->proportions()->detach();

            foreach ($proportionsCollection as $proportion) {
                $product->attachProportions($proportion);
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
            'brand' => 'integer|nullable',
            'category' => 'integer|nullable',
            'season' => 'integer|nullable',
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

        if ($request->query('has_discount', null) !== null) {

            $hasDiscount = (bool)$request->query('has_discount');
            if ($hasDiscount) {
                $products = $products->where('discount', '>', 0);
            } else {
                $products = $products->where('discount', '=', 0);
            }
        }

        if ($request->query('category', false)) {
            $category = array_map(function ($element) {
                return (int)$element;
            }, explode(',', $input['category']));
            $products = $products->whereIn('category_id', $category);
        }

        if ($request->query('season', false)) {
            $season = array_map(function ($element) {
                return (int)$element;
            }, explode(',', $input['season']));
            $products = $products->whereIn('season_id', $season);
        }

        if ($request->query('brand', false)) {
            $brand = array_map(function ($element) {
                return (int)$element;
            }, explode(',', $input['brand']));
            $products = $products->whereIn('brand_id', $brand);
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

    public function GET_ProductRandom(Request $request) {

        $validator = Validator::make($request->all(), [
            'limit' => 'integer|min:1|max:20'
        ]);

        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $products = Product::where('id', '!=', 0);
        $input = $request->query();

        $limit = 10;

        if ($request->query('limit', false)) {
            $limit = (int)$input['limit'];
        }

        return response(new ProductCollectionResource(
            $products
                ->inRandomOrder(5)
                ->limit($limit)
                ->get()),
            Response::HTTP_OK
        );
    }

}