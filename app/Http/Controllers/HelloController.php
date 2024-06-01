<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HelloController extends Controller
{
    public function show(): string
    {
        return "Hello, World!";
    }

}
