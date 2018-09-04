<?php

namespace App\Models\Role;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {
    const ROOT_ROLE_NAME = 'root';
    const ROOT_ROLE_DISPLAY_NAME = 'Суперпользователь';
    const ROOT_ROLE_DESCRIPTION = 'Роль, дающая доступ ко всем разделам. Эту роль нельзя удалить';
}
