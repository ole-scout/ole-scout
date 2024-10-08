<?php

namespace FossHaas\LaravelPermissionObjects;

use Closure;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;

/**
 * @property string $qualifier
 * @property string $name
 * @property string $objectType
 */
final class Permission
{
    use Traits\HasPermissions;

    /**
     * @var array<string,array<string,string|Closure>>
     */
    private static array $definitions = [];

    /**
     * @var array<string,Permission>
     */
    private static array $instances = [];

    private function __construct(
        private ?string $qualifier,
        private string $name,
        private string|Closure $label,
        private ?string $objectType
    ) {}

    /**
     * Get the key of the permission.
     */
    public function getKey(): string
    {
        return $this->qualifier ? "{$this->qualifier}.{$this->name}" : $this->name;
    }

    public function __get(string $name): mixed
    {
        return match ($name) {
            'qualifier' => $this->qualifier,
            'name' => $this->name,
            'objectType' => $this->objectType,
            default => null,
        };
    }

    /**
     * Get the label of the permission.
     */
    public function getLabel(): string
    {
        $label = $this->label;
        if ($label instanceof Closure) {
            $label = $label();
        }
        return $label;
    }

    /**
     * Check if the permission is applicable to the given object.
     */
    public function isApplicableTo(mixed $object): bool
    {
        if ($object === null) return true;
        if (is_string($object)) {
            return Relation::getMorphAlias($object) === $this->qualifier;
        }
        if (!is_object($object)) return false;
        return $object instanceof $this->objectType;
    }

    /**
     * Check if the permission is not applicable to the given object.
     */
    public function isNotApplicableTo(mixed $object): bool
    {
        return !$this->isApplicableTo($object);
    }

    public function __debugInfo(): array
    {
        return [
            'id' => $this->getKey(),
            'objectType' => $this->objectType,
            'name' => $this->name,
            'label' => $this->getLabel(),
        ];
    }

    /**
     * @param string $class
     * @param array<string,string|Closure> $permissions Name => Label
     */
    public static function register(string|null $class, array $permissions): void
    {
        if (!$class) $class = '';
        static::$definitions[$class] = isset(static::$definitions[$class])
            ? static::$definitions[$class] + $permissions
            : $permissions;
    }

    public static function find(string $id): Permission|null
    {
        static::loadValues();
        if (!isset(static::$instances[$id])) {
            return null;
        }
        return static::$instances[$id];
    }

    public static function resolve(string $name, string|null $objectType): Permission|null
    {
        if ($objectType === null) {
            return static::find($name);
        }
        $qualifier = Relation::getMorphAlias($objectType);
        return static::find("{$qualifier}.{$name}");
    }

    public static function all(): array
    {
        static::loadValues();
        return static::$instances;
    }

    public static function for(string $class): array
    {
        static::loadValues();
        return Arr::mapWithKeys(
            array_filter(
                static::$instances,
                fn($permission) => $permission->objectType === $class
            ),
            fn($permission) => [$permission->name => $permission]
        );
    }

    protected static function loadValues(): void
    {
        if (!static::$definitions) return;
        foreach (static::$definitions as $objectType => $permissions) {
            $qualifier = $objectType ? Relation::getMorphAlias($objectType) : null;
            foreach ($permissions as $name => $label) {
                $id = $qualifier ? "{$qualifier}.{$name}" : $name;
                if (isset(static::$instances[$id])) continue;
                $instance = new static($qualifier, $name, $label, $objectType ?: null);
                static::$instances[$id] = $instance;
            }
        }
        static::$definitions = [];
    }
}
