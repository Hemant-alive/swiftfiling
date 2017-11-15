@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')

<div id="page-wrapper">
    <div class="graphs">
            <div class="float-left pd10">
            <h3 class="blank1" style="min-width: 300px;">{{$faq['title']}}</h3>
            </div>
            <div class="float-right pd10">
                <button class="btn btn-primary"  onclick="history.back()">
                    <i class="fa fa-toggle-left"></i> <span>Back</span>
                </button>
            </div>
            <hr>
            <div class="grid_3 fulldiv">
                @if(count($faq['question'])>0)
                <?php $i=1;?>
                @foreach($faq['question'] as $questions)
                    <div class="row">
                        <div class="col-sm-12">
                            <p># {{$i}}</p>
                            <p style="word-break: break-word;"><strong>Question</strong> : {{$questions['question']}}</p>
                            <p style="word-break: break-word;"><strong>Answers</strong> : {{$questions['answer']}}</p>
                            <p>Status : {{($questions['status']=='1')?'Active' : 'Inactive'}}</p>
                            <p>Created on : {{$questions['created_at']}}</p>
                            <p>Updated on : {{$questions['updated_at']}}</p>
                        </div>
                    </div>
                <?php $i++;?>
                @endforeach 
                @else
                <tr>
                    <td><i>No Questions Found</i></td>
                </tr> 
                @endif 
            </div>
        </div>
</div>
@endsection
