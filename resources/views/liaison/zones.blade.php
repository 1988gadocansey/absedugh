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
        <h5 class="heading_c uk-margin-bottom">Zones</h5>

        <div style="">
            <div class="uk-margin-bottom" style="margin-left:1000px" >
                <i title="click to print" onclick="javascript:printDiv('print')" class="material-icons md-36 uk-text-success"   >print</i>

                <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                    <button class="md-btn md-btn-small md-btn-success"> show/hide columns <i class="uk-icon-caret-down"></i></button>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown" id="columnSelector"></ul>
                    </div>
                </div>
                <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                    <button class="md-btn md-btn-small md-btn-success uk-margin-right">Export <i class="uk-icon-caret-down"></i></button>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="#" onClick ="$('#regular').tableExport({type:'csv',escape:'false'});"><img src='{!! url("public/assets/icons/csv.png")!!}' width="24"/> CSV</a></li>

                            <li class="uk-nav-divider"></li>
                            <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'excel',escape:'false'});"><img src='{!! url("public/assets/icons/xls.png")!!}' width="24"/> XLS</a></li>
                            <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'doc',escape:'false'});"><img src='{!! url("public/assets/icons/word.png")!!}' width="24"/> Word</a></li>
                            <li><a href="#" onClick ="$('#ts_pager_filter').tableExport({type:'powerpoint',escape:'false'});"><img src='{!! url("public/assets/icons/ppt.png")!!}' width="24"/> PowerPoint</a></li>
                            <li class="uk-nav-divider"></li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>

        @inject('fee', 'App\Http\Controllers\FeeController')
        @inject('sys', 'App\Http\Controllers\SystemController')


        <!-- end filters -->
        <div class="uk-width-xLarge-1-1">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="md-fab-wrapper">
                        <a class="md-fab md-fab-small md-fab-accent md-fab-wave" href="{{url('/liaison/create/zones')}}"  >
                            <i class="material-icons md-18">&#xE145;</i>
                        </a>
                    </div>

                    <div class="uk-overflow-container" id='print'>
                        <center><span class="uk-text-success uk-text-bold">{!! $data->total()!!} Records</span></center>
                        <table border="0" class="uk-table uk-table-hover uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_pager_filter">
                            <thead>
                            <tr>
                                <td>NO</td>
                                <td>ZONES</td>
                                <td>SUB ZONES</td>
                                <td>ACTIONS</td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $index=> $row)
                                <tr>
                                    <td> {{ $data->perPage()*($data->currentPage()-1)+($index+1) }} </td>


                                    <td>{{ strtoupper($row->zones) }}</td>
                                    <td>{{ strtoupper($row->sub_zone) }}</td>
                                      <td>


                                          {!!Form::open(['action' =>['LiaisonController@destroyZones', 'id'=>$row->id], 'method' => 'DELETE','name'=>'c' ,'style' => 'display: inline;'])  !!}

                                          <button type="submit" onclick="return confirm('Are you sure you want to delete   {{$row->zones}} -  {{ @$row->sub_zone	 }}?')" class="md-btn  md-btn-danger md-btn-small   md-btn-wave-light waves-effect waves-button waves-light" ><i  class="sidebar-menu-icon material-icons md-18">delete</i></button>

                                          {!! Form::close() !!}



                                    </td>

                                </tr>
                            @endforeach



                            </tbody>

                        </table>
                        <table>

                        </table>

                        {!! (new Landish\Pagination\UIKit($data->appends(old())))->render() !!}
                    </div>


                </div>
            </div></div>
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