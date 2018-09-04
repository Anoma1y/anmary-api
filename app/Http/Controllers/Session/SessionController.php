<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use App\Http\Resources\Session\Session as SessionResource;
use App\Models\Profile\Profile;
use App\Models\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends Controller {
    public function POST_Session(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|min:5',
            'password' => 'required|string|min:6'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!$token = Auth::attempt([
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ])) {
            return response(null, Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        if (
            $user->profile->status === Profile::STATUS_BLOCKED
            || $user->profile->status === Profile::STATUS_INACTIVE
        ) {
            Auth::logout();
            return response(null, Response::HTTP_UNAUTHORIZED);
        }

        return response(new SessionResource(new Session([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ])), Response::HTTP_CREATED);
    }

    public function DELETE_Session() {
        Auth::logout();
        return response(null, Response::HTTP_OK);
    }

    public function GET_SessionRefresh() {
        if (!Auth::user()) {
            return response(null, Response::HTTP_UNAUTHORIZED);
        }
        return response(new SessionResource(new Session([
            'token' => auth()->refresh(),
            'expires_in' => auth()->factory()->getTTL() * 60
        ])), REsponse::HTTP_OK);
    }
}
