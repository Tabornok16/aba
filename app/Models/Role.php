<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('slug', $permission);
        }
        return !!$this->permissions->intersect($permission)->count();
    }

    public function givePermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug', $permission)->firstOrFail();
        }
        $this->permissions()->syncWithoutDetaching($permission);
        return $this;
    }

    public function revokePermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug', $permission)->firstOrFail();
        }
        $this->permissions()->detach($permission);
        return $this;
    }
}
