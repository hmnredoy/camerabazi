<?php
/**
 * Project      : Easy Role
 * File Name    : EasyRoleServiceProvider.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/17 5:49 PM
 */

namespace TunnelConflux\EasyRole;

use Illuminate\Support\ServiceProvider;

class EasyRoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->aliasMiddleware();
    }

    public function register()
    {
    }

    public function provides()
    {
        return [
            \Spatie\Permission\PermissionServiceProvider::class,
            \TunnelConflux\DevCrud\DevCrudServiceProvider::class,
        ];
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router      = $this->app['router'];
        $middlewares = [
            'role'               => \Spatie\Permission\Middlewares\RoleMiddleware::class,
            'permission'         => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        ];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        foreach ($middlewares as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }
}