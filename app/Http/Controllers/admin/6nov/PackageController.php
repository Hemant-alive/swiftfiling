<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator ;
use App\Package;
use Session;
use DB;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $plans = DB::table('plans')
                ->select('title','id')
                ->get()
                ->toArray();

        $query = Package::select();

        $query->leftJoin('plans', 'packages.plan_id', '=', 'plans.id');
        $query->select('packages.*','plans.title as plan_name');

        if($request->isMethod('post')){
            $this->validate($request, [
                'status' => 'nullable|numeric',
                'name' => 'nullable|regex:/^[\pL\s\-]+$/u',
                'plan_id' => 'nullable|numeric',
                
            ]);
            $search_title ='';
            $search_status ='';
            $search_plan =0;
            if($request->has('search_filter')){
                if($request->has('status')){
                    $search_status = trim(($request->input('status')));
                    $query->orWhere('packages.status', $search_status); 
                }
                if($request->has('name')){
                    $search_title = trim(($request->input('name')));
                    $query->orWhere('packages.title', 'like', '%' . strtolower($search_title) . '%'); 
                }
                if($request->has('plan_id')){
                    $search_plan = trim(($request->input('plan_id')));
                     $query->orWhere('packages.plan_id', $search_plan);  
                }
            }
             
            Session::flash('search_title',$search_title); 
            Session::flash('search_status',$search_status); 
            Session::flash('search_plan',$search_plan); 

        }else{

            Session::flash('search_title','');
            Session::flash('search_status','');
            Session::flash('search_plan',0);  
        }

        $orderBy = array('created_at'=>'desc','updated_at'=>'desc');
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $packages = $query->paginate(5);
        return view('admin.package.index')->with(['plans'=> $plans,'packages'=>$packages]);


       /* $packages = DB::table('packages')
        ->leftJoin('plans', 'packages.plan_id', '=', 'plans.id')
        ->select('packages.*','plans.title as plan_name')
        ->paginate(5);  
        return view('admin.package.index', compact('packages'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $plans = DB::table('plans')
                ->select('title','id')
                ->get()
                ->toArray();
        $states = DB::table('states')
                ->select('name','id')
                ->get()
                ->toArray();
        $country = DB::table('country')
                ->select('name','id')
                ->get()
                ->toArray();
        return view('admin.package.create')->with(['plans'=> $plans,'states'=> $states,'country'=> $country]);
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
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'price' => 'required',
        'plan_id' => 'required'
        ]);

        $package = new Package([
        'plan_id' => $request->input('plan_id'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'state_id ' => !empty($request->input('state_id'))? $request->input('state_id'):1,
        'status' => !empty($request->input('status'))? $request->input('status'):0,
        ]);
        $success = $package->save();

        if($success == 1){
            $insertedId = $package->id;
            Session::flash('success', 'Record Saved successfully');  
            return redirect(url('admin/package/'.$insertedId));   
        }else{
           Session::flash('success', 'Error occur ! Please try again.');
           return redirect()->back();
        } 

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
        $package = Package::find($id);

        $plans = DB::table('plans')
                ->select('title','id')
                ->get()
                ->toArray();
        $states = DB::table('states')
                ->select('name','id')
                ->get()
                ->toArray();
        $country = DB::table('country')
                ->select('name','id')
                ->get()
                ->toArray();

        return view('admin.package.edit')->with(['plans'=> $plans,'package'=> $package,'states'=> $states,'country'=> $country,'id'=>$id]);

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

        $this->validate($request, [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'price' => 'required',
        'plan_id' => 'required'
        ]);

        $package = Package::find($id);
        $package->plan_id       = $request->input('plan_id');
        $package->title = $request->input('title');
        $package->description = $request->input('description');
        $package->price = $request->input('price');
        $package->state_id = empty($request->input('state_id'))? $request->input('state_id'):1;
        $package->status = !empty($request->input('status'))? $request->input('status'):0;
        $success = $package->save();
        
        if($success == 1){
            Session::flash('success', 'Record Updated successfully');            
        }else{
           Session::flash('success', 'Error occur ! Please try again.');
        }
        return redirect()->back();
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
        $package = Plan::find($id);
        /*if($user->user_type_id == 1)
            return redirect()->back()->with('error', 'Admin account cannot be deleted!');*/
        $package->delete();
        return redirect()->back()->with('success', 'Record deleted successfully!');
    }
    
    public function changeStatus($id)
    {

        $id = explode('_', $id);
        $rid = $id[0];
        $status = $id[1]==1?0:1;
        $plan = Package::find($rid);
        $plan->status = $status;
        $plan->save();
        $id[1]==0?Session::flash('success', 'Record Activeted successfully'):Session::flash('error', 'Record de-activeted successfully');  
        return redirect()->back();
    }
}
