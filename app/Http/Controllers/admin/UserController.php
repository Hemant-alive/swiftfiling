<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('search') === 'search'){
            $this->validate($request, [
                'status' => 'nullable|numeric',
                'name' => 'nullable|regex:/^[\pL\s\-]+$/u',
                'email' => 'nullable|email',
                'mobile' => 'nullable|numeric|min:10',
                
            ]);

            $query = User::select();
            if(!empty($request->input('name'))){
                if(strpos($request->input('name'), ' ')){
                    $name = explode(' ', $request->input('name'));
                    $firstname = $name[0];
                    $lastname = $name[1];
                }else{
                    $firstname = $request->input('name');
                    $lastname = $request->input('name');
                }
                $query->orWhere('first_name', 'like', '%' . $firstname . '%');
                $query->orWhere('last_name', 'like', '%' . $lastname . '%');
            }
            if(!empty($request->input('email'))){
                $query->orWhere('email', 'like', '%' . $request->input('email') . '%');
            }
            if(!empty($request->input('mobile'))){
                $query->orWhere('mobile_number', 'like', '%' . $request->input('mobile') . '%');
            }

            /*if(!empty($request->input('name')) || !empty($request->input('email')) || !empty($request->input('mobile'))){*/
                
                try{
                    $query->orWhere('status', $request->input('status'));
                    $query->where('role_id','!=',1);
                    $users = $query->paginate(5);
                } catch(\Illuminate\Database\QueryException $ex){ 
                    //dd($ex->getMessage()); 
                    return redirect()->back()->with('error', 'Searching failed.Please Try again!');
                }
            /*}else{
                return redirect('admin/user')->with('error', 'Please Enter one of the search field!');
            }*/

            return view('admin.user.index', compact('users'));
        }else{
            $users = User::select()
                ->where('role_id','!=',1)
                ->orderBy('role_id', 'asc')
                ->orderBy('first_name', 'desc')
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate(5);
        }
        
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $roles = DB::table('user_roles')->where('id','!=',1)->get();
        return view('admin.user.create', compact('roles'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
    	$this->validate($request, [
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'role_id' => 'required|numeric',
            'mobile' => 'required|numeric|digits_between:1,10',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            //'cpassword' => 'required|min:6',
            
        ]);

        try { 
            $user = new User([
              'role_id' => $request->input('role_id'),
              'first_name' => $request->input('firstName'),
              'last_name' => $request->input('lastName'),
              'mobile_number' => $request->input('mobile'),
              'email' => $request->input('email'),
              'status' => 1,
              'password' =>  bcrypt($request->input('password'))
            ]);

            $user->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Registeration Failed.Please Try again!');
        }
        
        return redirect('admin/user')->with('success', 'Record added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try { 
                //$user = User::find($id);
                $user = DB::table('users')->where('id',$id)->first();
                $bussiness = DB::table('customer_business_info')
                ->leftJoin('business_roles', 'customer_business_info.category', '=', 'business_roles.id')
                ->leftJoin('business_categories', 'customer_business_info.business_role_id', '=', 'business_categories.id')
                ->leftJoin('business_address', 'customer_business_info.business_address_id', '=', 'business_address.id')
                ->leftJoin('states', 'business_address.state_id', '=', 'states.id')
                ->leftJoin('country', 'business_address.country_id', '=', 'country.id')
                ->select(
                     'customer_business_info.id as customer_bussiness_id',
                     'customer_business_info.preferred_business_name',
                     'customer_business_info.alternate_business_name',
                     'customer_business_info.business_role_id',
                     'customer_business_info.category',
                     'customer_business_info.describe_business',
                     'customer_business_info.business_address_id',

                      'business_roles.id as bussiness_role_id',
                      'business_roles.title as bussiness_role_title',
                      'business_roles.status as bussiness_role_status',

                      'business_categories.id as business_category_id',
                      'business_categories.title as business_category_title',
                      'business_categories.status as business_category_status',

                      'business_address.id as business_address_id',
                      'business_address.business_id',
                      'business_address.address',
                      'business_address.city',
                      'business_address.state_id',
                      'business_address.country_id',
                      'business_address.zipcode',

                      'states.id as states_id',
                      'states.name as state_name',

                      'country.id as country_id',
                      'country.name as country_name'
                  )
                ->where('user_id',$id)->first();

        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'User Not Found.Please Try again!');
        }
        return view('admin.user.view', compact('user','bussiness'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $roles = DB::table('user_roles')->where('id','!=',1)->get();
            $user = User::find($id);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'User Not Found.Please Try again!');
        }
        return view('admin.user.edit', compact('user','id', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'role_id' => 'required|numeric',
            'mobile' => 'required|numeric|digits_between:1,10',
            'email' => 'required|email',
        ]);
        
        try { 
            $user = User::find($request->input('id'));
            $user->first_name = $request->input('firstName');
            $user->last_name = $request->input('lastName');
            $user->role_id = $request->input('role_id');
            $user->mobile_number = $request->input('mobile');
            $user->email = $request->input('email');
            $user->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Updation Failed.Please Try again!');
        }
        return redirect('admin/user')->with('success', 'Record updated!');
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
    	if($user->id == $id && $user->role_id == 1)
    		return redirect()->back()->with('error', 'Admin account cannot be deleted!');
      	$user->delete();
      	return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    public function changeStatus($id)
    {
    	$user = User::find($id);
    	if($user->id == $id && $user->role_id == 1)
    		return redirect()->back()->with('error', 'Admin account cannot be deactivated!');
        $id = explode('_', $id);
        $user_id = $id[0];
        $status = $id[1];
        if($status == 1){
        	$changed_status = 0;
            $msg = 'Account deactivated!';
        }if($status == 0){
        	$changed_status = 1;
            $msg = 'Account activated!';
        }

        try{
            $user = User::find($user_id);
            $user->status = $changed_status;
            $user->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Status updation failed.Please Try again!');
        }

        
        return redirect()->back()->with('success', $msg);
    }

    public function mobileCheck(Request $request)
    {
        if ($request->isMethod('post')){
            try{
                $user_id = $request->input('user_id');
                if(isset($user_id)){
                    $user = User::where('id', '!=', $request->input('user_id'))
                            ->where('mobile_number', $request->input('contact'))->first();
                    if(isset($user->mobile_number))
                        return 'false';
                    else
                        return 'true';
                }else{
                    $user = User::where('mobile_number',$request->input('contact'))->first();
                    if(isset($user->mobile_number))
                        return 'false';
                    else
                        return 'true';
                }
                    
            } catch(\Illuminate\Database\QueryException $ex){ 
                return "true";
            }
        }
    }

}
