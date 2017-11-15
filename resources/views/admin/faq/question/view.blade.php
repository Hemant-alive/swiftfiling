@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')

<div id="page-wrapper">
    <div class="graphs">
            <div class="float-left pd10">
            <h3 class="blank1" style="min-width: 300px;">{{$question['category']['title']}}</h3>
            </div>
            <div class="float-right pd10">
                <button class="btn btn-primary"  onclick="history.back()">
                    <i class="fa fa-toggle-left"></i> <span>Back</span>
                </button>
            </div>
            <hr>
            <div class="grid_3 fulldiv">
                @if(count($question)>0)
                    <div class="row">
                        <div class="col-sm-12">
                            <p style="word-break: break-word;"><strong>Question</strong> : {{$question['question']}}</p>
                            <p style="word-break: break-word;"><strong>Answers</strong> : {{$question['answer']}}</p>
                            <p><strong>Status</strong> : {{($question['status']=='1')?'Active' : 'Inactive'}}</p>
                            <p><strong>Created on</strong> : {{$question['created_at']}}</p>
                            <p><strong>Updated on</strong> : {{$question['updated_at']}}</p>
                        </div>
                    </div>
                @else
                <tr>
                    <td><i>No Question Found</i></td>
                </tr> 
                @endif 
            </div>
        </div>
</div>
@endsection
