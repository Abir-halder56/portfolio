<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
 
    public function portfolio(){
        return view("admin.portfolio");
    }

}
