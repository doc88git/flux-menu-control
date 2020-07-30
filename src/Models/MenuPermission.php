<?php

namespace Doc88\FluxMenuControl\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model {
    protected $table = 'menus_permissions';
    public $guarded = ['id'];
}
