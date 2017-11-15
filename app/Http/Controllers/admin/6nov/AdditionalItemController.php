<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Additional_item;
use Illuminate\Http\Request;
use Session;
use DB;


class AdditionalItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Additional_item::select();

        if($request->isMethod('post')){
            $this->validate($request, [
                'status' => 'nullable|numeric',
                'options' => 'nullable|numeric',
                'name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            ]);
            $search_title ='';
            $search_status ='';
            $search_category ='';
            if($request->has('search_filter')){
                if($request->has('status')){
                    $search_status = trim(($request->input('status')));
                    $query->orWhere('status', $search_status); 
                }
                if($request->has('name')){
                    $search_title = trim(($request->input('name')));
                    $query->orWhere('title', 'like', '%' . strtolower($search_title) . '%'); 
                }
                if($request->has('options')){
                    $search_category = trim(($request->input('options')));
                     $query->orWhere('options', $search_category); 
                }
            }
             
            Session::flash('search_title',$search_title); 
            Session::flash('search_status',$search_status); 
            Session::flash('search_category',$search_category); 
        }else{
            Session::flash('search_title','');
            Session::flash('search_status',''); 
            Session::flash('search_category',''); 
        }

        $orderBy = array('created_at'=>'desc','updated_at'=>'desc');
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $items = $query->paginate(5);
        return view('admin.additionalItem.index', compact('items'));

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
        $packages = DB::table('packages')
                ->select('title','id')
                ->get()
                ->toArray();
        return view('admin.additionalItem.create')->with(['plans'=>$plans,'package'=>$packages]);
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
        'plan_id' => 'required',
        'package_id' => 'required',
        'options' => 'required|'

        ]);

        $plans = new Additional_item([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'plan_id' => $request->input('plan_id'),
        'package_id' => $request->input('package_id'),
        'options' => $request->input('options'),
        'price' => $request->input('price'),
        'notes' => $request->input('notes'),
        'status' => !empty($request->input('status'))? $request->input('status'):0,
        ]);
        $success = $plans->save();

        if($success == 1){
            $insertedId = $plans->id;
            Session::flash('success', 'Record Saved successfully');  
            return redirect(url('admin/additional-item/'.$insertedId));   
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
        $items = Additional_item::find($id);

        $plans = DB::table('plans')
                ->select('title','id')
                ->get()
                ->toArray();
        $packages = DB::table('packages')
                ->select('title','id')
                ->get()
                ->toArray();

        return view('admin.additionalItem.edit')->with(['plans'=>$plans,'package'=>$packages,'items'=>$items,'id'=>$id]);

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
        'plan_id' => 'required',
        'package_id' => 'required',
        'options' => 'required|'

        ]);

        $items = Additional_item::find($id);
        $items->title       = $request->input('title');
        $items->description = $request->input('description');
        $items->plan_id = $request->input('plan_id');
        $items->package_id = $request->input('package_id');
        $items->options = $request->input('options');
        $items->price = $request->input('price');
        $items->notes = $request->input('notes');

        $items->status = !empty($request->input('status'))? $request->input('status'):0;
        $success = $items->save();
        
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
        $plans = Additional_item::find($id);
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
        $plan = Additional_item::find($rid);
        $plan->status = $status;
        $plan->save();
        $id[1]==0?Session::flash('success', 'Record Activeted successfully'):Session::flash('error', 'Record de-activeted successfully');  
        return redirect()->back();
    }

}
