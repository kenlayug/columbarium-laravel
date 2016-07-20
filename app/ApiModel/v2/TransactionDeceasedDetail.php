<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class TransactionDeceasedDetail extends Model
{
    protected $table        =   'tblTDeceasedDetail';
    protected $primaryKey   =   'intTDeceasedDetailId';
    protected $fillable      =   [
        'intTDeceasedIdFK', 'intUDeceasedIdFK', 'dateReturn'
    ];
}
