@extends('layouts.app')

 
@section('style')
  <!-- additional styles for plugins -->
        <!-- weather icons -->
        <link rel="stylesheet" href="public/assets/plugins/weather-icons/css/weather-icons.min.css" media="all">
        <!-- metrics graphics (charts) -->
        <link rel="stylesheet" href="public/assets/plugins/metrics-graphics/dist/metricsgraphics.css">
        <!-- chartist -->
        <link rel="stylesheet" href="public/assets/plugins/chartist/dist/chartist.min.css">
    
@endsection
 @section('content')
 <div class="md-card-content">

    @if(Session::has('success'))
            <div style="text-align: center" class="uk-alert uk-alert-success" data-uk-alert="">
                {!! Session::get('success') !!}
            </div>
 @endif


    @if (count($errors) > 0)


    <div class="uk-alert uk-alert-danger  uk-alert-close" style="background-color: red;color: white" data-uk-alert="">

        <ul>
            @foreach ($errors->all() as $error)
            <li>{!!$error  !!} </li>
            @endforeach
        </ul>
    </div>

    @endif


</div>
   
   @inject('sys', 'App\Http\Controllers\SystemController')
  
      
         <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium">
                 <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">access_time</i></span></div>
                            <span class="uk-text-bold uk-text-small">Last Visit</span>
                            <h5 class="uk-margin-remove"><span class="uk-text-small uk-text-success"> {{$lastVisit}}</span></h5>
                        </div>
                    </div>
                </div>
                  @if( @Auth::user()->department=='top' || @Auth::user()->department=='Rector'  || @Auth::user()->department=='Tpmid' || @Auth::user()->department=='Tptop' || @Auth::user()->department=='Tptop2' || @Auth::user()->department=='Tptop3' || @Auth::user()->department=='Tptop4' || @Auth::user()->department=='Tptop5' || @Auth::user()->department=='Tptop6')
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=" "><i class="sidebar-menu-icon material-icons md-36">account_balance</i></span></div>
                            <span class="uk-text-muted uk-text-small">Owing - <span class="uk-text-bold uk-text-danger ">GH{{$owing}}</span></span><br/>
                            <span class="uk-text-muted uk-text-small">Paid - <span class="uk-text-bold uk-text-success ">GH{{$paid}}</span></span>
                        </div>
                    </div>
                </div>
                @endif
                @if( @Auth::user()->department=='Planning' || @Auth::user()->role=='Support')
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=" "><i class="sidebar-menu-icon material-icons md-36">account_balance</i></span></div>
                            <span class="uk-text-muted uk-text-small">Total Fees Owed</span><br/>
                            <span class="uk-text-muted uk-text-small"><span class="uk-text-bold uk-text-success ">GH{{$owing}}</span></span>
                        </div>
                    </div>
                </div>
                @endif
             <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">event_note</i></span></div>
                            <span class="uk-text-muted uk-text-small">Total Students - <span class="uk-text-bold uk-text-primary ">{{$total}} </span></span><br/>
                            <span class="uk-text-muted uk-text-small">Registered - <span class="uk-text-bold uk-text-success ">{!!$totalRegistered!!} </span></span>
                        </div>
                    </div>
                </div>
             
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                         <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">event_note</i></span></div>
                            <span class="uk-text-muted uk-text-small">Academic Calender</span>
                            <h5 class="uk-margin-remove"><span class="uk-text-small uk-text-success "> Semester {{$sem}} : Year {{$year}}</span></h5>
                        </div>
                    </div>
                </div>
                  @if( @Auth::user()->role=='Lecturer' || @Auth::user()->role=='HOD')
             
               <div>
                    <div class="md-card">
                        <div class="md-card-content">
                         <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class=""><i class="sidebar-menu-icon material-icons md-36">event_note</i></span></div>
                            <span class="uk-text-muted uk-text-small">Class Size</span>
                            <h5 class="uk-margin-remove"><span class="uk-text-small uk-text-success "> Your Class Size = {{$register}}  </span></h5>
                        </div>
                    </div>
                </div>
                @endif
            </div>

           
            <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler" id="dashboard_sortable_cards" data-uk-sortable data-uk-grid-margin>
              @if(@Auth::user()->department=='Planning' || @Auth::user()->role=='HOD' || @Auth::user()->department=='top' || @Auth::user()->department=='Rector' || @Auth::user()->role=='Support')        
                <div>
                    <a target="_" href='{{url("http://23.92.25.212/portal/course_registration")}}'>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/registration.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                    REGISTER STUDENTS
                                </h3>
                            </div>
                           Assist students to register
                        </div>
                    </div>
                    </a>
                </div>
                      @endif
                      @if(@Auth::user()->department=='Planning' || @Auth::user()->role=='Support')        
                <div>
                    <a  href='{{url("/students")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/classlist.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                    CLASS LIST
                                </h3>
                            </div>
                           View students
                        </div>
                    </div>
                    </a>
                </div>
                      @endif
                      @if(@Auth::user()->department=='Planning')        
                <div>
                    <a  href='{{url("/upload_marks")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/classgroup.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                    STAFF DIRECTORY
                                </h3>
                            </div>
                           View students
                        </div>
                    </div>
                    </a>

                </div>
                      @endif
                 
                    @if(@Auth::user()->role=='Lecturer' ||  @Auth::user()->role=='HOD' ||  @Auth::user()->role=='rector')
                <div>
                    <a  href='{{url("/upload_marks")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/results.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                   UPLOAD RESULTS
                                </h3>
                            </div>
                            <p>Upload semester results here.</p>
                            <button class="md-btn md-btn-primary">More</button>
                        </div>
                    </div>
                    </a>

                </div>
                    @endif
                    @if( @Auth::user()->department=='top' ||  @Auth::user()->role=='Lecturer' ||  @Auth::user()->role=='HOD' || @Auth::user()->department=='Tpmid' || @Auth::user()->department=='Tptop' || @Auth::user()->department=='Tptop2' || @Auth::user()->department=='Tptop3' || @Auth::user()->department=='Tptop4' || @Auth::user()->department=='Tptop5' || @Auth::user()->department=='Tptop6')
                <div>
                    <a  href='{{url("/download_registered")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/downloadexcel.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                   DOWNLOAD EXCEL
                                </h3>
                            </div>
                            <p>Download student list</p>
                            <button class="md-btn md-btn-primary">More</button>
                        </div>
                    </div>
                    </a>
                </div>
                    @endif
                 @if( @Auth::user()->department=='top' ||  @Auth::user()->role=='HOD' || @Auth::user()->department=='Rector' || @Auth::user()->department=='Tpmid' || @Auth::user()->department=='Tptop' || @Auth::user()->department=='Tptop2' || @Auth::user()->department=='Tptop3' || @Auth::user()->department=='Tptop4' || @Auth::user()->department=='Tptop5' || @Auth::user()->department=='Tptop6')
                
                <div>
                    <a  href='{{url("/mounted_view")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/uploadnotes.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content uk-badge-success">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper uk-text-red">
                                  MOUNTED COURSES
                                </h3>
                            </div>
                           <p>View mounted courses here</p>
                        </div>
                    </div>
                    </a>
                </div>
                 @endif
                 @if( @Auth::user()->department=='top' ||  @Auth::user()->role=='HOD' || @Auth::user()->department=='Rector' || @Auth::user()->department=='Tpmid' || @Auth::user()->department=='Tptop' || @Auth::user()->department=='Tptop2' || @Auth::user()->department=='Tptop3' || @Auth::user()->department=='Tptop4' || @Auth::user()->department=='Tptop5' || @Auth::user()->department=='Tptop6' || @Auth::user()->department=='Planning' )
                
                <div>
                    <a  href='{{url("/download_results")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">

                        </div>
                        <div class="md-card-overlay-content uk-badge-success">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper uk-text-red">
                                 BROADSHEET
                                </h3>
                            </div>
                           <p>DOWNLOAD BROADSHEET</p>
                        </div>
                    </div>
                    </a>
                </div>
                 @endif
                 @if( @Auth::user()->department=='top' ||  @Auth::user()->role=='HOD' || @Auth::user()->department=='Rector' || @Auth::user()->department=='Tpmid' || @Auth::user()->department=='Tptop' || @Auth::user()->department=='Tptop2' || @Auth::user()->department=='Tptop3' || @Auth::user()->department=='Tptop4' || @Auth::user()->department=='Tptop5' || @Auth::user()->department=='Tptop6' )
                
                <div>
                    <a  href='{{url("/broadsheet/noticeboard")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/academicboard.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content uk-badge-success">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper uk-text-red">
                                  GPA ACADEMIC BOARD
                                </h3>
                            </div>
                           <p>Academic board report</p>
                        </div>
                    </div>
                    </a>
                </div>
                 @endif
                  @if( @Auth::user()->role=='Lecturer'  || @Auth::user()->role=='HOD')
                <div>
                    <a>  
                     <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/uploadvideos.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                    UPLOAD VIDEOS
                                </h3>
                            </div>
                           Upload lecture videos
                        </div>
                    </div>
                    </a>
                </div>
                 
                  
                <div>
                    <a>  
                     <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/uploadnotes.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                   UPLOAD NOTES
                                </h3>
                            </div>
                           Upload lecture notes
                        </div>
                    </div>
                    </a>
                </div>
                  
                   
                @endif
                  @if( @Auth::user()->role=='Lecturer'  || @Auth::user()->role=='registrar'|| @Auth::user()->role=='admin')
                <div>
                    <a  href='{{url("/transcript")}}'>  
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <img src="{{url('public/assets/img/dashboard/transcript.png')}}"/>
                        </div>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3 class="uk-text-center uk-text-upper">
                                    RESULTS
                                </h3>
                            </div>
                            Check performance of students
                        </div>
                    </div>
                    </a>
                </div>
                  @endif
                 
                
                   @if( @Auth::user()->department=='top')  
                        <div>
                            <div class="md-card md-card-hover md-card-overlay">
                                <div class="md-card-content">
                                    <div class="epc_chart" data-percent="37" data-bar-color="#607d8b">
                                        <span class="epc_chart_icon"><i class="material-icons">&#xE7FE;</i></span>
                                    </div>
                                </div>
                                <div class="md-card-overlay-content">
                                    <div class="uk-clearfix md-card-overlay-header">
                                        <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                        <h3>
                                          CREATE USERS
                                        </h3>
                                    </div>
                                    Create a new user account
                                </div>
                            </div>
                        </div>
                   @endif
            </div> 
  


          
