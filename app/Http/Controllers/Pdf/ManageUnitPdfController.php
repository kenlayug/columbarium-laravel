<?php

namespace App\Http\Controllers\Pdf;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App;

class ManageUnitPdfController extends Controller
{
    public function generatePdf($id){

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.manage-unit-success');
        return $pdf->stream('manage-unit-success.pdf');

    }//end function
}
