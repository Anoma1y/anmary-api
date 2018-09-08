<?php
namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\News\News as NewsResource;

class NewsController extends Controller {
    public function GET_News(Request $request) {

        $news = News::where('id', '!=', 0);
        if ($request->get('name', false)) {
            $news = $news->where('name', 'like', '%' . $request->get('name') . '%');
        }

        return response(NewsResource::collection($news->get()), Response::HTTP_OK);
    }

    public function POST_News(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'content' => 'string|nullable',
            'image_id' => 'integer|nullable'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category = News::create([
            'name' => $request->post('name'),
            'content' => $request->post('content', null),
            'image_id' => $request->post('image_id', null)
        ]);

        return response(new NewsResource($category), Response::HTTP_CREATED);
    }

    public function PATCH_NewsSingle(Request $request) {
        try {
            $category = News::findOrFail((int)$request->route('category_id'));
            $category->name = $request->post('name', $category->name);
            $category->description = $request->post('description', $category->description);
            $category->save();

            return response(new NewsResource($category), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

}