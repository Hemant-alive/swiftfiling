@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')

<div id="page-wrapper">
    <div class="graphs">
            <div class="float-left pd10">
            <h3 class="blank1">User Info</h3>
            </div>
            <div class="float-right pd10">
                <button class="btn btn-primary"  onclick="history.back()">
                    <i class="fa fa-toggle-left"></i> <span>Back</span>
                </button>
            </div>
            <hr>
            <div class="grid_3 fulldiv">
                <div class="row">    
                    <table class="table table-bordered">
                        <thead>
                            <th colspan="2">User details</th>
                        </thead>
                        <tbody>
                            <tr>
                                 <td style="width: 20%;">Name</td>
                                 <td>{{$user->first_name.' '.$user->last_name}}</td>
                             </tr>
                             <tr>
                                 <td style="width: 20%;">Email</td>
                                 <td>{{$user->email}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Mobile</td>
                                 <td>{{$user->mobile_number}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Status</td>
                                 <td>{{($user->status=='0')?'Inactive' : 'Active'}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Registered Date</td>
                                 <td>{{$user->created_at}}</td>
                             </tr>
                        </tbody> 
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <th colspan="2">Bussiness details</th>
                        </thead>

                        <tbody>
                            @if(isset($bussiness) && !empty($bussiness) && ($user->status != 0))
                            <tr>
                                 <td style="width: 20%;">Business Name</td>
                                 <td>{{$bussiness->preferred_business_name}}</td>
                             </tr>
                             <tr>
                                 <td style="width: 20%;">Alternate Name</td>
                                 <td>{{$bussiness->alternate_business_name}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Bussiness Detail</td>
                                 <td>{{$bussiness->describe_business}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Bussiness Role</td>
                                 <td>{{$bussiness->bussiness_role_title}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Bussiness Category</td>
                                 <td>{{$bussiness->business_category_title}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Status</td>
                                 <td>{{($bussiness->bussiness_role_status=='1')?'Active' : 'Inactive'}}</td>
                             </tr> 
                             <tr>
                                 <td style="width: 20%;">Company Address</td>
                                 <td>{{$bussiness->address}}, {{$bussiness->city}}, {{$bussiness->state_name}}, {{$bussiness->country_name}}, ({{$bussiness->zipcode}})</td>
                             </tr> 
                             @else
                             <tr>
                                 <td>Not Available</td>
                             </tr>
                             @endif
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
