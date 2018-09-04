<?php

namespace App\Console\Commands\Role;

use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleRoot extends Command {
    protected $signature = 'role:root {user_id}';
    protected $description = 'Command description';

    public function handle() {
        try {
            $user = User::findOrFail((int)$this->argument('user_id'));
            $role = Role::where('name', Role::ROOT_ROLE_NAME)->firstOrFail();
            $user->detachRoles($user->roles);
            $user->attachRole($role);

            echo "`root` granted for `".$user->name."`".PHP_EOL;
        } catch (ModelNotFoundException $e) {
            echo "User with specified ID cannot be found".PHP_EOL;
        }
    }
}
