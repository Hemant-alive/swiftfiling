<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\ShippingDetail;
use Session;
use DB;
use Validator;
use Request;
use Hash;
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
    /*public function jjjj()
    {
        die('ssss');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //die('sssssss');
         /*$this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cpassword' => 'required',
        ]);*/
         /*if($request->get('password') != $request->get('cpassword')){
            return redirect()->back()->with('error', 'Password not match!');
        }*/

        /*return [
          'user_type_id' => 2,
          'first_name' => Request::get('firstName'),
          'last_name' => Request::get('lastName'),
          'mobile_number' => Request::get('mobile'),
          'email' => Request::get('email'),
          'password' =>  Hash::make("'".Request::get('password')."'")
        ];*/

        $user = new User([
          'user_type_id' => 2,
          'first_name' => Request::get('firstName'),
          'last_name' => Request::get('lastName'),
          'mobile_number' => Request::get('mobile'),
          'email' => Request::get('email'),
          'password' =>  Hash::make("'".Request::get('password')."'")
        ]);
        return Request::all();

        $user->save();
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
