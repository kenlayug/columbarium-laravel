<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\ApiModel\v2\Position;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserSeed extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $position           =   Position::create([
            'strPositionName'       =>  'Admin',
            'intUserAuth'           =>  1
            ]);

        $user               =   User::create([
            'strFirstName'          =>  'Ken',
            'strMiddleName'         =>  'Malit',
            'strLastName'           =>  'Layug',
            'email'                 =>  'ken_layug@yahoo.com',
            'password'              =>  bcrypt('kenlayug1'),
            'dateBirthday'          =>  Carbon::parse('November 8, 1996'),
            'strAddress'            =>  'QC',
            'intPositionIdFK'       =>  $position->intPositionId
            ]);
        echo 'Tapos na.';
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
}
