<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TunnelConflux\DevCrud\Controllers\DevCrudController;
use App\Models\Question;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }
}
