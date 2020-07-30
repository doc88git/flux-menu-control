<?php

namespace Doc88\FluxMenuControl\Repositories;

use Doc88\FluxMenuControl\Models\Menu;
use Doc88\FluxMenuControl\Models\MenuPermission;
use Doc88\FluxRolePermission\Models\Permission;

class MenuRepository {

    /**
     * Cadastra um novo menu
     */
    public static function store($data)
    {
        $data_create = [
            'module'    => $data['module'],
            'slug'      => $data['slug'],
            'icon'      => $data['icon'] ?? null,
        ];

        if(isset($data['parent'])) {
            $query_menu = Menu::whereSlug($data['parent']);

            if ($query_menu->exists()) {
                $data_create += ['parent_id' => $query_menu->select('id', 'slug')->first()->id];
            }
        }

        return Menu::create($data_create);
    }

    /**
     * Deleta um menu
     */
    public static function delete($slug)
    {
        return Menu::whereSlug($slug)->delete();
    }

    /**
     * Vincula permissão ao menu
     */
    public static function attachPermission($slug, $permission)
    {
        $query_menu = Menu::whereSlug($slug);
        $query_permission = Permission::whereSlug($permission);

        $check = $query_menu->exists() && $query_permission->exists();

        if ($check) {
            MenuPermission::create([
                'menu_id' => $query_menu->select('id', 'slug')->first()->id,
                'permission_id' => $query_permission->select('id', 'slug')->first()->id
            ]);
        }

        return $check;
    }

    /**
     * Desvincula permissão do menu
     */
    public static function dettachPermission($slug, $permission)
    {
        $query_menu = Menu::whereSlug($slug);
        $query_permission = Permission::whereSlug($permission);

        $deteled = false;

        if ($query_menu->exists() && $query_permission->exists()) {
            $deteled = MenuPermission::whereMenuId($query_menu->select('id', 'slug')->first()->id)
            ->wherePermissionId($query_permission->select('id', 'slug')->first()->id)
            ->delete();
        }

        return (bool)$deteled;
    }
}
