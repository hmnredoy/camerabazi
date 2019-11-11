<?php
/**
 * Project      : Easy Role
 * File Name    : Permission.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/21 1:36 PM
 */

namespace TunnelConflux\EasyRole\Models;

use TunnelConflux\DevCrud\Models\DevCrudModel;

class Permission extends DevCrudModel
{
    protected $fillable = ['name', 'guard_name'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        parent::__construct($attributes);
        $this->setTable(config('permission.table_names.permissions'));
    }
}