<?php

namespace App\Providers;

use App\Filesystem\FakeAdapter;
use App\Models\User;
use FossHaas\LaravelPermissionObjects\Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Translatable::fallback(
            fallbackAny: true,
        );
        Storage::extend('fake', function (Application $app, array $config) {
            $adapter = new FakeAdapter();
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
        Relation::morphMap([
            'user' => \App\Models\User::class,
            'permission' => \FossHaas\LaravelPermissionObjects\Permission::class,
            'course' => \FossHaas\Courses\Models\Course::class,
            'courseGroup' => \FossHaas\Courses\Models\CourseGroup::class,
            'activity' => \FossHaas\Courses\Models\Activity::class,
            'activityGroup' => \FossHaas\Courses\Models\ActivityGroup::class,
        ]);
        Permission::register(User::class, [
            'manage' => fn() => __('Manage users'),
            'manage-credentials' => fn() => __('Manage user credentials'),
        ]);
        Permission::register(Permission::class, [
            'assign' => fn() => __('Assign permissions'),
        ]);
        Gate::after(function (User $user) {
            if ($user->is_admin) {
                return true;
            }
        });
        Gate::after(function (User $user, string $ability, bool|null $result, mixed $arguments) {
            if ($result !== null) return $result;
            $object = isset($arguments[0]) ? $arguments[0] : null;
            $scopes = isset($arguments[1]) ? $arguments[1] : null;
            return $user->permissions->can($ability, $object, $scopes);
        });
    }
}
