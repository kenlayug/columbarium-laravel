<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    protected $table		=	'tblCheque';
    protected $primaryKey	=	'intChequeId';
    public $timestamps   =   false;
    protected $fillable 	=	[
    	'strBankName',
    	'strReceiver',
    	'strChequeNo',
    	'dateCheque',
    	'strAccountHolderName',
    	'strAccountNo'
    ];
}
