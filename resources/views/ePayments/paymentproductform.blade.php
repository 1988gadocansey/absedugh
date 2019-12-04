@extends('layouts.app')

@section("body_class")
class="header-full"
@endsection

@section('main-header')
<!-- main header -->

@endsection
@section('content')
 <div class="md-card">
            
       <div class="md-card-content">


      <div class="uk-width-1-1  uk-container-center">
      @if ($messages=Session::get("messages"))
      <div class="uk-alert uk-alert-success">
          @foreach ($messages as $error)
          <p>{!! $error !!}</p>
          @endforeach
      </div>
      @endif

   @if (count($errors) > 0)
          <div class="uk-alert uk-alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{!! $error !!}</li>
              @endforeach
          </ul>
      </div>
      @endif
      </div>


<?php

//check for whether we are editing an existing model or a creating a new paymentproduct and set the url accordingly
if (isset($paymentproduct->id)) {
	$url = url("viewproduct", array(@$paymentproduct->id));
} else {
	$url = url("createproduct");
}

?>
<h2> 
  @if(isset($paymentproduct->id))  
  PAYMENT PRODUCT UPDATE
@else
    PAYMENT PRODUCT CREATION
@endif
</h2>

<form class="uk-form uk-form-horizontal"  action="{!!  $url !!}" method="post">

                              <input type="hidden" name="_token" value="{!!  csrf_token ()  !!}">
                                <div class="uk-form-row">
                                    <label for="form-h-it" class="uk-form-label">Purpose</label>
                                    <div class="uk-form-controls">
                                        <input name="purpose" placeholder="Purpose of payment" id="payment_purpose"  value="{{ old("purpose",@$paymentproduct->purpose) }}">
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Payment Name</label>
                                    <div class="uk-form-controls">
                                        <input name="payment_name" placeholder="Brand Name for Payment" id="payment_name" value="{{ old("payment_name",@$paymentproduct->payment_name) }}">
                                    </div>
                                </div>
                                    <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Bank Account Number</label>
                                    <div class="uk-form-controls">
                                        <input name="account_no" placeholder="Enter Account No" id="account_no" value="{{  old("account_no",@$paymentproduct->account_no)  }}">
                                    </div>
                                </div>
                          <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Deadline of Payment</label>
                                    <div class="uk-form-controls">
                                        <input name="deadline" placeholder="PAYMENT WILL BE DISABLED AFTER DATE" id="deadline" data-uk-datepicker="{format:'YYYY-MM-DD'}"  value="{{  old("deadline",@$paymentproduct->deadline)}}"  class="form-control">
                                    </div>
                                </div>

<div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Payment Made Being</label>
                                    <div class="uk-form-controls">
                                <input name="payment_info" placeholder="WHAT SHOULD APPEAR ON RECEIPT"  value="{{ old("payment_info",@$paymentproduct->payment_info) }}"   id="payment_info">
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Part Payment Acceptable</label>
                                    <div class="uk-form-controls">
                                        {!! Form::select("accept_part_payment",array_combine(range(0,100,5),range(0,100,5)),old("accept_part_payment",@$paymentproduct->accept_part_payment) ,array("placeholder"=>"IS PART PAYMENT ACCEPTED" ,"id"=>"accept_part_payment"))  !!} % of amount
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Currency</label>
                                    <div class="uk-form-controls">
                                        {!! Form::select("currency",array("GHC"=>"GHC","POUNDS"=>"POUNDS","DOLLAR"=>"DOLLAR","EURO"=>"EURO"),old("currency",@$paymentproduct->currency) ,array( "id"=>"currency","placeholder"=>"Select Currency"))  !!}
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Default Transactional Value</label>
                                    <div class="uk-form-controls">
                                        <input name="default_value" placeholder="COST PER TRANSACTION"   id="default_value"  value="{{  old("default_value",@$paymentproduct->default_value)}}" >
                                    </div>
                                </div>
                               <div class="uk-form-row">
                                    <label for="form-h-ip" class="uk-form-label">Amount</label>
                                    <div class="uk-form-controls">
                                        <input name="cot" placeholder="CHARGE ON TRANSACTION"   id="default_value"  value="{{  old("cot",@$paymentproduct->cot)}}" >
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <label for="form-h-t" class="uk-form-label">Payment Period Info</label>
                                    <div class="uk-form-controls">
                                        <textarea  name="payment_period" id="payment_period"  rows="3" cols="30" id="form-h-t"  placeholder="LIKE YEAR:2013/2014 TERM:1 OR MONTH:JULY">
                                          {!!  trim(old("payment_period",@$paymentproduct->payment_period) ) !!}
                                        </textarea>
                                    </div>
                                </div>

<div class="uk-form-row">
                                    <label for="form-h-t" class="uk-form-label">Instruction to Follow After Payment</label>
                                    <div class="uk-form-controls">
                                        <textarea  name="usage_instruction" id="usage_instruction"  rows="3 " cols="30" id="form-h-t" placeholder="PLEASE ENTER WHAT THE PAYEE SHOULD DO AFTER PAYMENT">
                                          {{  old("usage_instruction",trim(@$paymentproduct->usage_instruction))  }}
                                        </textarea>
                                    </div>
                                </div>

                                       <div class="uk-form-row">
                                         <div class="uk-form-controls">
                                        <input class="md-btn md-btn-primary "  type="submit" name="submit" value="SAVE">
                                        <input class="md-btn md-btn-warning " type="reset" name="cancel" value="CANCEL">
                                    </div>
                                </div>


                            </form>


</div>
</div>
  @endsection

  @section("javascript")
  <script>
  </script>
  @endsection
