<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function addQrCode(){
        return QrCode::generate(
            'Hello, World!',
        );
    }
}
