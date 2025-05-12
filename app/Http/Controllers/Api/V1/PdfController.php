<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $pdf = Pdf::loadView('pdf.invoice',);
        return $pdf->download('invoice.pdf');
    }
}
