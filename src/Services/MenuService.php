<?php

namespace Doc88\FluxMenuControl\Services;

use Doc88\FluxMenuControl\Models\MenuPermission;
use Doc88\FluxMenuControl\Models\MenuUser;
use Doc88\FluxRolePermission\Models\PermissionUser;

class MenuService {

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Sincorniza Menu do usuário atráves das permissões
     */
    public function syncUserMenuPermission()
    {
        MenuUser::whereUserId($this->user->id)->delete();

        PermissionUser::whereUserId($this->user->id)
        ->get(['id', 'permission_id', 'user_id'])->map(function ($permission_user) {
            return MenuPermission::wherePermissionId($permission_user->permission_id)
            ->get(['id', 'menu_id', 'permission_id'])->map(function ($menu_permission) {
                return MenuUser::create([
                    'menu_id' => $menu_permission->menu_id,
                    'user_id' => $this->user->id
                ]);
            });
        });

        return $this->menu();
    }

    /**
     * Monta o menu do usuário
     */
    public function menu()
    {   
        return MenuUser::with('menu.subitem')->whereUserId($this->user->id)
        ->get()
        ->map(function ($menu_user) {
            $menu = [
                'module' => $menu_user->menu->module,
                'slug' => $menu_user->menu->slug,
                'icon' => $menu_user->menu->icon,
            ];

            if (count($menu_user->menu->subitem) > 0) {
                $submenu = $menu_user->menu->subitem->map(function ($subitem) {
                    return [
                        'module' => $subitem->module,
                        'slug' => $subitem->slug,
                        'icon' => $subitem->icon,
                    ];
                });

                $menu += ['itens' => $submenu];
            }

            return $menu;
        });
    }
}
