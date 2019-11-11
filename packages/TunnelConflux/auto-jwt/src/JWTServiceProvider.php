<?php
/**
 * Project      : Auto JWT
 * File Name    : JWTServiceProvider.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/17 5:49 PM
 */

namespace TunnelConflux\AutoJWT;

use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function register()
    {
    }

    public function provides()
    {
        return [
            Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        ];
    }
}
