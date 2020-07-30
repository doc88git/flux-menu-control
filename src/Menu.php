<?php

namespace Doc88\FluxMenuControl;

use Doc88\FluxMenuControl\Repositories\MenuRepository;
use Doc88\FluxMenuControl\Services\MenuService;

class Menu {

    //---------------------------------
    // Funções Menu
    //---------------------------------

    /**
     * Cria um novo menu
     */
    public static function create($data)
    {
        return MenuRepository::store($data);
    }

    /**
     * Deleta um menu
     */
    public static function remove($slug)
    {
        return MenuRepository::delete($slug);
    }

    /**
     * Vincula permissão a menu
     */
    public static function attachPermission($slug, $permission)
    {
        return MenuRepository::attachPermission($slug, $permission);
    }

    /**
     * Desvincula permissão de menu
     */
    public static function dettachPermission($slug, $permission)
    {
        return MenuRepository::dettachPermission($slug, $permission);
    }

    //---------------------------------
    // Funções User
    //---------------------------------

    /**
     * Sincroniza as permissões do usuário com os menus existentes
     *
     */
    public static function sync($user)
    {
        return (new MenuService($user))->syncUserMenuPermission();
    }

    /**
     * Retorna o menu do usuário
     */
    public static function get($user)
    {
        return (new MenuService($user))->menu();
    }
}
