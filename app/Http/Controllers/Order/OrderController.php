<?php

namespace App\Http\Controllers\Order;

use App\Http\Resources\Order\Order as OrderResource;
use App\Http\Resources\Order\OrderCollection as OrderCollectionResource;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Proportion\Proportion;
use App\Http\Resources\Proportion\ProportionOrder as ProportionOrderResource;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {
    public function POST_Order(Request $request) {

        $validator = Validator::make($request->all(), [
            'contact_name' => 'nullable|string|min:1|max:100',
            'contact_detail' => 'nullable|string|min:1|max:100',
            'user_id' => 'nullable|integer|min:1',
            'products' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $order = new Order();
        $order->contact_name = $request->post('contact_name', '');
        $order->contact_detail = $request->post('contact_detail', '');
        $order->user_id = $request->post('user_id', null);

        $order->save();
        $order = $order->fresh();

        if ($request->post('products', false)) {
            $productsCollection = [];

            if (!is_array($request->post('products', []))) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $products = array_unique($request->post('products', []));
            try {
                foreach ($products as $productId) {
                    $product = Proportion::findOrFail((int)$productId);
                    $productsCollection[] = new ProportionOrderResource($product);
                }
            } catch (ModelNotFoundException $e) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $order->products()->detach();

            foreach ($productsCollection as $product) {
                $product_id = DB::table('products_proportion')->select('product_id')->where('proportion_id', $product->id)->first()->product_id;
                $order->attachProducts($product_id, $product->size_id);
            }


        }
        return response(new OrderResource($order->fresh()), Response::HTTP_CREATED);

    }

    public function GET_Order(Request $request) {
        $validator = Validator::make($request->all(), [
            'is_completed' => 'boolean|nullable'
        ]);

        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $orders = Order::where('id', '!=', 0);

        if ($request->query('is_completed', null) !== null) {

            $isActive = (bool)$request->query('is_completed');
            if ($isActive) {
                $orders = $orders->where('is_completed', '=', true);
            } else {
                $orders = $orders->where('is_completed', '=', false);
            }
        }

        $numOnPage = (int)$request->query('num_on_page', 9);
        $page = (int)$request->query('page', 0);

        $ordersTotal = $orders->count();

        $sortingOrder = (string)$request->query('sort', 'desc');
        $typeOrder = (string)$request->query('type_order', 'created_at');

        $orders = $orders
            ->orderBy($typeOrder, $sortingOrder)
            ->skip(($page) * $numOnPage)
            ->take($numOnPage);

        return response([
            'records' => new OrderCollectionResource($orders->get()),
            'total_records' => $ordersTotal,
            'page' => $page,
            'num_on_page' => $numOnPage
        ], Response::HTTP_OK);

    }

    public function GET_OrderSingle(Request $request) {
        try {
            $order = Order::findOrFail((int)$request->route('order_id'));
            return response(new OrderResource($order), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }
}