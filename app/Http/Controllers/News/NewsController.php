<?php
namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\News\News as NewsResource;

class NewsController extends Controller {
    public function GET_News(Request $request) {

        $news = News::where('id', '!=', 0);

        if ($request->get('name', false)) {
            $news = $news->where('name', 'like', '%' . $request->get('name') . '%');
        }

        return response(
            NewsResource::collection(
                $news
                    ->orderBy('created_at', 'desc')
                    ->get()
            ),
            Response::HTTP_OK
        );
    }

    public function GET_NewsSingle(Request $request) {
        try {
            $news = News::findOrFail((int)$request->route('news_id'));
            return response(new NewsResource($news), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function POST_News(Request $request) {

        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

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

        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        try {
            $news = News::findOrFail((int)$request->route('news_id'));
            $news->name = $request->post('name', $news->name);
            $news->content = $request->post('content', $news->content);
            $news->image_id = $request->post('image_id', $news->image_id);
            $news->save();

            return response(new NewsResource($news), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function DELETE_NewsSingle(Request $request) {
        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }
        try {
            $news = News::findOrFail((int)$request->route('news_id'));
            $news->delete();

            return response(null, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

    }

}