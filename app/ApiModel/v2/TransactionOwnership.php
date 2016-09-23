<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class TransactionOwnership extends Model
{
    protected $table            =   'tblTransactionOwnership';
    protected $primaryKey       =   'intTransactionOwnershipId';

    protected $fillable         =   [
        'intPrevOwnerIdFK', 'intNewOwnerIdFK', 'deciAmountPaid', 'intPaymentType', 'intUnitIdFK', 'intChequeIdFK'
    ];

    public function getNewOwnerAttribute(){
    	return $this->attributes['newOwnerName'];
    }

    public function setNewOwnerAttribute($value){
    	$this->attributes['newOwnerName']		=	$value;
    }

    public function getPrevOwnerAttribute(){
    	return $this->attributes['prevOwnerName'];
    }

    public function setPrevOwnerAttribute($value){
    	$this->attributes['prevOwnerName']		=	$value;
    }

    public function getAmountAttribute(){
    	return $this->attributes['deciAmount'];
    }

    public function setAmountAttribute($value){
    	$this->attributes['deciAmount']		=	$value;
    }
}
