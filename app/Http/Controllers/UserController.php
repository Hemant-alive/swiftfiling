<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Hash;
//use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.user.create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {	
    	//print_r($_POST);die;
        $user = new User([
          'user_type_id' => 2,
          'first_name' => $request->input('firstName'),
          'last_name' => $request->input('lastName'),
          'mobile_number' => $request->input('mobile'),
          'email' => $request->input('email'),
          'password' =>  bcrypt($request->input('password'))
        ]);

        $user->save();
        return redirect()->back()->with('success', 'Record added successfully!');
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
        $user = User::find($id);
        //return $user;
        return view('admin.user.edit', compact('user','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {//print_r($request->get($request));die;
        $user = User::find($request->input('id'));
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->mobile_number = $request->input('mobile');
        $user->email = $request->input('email');
        $user->save();
        //return redirect('/crud');
        return redirect()->back()->with('success', 'Record updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$user = User::find($id);
    	if($user->id == $id && $user->user_type_id == 1)
    		return redirect()->back()->with('error', 'Admin account cannot be deleted!');
      	$user->delete();
      	return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    public function changeStatus($id)
    {
    	$user = User::find($id);
    	if($user->id == $id && $user->user_type_id == 1)
    		return redirect()->back()->with('error', 'Admin account cannot be deactivated!');
        $id = explode('_', $id);
        $user_id = $id[0];
        $status = $id[1];
        if($status == 1){
        	$changed_status = 0;
        }if($status == 0){
        	$changed_status = 1;
        }

        $user = User::find($user_id);
        $user->status = $changed_status;
        $user->save();
        return redirect()->back()->with('success', 'Record updated!');
    }

}
