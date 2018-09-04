<?php

namespace App\Http\Controllers\Role;

use App\Helpers\RoleHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleCollection;
use App\Models\Role\Role;
use App\Http\Resources\Role\Role as RoleResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller {
    public function GET_RoleSchema(Request $request) {
        // TODO: Add token guard
        return response(RoleHelper::$actions, Response::HTTP_OK);
    }

    public function GET_RoleSingle(Request $request) {
        // TODO: Add token guard
        try {
            $role = Role::findOrFail((int)$request->route('role_id'));
            return response(
                new RoleResource($role),
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function PATCH_RoleSingle(Request $request) {
        // TODO: Add token guard
        $validator = Validator::make($request->all(), [
            'display_name' => 'string|min:4',
            'description' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Ensure we have role
        $role = null;
        try {
            $role = Role::findOrFail((int)$request->route('role_id'));
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        // Update role with new data
        $role->display_name = $request->post('display_name', $role->display_name);
        $role->description = $request->post('description', $role->description);
        $role->save();


        $actions = $request->post('permissions', false);
        if ($actions !== false) {
            // Force remove all previous permissions, and populate with new ones
            foreach ($role->perms->all() as $perm) {
                $role->detachPermission($perm);
            }
            RoleHelper::setRoleAvailableActions($role, $actions);
        }
        return response(new RoleResource($role->fresh()), Response::HTTP_OK);
    }

    public function POST_Role(Request $request) {
        // TODO: Add token validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|unique:roles',
            'display_name' => 'required|string|min:4',
            'description' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return response([
                'validation' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create empty role
        $role = new Role();
        $role->name = $request->post('name');
        $role->display_name = $request->post('display_name');
        $role->description = $request->post('description');
        $role->save();

        $actions = $request->post('permissions');
        RoleHelper::setRoleAvailableActions($role, $actions);
        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    public function GET_Role(Request $request) {
        // TODO: Validate auth token
        return response(
            new RoleCollection(Role::all()),
            Response::HTTP_OK
        );
    }
}