@endsection
@section('js')
  <!-- d3 -->
        <script src="public/assets/plugins/d3/d3.min.js"></script>
        <!-- metrics graphics (charts) -->
        <script src="public/assets/plugins/metrics-graphics/dist/metricsgraphics.min.js"></script>
        <!-- chartist (charts) -->
        <script src="public/assets/plugins/chartist/dist/chartist.min.js"></script>
        <!-- maplace (google maps) -->
          <script src="public/assets/plugins/maplace-js/dist/maplace.min.js"></script>
        <!-- peity (small charts) -->
        <script src="public/assets/plugins/peity/jquery.peity.min.js"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="public/assets/plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <!-- countUp -->
        <script src="public/assets/plugins/countUp.js/dist/countUp.min.js"></script>
        <!-- handlebars.js -->
        <script src="public/assets/plugins/handlebars/handlebars.min.js"></script>
        <script src="public/assets/js/custom/handlebars_helpers.min.js"></script>
        <!-- CLNDR -->
        <script src="public/assets/plugins/clndr/clndr.min.js"></script>
        <!-- fitvids -->
        <script src="public/assets/plugins/fitvids/jquery.fitvids.js"></script>

        <!--  dashbord functions -->
        <script src="public/assets/js/pages/dashboard.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="jquery.counterup.min.js"></script>


 <script src=https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
