<?php

namespace App\Console\Commands\User;

use App\Models\Profile\Profile;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitRootUser extends Command {
    protected $signature = 'init:root_user {password}';
    protected $description = 'Creates new user with specified password';

    public function handle() {
        $password = (string)$this->argument('password');
        if (strlen($password) < 6) {
            echo 'Provide password (should be more than 6 characters)'.PHP_EOL;
            return;
        }

        DB::beginTransaction();
        try {
            // TODO: Check if root user already exists
            $rootRole = Role::where('name', Role::ROOT_ROLE_NAME)->firstOrFail();

            $user = User::create([
                'name' => 'Администратор',
                'email' => 'admin@anmary.ru',
                'password' => bcrypt($this->argument('password'))
            ]);
            Profile::create([
                'user_id' => $user->id,
                'phone' => '',
                'status' => Profile::STATUS_ACTIVE
            ]);

            DB::commit();

            $user->attachRole($rootRole);
            echo 'Successfully spawned root user'.PHP_EOL;

        } catch (\Exception $e) {
            DB::rollback();
            echo 'Something went wrong: '.$e->getMessage().PHP_EOL;
        }

    }
}
