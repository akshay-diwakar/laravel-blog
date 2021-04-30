<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	return view('Backend.Admin.DashBoard');
    }
}