<script>
    var newTotalArray = new Array();
    var newTotalMale = new Array();
    var newTotalFemale = new Array();
    var years = new Array();
    var newPrgramClass = new Array();
    var new1stClass = new Array();
    var new2ndUClass = new Array();
    var new2ndLClass = new Array();
    var newPassClass = new Array();
    var newFailClass = new Array();
    <?php
    foreach($prgram1stClass as $key=> $val){?>
    new1stClass.push('<?php echo $val; ?>');
    <?php    }


    ?>
    <?php
    foreach($prgram2ndUClass as $key=> $val){?>
    new2ndUClass.push('<?php echo $val; ?>');
    <?php    }


    ?>
    <?php
    foreach($prgram2ndLClass as $key=> $val){?>
    new2ndLClass.push('<?php echo $val; ?>');
    <?php    }


    ?>
    <?php
    foreach($prgramPassClass as $key=> $val){?>
    newPassClass.push('<?php echo $val; ?>');
    <?php    }


    ?>
    <?php
    foreach($prgramFailClass as $key=> $val){?>
    newFailClass.push('<?php echo $val; ?>');
    <?php    }


    ?>
    <?php
    foreach($totalYearTotal as $key=> $val){?>
    newTotalArray.push('<?php echo $val; ?>');
    <?php    }


    ?>

    <?php
    foreach($totalMalePerYear as $key=> $val){?>
    newTotalMale.push('<?php echo $val; ?>');
    <?php    }


    ?>

    <?php
    foreach($totalFemalePerYear as $key=> $val){?>
    newTotalFemale.push('<?php echo $val; ?>');
    <?php    }


    ?>


    <?php
    foreach($prgramClass as $key=> $val){?>
    newPrgramClass.push('<?php echo $val; ?>');
    <?php    }


    ?>

    <?php
    foreach($yearData as $key=> $val){?>
    years.push('<?php echo $val; ?>');
    <?php    }


        ?>

    

