<?php

namespace App\Http\Controllers\Management;
use App\Models\Providers;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    /**
     * Sección de vistas
     */

    public function viewProviderTable() {
        return view('management.provider');
    }

    /**
     * Sección para funciones y procedimientos
     */

    static function listAllFromView() {
        $query = Providers::select('id AS id', 'name AS description')
            ->orderby('name');
        $products = $query->get();

        return $products;
    }
}
