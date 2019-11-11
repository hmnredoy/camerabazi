<?php
/**
 * Project      : Loreal TMR Automation
 * File Name    : Role.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/21 1:55 PM
 */

namespace TunnelConflux\EasyRole\Models;

use TunnelConflux\DevCrud\Models\DevCrudModel;
use TunnelConflux\DevCrud\Models\JoinModel;

class Role extends DevCrudModel
{
    protected $fillable = ['name', 'guard_name'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        parent::__construct($attributes);
        $this->setTable(config('permission.table_names.roles'));
        $this->relationalFields = [
            'permissions' => new JoinModel(Permission::class, 'id', 'name', null, 'manyToMany'),
        ];
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, config('permission.table_names.role_has_permissions'));
    }
}