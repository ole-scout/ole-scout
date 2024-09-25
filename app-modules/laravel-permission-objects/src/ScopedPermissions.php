<?php

namespace FossHaas\LaravelPermissionObjects;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ScopedPermissions implements Arrayable, Castable, Jsonable
{
    /**
     * @var array<string, Permissions>
     */
    private $scoped = [];

    /**
     * @param ?list<array{'name':string,'object_id':string|null,'scope':string|null}>|null $items
     */
    public function __construct(?array $items = null)
    {
        if ($items) {
            $this->load($items);
        }
    }

    /**
     * @param list<array{'name':string,'object_id':string|null,'scope':string|null}> $items
     */
    public function load(array $items): self
    {
        $scoped = [];
        foreach ($items as $item) {
            $scope = isset($item['scope']) ? $item['scope'] : null;
            $scoped[$scope ?: ''][] = $item;
        }
        foreach ($scoped as $scope => $scopedItems) {
            if (!isset($this->scoped[$scope])) {
                $this->scoped[$scope] = new Permissions();
            }
            $this->scoped[$scope]->load($scopedItems);
        }
        return $this;
    }

    /**
     * @param string|object|null $object
     * @param string|list<string> $scopes
     */
    public function can(string $ability, mixed $object, string|array $scopes = ""): bool|null
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
        return $this->has($permission, $objectId, $scopes);
    }

    /**
     * @param string|list<string> $scopes
     */
    public function has(Permission $permission, string|null $objectId, string|array $scopes = ""): bool
    {
        if (!is_array($scopes)) {
            $scopes = [$scopes];
        }
        if (!in_array("", $scopes)) {
            $scopes[] = "";
        }
        return Arr::some($scopes, fn($scope) => (
            isset($this->scoped[$scope])
            && $this->scoped[$scope]->has($permission, $objectId)
        ));
    }

    /**
     * @param string|list<string> $scopes
     */
    public function grant(Permission $permission, string|null $objectId, string|array $scopes = ""): self
    {
        if (!is_array($scopes)) {
            $scopes = [$scopes];
        }
        foreach ($scopes as $scope) {
            if (!isset($this->scoped[$scope])) {
                $this->scoped[$scope] = new Permissions();
            }
            $this->scoped[$scope]->grant($permission, $objectId);
        }
        return $this;
    }

    /**
     * @param string|list<string> $scopes
     */
    public function revoke(Permission $permission, string|null $objectId, string|array $scopes = ""): self
    {
        if (!is_array($scopes)) {
            $scopes = [$scopes];
        }
        foreach ($scopes as $scope) {
            if (isset($this->scoped[$scope])) {
                $this->scoped[$scope]->revoke($permission, $objectId);
            }
        }
        return $this;
    }

    /**
     * @param string|list<string>|null $scopes
     */
    public function revokeAll(?Permission $permission = null, string|array|null $scopes = ""): self
    {
        if ($scopes === null) {
            $scopes = array_keys($this->scoped);
        } elseif (!is_array($scopes)) {
            $scopes = [$scopes];
        }
        foreach ($scopes as $scope) {
            if (isset($this->scoped[$scope])) {
                if ($permission === null) {
                    unset($this->scoped[$scope]);
                } else {
                    $this->scoped[$scope]->revokeAll($permission);
                }
            }
        }
        return $this;
    }

    public function __debugInfo(): array
    {
        return Arr::mapWithKeys(
            $this->scoped,
            fn($value, $scope) => [$scope => $value->__debugInfo()]
        );
    }

    /**
     * @return list<array{'name':string,'object_id':string|null,'scope':string|null}>
     */
    public function toArray(): array
    {
        return array_merge(
            ...array_map(
                fn(Permissions $permissions, string $scope) => array_map(
                    fn(array $item) => array_merge($item, ['scope' => $scope ?: null]),
                    $permissions->toArray()
                ),
                $this->scoped,
                array_keys($this->scoped)
            )
        );
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @param list<array{'name':string,'object_id':string|null,'scope':string|null}> $items
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
                    return new ScopedPermissions();
                }
                return ScopedPermissions::fromJson($value);
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
