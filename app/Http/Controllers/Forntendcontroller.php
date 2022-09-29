<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Forntendcontroller extends Controller
{
   
        public function index(){
            return view("welcome");
        }
    }


