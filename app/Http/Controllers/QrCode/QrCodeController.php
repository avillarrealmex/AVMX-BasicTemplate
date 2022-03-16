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


}
