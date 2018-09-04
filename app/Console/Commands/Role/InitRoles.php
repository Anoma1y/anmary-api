<?php

namespace App\Console\Commands\Role;

use App\Helpers\RoleHelper;
use App\Models\Role\Role;
use Illuminate\Console\Command;

class InitRoles extends Command {
    protected $signature = 'init:roles';
    protected $description = 'Spawns roles on startup';

    public function handle() {
        $root = new Role();
        $root->name = Role::ROOT_ROLE_NAME;
        $root->display_name = Role::ROOT_ROLE_DISPLAY_NAME;
        $root->description = Role::ROOT_ROLE_DESCRIPTION;
        $root->save();
        RoleHelper::attachRootPermissions($root);
    }
}
