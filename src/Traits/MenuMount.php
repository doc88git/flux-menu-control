<?php

namespace Doc88\FluxMenuControl\Traits;

use Doc88\FluxMenuControl\Services\MenuService;

trait MenuMount {

    /**
     * Retorna o menu do usuário
     */
    public function getMenu()
    {
        return (new MenuService($this))->menu();
    }
}
