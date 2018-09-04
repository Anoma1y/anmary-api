<?php

namespace App\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PermissionCollection extends ResourceCollection {
    public function toArray($request) {
        return array_map(function($permission) {
            return $permission->name;
        }, $this->collection->toArray());
    }
}
