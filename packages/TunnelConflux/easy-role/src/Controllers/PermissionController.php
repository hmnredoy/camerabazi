<?php
/**
 * Project      : Easy Role
 * File Name    : PermissionController.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/18 4:03 PM
 */

namespace TunnelConflux\EasyRole\Controllers;

use TunnelConflux\DevCrud\Controllers\DevCrudController as Controller;
use TunnelConflux\EasyRole\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
        $this->isCreatable = false;
        $this->isEditable  = false;
        $this->isDeletable = false;
        $this->isViewable  = false;
        $this->routePrefix = 'permission';
    }
}