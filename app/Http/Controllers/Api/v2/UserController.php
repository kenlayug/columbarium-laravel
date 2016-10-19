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
        return response()
            ->json(
                [
                    'employeeList'      =>  $this->queryEmployee(null)
                ],
                200
            );
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
        $user = User::create([
            'strFirstName'          =>  $request->strFirstName,
            'strMiddleName'         =>  $request->strMiddleName,
            'strLastName'           =>  $request->strLastName,
            'intPositionIdFK'       =>  $request->intPositionId,
            'dateBirthday'          =>  $request->dateBirthday,
            'strAddress'            =>  $request->strAddress,
            'password'              =>  bcrypt($request->strPassword),
            'email'                 =>  $request->strEmail,
            'strPhotoDirectory'     =>  ''
        ]);

        return response()
            ->json(
                [
                    'user'          =>  $user,
                    'message'       =>  'Employee is successfully created.'
                ],
                201
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()
            ->json(
                [
                    'employee'          =>  $this->queryEmployee($id)
                ],
                200
            );
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
        $user = User::find($id);

        $user->strFirstName             =   $request->strFirstName;
        $user->strMiddleName            =   $request->strMiddleName;
        $user->strLastName              =   $request->strLastName;
        $user->intPositionIdFK          =   $request->intPositionId;
        $user->strAddress               =   $request->strAddress;
        $user->dateBirthday             =   $request->dateBirthday;
        $user->password                 =   bcrypt($request->strPassword);

        $user->save();

        return response()
            ->json(
                [
                    'user'          =>  $user,
                    'message'       =>  'Employee is successfully updated.'
                ],
                200
            );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user   =   User::find($id);

        $user->delete();

        return response()
            ->json(
                [
                    'user'      =>  $user,
                    'message'   =>  'Employee is successfully deactivated.'
                ],
                200
            );
    }

    public function queryEmployee($id){

        $employee           =   User::select(
            'id',
            'strFirstName',
            'strMiddleName',
            'strLastName',
            'strAddress',
            'dateBirthday',
            'intPositionId',
            'strPositionName'
            )
            ->join('tblPosition', 'tblPosition.intPositionId', '=', 'users.intPositionIdFK');

        if ($id){
            return $employee->where('id', '=', $id)
                ->first();
        }

        return $employee->get();

    }//end function
}
