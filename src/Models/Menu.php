<?php

namespace Doc88\FluxMenuControl\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    protected $table = 'menus';
    public $guarded = ['id'];

    public function subitem()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
