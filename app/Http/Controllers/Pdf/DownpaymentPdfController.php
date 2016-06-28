<?php

namespace App\Http\Controllers\Pdf;

use App\ApiModel\v2\Downpayment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class DownpaymentPdfController extends Controller
{
    public function generate($id){

        $downPayment = Downpayment::join('tblReservationDetail', 'tblReservationDetail.intReservationDetailId', '=',
                        'tblDownpayment.intReservationDetailIdFK')
                        ->join('tblReservation', 'tblReservation.intReservationId', '=', 'tblReservationDetail.intReservationIdFK')
                        ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblReservation.intCustomerIdFK')
                        ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblReservationDetail.intUnitIdFK')
                        ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
                        ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblReservationDetail.intUnitCategoryPriceIdFK')
                        ->where('tblDownpayment.intDownpaymentId', '=', $id)
                        ->first([
                            'tblDownpayment.intDownpaymentId',
                            'tblCustomer.strFirstName',
                            'tblCustomer.strMiddleName',
                            'tblCustomer.strLastName',
                            'tblDownpayment.created_at',
                            'tblDownpayment.intPaymentType',
                            'tblUnit.intUnitId',
                            'tblBlock.intUnitType',
                            'tblDownpayment.deciAmount',
                            'tblUnitCategoryPrice.deciPrice',
                            'tblReservationDetail.intReservationDetailId'
                        ]);

        if ($downPayment->intUnitType == 1){
            $downPayment->unit_type = 'Columbary Vault';
        }else{
            $downPayment->unit_type = 'Full Body Crypt';
        }

        if ($downPayment->intPaymentType == 1){
            $downPayment->payment_type = 'Cash';
        }else{
            $downPayment->payment_type = 'Cheque';
        }

        $paymentPrevMaid = Downpayment::where('intReservationDetailIdFK', '=', $downPayment->intReservationDetailId)
                        ->where('intDownpaymentId', '!=', $id)
                        ->sum('deciAmount');

        $paymentAllMaid = Downpayment::where('intReservationDetailIdFK', '=', $downPayment->intReservationDetailId)
                            ->sum('deciAmount');

        $balance = ($downPayment->deciPrice*.3) - $paymentAllMaid;

        $balanceBeforeTransac = ($downPayment->deciPrice*.3) - $paymentPrevMaid;

        $change = $downPayment->deciAmount - $balanceBeforeTransac;
        if($change < 0){
            $change = 0;
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.downpayment', [
            'downPayment'       =>  $downPayment,
            'balance'           =>  $balance,
            'change'            =>  $change
        ]);
        return $pdf->stream('downpayment.pdf');

    }
}
