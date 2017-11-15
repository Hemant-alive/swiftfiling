<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plan;
use Session;
use DB;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Plan::select();

        if($request->isMethod('post')){
            $this->validate($request, [
                'status' => 'nullable|numeric',
                'name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            ]);
            $search_title ='';
            $search_status ='';
            if($request->has('search_filter')){
                if($request->has('status')){
                    $search_status = trim(($request->input('status')));
                    $query->orWhere('status', $search_status); 
                }
                if($request->has('name')){
                    $search_title = trim(($request->input('name')));
                    $query->orWhere('title', 'like', '%' . strtolower($search_title) . '%'); 
                }
            }
             
            Session::flash('search_title',$search_title); 
            Session::flash('search_status',$search_status); 
        }else{
            Session::flash('search_title','');
            Session::flash('search_status',''); 
        }

        $orderBy = array('created_at'=>'desc','updated_at'=>'desc');
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $plans = $query->paginate(5);
        return view('admin.plans.index', compact('plans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.plans.create');
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
        'description' => 'required|min:3'
        ]);

        $plans = new Plan([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'status' => !empty($request->input('status'))? $request->input('status'):0,
        ]);
        $success = $plans->save();

        if($success == 1){
            $insertedId = $plans->id;
            Session::flash('success', 'Record Saved successfully');  
            return redirect(url('admin/plans/'.$insertedId.'/edit'));   
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
        $plans = Plan::find($id);
        return view('admin.plans.view', compact('plans','id'));
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
        $plans = Plan::find($id);
        return view('admin.plans.edit', compact('plans','id'));
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
            'description' => 'required|min:3'
         ]);

        $plans = Plan::find($id);
        $plans->title       = $request->input('title');
        $plans->description = $request->input('description');
        $plans->status =  !empty($request->input('status'))? $request->input('status'):0;
        $success = $plans->save();
        
        if($success == 1){
            Session::flash('success', 'Record Updated successfully');            
        }else{
           Session::flash('success', 'Error occur ! Please try again.');
        }

        //return redirect(url('admin/userList'));
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
        $plans = Plan::find($id);
        /*if($user->user_type_id == 1)
            return redirect()->back()->with('error', 'Admin account cannot be deleted!');*/
        $plans->delete();
        return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    public function changeStatus($id)
    {

        $id = explode('_', $id);
        $rid = $id[0];
        $status = $id[1]==1?0:1;
        $plan = Plan::find($rid);
        $plan->status = $status;
        $plan->save();
        $id[1]==0?Session::flash('success', 'Record Activeted successfully'):Session::flash('error', 'Record de-activeted successfully');  
        return redirect()->back();
    }

}
