<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\Image\Image;
use App\Http\Resources\Image\Image as ImageResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller {

    public function POST_Image(Request $request) {
        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|min:20|max:4096'
        ]);

        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $image = $request->file('image', null);
            if ($image === null) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $now = new Carbon();
            $imageSubfolder = (string)$now->startOfDay()->getTimestamp();
            $image->store(
                '/'.$imageSubfolder,
                'public'
            );

            $image = new Image();
            $image->original_name = $request->file('image', null)->getClientOriginalName();
            $image->extension = strtolower($request->file('image', null)->getClientOriginalExtension());
            $image->size = $request->file('image', null)->getSize();
            $image->original_uri = '/storage/'.$imageSubfolder.'/'
                .$request->file('image', null)->hashName();
            $image->preview_uri = 'undefined';
            $image->save();

            return response(new ImageResource($image), Response::HTTP_CREATED);
        } catch (\Exception $e) {
           return $e;
        }
    }

    public function GET_ImageSingle(Request $request) {
        try {
            $image = Image::findOrFail((int)$request->route('image_id'));
            return response(new ImageResource($image), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function POST_ImageSetDefault(Request $request) {
        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        try {

            $image = Image::findOrFail((int)$request->route('image_id'));
            $image->is_default = true;
            $image->save();

            return response(new ImageResource($image), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function POST_ImageChangeDefault(Request $request) {
        if (!Auth::user()->hasRole('root')) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        try {

            $image_old = Image::findOrFail((int)$request->route('image_id_old'));
            $image_old->is_default = false;
            $image_old->save();

            $image_new = Image::findOrFail((int)$request->route('image_id_new'));
            $image_new->is_default = true;
            $image_new->save();

            return response([
                'old_image' => new ImageResource($image_old),
                'new_image' => new ImageResource($image_new)
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }
}
