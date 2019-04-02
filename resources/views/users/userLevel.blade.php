@extends('layouts.app')

 
@section('style')
 
@endsection
 @section('content')
   <div class="md-card-content">
@if(Session::has('success'))
            <div style="text-align: center" class="uk-alert uk-alert-success" data-uk-alert="">
                {!! Session::get('success') !!}
            </div>
 @endif
 @if(Session::has('error'))
            <div style="text-align: center" class="uk-alert uk-alert-danger" data-uk-alert="">
                {!! Session::get('error') !!}
            </div>
 @endif
 
     @if (count($errors) > 0)

    <div class="uk-form-row">
        <div class="uk-alert uk-alert-danger" style="background-color: red;color: white">

              <ul>
                @foreach ($errors->all() as $error)
                  <li> {{  $error  }} </li>
                @endforeach
          </ul>
    </div>
  </div>
@endif
  </div>
 
 <form  action=""  id="form" accept-charset="utf-8" method="POST" name="applicationForm"  v-form>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
 <div class="uk-width-xLarge-1-1">
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-overflow-container" id='print'>
                
                    <table class="uk-table uk-table-hover uk-table-striped" id="ts_pager_filter" width="70"> 
                        
                            <tr class="uk-text-small">
                              
                                <th>no</th>
                                <th class="uk-table-shrink">name</th>
                                <th>result all</th>
                                <th>result reg</th>
                                <th>print card</th>
                                <th>course up</th>
                                <th>mount up</th>
                                <th>del mount</th>
                                <th>resit up</th>
                                <th>legacy up</th>
                                <th>trans cript</th>
                                <th>admin top</th>
                                <th>admin aca</th>
                                <th>exam dpt</th>
                                <th>create bill</th>
                                <th>enter fees</th>
                                <th>proto col</th>
                                <th>change status</th>
                                <th>change prog</th>
                                <th>receipt</th>
                                <th>del fee</th>
                                <th>del paymen</th>
                                <th>aca cal</th>
                                <th>view nptx</th>
                                <th>add stu</th>
                                <th>add staf</th>
                                  
                     
                            </tr>
                        
                        <tbody>

                            @foreach($data as $index=>$row) 
 
                            <tr align="">
                                
                                <td>
                                    <span class="uk-text-small">

                                        {{ @$row->id}}
                                                 

                                    </span>
                                </td>
                                <td> <span class="uk-text-small">

                                        {{ @$row->name}}       

                                    </span>
                                </td>
                                
                        
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/result_all0/action")}}' ><i  class="uk-badge uk-badge-success">Yes</i></span>
                                    @else<span> <a href='{{url("fireUserLevel/$row->id/id/result_all1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_register==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/view_results_register0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/view_results_register1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->print_card==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/print_card0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/print_card1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->courses_upload==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/courses_upload0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/courses_upload1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->mounted_upload==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/mounted_upload0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/mounted_upload1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->delete_mounted==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/delete_mounted0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/delete_mounted1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->resit_upload==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/resit_upload0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/resit_upload1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->legacy_upload==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/legacy_upload0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/legacy_upload1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->transcript==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/transcript0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/transcript1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->admin_top==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/admin_top0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/admin_top1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->admin_academic==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/admin_academic0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/admin_academic1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->exam_dpt==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/exam_dpt0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/exam_dpt1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->create_bill==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/create_bill0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/create_bill1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->enter_fees==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/enter_fees0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/enter_fees1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->grant_protocol==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/grant_protocol0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/grant_protocol1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->change_status==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/change_status0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/change_status1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->change_programme==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/change_programme0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/change_programme1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->print_receipt==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/print_receipt0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/print_receipt1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->delete_fee==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/delete_fee0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/delete_fee1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->delete_payment==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/delete_payment0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/delete_payment1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->academic_calender==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/academic_calender0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/academic_calender1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->download_nabptex==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/download_nabptex0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/download_nabptex1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->create_student==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/create_student0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/create_student1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->create_staff==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/create_staff0/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/create_staff1/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/closeReg/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/openReg/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/closeReg/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/openReg/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/closeReg/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/openReg/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/closeReg/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/openReg/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/closeReg/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/openReg/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                <td class="uk-text-center">
                                    @if($row->view_results_all==1)
                                    <span> <a href='{{url("fireUserLevel/$row->id/id/closeReg/action")}}' ><i class="uk-badge uk-badge-success">Yes</i></span>
                                    @else <span> <a href='{{url("fireUserLevel/$row->id/id/openReg/action")}}' ><i class="uk-badge uk-badge-danger"> No </i></span> @endif
                                </td>
                     
                                
                                                          

                            </tr>
                            @endforeach
                        </tbody>
                                    
                    </table>
           {!! (new Landish\Pagination\UIKit($data->appends(old())))->render() !!}
         
            </div>
            
        </div>
    </div>
 </div>

@endsection
@section('js')
 
 
@endsection
</form>