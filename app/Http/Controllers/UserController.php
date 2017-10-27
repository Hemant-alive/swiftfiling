<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\User;
use Hash;
use Illuminate\Support\Facades\DB;
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
        /*$user = array(
          'user_type_id' => 2,
          'first_name' => $request->input('firstName'),
          'last_name' => $request->input('lastName'),
          'mobile_number' => $request->input('mobile'),
          'email' => $request->input('email'),
          //'remember_token' => User::get
          //'password' =>  Hash::make("'".$request->input('password')."'")
          'password' =>  bcrypt($request->input('password')),
          //'created_at' => 'NOW()'
        );*/
        //echo '<pre>';print_r($user);
        //return $request->get('firstName');

        
       /* DB::table('users')->insert($user);*/
        return redirect()->back()->with('message', 'Record added!');
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
        //return view('admin.user.edit', compact('user'));
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
        $user->first_name = $request->get('firstName');
        $user->first_name = $request->get('lastName');
        $user->first_name = $request->get('mobile');
        $user->first_name = $request->get('email');
        $user->save();
        //return redirect('/crud');
        return redirect()->back()->with('message', 'Record updated!');
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
