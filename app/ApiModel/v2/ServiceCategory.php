<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'tblServiceCategory';
    protected $primaryKey = 'intServiceCategoryId';
    protected $fillable = [
        'strServiceCategoryName',
        'intServiceType',
        'intServiceSchedulePerDay',
        'intServiceDayInterval'
    ];
}
