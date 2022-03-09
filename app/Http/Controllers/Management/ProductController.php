<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Sección de vistas
     */

    public function viewProductTable() {
        return view('management.product');
    }

    /**
     * Sección para funciones y procedimientos
     */
}