var stClass = '<?php echo  $stClass; ?>';
var ndClassU = '<?php echo  $ndClassU; ?>';
var ndClassL = '<?php echo  $ndClassL; ?>';
var pass = '<?php echo  $pass; ?>';
var fail = '<?php echo  $fail; ?>';

var admitPreviousHnd = '<?php echo $admitPreviousHnd;?>';
var admitPreviousBtt = '<?php echo $admitPreviousBtt;?>';
var admitPreviousBt = '<?php echo $admitPreviousBt;?>';
var admitPreviousNt = '<?php echo $admitPreviousNt;?>';
var admitPreviousMt = '<?php echo $admitPreviousMt;?>';

var admitCurrentHnd = '<?php echo $admitCurrentHnd;?>';
var admitCurrentBtt = '<?php echo $admitCurrentBtt;?>';
var admitCurrentBt = '<?php echo $admitCurrentBt;?>';
var admitCurrentNt = '<?php echo $admitCurrentNt;?>';
var admitCurrentMt = '<?php echo $admitCurrentMt;?>';

var currentTotal = '<?php echo $currentTotal;?>';
var previousTotal = '<?php echo $previousTotal;?>';

     
     
 
$(function() {
        $(".dial").knob();
    });                            

        window.onload = function() {
        //lineChart.canvas.parentNode.style.height = '128px';
        const ctx = document.getElementById("lineChart").getContext("2d");
        //ctx.height = '100px';
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: newPrgramClass,
                datasets: [
                    {
                        label: "1st",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth:0,
                        backgroundColor: "rgba(132,236,142,0.8)",
                        borderColor: "rgba(132,236,142,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(132,236,142,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(132,236,142,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: new1stClass,
                    },

                    {
                        label: "2nd U",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth:0,
                        backgroundColor: "rgba(209,211,41,0.8)",
                        borderColor: "rgba(209,211,41,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(209,211,41,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(209,211,41,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: new2ndUClass,
                    },

                    {
                        label: "2nd L",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth:0,
                        backgroundColor: "rgba(132,132,236,0.8)",
                        borderColor: "rgba(132,132,236,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(132,132,236,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(132,132,236,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: new2ndLClass,
                    },

                    {
                        label: "Pass",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth:0,
                        backgroundColor: "rgba(158,139,41,0.8)",
                        borderColor: "rgba(158,139,41,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(158,139,41,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(158,139,41,1)",
                        pointHoverBorderColor: "rgba(250,20,20,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: newPassClass,
                    },

                    {
                        label: "Fail",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth:0,
                        backgroundColor: "rgba(253,41,41,0.8)",
                        borderColor: "rgba(253,41,41,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(253,41,41,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(253,41,41,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: newFailClass,
                    }
                ]
            },
            options: { maintainAspectRatio: false,
                legend: {
                    position : 'bottom',
                    labels: {
                    boxWidth: 20,
                    padding: 20,
                    }
                },
                scales:{
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            display: false
                        }
                            }],
                    yAxes:[{
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })

         // const ctxGender = document.getElementById("lineChartGender").getContext("2d");
         // //ctx.height = '100px';
         // window.myBar = new Chart(ctxGender, {
         //     type: 'line',
         //     data: {
         //         labels: years,
         //         datasets: [
         //             {
         //                 label: "Male",
         //                 fill: true,
         //                 lineTension: 0.0,
         //                 borderWidth:0,
         //                 backgroundColor: "rgba(255,255,255,0.2)",
         //                 borderColor: "rgba(132,236,142,1)",
         //                 borderCapStyle: 'butt',
         //                 borderDash: [],
         //                 BorderDashOffset: 0.0,
         //                 borderJoinStyle: 'miter',
         //                 pointBorderColor: "rgba(132,236,142,1)",
         //                 pointHoverRadius: 5,
         //                 pointHoverBackgroundColor: "rgba(132,236,142,1)",
         //                 pointHoverBorderColor: "rgba(220,220,220,1)",
         //                 pointHitRadius: 10,
         //                 pointBorderWidth: 1,
         //                 pointRadius: 1,
         //                 data: newTotalMale,
         //             },

         //             {
         //                 label: "Female",
         //                 fill: true,
         //                 lineTension: 0.0,
         //                 borderWidth:0,
         //                 backgroundColor: "rgba(255,255,255,0.2)",
         //                 borderColor: "rgba(132,132,236,1)",
         //                 borderCapStyle: 'butt',
         //                 borderDash: [],
         //                 BorderDashOffset: 0.0,
         //                 borderJoinStyle: 'miter',
         //                 pointBorderColor: "rgba(132,132,236,1)",
         //                 pointHoverRadius: 5,
         //                 pointHoverBackgroundColor: "rgba(132,132,236,1)",
         //                 pointHoverBorderColor: "rgba(220,220,220,1)",
         //                 pointHitRadius: 10,
         //                 pointBorderWidth: 1,
         //                 pointRadius: 1,
         //                 data: newTotalFemale,
         //             },

         //             {
         //                 label: "Total",
         //                 fill: true,
         //                 lineTension: 0.0,
         //                 borderWidth:0,
         //                 backgroundColor: "rgba(255,255,255,0.2)",
         //                 borderColor: "rgba(236,147,132,1)",
         //                 borderCapStyle: 'butt',
         //                 borderDash: [],
         //                 BorderDashOffset: 0.0,
         //                 borderJoinStyle: 'miter',
         //                 pointBorderColor: "rgba(236,147,132,1)",
         //                 pointHoverRadius: 5,
         //                 pointHoverBackgroundColor: "rgba(236,147,132,1)",
         //                 pointHoverBorderColor: "rgba(250,20,20,1)",
         //                 pointHitRadius: 10,
         //                 pointBorderWidth: 1,
         //                 pointRadius: 1,
         //                 data: newTotalArray,
         //             }
         //         ]
         //     },
         //     options: { maintainAspectRatio: false,
         //         legend: {
         //             position : 'bottom',
         //             labels: {
         //             boxWidth: 20,
         //             padding: 20,
         //             }
         //         },
         //         scales:{
         //             yAxes:[{
         //                 ticks: {
         //                     beginAtZero: true
         //                 }
         //             }]
         //         }
         //     }
         // })

         const ctx1 = document.getElementById("doughnutClass").getContext("2d");
        window.myBar = new Chart(ctx1, {
            type: 'doughnut',
            data: {
    datasets: [{
        data: [stClass, ndClassU, ndClassL, pass, fail],
        backgroundColor:['#a9ec84','#cdec84','#ecda84','#ecb584','#ec8484']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        '1st',
        '2nd U',
        '2nd L',
        'Pass',
        'Fail'
    ]
},
options:{
     legend: {
                    position : 'left',
                    labels: {
                    boxWidth: 20,
                    
                    }
                },
}
            
        })


        const ctx3 = document.getElementById("barChartInSchool").getContext("2d");
        window.myBar = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['p ('+ previousTotal +')', 'c ('+ currentTotal +')'],
                datasets: [
                    {
                        label: "Non-Ter",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth: 0,
                        backgroundColor: "rgba(87,156,215,0.8)",
                        borderColor: "rgba(87,156,215,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(87,156,215,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(87,156,215,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: [admitPreviousNt,admitCurrentNt],

                    },

                    {
                        label: "HND",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth: 0,
                        backgroundColor: "rgba(237,125,49,0.8)",
                        borderColor: "rgba(237,125,49,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(237,125,49,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(237,125,49,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: [admitPreviousHnd,admitCurrentHnd],
                    },

                    {
                        label: "BTT",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth: 0,
                        backgroundColor: "rgba(165,165,165,0.8)",
                        borderColor: "rgba(165,165,165,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(165,165,165,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(165,165,165,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: [admitPreviousBtt,admitCurrentBtt],
                    },

                    {
                        label: "BT(4yrs)",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth: 0,
                        backgroundColor: "rgba(255,192,0,0.8)",
                        borderColor: "rgba(255,192,0,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(255,192,0,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(255,192,0,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: [admitPreviousBt,admitCurrentBt],
                    },

                    {
                        label: "Mst",
                        fill: true,
                        lineTension: 0.0,
                        borderWidth: 0,
                        backgroundColor: "rgba(126,213,88,0.8)",
                        borderColor: "rgba(126,213,88,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        BorderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(126,213,88,1)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(126,213,88,1)",
                        pointHoverBorderColor: "rgba(250,20,20,1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 1,
                        pointRadius: 1,
                        data: [admitPreviousMt,admitCurrentMt],
                    }
                ]
            },
            options: { maintainAspectRatio: false,
                legend: {
                    position : 'right',
                    labels: {
                    boxWidth: 20,
                    padding:7,
                    }
                },
                scales:{
                    xAxes: [{
                        stacked: true
                            }],
                    yAxes:[{
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })
    }

    // $('.counter').counterUp({
                
    //       });
</script>

<script type="text/javascript">
    setInterval(function(){

       location.reload("true"); 
    }, 600000)


    /* setInterval(function(){
        $("#counterRefresh").load("dashboard");
    // }, 2000)*/
</script>
 
@endsection