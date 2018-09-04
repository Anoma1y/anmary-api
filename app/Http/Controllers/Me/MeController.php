<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MeController extends Controller {
    public function GET_Me() {
        if (!Auth::user()) {
            return response(null, Response::HTTP_UNAUTHORIZED);
        }

        return response(new UserResource(Auth::user()), Response::HTTP_OK);
    }
}
