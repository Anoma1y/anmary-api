<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\Models\Profile\Profile;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {
    public function POST_User(Request $request) {
        // TODO: Add permission check
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:55',
            'email' => 'required|string|email|min:5|max:255|unique:users',
            'password' => 'required|string|min:6',
            'status' => 'required|integer|min:1',
            'role_id' => 'required|integer|min:1',
            'phone' => 'string|min:5|nullable'
            // TODO: Create check for status
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // TODO: Put user saving in service
        DB::beginTransaction();
        try {
            // Get role
            $roleToAssign = Role::findOrFail((int)$request->post('role_id', 0));

            // Generate user model
            $user = User::create([
                'name' => $request->post('name', 'undefined'),
                'email' => $request->post('email', 'undefined@example.com'),
                'password' => bcrypt($request->post('password'))
            ]);

            // Create profile
            Profile::create([
                'user_id' => $user->id,
                'phone' => $request->post('phone', ''),
                'status' => (int)$request->post('status', Profile::STATUS_INACTIVE)
            ]);
            DB::commit();

            $user->attachRole($roleToAssign);

            return response(new UserResource($user->fresh()), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollback();
            // TODO: Return something informative
            return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function PATCH_UserSingle(Request $request) {
        // TODO: Add auth guard
        // TODO: Separate into service
        try {
            $user = User::findOrFail((int)$request->route('user_id'));

            // Build validation rules
            $validationRules = [];

            // Updating username
            if ($request->post('name', false)) {
                $validationRules['name'] = 'string|min:5|max:55';
            }

            // Updating email
            if ($request->post('email', false)) {
                $validationRules['email'] = 'string|email|min:5|max:255|unique:users';
            }

            // Updating password
            if ($request->post('password', false)) {
                $validationRules['password'] = 'string|min:6';
            }

            // Updating status
            if ($request->post('status', false)) {
                $validationRules['status'] = 'integer|min:1';
            }

            // Updating role
            if ($request->post('role_id', false)) {
                $validationRules['role_id'] = 'integer|min:1';
            }

            // Updating phone
            if ($request->post('phone', false)) {
                $validationRules['phone'] = 'string|min:5';
            }

            // Validate input data
            $validator = Validator::make($request->all(), $validationRules);
            if ($validator->fails()) {
                return response([
                    'validation' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $role = null;
            if ($request->post('role_id', false)) {
                try {
                    $role = Role::findOrFail((int)$request->post('role_id'));
                } catch (ModelNotFoundException $ie) {
                    return response(null, Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            }

            // Update user
            $user->name = $request->post('name', $user->name);
            $user->email = $request->post('email', $user->email);
            $user->password = $request->post('password', false) ? bcrypt($request->post('password')) : $user->password;
            $user->profile->phone = $request->post('phone', $user->profile->phone);
            $user->profile->status = (int)$request->post('status', $user->profile->status);
            $user->profile->save();
            $user->save();

            // Assign user role if needed
            if ($role !== null) {
                $user->detachRoles($user->roles);
                $user->attachRole($role);
            }
            return response(new UserResource($user->fresh()), Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function GET_UserSingle(Request $request) {
        // TODO: Add token validation
        try {
            $user = User::findOrFail((int)$request->route('user_id'));
            return response(new UserResource($user), Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function GET_User(Request $request) {
        // TODO: Add token validation
        $users = User::where('id', '!=', 0);
        if ($request->get('name', false)) {
            $users = $users->where('name', 'like', '%'.$request->get('name').'%');
        }
        return response(UserResource::collection($users->get()), Response::HTTP_OK);
    }

    public function GET_UserSchema(Request $request) {
        // TODO: Add token validation
        return response([
            'status' => Profile::$statusReadable
        ], Response::HTTP_OK);
    }
}
