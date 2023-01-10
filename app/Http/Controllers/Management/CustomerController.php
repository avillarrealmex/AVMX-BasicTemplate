<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Sección de vistas
     */

    public function viewCustomerTable() {
        return view('management.customer');
    }

    /**
     * Sección para funciones y procedimientos
     */
}
