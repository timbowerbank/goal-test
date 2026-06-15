<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


abstract class Controller
{
    // use the authorize method for policies
    use AuthorizesRequests;
}
