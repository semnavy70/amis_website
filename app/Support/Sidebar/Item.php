<?php

namespace Vanguard\Support\Sidebar;

use Closure;
use Illuminate\Support\Collection;
use Vanguard\User;

class Item
{
    protected $title;
    protected $route;
    protected $href;
    protected $icon;
    protected $activePath;
    protected $permissions;
    protected $children;
    protected $target;

    public function __construct($title)
    {
        $this->title = $title;
        $this->target = "_self";
    }

    public static function create($title): Item
    {
        return new self($title);
    }

    public function route($route): Item
    {
        $this->route = $route;

        return $this;
    }

    public function href($href): Item
    {
        $this->href = $href;

        return $this;
    }


    public function icon($icon): Item
    {
        $this->icon = $icon;

        return $this;
    }

    public function active($path): Item
    {
        $this->activePath = $path;

        return $this;
    }

    public function target($target): Item
    {
        $this->target = $target;

        return $this;
    }

    public function getExpandedPath()
    {
        if (!$this->children->count()) {
            return null;
        }

        return $this->children->toBase()->map(function (Item $item) {
            return $item->getActivePath();
        })->toArray();
    }

    public function getActivePath()
    {
        return $this->activePath;
    }

    public function getHref()
    {
        if ($this->href) {
            return $this->href;
        }

        return $this->route ? route($this->route) : null;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function permissions($permissions): Item
    {
        $this->permissions = $permissions;

        return $this;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function isDropdown(): bool
    {
        return $this->children && $this->children->count();
    }

    public function children()
    {
        return $this->children;
    }

    public function addChildren(array $children): Item
    {
        if (is_null($this->children)) {
            $this->children = new Collection;
        }

        foreach ($children as $child) {
            $this->children->push($child);
        }

        return $this;
    }

    public function authorize(User $user)
    {
        if (is_object($this->permissions) && $this->permissions instanceof Closure) {
            return call_user_func($this->permissions, $user);
        }

        foreach ((array)$this->permissions as $permission) {
            if (!$user->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }
}
