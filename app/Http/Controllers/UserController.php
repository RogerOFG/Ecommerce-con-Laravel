<?php

namespace App\Http\Controllers;

use App\Models\userModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
