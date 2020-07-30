<?php

namespace Doc88\FluxMenuControl\Models;

use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model {
    protected $table = 'menus_users';
    public $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
