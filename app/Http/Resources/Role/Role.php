<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\Permission\PermissionCollection as PermissionCollectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Role extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'permissions' => new PermissionCollectionResource($this->perms)
        ];
    }
}
