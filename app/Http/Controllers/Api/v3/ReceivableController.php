<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
use App\ApiModel\v2\Downpayment;

use App;
use Carbon\Carbon;
use DB;

class ReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(
                [
                    'receivableList'        =>  $this->queryTabularReceivables()
                ],
                200
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generatePdf(){

        $receivableList             =   $this->queryTabularReceivables();
        $deciTotalReceivables       =   0;
        $intTransactionNo           =   0;
        $categoryList               =   array(
            '',
            'Regular Collections',
            'Downpayments'
            );

        foreach($receivableList as $receivable){

            $intTransactionNo++;
            $deciTotalReceivables       +=  $receivable['deciAmountToReceive'];

        }//end foreach

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'landscape');
        $pdf->loadView('pdf.receivables-report', [
            'deciTotalReceivables'      =>  $deciTotalReceivables,
            'receivableList'            =>  $receivableList,
            'categoryList'              =>  $categoryList,
            'intTransactionNo'          =>  $intTransactionNo
            ]);
        return $pdf->stream('receivables-report.pdf');

    }//end function

    public function queryTabularReceivables(){

        $receivableList          =   array();

        foreach($this->queryCollections() as $collection){

            if ($collection['deciAmountToReceive'] > 0){
                array_push($receivableList, $collection);
            }

        }//end foreach
        foreach($this->queryDownpayments() as $downpayment){

            array_push($receivableList, $downpayment);

        }//end foreach

        $collection             =   collect($receivableList);
        $sortedCollection       =   $collection->sortBy('strCustomerName');

        return $sortedCollection->values()
                        ->all();

    }//end function

    public function queryCollections(){

        $gracePeriod                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
            ->first(['deciBusinessDependencyValue']);

        $receivableList             =   array();

        $collectionList             =   Collection::select(
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblCollection.intCollectionId',
            'tblUnitCategoryPrice.deciPrice',
            'tblInterest.intNoOfYear',
            'tblInterestRate.deciInterestRate',
            'tblCollection.dateCollectionStart',
            'tblCollection.intUnitIdFK'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->get();

        foreach($collectionList as $collection){

            $lastCollectionPayment      =   CollectionPayment::select(
                'tblCollectionPaymentDetail.dateDue'
                )
                ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('intCollectionIdFK', '=', $collection->intCollectionId)
                ->orderBy('tblCollectionPayment.created_at', 'desc')
                ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                ->first();

            $dateNow                =   Carbon::now()
                ->startOfDay();
            $dateLastPayment        =   Carbon::parse($lastCollectionPayment->dateDue)
                ->addMonth();

            $dateCollection         =   Carbon::parse($lastCollectionPayment->dateDue);

            $deciAmountToReceive    =   0;
            $deciMonthlyAmortization    =   (new CollectionBusiness())
                ->getMonthlyAmortization($collection->deciPrice, $collection->deciInterestRate, $collection->intNoOfYear);

            $intCtr                 =   0;
            while($dateNow->month >= $dateLastPayment->month && $dateNow->year >= $dateLastPayment->year){

                $intMonthDue            =   0;

                $datePenalty                =   Carbon::parse($dateLastPayment)
                    ->addDays($gracePeriod->deciBusinessDependencyValue);

                if ($dateNow >= $dateLastPayment){

                    $deciAmountToReceive        +=  $deciMonthlyAmortization;

                }//end if

                if ($datePenalty <= $dateNow){
                
                    $intMonthDue                =   $dateLastPayment->diffInMonths($dateCollection);

                }//end if

                if ($intMonthDue > 0){

                    $deciAmountToReceive        +=  (new PenaltyBusiness())
                        ->getPenalty($deciMonthlyAmortization, $intMonthDue);

                }//end if

                $dateLastPayment->addMonth();
                $intCtr++;

            }//end for

            $receivable             =   array(
                'strCustomerName'                   =>  $collection->strLastName.', '.$collection->strFirstName.' '.$collection->strMiddleName,
                'deciAmountToReceive'               =>  $deciAmountToReceive,
                'intUnitId'                         =>  $collection->intUnitIdFK,
                'intCategory'                       =>  1,
                'deciPrice'                         =>  $collection->deciPrice
                );

            array_push($receivableList, $receivable);

        }//end foreach

        return $receivableList;

    }//end public

    public function queryDownpayments(){

        $receivableList             =   array();

        $downpaymentBD              =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $discountSpotdown           =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
            ->first(['deciBusinessDependencyValue']);

        $dateNow                    =   Carbon::today();

        $downpaymentList            =   Downpayment::select(
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblDownpayment.intDownpaymentId',
            DB::raw('SUM(tblDownpaymentPayment.deciAmountPaid) as deciTotalPayment'),
            'tblUnitCategoryPrice.deciPrice',
            'tblDownpayment.created_at',
            'tblDownpayment.intUnitIdFK'
            )
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblDownpayment.intDownpaymentId')
            ->get();

        foreach($downpaymentList as $downpayment){

            $deciDownpaymentAmount          =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;
            if (Carbon::parse($downpayment->created_at)
                ->addDays(7) >= $dateNow){
                $deciDownpaymentAmount      -=  ($deciDownpaymentAmount * $discountSpotdown->deciBusinessDependencyValue);
            }//end if

            $receivable                     =   array(
                'intUnitId'                 =>  $downpayment->intUnitIdFK,
                'strCustomerName'           =>  $downpayment->strLastName.', '.$downpayment->strFirstName.' '.$downpayment->strMiddleName,
                'deciAmountToReceive'       =>  $deciDownpaymentAmount - $downpayment->deciTotalPayment,
                'intCategory'               =>  2,
                'deciPrice'                 =>  $downpayment->deciPrice
                );

            if ($receivable['deciAmountToReceive'] > 0){

                array_push($receivableList, $receivable);

            }//end if

        }//end foreach

        return $receivableList;

    }//end function
}
