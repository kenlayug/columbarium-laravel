<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    protected $table 			=	"tblDiscount";
    protected $primaryKey 		=	"intDiscountId";
    protected $dates 			=	[
    	"deleted_at"
    ];
    protected $fillable 		=	[
    	"strDiscountName"
    ];

    use SoftDeletes;

    public function getDiscountRateAttribute(){
        return $this->attributes['deciDiscountRate'];
    }//end function

    public function setDiscountRateAttribute($value){
        $this->attributes['deciDiscountRate']   =   $value;
    }//end function

    public static function queryDiscount($id){

        $discountList       =   Discount::select(
            'tblDiscount.strDiscountName',
            'tblDiscount.intDiscountId'
            );

        if ($id){

            $discount       =   $discountList->where('tblDiscount.intDiscountId', '=', $id)
                ->first();

            return Discount::queryDiscountRate($discount);

        }//end if

        $discountList       =   $discountList->get();

        foreach($discountList as $discount){

            $discount       =   Discount::queryDiscountRate($discount);

        }//end foreach

        return $discountList;

    }//end function

    public static function queryDiscountRate($discount){

        $discountRate   =   DiscountRate::where('intDiscountIdFK', '=', $discount->intDiscountId)
            ->orderBy('created_at', 'desc')
            ->first(['deciDiscountRate', 'intDiscountType']);

        $discount->discount_rate            =   $discountRate->deciDiscountRate;
        $discount->intDiscountType            =   $discountRate->intDiscountType;

        return $discount;

    }//end function
}
