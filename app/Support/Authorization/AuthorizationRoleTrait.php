<?php

namespace Vanguard\Support\Authorization;

use Cache;
use Config;
use Vanguard\Permission;

trait AuthorizationRoleTrait
{
    /**
     * Override "save" role method to clear role cache.
     * @param array $options
     */
    public function save(array $options = [])
    {
        $this->flushCache();
        parent::save($options);
    }

    /**
     * Flush cached permissions for this role.
     */
    private function flushCache()
    {
        Cache::forget($this->getCacheKey());
    }

    /**
     * Get permissions cache key.
     * @return string
     */
    private function getCacheKey()
    {
        return 'permissions_for_role_' . $this->{$this->primaryKey};
    }

    /**
     * Override "delete" role method to clear role cache.
     * @param array $options
     * @throws \Exception
     */
    public function delete(array $options = [])
    {
        $this->flushCache();
        parent::delete($options);
    }

    /**
     * Override "restore" role method to clear role cache.
     */
    public function restore()
    {
        $this->flushCache();
        parent::restore();
    }

    /**
     * Checks if the role has a permission by its name.
     *
     * @param string $name Permission name.
     * @return bool
     */
    public function hasPermission($name)
    {
        $perms = $this->cachedPermissions()->pluck('name')->toArray();

        return in_array($name, $perms, true);
    }

    /**
     * Get cached permissions for this role.
     * @return mixed
     */
    public function cachedPermissions()
    {
        return Cache::remember($this->getCacheKey(), Config::get('cache.ttl'), function () {
            return $this->permissions()->get();
        });
    }

    /**
     * Many-to-Many relations with the permission model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id');
    }

    /**
     * Save the inputted permissions.
     *
     * @param mixed $inputPermissions
     *
     * @return void
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        } else {
            $this->permissions()->detach();
        }

        $this->flushCache();
    }

    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->attach($permission);

        $this->flushCache();
    }

    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    /**
     * Detach permission from current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->detach($permission);

        $this->flushCache();
    }

    /**
     * Sync role permissions.
     * @param $permissions array Permission IDs.
     */
    public function syncPermissions(array $permissions)
    {
        $this->permissions()->sync($permissions);

        $this->flushCache();
    }
}
