@extends('layouts.app')



@section('content')

    <div class="md-card">
        <div class="md-card-content">
            @if(Session::has('success_message'))
                <div style="text-align: center" class="uk-alert uk-alert-success" data-uk-alert="">
                    {{ Session::get('success_message') }}
                </div>
            @endif
            @if(Session::has('error_message'))

                <div style="text-align: center" class="uk-alert uk-alert-danger" data-uk-alert="">
                    {{ Session::get('error_message') }}
                </div>
            @endif



            @if (count($errors) > 0)

                <div class="uk-form-row">
                    <div class="alert alert-danger" style="background-color: red;color: white">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{  $error  }} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <center><h5>View Payment Products</h5></center>



            <form    method="get" accept-charset="utf-8" novalidate>

                <div class="uk-grid" data-uk-grid-margin="">


                    <div class=" ">
                        <input type="text" placeholder="Type Search" class="md-input" placeholder="Search " name="search" value="{{  old("search")  }}">
                    </div>


                    <div class="">
                        <div class="md-input-wrapper md-input-filled">
                            <label>Deadline</label>
                            <input type="text"  style="width: 130px" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ old("deadline") }}" name="deadline"  placeholder="Deadline"  id="invoice_dp" class="md-input" >

                        </div>
                    </div>

                    <div class="" style="margin-top: 13px">
                        <input class="md-btn md-btn-primary " type="submit" name="submit"  value="Search" />
                    </div>


                    <div class="uk-width-medium-1-10 uk-text-center" style="margin-left: 0px;margin-top: 13px"  >

                        <i title="click to print" style="margin-top: 1px"class="material-icons md-36 uk-text-success" onclick=" "  >print</i>
                    </div>

                </div>

            </form>


        </div>
    </div>

    <div class="uk-width-xLarge-1-1">
        <div class="md-card">
            <div class="md-card-content">
            <div class="uk-overflow-container">
                <table class="uk-table uk-table-condensed uk-table-hover" >
                    <thead>
                    <tr>
                        <th style="font-weight: bold!important;">#</th>
                        <th  style="font-weight: bold!important;" width="">Date</th>
                        <th  style="font-weight: bold!important;"  width="">Purpose</th>
                        <th  style="font-weight: bold!important;" width="">Payment Name </th>
                        <th  style="font-weight: bold!important;"  width="">Bank Account No</th>
                        <th   style="font-weight: bold!important;" width="">Deadline</th>
                        <th  style="font-weight: bold!important;" >Payment Information </th>
                        <th  style="font-weight: bold!important;" >Accept Part Payment</th>
                        <th  style="font-weight: bold!important;" >Default Transactional Value</th>
                        <th  style="font-weight: bold!important;"  width="">Currency</th>
                        <th  style="font-weight: bold!important;"  width="">Payment Period Note</th>
                        <th  style="font-weight: bold!important;" width="">Usage Instructions</th>
                        <th  style="font-weight: bold!important;" colspan="2">Action</th>

                    </tr>
                    </thead>
                    <tbody class="selects">

                    @if(!@$paymentproducts->isEmpty())
                        @foreach(@$paymentproducts as $data=>$paymentproduct)
                            <tr class="uk-table-middle">
                                <td class="uk-text-left">{{ $paymentproducts->perPage()*($paymentproducts->currentPage()-1)+($data)+1 }}</td>
                                <td class="uk-text-left">{{  date('D, d/m/Y',strtotime( $paymentproduct->dates)) }}</td>
                                <td class="uk-text-left">{{ $paymentproduct->purpose }}</td>
                                <td class="uk-text-left">{{$paymentproduct->payment_name}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->account_no}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->deadline}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->payment_info}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->accept_part_payment}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->default_value}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->currency}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->payment_period}}</td>
                                <td class="uk-text-left">{{ $paymentproduct->usage_instruction}}</td>
                                <td>
                                        <a href='{{url("/viewproduct/$paymentproduct->id")}}' ><i title='Click to edit course' class="md-icon material-icons">edit</i></a>
                                </td>
                                <td>
                                        {!!Form::open(['action' =>['PaymentProductController@destroy', 'id'=>$paymentproduct->id], 'method' => 'DELETE','name'=>'c' ,'style' => 'display: inline;'])  !!}

                                        <button type="submit" onclick="return confirm('Are you sure you want to delete   {{$paymentproduct->payment_name}}?')" class="md-btn  md-btn-danger md-btn-small   md-btn-wave-light waves-effect waves-button waves-light" ><i  class="sidebar-menu-icon material-icons md-18">delete</i></button>

                                        {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="md-card-content">

                            0 records found!
                        </div>
                    @endif

                    </tbody>
                </table>
                <br>
                {!!  (new App\Presenters\UIKitPresenter($paymentproducts->appends(old()) ))->render() !!}

            </div>
        </div>
    </div>
    </div>


@endsection
@section('scripts')


    <script type="text/javascript">

        $(document).ready(function(){
// console.log($('select[name="status"]'));
            $("#parent").on('change',function(e){

                $("#group").submit();

            });
        });

    </script>
@endsection