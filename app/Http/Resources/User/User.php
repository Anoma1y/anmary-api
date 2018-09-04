<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Profile\Profile as ProfileResource;
use App\Http\Resources\Role\Role as RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'profile' => new ProfileResource($this->profile),
            'roles' => RoleResource::collection($this->roles)
        ];
    }
}
