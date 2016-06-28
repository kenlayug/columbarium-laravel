<?php

namespace App\Http\Controllers\Pdf;

use App\Reservation;
use App\ReservationDetail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class ReservationPdfController extends Controller
{
    public function generate($id){


        $reservation = Reservation::join('tblCustomer', 'tblCustomer.intCustomerId', '=',
                        'tblReservation.intCustomerIdFK')
                        ->where('tblReservation.intReservationId', '=', $id)
                        ->first([
                            'tblReservation.intReservationId',
                            'tblReservation.created_at',
                            'tblCustomer.intCustomerId',
                            'tblCustomer.strFirstName',
                            'tblCustomer.strMiddleName',
                            'tblCustomer.strLastName',
                            'tblReservation.deciAmountPaid'
                        ]);

        $reservation->payment_type = 'Cash';

        $reservationDetailList = ReservationDetail::join('tblUnit', 'tblReservationDetail.intUnitIdFK', '=', 'tblUnit.intUnitId')
                        ->join('tblBlock', 'tblUnit.intBlockIdFK', '=', 'tblBlock.intBlockId')
                        ->join('tblRoom', 'tblBlock.intRoomIdFK', '=', 'tblRoom.intRoomId')
                        ->join('tblFloor', 'tblRoom.intFloorIdFK', '=', 'tblFloor.intFloorId')
                        ->join('tblBuilding', 'tblFloor.intBuildingIdFK', '=', 'tblBuilding.intBuildingId')
                        ->join('tblUnitCategoryPrice', 'tblReservationDetail.intUnitCategoryPriceIdFK', '=',
                            'tblUnitCategoryPrice.intUnitCategoryPriceId')
                        ->where('tblReservationDetail.intReservationIdFK', '=', $id)
                        ->orderBy('tblUnit.intUnitId')
                        ->get([
                            'tblUnit.intUnitId',
                            'tblUnit.intColumnNo',
                            'tblBlock.intUnitType',
                            'tblUnitCategoryPrice.deciPrice',
                            'tblBuilding.strBuildingName',
                            'tblFloor.intFloorNo',
                            'tblRoom.intRoomNo',
                            'tblBlock.strBlockName'
                        ]);

        foreach ($reservationDetailList as $reservationDetail){

            if ($reservationDetail->intUnitType == 1){
                $reservationDetail->unit_type = 'Columbarium Vault';
            }else if($reservationDetail->intUnitType == 2){
                $reservationDetail->unit_type = 'Full Body Crypt';
            }

        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.sample', [
            'reservation'                   =>  $reservation,
            'reservationDetailList'         =>  $reservationDetailList
        ]);
        return $pdf->stream('sample.pdf');

    }
}
