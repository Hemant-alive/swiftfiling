@extends('layouts.admin-layout')
@section('body')
<div id="page-wrapper">
    <div class="graphs">
        <div class="float-left pd10">
        <h3 class="blank1">Faqs</h3>
        </div>
        <div class="float-right pd10">
            <a href="{{ url('admin/faq/question/create') }}" class="btn btn-primary" title="New USer">
             <i class="fa fa-question-circle"></i> <span>New Question</span>
            </a>
        </div>
        <hr>
        <div class="grid_3 fulldiv pd10 m0">
            <div class="row">
                <form method="post" action="{{url('admin/faq/question')}}" id='menu' class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" name="search" value="search">
                    <div class="col-sm-2 grid_box1"> 
                        <input type="text" name="question" value="{{ old('question') }}" class="form-control1 input-sm" placeholder="Question">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <input type="text" name="answer" value="{{ old('answer') }}" class="form-control1 input-sm" placeholder="Answer">
                    </div>
                    
                    <div class="col-sm-2 grid_box1">
                        <select name="status" id="status" class="form-control1 select2">
                            <option value="">Select Status</option>
                            <option value="1" {{old( 'status')=='1' ? 'selected' : ''}}>Active</option>
                            <option value="0" {{old( 'status')=='0' ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-4 grid_box1">
                        <input type="submit" value="Search" class="btn btn-success min-btn">
                        <a href="{{ url('admin/faq/question') }}" class="btn btn-success min-btn" title="Refresh">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </form>
            </div>
            @if ($errors->any())
                <div class="error small">
                    <span style="margin-right: 10px;">{{ $errors->first('question') }}</span>
                    <span style="margin-right: 10px;">{{ $errors->first('answer') }}</span>
                    <span>{{ $errors->first('status') }}</span>
                </div>
            @endif
        </div>
        <div class="clearfix"></div>
        <div class="xs tabls tab-content">
             @if(Session::has('success'))
                <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> 
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('error')}} </div> 
                @endif
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h2>Faqs List</h2>
                    <div class="panel-ctrls"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
                </div> 
               
                <div class="panel-body no-padding" style="display: block;">
                    <table class="table table-striped">
                        <thead>
                            <tr class="warning">
                                <th>#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Faq Category</th>
                                <th>status</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> @if(count($questionslist)>0)
                            <?php $i = ($questionslist->currentpage()-1)* $questionslist->perpage() + 1; ?> 
                            @foreach($questionslist->toArray()['data'] as $question)
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td width="20%">
                                        <a href="{{url('admin/faq/question/'.$question['id'])}}" class="btn btn-xs btn-link">{!!$question['question']!!}</a>
                                    </td>
                                    <td width="30%" style="word-break: break-word;">
                                        <div style="overflow: auto;max-height: 80px;">
                                            {!!$question['answer']!!}
                                        </div>
                                        
                                    </td>
                                    <td><a href="{{url('admin/faq/category/'.$question['category']['id'])}}" class="btn btn-xs btn-link">{{$question['category']['title']}}</a></td>
                                    <td><a onclick="return confirm('Do you Want to Change Status?');return false;" href="{{URL :: asset('admin/faq/question/status/'.$question['id'].'_'.$question['status'])}}">{{($question['status']=='1')?'Active' : 'Inactive'}}</a></td>
                                    <td>{{date('F d, Y', strtotime($question['created_at']))}}</td>
                                    <td width="20%"> <a href="{{URL :: asset('admin/faq/question/'.$question['id'])}}/edit" class="btn btn-success" title='edit'><i class="fa fa-edit"></i></a>
                                        <?php if(Auth::user()->role_id==1) { ?> <a onclick="return confirm('Do you Want to Delete Faq?');return false;" href="{{URL :: asset('admin/faq/question/'.$question['id'])}}/delete" class="btn btn-success" title='delete'><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                    </td>
                                </tr> 
                                @endforeach 
                                @else
                                <tr>
                                    <td><i>No User Found</i></td>
                                </tr> 
                            @endif 
                        </tbody>
                    </table>
                    <div class="col-sm-12 text-center">
                        {{$questionslist->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop