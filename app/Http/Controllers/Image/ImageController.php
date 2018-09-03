<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Image;
use App\Http\Resources\Image\Image as ImageResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller {

    public function POST_Image(Request $request) {
        try {
            $image = $request->file('image', null);
            if ($image === null) {
                return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $now = new Carbon();
            $imageSubfolder = (string)$now->startOfDay()->getTimestamp();
            $image->store(
                Image::FILES_ROOT_FOLDER.'/'.$imageSubfolder,
                'public'
            );

            // Save
            $image = new Image();
            $image->original_name = $request->file('image', null)->getClientOriginalName();
            $image->extension = strtolower($request->file('image', null)->getClientOriginalExtension());
            $image->size = $request->file('image', null)->getSize();
            $image->original_uri = '/storage/'.Image::FILES_ROOT_FOLDER.'/'.$imageSubfolder.'/'
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
}
