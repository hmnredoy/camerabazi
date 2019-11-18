<?php

namespace App\Models;

use App\Models\Enums\SkillToolTypes;
use Illuminate\Database\Eloquent\Model;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class SkillTool extends DevCrudModel
{
    protected $fillable = ['title','type','status'];

    protected $listColumns = ['title', 'type', 'status'];

    protected $infoItems = ['title', 'type', 'status'];

    public function getTypeAttribute(){
        return ucwords(SkillToolTypes::getKey($this->attributes['type'] ?? 'N\A'));
    }

    public function getFormAble()
    {
        $form = parent::getFormAble();
        $form['type'] ? $form['type']->setOptions(SkillToolTypes::getHumanKeys())->setType('select') : null;
        return $form;
    }
}
