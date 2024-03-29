<?php

namespace Iyngaran\User\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Iyngaran\User\Tests\Models\User;
use Iyngaran\User\UserServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\SanctumServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Permission\PermissionServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Iyngaran\\User\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            UserServiceProvider::class,
            PermissionServiceProvider::class,
            SanctumServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('auth.defaults.guard', 'sanctum');

        include_once __DIR__.'/../database/migrations/create_laravel_users_table.php.stub';
        (new \CreateLaravelUsersTable())->up();
        include_once __DIR__.'/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub';
        (new \CreatePermissionTables())->up();
    }

    public function login()
    {
        $user = User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]);
        Sanctum::actingAs($user);
    }
}
