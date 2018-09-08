<?php
namespace App\Http\Controllers\Size;

use App\Http\Controllers\Controller;
use App\Models\Size\Size;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Size\Size as SizeResource;

class SizeController extends Controller {
    public function GET_Size(Request $request) {
        $size = Size::where('id', '!=', 0);
        return response(SizeResource::collection($size->get()), Response::HTTP_OK);
    }
}