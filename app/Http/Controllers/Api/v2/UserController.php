<?php

namespace App\Http\Controllers\Api\v2;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $fileName = null;
        $strPhotoDirectory = null;
        if ($request->hasFile('photo')){

            if ($request->file('photo')->isValid()){

                $milliseconds = round(microtime(true) * 1000);
                $fileName = $milliseconds.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move(public_path().'/employee-photos/', $fileName);
                $strPhotoDirectory = '/employee-photos/'.$fileName;

            }

        }
        if($fileName == null){
            $strPhotoDirectory = null;
        }


        $user = User::create([
            'strFirstName'          =>  $request->strFirstName,
            'strMiddleName'         =>  $request->strMiddleName,
            'strLastName'           =>  $request->strLastName,
            'intPositionIdFK'       =>  $request->intPositionId,
            'strAddress'            =>  $request->strAddress,
            'password'              =>  bcrypt($request->strPassword),
            'email'                 =>  $request->strEmail,
            'strPhotoDirectory'     =>  $strPhotoDirectory
        ]);
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
