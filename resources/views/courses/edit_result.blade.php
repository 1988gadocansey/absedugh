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
    @inject('sys', 'App\Http\Controllers\SystemController')
    <div style="">
        <div class="uk-margin-bottom" style="margin-left:750px" >

            <a href="#" class="md-btn md-btn-small md-btn-success uk-margin-right" id="printTable">Print Table</a>

            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                <button class="md-btn md-btn-small md-btn-success"> columns <i class="uk-icon-caret-down"></i></button>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown" id="columnSelector"></ul>
                </div>
            </div>





            <div style="margin-top: -5px" class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                <button class="md-btn md-btn-small md-btn-success uk-margin-small-top">Export <i class="uk-icon-caret-down"></i></button>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'csv',escape:'false'});"><img src='{!! url("public/assets/icons/csv.png")!!}' width="24"/> CSV</a></li>

                        <li class="uk-nav-divider"></li>
                        <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'excel',escape:'false'});"><img src='{!! url("public/assets/icons/xls.png")!!}' width="24"/> XLS</a></li>
                        <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'doc',escape:'false'});"><img src='{!! url("public/assets/icons/word.png")!!}' width="24"/> Word</a></li>
                        <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'powerpoint',escape:'false'});"><img src='{!! url("public/assets/icons/ppt.png")!!}' width="24"/> PowerPoint</a></li>
                        <li class="uk-nav-divider"></li>

                    </ul>
                </div>
            </div>




            <i title="click to print" onclick="javascript:printDiv('print')" class="material-icons md-36 uk-text-success"   >print</i>



        </div>
    </div>
@inject('sys', 'App\Http\Controllers\SystemController')
    <h5>Uploaded Results</h5>
    <div class="uk-width-xLarge-1-1">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-overflow-container" id='print'>
                    <center><span class="uk-text-success uk-text-bold">{!! $data->total()!!} Records</span></center>
                    <table class="uk-table uk-table-hover uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_pager_filter">
                        <thead>
                        <tr>
                            <th width="5%" class="filter-false remove sorter-false" data-priority="6" >NO</th>
                            <th width="30%">PROGRAMME</th>
                            <th width="30%">COURSE</th>
                            <th width="7%" style="text-align:center">CODE</th>
                            <!--<th>PROGRAMME</th>-->
                            <th width="7%" style="text-align:center">CREDIT</th>

                            <th width="7%" style="text-align:center">LEVEL</th>
                            <th width="7%" style="text-align:center">SEM</th>
                            <th width="7%" style="text-align:center">YEAR</th>

                            <th width="15%" class="filter-false remove sorter-false uk-text-center" colspan="2" data-priority="1">ACTION</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $index=> $row)


                        <?php $year_array=explode("/",$row->year);

                        $year1=$year_array[0];
                        $year2=$year_array[1];
                        $year=$year1."_".$year2;
                        $progName=@$sys->getProgramName($row->programme);


                        ?>

                            <tr align="">
                                <td> {{ $data->perPage()*($data->currentPage()-1)+($index+1) }} </td>
                                <td> {{ @$progName }}</td>
                                <td> {{ @$row->courseMount->course->COURSE_NAME }}</td>
                                <td> {{ @$row->courseMount->course->COURSE_CODE	 }}</td>
                                <!--<td> {{ @$row->courseMount->course->programme->PROGRAMME	 }}</td>-->
                                <td> {{ @$row->credits	 }}</td>
                                <td> {{ @$row->level }}</td>
                                <td> {{ @$row->sem }}</td>
                                <td> {{ @$row->year }}</td>
                                <td>
                                    <a onclick="return MM_openBrWindow('{{url("enter_mark/$row->code/course/$row->code/code/year/$year/sem/$row->sem/pro/$row->programme")}}','mark','width=800,height=500')" ><i title='Click to enter mark' class="md-icon material-icons">edit</i>View/Enter Marks</a>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {!! (new Landish\Pagination\UIKit($data->appends(old())))->render() !!}
                </div>
            </div>
            <div class="md-fab-wrapper">
                <a class="md-fab md-fab-small md-fab-accent md-fab-wave" href="{!! url('/create_course') !!}">
                    <i class="material-icons md-18">&#xE145;</i>
                </a>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">

        $(document).ready(function(){

            $(".parent").on('change',function(e){

                $("#group").submit();

            });
        });

    </script>
    <script src="{!! url('public/assets/js/select2.full.min.js') !!}"></script>
    <script>
        $(document).ready(function(){
            $('select').select2({ width: "resolve" });


        });


    </script>
    <!--  notifications functions -->
    <script src="public/assets/js/components_notifications.min.js"></script>
@endsection