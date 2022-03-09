<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Sección de vistas
     */

    public function viewuserTable() {
        return view('management.user');
    }

    /**
     * Sección para funcionesy procedimientos
     */
}
