<?php

namespace App\ApiModel\v4;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;

use App\ApiModel\v4\Customer;

class Customer extends Model
{
    protected $table 		=	"tblCustomer";
    protected $primaryKey	=	"intCustomerId";
    protected $dates 		=	['deleted_at'];
    
    protected $fillable 	=	[
    	"strFirstName",
    	"strMiddleName",
    	"strLastName",
    	"strAddress",
    	"strContactNo",
    	"dateBirthday",
    	"intGender",
    	"intCivilStatus"
    ];

    use SoftDeletes;

    public function downpayments(){

        return $this->hasMany('App\ApiModel\v2\Downpayment', 'intCustomerIdFK');

    }//end function

    public function collections(){

    	return $this->hasMany('App\ApiModel\v2\Collection', 'intCustomerIdFK');

    }//end function

    public function getCollectiblesAttribute(){

        return array(
        	'deciDownpaymentCollectible'		=>	$this->downpayment_collectible,
        	'deciCollectionCollectible'			=>	$this->collection_collectible,
        	'deciPreNeedCollectible'			=>	$this->pre_need_collectible
        	);

    }//end function

    public function getCollectionCollectibleAttribute(){

    	$deciCollectible 		=	0;

    	//unfinished collections
    	$collectionList 		=	$this->collections()
    		->where('boolFinish', '=', false)
    		->whereNotNull('intUnitIdFK')
    		->get();

    	foreach($collectionList as $collection){

    		$deciCollectible 	+=	$collection->deci_collectible;

    	}//end foreach

    	return $deciCollectible;

    }//end function

    public function getDownpaymentCollectibleAttribute(){

    	$deciCollectible 		=	0;

    	//unfinished downpayments
    	$downpaymentList 		=	$this->downpayments()
    		->where('boolPaid', '=', false)
    		->get();

    	foreach($downpaymentList as $downpayment){

			//downpayment is not yet fully paid
			$deciCollectible 	+= 	$downpayment->deci_balance;

    	}//end foreach

    	return $deciCollectible;

    }//end function

    public function getPreNeedCollectibleAttribute(){

    	$deciCollectible 			=	0;

    	//unfinished collections
    	$collectionList 			=	$this->collections()
    		->where('boolFinish', '=', false)
    		->whereNull('intUnitIdFK')
    		->get();

    	foreach($collectionList as $collection){

    		$deciCollectible 	+=	$collection->deci_pre_need_collectible;

    	}//end foreach

    	return $deciCollectible;

    }//end function

    public static function getCustomersWithCollectibles(){

    	$customerList           =   array();

        $downpaymentList        =   Downpayment::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        $customerList       =   Customer::addToList($downpaymentList, $customerList);

        $collectionList     =   Collection::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->where('tblCollection.boolFinish', '=', false)
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        $customerList       =	Customer::addToList($collectionList, $customerList);

        foreach($customerList as $customer){

        	$collectibleList 		=	Customer::find($customer->intCustomerId)->collectibles;
        	$customer->deciDownpaymentCollectible		=	$collectibleList['deciDownpaymentCollectible'];
        	$customer->deciCollectionCollectible		=	$collectibleList['deciCollectionCollectible'];
        	$customer->deciPreNeedCollectible		=	$collectibleList['deciPreNeedCollectible'];

        }//end foreach

        return $customerList;

    }//end function

    public static function addToList($customerListToAdd, $customerList){

        foreach($customerListToAdd as $customer){

            $boolExist          =   false;

            foreach($customerList as $customerIncluded){

                if ($customer->intCustomerId == $customerIncluded->intCustomerId){

                    $boolExist      =   true;

                }//end if

            }//end foreach   

            if (!$boolExist){

                array_push($customerList, $customer);

            }//end if

        }//end foreach

        return $customerList;

    }//end function
}
