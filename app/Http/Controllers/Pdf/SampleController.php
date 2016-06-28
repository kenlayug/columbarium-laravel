<?php

namespace App\Http\Controllers\Pdf;

use App\ApiModel\v2\Block;
use App\Customer;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class SampleController extends Controller
{
   public function sample(){

       $pdf = App::make('dompdf.wrapper');
       $pdf->loadView('pdf.downpayment', [

       ]);
       return $pdf->stream('downpayment.pdf');

   }
}
