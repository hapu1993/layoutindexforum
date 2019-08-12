<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\User;
use Response;
use Hash;       
use Validator;

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
        return view('users.index');
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
        $user = User::find($id);
        // dd($user);
        return $user;
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
        // dd($request->all());
        $validator = $this->validateData($request->all(),$id);
            if ($validator->fails()) {
              return Response::json($validator->errors(), 422);
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password && $request->confirm_password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return response()->json(['msg' => 'User Updated Successfully'], 200);



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
        $user = User::find($id);
        $user->delete();
        return response()->json(['msg' => 'User Deleted Successfully'], 200);

    }

    public function getAll()
    {
        $user = User::whereRole('user')->get();
        // dd($user);
        return Datatables::of($user)
         ->addColumn(
            'action', function ($row) {
                return '<a class="btn btn-info" id="btn-info" data-id="'.$row->id.'">
                    EDIT
                </a>
                <button type="button" class="btn btn-danger" data-id="'.$row->id.'" onclick="deleteUser('.$row->id.')">
                    DELETE
                </button>';
            })
         ->rawColumns(['action'])
        ->make(true);
    }

    public function validateData($data, $id = 0)
    {
    $rules = [

            'name' => 'required|max:255',
            'email'=>'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm_password',
        'confirm_password' => 'required_with:password'

        ];


    $msg = [

            'name.required' => 'User name is required',
            'name.max' => 'User Name exceeded character limit',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password should be at least 6 characters',
            'password.confirmed' => 'Password Confimation did not match',
            'admin_password.required' => 'Current User Password is required',
    ];

    return Validator::make($data,$rules,$msg);
}
}
