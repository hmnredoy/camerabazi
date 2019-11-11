<?php
/**
 * Project      : Easy Role
 * File Name    : RoleController.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/18 4:05 PM
 */

namespace TunnelConflux\EasyRole\Controllers;


use TunnelConflux\DevCrud\Controllers\DevCrudController;
use TunnelConflux\EasyRole\Models\Role;

class RoleController extends DevCrudController
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
        $this->routePrefix = 'role';
    }
}