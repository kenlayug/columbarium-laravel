<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class StorageType extends Model
{
    protected $table        =   'tblStorageType';
    protected $primaryKey   =   'intStorageTypeId';
    protected $fillable     =   [
        'strStorageTypeName'
    ];
}
