<?php

namespace App\Http\Controllers\QrCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class QrCodeController extends Controller
{
    public function viewGenerateQrCode() {
        $this->generateQrCode();
        return view('qrCode.qrGenerator');
    }

    public function viewScanQrCode() {
        return view('qrCode.qrScan');
    }

    private function generateQrCode() {
        if (!extension_loaded('imagick')){
            dd('imagick not installed');
        }
        return \QrCode::format('png')
            ->merge('images/logoBienestar.png', 0.3, true)
            ->size(250)
            ->color(120, 204, 109)
            ->errorCorrection('H')
            ->generate('https://intranet.nikken.com.mx:8049/rmank/Nzk0NDIwM3wy', public_path('images/qrAdviserNikken.png'));
    }

    public function readCSV(Request $request) {
        $linea = 0;
        //Abrimos nuestro archivo
        $archivo = "C:/Nikken/Datos archivos.csv";
        $fila = 1;
        if (($gestor = fopen($archivo, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                $folderName = "C:/xampp/htdocs/backend/".trim($datos[1]);
                $pathFileToMove = "C:/xampp/htdocs/backend/".trim($datos[1])."/".trim($datos[0]);
                $originalPath = "C:/xampp/htdocs/backend/".trim($datos[0]);
                //Se crea una nueva carpeta si no existe
                if (!file_exists($folderName)) {
                    mkdir($folderName, 0777, true);
                }
                //Validamos si el archivo existe
                if ((!file_exists($pathFileToMove)) && (file_exists($originalPath))) {
                    copy($originalPath, $pathFileToMove);
                    echo "<p> El archivo ".$datos[0]." de la fila $fila se copio correctamente <br /></p>\n";
                } else {
                    echo "<p> El archivo ".$datos[0]." de la fila $fila ya existe en el servidor <br /></p>\n";
                }
            }
            fclose($gestor);
        }
    }
}
