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
 <h5>Academic Calender</h5>
@foreach($data as $index=>$row)
 <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium">
                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Year</span>
                            <div class="uk-input-group">

                                        <input type="text" id="year" name="year" v-form-ctrl  class="md-input uk-text-primary uk-text-bold"    v-model="year" value="{{ @$row->YEAR}}"/>
                                                 

                                    </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Sem</span>
                            <div class="uk-input-group">

                                        <input type="text" id="sem" name="sem" v-form-ctrl  class="md-input uk-text-primary uk-text-bold"    v-model="sem" value="{{ @$row->SEMESTER}}"/>         

                                    </div>
                        </div>
                    </div>
                </div>
                

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Exam</span>
                            <div class="uk-input-group col-md-4">

                                        <input type="text" id="upload" name="upload" v-form-ctrl  class="md-input uk-text-primary uk-text-bold col-md-4"    v-model="upload" value="{{ @$row->RESULT_DATE}}"/>         

                                    </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Exam</span>
                            <div>
                            @if($row->ENTER_RESULT==1)<span class="uk-badge uk-badge-success">Opened</span><span> <a href='{{url("fireCalender/$row->ID/id/closeMark/action")}}' ><i title='Click to close entering of marks' onclick="return confirm('Are you sure you want to close entering of marks?' );" class="md-icon material-icons uk-text-danger">power_settings_new</i></a></span> @else <span class="uk-badge uk-badge-danger">Closed</span><span> <a href='{{url("fireCalender/$row->ID/id/openMark/action")}}' ><i onclick="return confirm('Are you sure you want to open entering of marks?' );" title='Click to open online registration'  class="md-icon material-icons uk-text-success">power_settings_new</i></a></span> @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Assesment</span>
                            <div class="uk-input-group col-md-4">

                                        <input type="text" id="qa" name="qa" v-form-ctrl  class="md-input uk-text-primary uk-text-bold col-md-4"    v-model="qa" value="{{ @$row->QA}}"/>        

                                    </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Assesment</span>
                            <div>
                            @if($row->QAOPEN==1)<span class="uk-badge uk-badge-success">Opened</span><span> <a href='{{url("fireCalender/$row->ID/id/closeQa/action")}}' ><i title='Click to close lecturer assesment' onclick="return confirm('Are you sure you want to close lecturer assesment?' );" class="md-icon material-icons uk-text-danger">power_settings_new</i></a></span> 
                                @else <span class="uk-badge uk-badge-danger">Closed</span><span> <a href='{{url("fireCalender/$row->ID/id/openQa/action")}}' ><i onclick="return confirm('Are you sure you want to open lecturer assesment?' );" title='Click to open lecturer assesment'  class="md-icon material-icons uk-text-success">power_settings_new</i></a></span> @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Result View</span>
                            <div class="uk-input-group col-md-4">

                                        <input type="text" id="result" name="result" v-form-ctrl  class="md-input uk-text-primary uk-text-bold col-md-4"    v-model="result" value="{{ @$row->RESULT_BLOCK}}"/>        

                                    </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Attachment</span>
                            <div>
                            @if($row->LIAISON==1)<span class="uk-badge uk-badge-success">Opened</span><span> <a href='{{url("fireCalender/$row->ID/id/closeLia/action")}}' ><i title='Click to close registration for attachment' onclick="return confirm('Are you sure you want to close registration for attachment?' );" class="md-icon material-icons uk-text-danger">power_settings_new</i></a></span>
                                        @else <span class="uk-badge uk-badge-danger">Closed</span><span> <a href='{{url("fireCalender/$row->ID/id/openLia/action")}}' ><i onclick="return confirm('Are you sure you want to open registration for attachment?' );" title='Click to open registration for attachment'  class="md-icon material-icons uk-text-success">power_settings_new</i></a></span> @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Graduation</span>
                            <div class="uk-input-group">

                                        <input type="text" id="grad" name="grad" v-form-ctrl  class="md-input uk-text-primary uk-text-bold"    v-model="grad" value="{{ @$row->GRAD}}"/>
                                                 

                                    </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Admissions</span>
                            <div class="uk-input-group">

                                        <input type="text" id="admit" name="admit" v-form-ctrl  class="md-input uk-text-primary uk-text-bold"    v-model="admit" value="{{ @$row->ADMIT}}"/>         

                                    </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Register</span>
                            <div class="uk-input-group col-md-4">

                            @if($row->STATUS==1)<span class="uk-badge uk-badge-success">Opened</span>
                                    <span> <a href='{{url("fireCalender/$row->ID/id/closeReg/action")}}' ><i title='Click to close online registration' onclick="return confirm('Are you sure you want to close online registration?' );" class="md-icon material-icons uk-text-danger">power_settings_new</i></a></span>
                                    @else <span class="uk-badge uk-badge-danger">Closed</span><span> <a href='{{url("fireCalender/$row->ID/id/openReg/action")}}' ><i title='Click to open online registration' onclick="return confirm('Are you sure you want to open online registration?' );" class="md-icon material-icons uk-text-success">power_settings_new</i></a></span> @endif
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="uk-margin-top">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Save</span>
                            <div class="uk-input-group">

                                        <input type="submit" value="Save" id='save'v-show="applicationForm.$valid"  class="md-btn   md-btn-success uk-margin-small-top">         

                                    </div>
                        </div>
                    </div>
                </div>
            </div>



                            
 
                            
                            @endforeach
                       

@endsection
@section('js')
 
 
@endsection
</form>