<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Category\Category as CategoryResource;

class CategoryController extends Controller {
    public function GET_Category(Request $request) {

        $categories = Category::where('id', '!=', 0);
        if ($request->get('name', false)) {
            $categories = $categories->where('name', 'like', '%' . $request->get('name') . '%');
        }

        return response(CategoryResource::collection($categories->get()), Response::HTTP_OK);
    }

    public function POST_Category(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category = Category::create([
            'name' => $request->post('name'),
            'description' => $request->post('description', null)
        ]);

        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }

    public function PATCH_CategorySingle(Request $request) {
        try {
            $category = Category::findOrFail((int)$request->route('category_id'));
            $category->name = $request->post('name', $category->name);
            $category->description = $request->post('description', $category->description);
            $category->save();

            return response(new CategoryResource($category), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}