<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = array('name','description');

    public function getPermissions(){
        return $this->hasMany(RolePermissions::class,'role_id','id');
    }
    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($role) {
            $role->getPermissions()->delete();
        });
    }
}
