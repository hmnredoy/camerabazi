<?php

use TunnelConflux\DevCrud\Helpers\DevCrudHelper;

app("router")->middleware('web')->namespace("TunnelConflux\EasyRole\Controllers")->group(function () {
    DevCrudHelper::setRoutes('permission', 'PermissionController');
    DevCrudHelper::setRoutes('role', 'RoleController');
});