<?php

namespace App\Http\Controllers\Humancapital;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Custom\NikkenFunctions;

class SmoRoomScheduleController extends Controller
{
    public $nikkenFunctions;

    public function __construct()
    {
        $this->nikkenFunctions = new NikkenFunctions();
    }
    /**
     * Sección de vistas
     */
    //Vista del index
    public function viewIndex(Request $request) {
        try {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('humanCapital.smoRoomSchedule.index', [

                    ])->render()
                ]);
            } else {
                return view('humanCapital.smoRoomSchedule.index', [

                ]);
            }
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['error' => $th->getMessage()], 500); // Status code here
            } else {
                return view('layouts.errors.500', ['message' => $th->getMessage()]);
            }
        }
    }

    /**
     * Funciones del controlador
     */
}
