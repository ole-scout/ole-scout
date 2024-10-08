<?php

namespace FossHaas\LaravelPermissionObjects;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Permissions implements Arrayable, Castable, Jsonable
{
    /**
     * @var array<string, true|list<string>>
     */
    private $permissions = [];

    /**
     * @param ?list<array{'name':string,'object_id':string|null}>|null $items
     */
    public function __construct(?array $items = null)
    {
        if ($items) {
            $this->load($items);
        }
    }

    /**
     * @param list<array{'name':string,'object_id':string|null}> $items
     */
    public function load(array $items): self
    {
        foreach ($items as $item) {
            if (!isset($item['object_id']) || $item['object_id'] === null) {
                $this->permissions[$item['name']] = true;
            } else if (
                !isset($this->permissions[$item['name']]) ||
                $this->permissions[$item['name']] !== true
            ) {
                $this->permissions[$item['name']][] = (string) $item['object_id'];
            }
        }
        return $this;
    }

    /**
     * @param string|object|null $object
     */
    public function can(string $ability, mixed $object): bool|null
    {
        $objectType = null;
        $objectId = null;
        if (isset($object)) {
            if (is_string($object)) {
                $objectType = $object;
            } elseif (is_object($object)) {
                $objectType = get_class($object);
                if (method_exists($object, 'getKey')) {
                    $objectId = (string) $object->getKey();
                }
            }
        }
        $permission = Permission::resolve($ability, $objectType);
        if (!$permission) {
            return null;
        }
        return $this->has($permission, $objectId);
    }

    public function has(Permission $permission, string|null $objectId): bool
    {
        $id = $permission->getKey();
        if (!isset($this->permissions[$id])) {
            return false;
        }
        if ($this->permissions[$id] === true) {
            return true;
        }
        if ($objectId === null) {
            return false;
        }
        return in_array((string) $objectId, $this->permissions[$id]);
    }

    public function grant(Permission $permission, string|null $objectId): self
    {
        $id = $permission->getKey();
        if ($objectId === null) {
            $this->permissions[$id] = true;
        } else {
            $objectId = (string) $objectId;
            if (!isset($this->permissions[$id]) || (
                is_array($this->permissions[$id])
                && !in_array($objectId, $this->permissions[$id])
            )) {
                $this->permissions[$id][] = $objectId;
            }
        }
        return $this;
    }

    public function revoke(Permission $permission, string|null $objectId): self
    {
        $id = $permission->getKey();
        if (isset($this->permissions[$id])) {
            $permissions = $this->permissions[$id];
            if ($permissions === true) {
                if ($objectId === null) {
                    unset($this->permissions[$id]);
                }
            } else if ($objectId !== null) {
                $index = array_search((string) $objectId, $permissions);
                if ($index !== false) {
                    if (count($permissions) === 1) {
                        unset($this->permissions[$id]);
                    } else {
                        array_splice($permissions, $index, 1);
                    }
                    return $this;
                }
            }
        }
        return $this;
    }

    public function revokeAll(?Permission $permission = null): self
    {
        if ($permission === null) {
            array_splice($this->permissions, 0, count($this->permissions));
        } else {
            $id = $permission->getKey();
            unset($this->permissions[$id]);
        }
        return $this;
    }

    public function __debugInfo(): array
    {
        return Arr::mapWithKeys(
            $this->permissions,
            fn($value, $id) => [$id => $value === true ? null : $value]
        );
    }

    /**
     * @return list<array{'name':string,'object_id':string|null}>
     */
    public function toArray(): array
    {
        return array_merge(...array_map(
            fn($value, $id) => is_array($value) ? array_map(
                fn($value) => ['name' => $id, 'object_id' => $value],
                $value
            ) : [['name' => $id, 'object_id' => null]],
            $this->permissions,
            array_keys($this->permissions)
        ));
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @param list<array{'name':string,'object_id':string|null}> $items
     */
    public static function fromArray(array $items): self
    {
        return new self($items);
    }

    public static function fromJson(string $json): self
    {
        $items = json_decode($json, associative: true);
        return new self($items);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes
        {
            public function get(Model $model, string $key, mixed $value, array $attributes): mixed
            {
                if (!$value) {
                    return new Permissions();
                }
                return Permissions::fromJson($value);
            }

            public function set(Model $model, string $key, mixed $value, array $attributes): mixed
            {
                if ($value === null) {
                    return null;
                }
                return $value->toJson();
            }
        };
    }
}
