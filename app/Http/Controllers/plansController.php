<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Plan;

class plansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = Plan::all();
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

        $plans = new Plan([
          'title' => $request->input('title'),
          'description' => $request->input('description'),
          'status' => 1,
        ]);

        $plans->save();
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
        $plans = Plan::find($id);
        return view('admin.plans.edit', compact('plans','id'));
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
        echo $id;
        die;
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
        $plans = Plan::find($id);
        /*if($user->user_type_id == 1)
            return redirect()->back()->with('error', 'Admin account cannot be deleted!');*/
        $plans->delete();
        return redirect()->back()->with('success', 'Record deleted successfully!');
    }
}
