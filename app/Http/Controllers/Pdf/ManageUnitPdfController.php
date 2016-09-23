<?php

namespace App\Http\Controllers\Pdf;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v2\TransactionDeceased;

use Carbon\Carbon;

use App;

class ManageUnitPdfController extends Controller
{
    public function generatePdf($id){

    	$transactionDeceased 		=	TransactionDeceased::select(
    		'tblTransactionDeceased.intTransactionDeceasedId',
    		'tblTransactionDeceased.created_at',
    		'tblTransactionDeceased.intTransactionType',
    		'tblTransactionDeceased.deciAmountPaid',
    		'tblCustomer.strFirstName',
    		'tblCustomer.strMiddleName',
    		'tblCustomer.strLastName',
    		'tblDeceased.strFirstName as strDeceasedFirst',
    		'tblDeceased.strMiddleName as strDeceasedMiddle',
    		'tblDeceased.strLastName as strDeceasedLast',
    		'tblDeceased.dateDeath',
    		'tblTDeceasedDetail.dateReturn',
    		'tblStorageType.strStorageTypeName',
    		'tblUnit.intColumnNo',
    		'tblUnitCategory.intLevelNo',
    		'tblService.strServiceName',
    		'tblServicePrice.deciPrice'
    		)
    		->join('tblTDeceasedDetail', 'tblTransactionDeceased.intTransactionDeceasedId', '=', 'tblTDeceasedDetail.intTDeceasedIdFK')
    		->join('tblUnitDeceased', 'tblUnitDeceased.intUnitDeceasedId', '=', 'tblTDeceasedDetail.intUDeceasedIdFK')
    		->join('tblStorageType', 'tblStorageType.intStorageTypeId', '=', 'tblUnitDeceased.intStorageTypeIdFK')
    		->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblTDeceasedDetail.intServiceIdFK')
    		->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTDeceasedDetail.intServicePriceIdFK')
    		->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblUnitDeceased.intUnitIdFK')
    		->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
    		->join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
    		->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblUnit.intCustomerIdFK')
    		->where('tblTransactionDeceased.intTransactionDeceasedId', '=', $id)
    		->get();

    	$transactionDetail 		=	array(
    		'intTransactionId'		=>	$transactionDeceased[0]->intTransactionDeceasedId,
    		'strCustomerName'		=>	$transactionDeceased[0]->strLastName.', '.$transactionDeceased[0]->strFirstName.' '.$transactionDeceased[0]->strMiddleName,
    		'intUnitId'				=>	$transactionDeceased[0]->intColumnNo.$transactionDeceased[0]->intLevelNo,
    		'intTransactionType'	=>	$transactionDeceased[0]->intTransactionType,
    		'deciAmountPaid'		=>	$transactionDeceased[0]->deciAmountPaid,
			'strServiceName'		=>	$transactionDeceased[0]->strServiceName,
			'deciServicePrice'		=>	$transactionDeceased[0]->deciPrice,
    		'dateTransaction'		=>	Carbon::parse($transactionDeceased[0]->created_at)->toFormattedDateString()
    		);

    	$deceasedList 			=	array();
    	$deciTotalAmountToPay 	=	0;
    	foreach($transactionDeceased as $deceased){

    		$deciTotalAmountToPay 		+=	$deceased->deciServicePrice;
    		$deceased 		=	array(
    			'strDeceasedName'		=>	$deceased->strDeceasedLast.', '.$deceased->strDeceasedFirst.' '.$deceased->strDeceasedMiddle,
    			'strStorageTypeName'	=>	$deceased->strStorageTypeName,
    			'dateDeath'				=>	Carbon::parse($deceased->dateDeath)->toFormattedDateString(),
    			'intUnitId'				=>	chr(64+$deceased->intLevelNo).$deceased->intColumnNo,
    			'dateReturn'			=>	Carbon::parse($deceased->dateReturn)->toFormattedDateString()
    			);
    		array_push($deceasedList, $deceased);

    	}//end foreach

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.manage-unit-success', [
        	'transactionDetail'		=>	$transactionDetail,
        	'deciTotalAmountToPay'	=>	$deciTotalAmountToPay,
        	'deceasedList'			=>	$deceasedList
		]);
        return $pdf->stream('manage-unit-success.pdf');

    }//end function
}
