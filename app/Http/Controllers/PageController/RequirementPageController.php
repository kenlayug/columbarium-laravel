<?php

namespace App\Http\Controllers\PageController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RequirementPageController extends Controller
{
    public function pageUp(){
        return view('requirementMaintenance');
    }
}
