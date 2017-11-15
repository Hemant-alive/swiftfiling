<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;
use App\Question;
use DB;

class FaqController extends Controller
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
                'title' => 'nullable|regex:/^[\pL\s\-]+$/u',
                'status' => 'nullable|numeric',
                
            ]);

            //$query = User::where('role_id','!=', '1')        
             $query = Faq::select();
            if(!empty($request->input('title'))){
                $query->orWhere('title', 'like', '%' . $request->input('title') . '%');
            }

            /*if(!empty($request->input('name')) || !empty($request->input('email')) || !empty($request->input('mobile'))){*/
                
                try{
                    $query->orWhere('status', $request->input('status'));
                    $query->orderBy('title', 'asc');
                    $query->orderBy('created_at', 'desc');
                    $faqs = $query->paginate(5);
                } catch(\Illuminate\Database\QueryException $ex){ 
                    //dd($ex->getMessage()); 
                    return redirect()->back()->with('error', 'Searching failed.Please Try again!');
                }
            /*}else{
                return redirect('admin/user')->with('error', 'Please Enter one of the search field!');
            }*/
            return view('admin.faq.category.index', compact('faqs'));

        }else{
            try{
            $faqs = Faq::select()
                ->orderBy('title', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            } catch(\Illuminate\Database\QueryException $ex){ 
                //dd($ex->getMessage()); 
                return redirect()->back()->with('error', 'Searching failed.Please Try again!');
            }
        }
        return view('admin.faq.category.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createCategory()
    {
        return view('admin.faq.category.create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {	
    	$this->validate($request, [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'status' => 'required|numeric',
        ]);

        try { 
            $faq = new Faq([
              'title' => $request->input('title'),
              'slug' => str_slug($request->input('title'), '-'),
              'status' => $request->input('status'),
            ]);

            $faq->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Faq Creation Failed.Please Try again!');
        }
        
        return redirect('admin/faq/category')->with('success', 'Record added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategory($id)
    {
        try {
            $faq = Faq::find($id);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Faq Not Found.Please Try again!');
        }
        return view('admin.faq.category.edit', compact('faq','id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory($id)
    {
    	$faq = Faq::find($id);
      	$faq->delete();
      	return redirect()->back()->with('success', 'Record deleted successfully!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'status' => 'required|numeric',
        ]);
        
        try { 
            $faq = Faq::find($request->input('id'));
            $faq->title = $request->input('title');
            $faq->slug = str_slug($request->input('title'), '-');
            $faq->status = $request->input('status');
            $faq->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Updation Failed.Please Try again!');
        }
        return redirect('admin/faq/category')->with('success', 'Faq Category updated!');
    }

    public function changeCategoryStatus($id)
    {
    	//$faq = Faq::find($id);
        $id = explode('_', $id);
        $faq_id = $id[0];
        $status = $id[1];
        if($status == 1){
        	$changed_status = 0;
            $msg = 'Faq deactivated!';
        }if($status == 0){
        	$changed_status = 1;
            $msg = 'Faq activated!';
        }

        try{
            $faq = Faq::find($faq_id);
            $faq->status = $changed_status;
            $faq->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Status updation failed.Please Try again!');
        }
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategory($id)
    {
        try {
            $faq = Faq::with(['question'])->where('id',$id)->first();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Faq Not Found.Please Try again!');
        }
        $faq = $faq->toArray();
        return view('admin.faq.category.view', compact('faq'));
    }



    public function question(Request $request)
    {
        if($request->input('search') === 'search'){
            $this->validate($request, [
                'question' => 'nullable|regex:/^[\pL\s\-]+$/u',
                'answer' => 'nullable|regex:/^[\pL\s\-]+$/u',
                'status' => 'nullable|numeric',
                
            ]);

            //$query = User::where('role_id','!=', '1')        
             $query = Question::with('category');
            if(!empty($request->input('question'))){
                $query->orWhere('question', 'like', '%' . $request->input('question') . '%');
            }
            if(!empty($request->input('answer'))){
                $query->orWhere('answer', 'like', '%' . $request->input('answer') . '%');
            }

            /*if(!empty($request->input('name')) || !empty($request->input('email')) || !empty($request->input('mobile'))){*/
                
                try{
                    $query->orWhere('status', $request->input('status'));
                    $questionslist = $query->paginate(5);
                } catch(\Illuminate\Database\QueryException $ex){ 
                    //dd($ex->getMessage()); 
                    return redirect()->back()->with('error', 'Searching failed.Please Try again!');
                }
            /*}else{
                return redirect('admin/user')->with('error', 'Please Enter one of the search field!');
            }*/

        }else{
        
            try {
                $questions = Question::with('category')->paginate(5);
            } catch(\Illuminate\Database\QueryException $ex){ 
                //dd($ex->getMessage()); 
                return redirect()->back()->with('error', 'questions Not Found.Please Try again!');
            }
            $questionslist = $questions;
        }
        //echo '<pre>';print_r($questionslist);die;
        return view('admin.faq.question.index', compact('questionslist'));
    }

    public function createQuestion()
    {
        $faqs = Faq::select()
            ->where('status', 1)
            ->orderBy('title', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        $faqs = $faqs->toArray();
        //echo '<pre>';print_r($faqs);die;
        return view('admin.faq.question.create', compact('faqs'));
    }


    public function storeQuestion(Request $request)
    {   //dd($request->input());
        $this->validate($request, [
            'category_id' => 'required|numeric',
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required|numeric',
        ]);

        try { 
            $question = new Question([
              'category_id' => $request->input('category_id'),
              'question' => $request->input('question'),
              'answer' => $request->input('answer'),
              'status' => $request->input('status'),
            ]);

            $question->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Question Creation Failed.Please Try again!');
        }
        
        return redirect('admin/faq/question')->with('success', 'Record added successfully!');
    }

    public function editQuestion($id)
    {
        try {
            $question = Question::find($id);
            $question = $question->toArray();
            $faqs = Faq::get();
            $faqs = $faqs->toArray();
            
            //dd($question,$faqs);
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Question Not Found.Please Try again!');
        }
        return view('admin.faq.question.edit', compact('question','faqs','id'));
    }

    public function updateQuestion(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|numeric',
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required|numeric',
        ]);
        
        try {
            
            $question = Question::find($request->input('id'));
            $question->category_id = $request->input('category_id');
            $question->question = $request->input('question');
            $question->answer = $request->input('answer');
            $question->status = $request->input('status');
            $question->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Updation Failed.Please Try again!');
        }
        return redirect('admin/faq/question')->with('success', 'Question updated!');
    }

    public function destroyQuestion($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->back()->with('success', 'Record deleted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showQuestion($id)
    {
        try {
            $question = Question::with('category')->where('id',$id)->first();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Question Not Found.Please Try again!');
        }
        $question = $question->toArray();
        return view('admin.faq.question.view', compact('question'));
    }

    public function changeQuestionStatus($id)
    {
        $id = explode('_', $id);
        $question_id = $id[0];
        $status = $id[1];
        if($status == 0){
            $changed_status = 1;
            $msg = 'Question activated!';
        }else{
            $changed_status = 0;
            $msg = 'Question deactivated!';
        }

        try{
            $question = Question::find($question_id);
            $question->status = $changed_status;
            $question->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Status updation failed.Please Try again!');
        }
        return redirect()->back()->with('success', $msg);
    }
    
}
