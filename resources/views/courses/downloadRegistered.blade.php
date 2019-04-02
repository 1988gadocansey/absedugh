@extends('layouts.app')


@section('style')
    <style>
        .md-card{
            width: auto;

        }

    </style>
    <script src="{!! url('public/assets/js/jquery.min.js') !!}"></script>

    <script src="{!! url('public/assets/js/jquery-ui.min.js') !!}"></script>

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
        <h3 class="heading_c uk-margin-bottom">Download Class List</h3>

        <div class="uk-width-xLarge-1-1">

            <div class="md-card">
                <div class="md-card-content" style="">

                    <form  action="{{url('/download_registered')}}" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="POST" name="applicationForm"  v-form>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="uk-grid" data-uk-grid-margin>
                            
                                
                                    
                                    <div class="uk-width-medium-1-4">
                                        <div class="uk-form-row">
                                            <label class="">Semester</label>
                                            <p></p>
                                            {{ Form::select('sem', array(''=>'select semester','1'=>'1', '2'=>'2','3'=>'3'), null, ["required"=>"required",'class' => 'md-input label-fixed','v-model'=>'semester','v-form-ctrl'=>'','v-select'=>'']) }}

                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <div class="uk-form-row">  
                                            <label>Level</label>
                                            <p></p>
                                            <!-- {!! Form::select('level',
                                            ($level ),
                                            old("level",""),
                                             ['class' => 'md-input parent','required'=>"required",'placeholder'=>'select level'] )  !!} -->
                                             <select name="level" id="level" required>
                                                <option value="" disabled selected>Select Level</option>
                                                <option value="100">Level 100</option>
                                                <option value="200">Level 200</option>
                                                <option value="300">Level 300</option>
                                                <option value="400">Level 400</option>
                                             </select>

                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-form-row">        
                                            <table align="left">
                                                <tr><td><label>Masters</label><br/><p></p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="combine" name="combine" value="MT" required>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td><label>Btech (4yrs)</label><br/><p></p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="combine" name="combine" value="BT">
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td><label>Btech top up</label><br/><p></p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="combine" name="combine" value="BTT">
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td><label>HND</label><br/><p></p>
                                                <input type="radio" id="combine" name="combine" value="H">
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td><label>Diploma</label><br/><p></p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="combine" name="combine" value="NT">
                                                </td>
                                                </tr>
                                                
                                            </table>
                                        </div>    
                                    </div>

                                
                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-form-row">
                                            <label>Course</label>
                                            <p></p>
                                              <select placeholder='type courses' class="form-control" style="width:490px" name="course" required="required" class= 'md-input'v-model='course' v-form-ctrl='' v-select=''>

                                                       <option selected="">type course name here</option>

                                                       @foreach($courses as $item)

                                                    

                                                      <option value="{{$item->COURSE_CODE}}">{{$item->COURSE_NAME}} - {{ $item->COURSE_CODE }} - Sem{{ $item->COURSE_SEMESTER}}</option>

                                                    @endforeach

                                                  </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-form-row">
                                                <label>Program</label>
                                                <p></p>
                                                {!! Form::select('program',
                                             (['' => 'select program'] +$programme ),
                                               old("program",""),
                                                 ['class' => 'md-input parent','required'=>"required",'placeholder'=>'select program'] )  !!}

                                        </div>
                                    </div>
                        </div>
                        <p></p>
                        <table align="center">

                            <tr><td><input type="submit" value="Download" id='saves'   class="md-btn   md-btn-success uk-margin-small-top">
                                    <input type="reset" value="Clear" class="md-btn   md-btn-default uk-margin-small-top">
                                </td></tr></table>
                        
                    </form>

                </div>
            </div>
        </div>
        @endsection

        @section('js')
            <script>

            </script>
            <script src="{!! url('public/assets/js/select2.full.min.js') !!}"></script>
            <script>
                $(document).ready(function(){
                    $('select').select2({ width: "resolve" });


                });


            </script>

@endsection    