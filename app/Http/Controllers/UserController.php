<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use TunnelConflux\DevCrud\Controllers\DevCrudController;

class UserController extends DevCrudController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->data = User::where('role_id', '<>', 3)->latest()
            ->paginate(15);

        if (view()->exists("{$this->viewPrefix}.index")) {
            return view("{$this->viewPrefix}.index", (array)$this);
        }

        return view("dev-crud::index", (array)$this);
    }
}
