<?php

namespace App\Helpers;

use App\Models\Permission\Permission;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleHelper {
    public static $actions = [
        'users' => [
            'description' => 'Управление пользователями',
            'actions' => [
                'list' => 'Просмотр списка пользователей',
                'single' => 'Просмотр информации об одном пользователе',
                'create' => 'Создание нового пользователя',
                'edit' => 'Редактирование пользователя',
            ]
        ],
        'shift' => [
            'description' => 'Управление сменами',
            'actions' => [
                'list' => 'Просмотр списка смен',
                'start' => 'Открытие смены',
                'end' => 'Закрытие смены',
            ]
        ],
        'operations' => [
            'description' => 'Управление операциями',
            'actions' => [
                'list' => 'Просмотр списка операций',
                'single' => 'Просмотр информации об одной операции',
                'create' => 'Создание операции'
            ]
        ],
        'categories' => [
            'description' => 'Управление категориями операций',
            'actions' => [
                'list' => 'Просмотр списка категорий',
                'create' => 'Добавление категории',
                'edit' => 'Редактирование категории'
            ]
        ],
        'currencies' => [
            'description' => 'Управление валютами',
            'actions' => [
                'list' => 'Просмотр списка валют',
                'create' => 'Создание валюты',
                'edit' => 'Редактирование валюты'
            ]
        ],
        'roles' => [
            'description' => 'Управление ролями',
            'actions' => [
                'list' => 'Просмотр списка ролей',
                'create' => 'Создание новой роли',
                'edit' => 'Редактирование роли',
                'delete' => 'Удаление роли'
            ]
        ],
        'export' => [
            'description' => 'Экспорт данных',
            'actions' => [
                'list' => 'Производить экспорт операций'
            ]
        ]
    ];

    public static function setRoleAvailableActions(Role $role, $actions) {
        foreach ($actions as $act) {
            $permission = null;
            try {
                $permission = Permission::where('name', '=', $act)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $permission = new Permission();
                $permission->name = $act;
                $permission->display_name = RoleHelper::getPermissionLabelByKey($act);
                $permission->save();
            }
            $role->attachPermission($permission);
        }
        return $role;
    }

    public static function attachRootPermissions(Role $role) {
        foreach (self::$actions as $actCategory => $actContent) {
            foreach ($actContent['actions'] as $actName => $description) {
                $actname = $actCategory . '-' . $actName;
                $permission = null;
                try {
                    $permission = Permission::where('name', '=', $actname)->firstOrFail();
                } catch (ModelNotFoundException $e) {
                    $permission = new Permission();
                    $permission->name = $actname;
                    $permission->display_name = $description;
                    $permission->save();
                }
                $role->attachPermission($permission);
            }
        }
    }

    public static function getPermissionLabelByKey($key = false) {
        if (!$key) {
            return 'None';
        }
        list($category, $subkey) = explode('-', $key, 2);
        return self::$actions[$category]['actions'][$subkey];
    }
}
