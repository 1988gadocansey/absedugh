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
  <h3 class="heading_c uk-margin-bottom">Upload   Grades (Excel file format only)  </h3>
        
<div class="uk-width-xLarge-1-1">
    
    <div class="md-card">
        <div class="md-card-content" style="">
 
             <form  action="{{url('/upload_marks')}}" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="POST" name="applicationForm"  v-form>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
               <div class="uk-grid" data-uk-grid-margin>                            
                                  <div class="uk-width-medium-1-6">
                                    <div class="uk-form-row">
                                        <label class="">Semester</label>
                                        <p></p>

                                        <select name="sem" id="sem" required>
                                            <option value="" disabled selected>Select Semester</option>
                                            <option value="1">Semester 1</option>
                                            <option value="2">Semester 2</option>
                                            <option value="3">Semester 3</option>

                                        </select>



                                    </div>
                                  </div>

                   <div class="uk-width-medium-1-6">
                       <div class="uk-form-row">
                           <label class="">Level</label>
                           <p></p>
                            <select name="level" id="level" required>
                               <option value="" disabled selected>Select Level</option>
                               <option value="100">Level 100</option>
                               <option value="200">Level 200</option>
                               <option value="300">Level 300</option>
                               <option value="400">Level 400</option>
                               <option value="MBA">MBA</option>
                           </select>
                       </div>
                   </div>




                                  <div class="uk-width-medium-1-3">

                                        <label>Academic year</label>
                                        <p></p>
                                      <select name="year" id="year" required>
                                          <option value="" disabled selected>Select academic year</option>
                                          <option value="2018/2019">2018/2019</option>
                                          <option value="2019/2020">2019/2020</option>
                                          <option value="2020/2021">2020/2021</option>
                                          <option value="2021/2022">2021/2022</option>
                                          <option value="2022/2023">2022/2023</option>
                                      </select>


                                  </div>
                        
                            <div class="uk-width-medium-1-6">
                            <div class="uk-form-row">
                              
                                <label>Excel files only</label>
                                 <p></p>                                  
                               <input type="file"  class="md-input   md-input-success " required=""  name="file"/>
                            </div>
                            
                        </div>


                        <div class="uk-width-medium-2-5">
                            <div class="uk-form-row">
                              
                                <label>Course</label>
                                <p></p>
                                  <select placeholder='type courses' class="form-control" style="width:490px" name="course" required="required" class= 'md-input'v-model='course' v-form-ctrl='' v-select=''>

                                           <option value="" disabled selected hidden>select course</option>


                                           @foreach($courses as $item)

                                        

                                          <option value="{{$item->COURSE_CODE}}">{{$item->COURSE_NAME}} - {{ $item->COURSE_CODE }} - Sem{{ $item->COURSE_SEMESTER}}</option>

                                        @endforeach

                                      </select>
                            </div>
                            </div>
                        <div class="uk-width-medium-1-5">
                            <div class="uk-form-row">
                              <p></p><p></p><p></p><p></p>
                                <table align="center">
       
        <tr><td><input type="submit" value="Upload" id='savess'   class="md-btn   md-btn-success uk-margin-small-top">
      <input type="reset" value="Clear" class="md-btn   md-btn-default uk-margin-small-top">
    </td></tr></table>
                            </div>
                            
                        </div>
                    </div>
                    <p></p>
                  
            </form>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
        $(document).ready(function(){
            $("#form").on("submit",function(event){
                event.preventDefault();
       UIkit.modal.alert('Uploading marks. Please wait patiently. Larger classes take longer time');
         $(event.target).unbind("submit").submit();
    
                        
            });
            
    
                    
    
    });
</script>
<script src="{!! url('public/assets/js/select2.full.min.js') !!}"></script>
  <script>
$(document).ready(function(){
  $('select').select2({ width: "resolve" });

  
});


</script>   
 
@endsection    