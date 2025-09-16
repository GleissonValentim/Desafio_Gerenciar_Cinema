<?php

namespace App\Http\Controllers;
use LaravelQRCode\Facades\QRCode;

class QrCodeController extends Controller
{
    public function create(){
        $qrCodeImage = QRCode::text('Olá, mundo do Laravel!')->svg();

        return view('eu', ['qrCode' => $qrCodeImage]);
    }
}
