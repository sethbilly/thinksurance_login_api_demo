<?php

namespace App\Traits;
use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions == null)
        {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
    }

    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasRole(... $roles)
    {
        foreach($roles as $role)
        {
            if($this->roles->contains('name',$role))
            {
                return true;
            }
        }
        return false;
    }
}

?>
