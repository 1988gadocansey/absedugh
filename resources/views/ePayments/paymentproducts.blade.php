@extends('layouts.master')

@section("body_class")
 class="header-full"
@endsection

@section('main-header')
    <!-- main header -->

@endsection
@section('content')
 <div class="md-card">
            
       <div class="md-card-content">



                <form action="{!!    url('viewproducts')  !!}"  method="post" accept-charset="utf-8" novalidate>
                   {!!  csrf_field()  !!}
                    <div class="uk-grid" data-uk-grid-margin="">

                         <div class="-medium-1-10">
                            <input type="text" class="md-input" name="search" value="{{  old("search")  }}">
                        </div>
                          <div class="-medium-1-10 uk-text-center">
                            <input class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit"  value="Search" />
                        </div>

                        <div class="-medium-1-10">
                            <input type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ old("order_from_date") }}" name="date1" id="invoice_dp" class="md-input">
                        </div>

                        <div class="-medium-1-10">
                            <input type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ old("order_to_date") }}" name="date2"  class="md-input">
                        </div>

                          <div class="-medium-1-10 uk-text-center"   >
                           {{--  <input class="md-btn md-btn-success uk-margin-small-top" type="submit" name="search_button"  value="Print All " /> --}}
                           <i class="material-icons md-36 uk-text-success" onclick="window.open('','location=1,status=1,menubar=yes,scrollbars=yes,resizable=yes,width=1000,height=500');"  >print</i>
                        </div>

                    </div>
                    </form>
                </div>
            </div>


            <div class="md-card uk-margin-medium-bottom">

                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table  uk-table-hover uk-table-condensed " border="">
                            <thead>
                            <tr>
                            <th class=" uk-text-left">#</th>
                            <th class=" uk-text-left">Date</th>
                            <th class=" uk-text-left">Purpose</th>
                                <th class=" uk-text-left">Payment Name</th>
                                <th class=" uk-text-left">Bank Account No</th>
                                <th class="uk-text-left">Deadline</th>
                                <th class=" uk-text-left">Payment Information</th>
                                <th class=" uk-text-left">Accept Part Payment</th>

                                <th class=" uk-text-left">Default Transactional Value</th>
                                <th class=" uk-text-left">Currency  </th>

                                <th class=" uk-text-left">Payment Period Note</th>
                                <th class=" uk-text-left">Usage Instructions</th>

                                <th class=" uk-text-left">View Assets</th>
                                <th class=" uk-text-left">Load Assets</th>

                            </tr>
                            </thead>
                            <tbody>
                          @if(!$paymentproducts->isEmpty())
                          @foreach($paymentproducts as $index=>$paymentproduct)
                                <tr class="uk-table-middle">
                                <td class="uk-text-left">{{ $paymentproducts->perPage()*($paymentproducts->currentPage()-1)+($index)+1 }}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->dates }}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->purpose }}</td>
                                  <td class="uk-text-left"><a href="{{  url("viewproduct",array($paymentproduct->id)) }}">{{ $paymentproduct->payment_name}}</a></td>
                                  <td class="uk-text-left">{{ $paymentproduct->account_no}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->deadline}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->payment_info}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->accept_part_payment}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->default_value}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->currency}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->payment_period}}</td>
                                  <td class="uk-text-left">{{ $paymentproduct->usage_instruction}}</td>
                                  <td class="uk-text-left">
                                  <a style="font-size:16px;color:#060; font-weight:bold" href="{!!  url($assets_view_list[$paymentproduct->purpose],array($paymentproduct->id)) !!}" ><img src='{!! url("public/images/properties_f2.png") !!}' width="32" height="32" alt="entermarks" /></a></td>
                                  <td class="uk-text-left">
                                    <a style="font-size:16px;color:#060; font-weight:bold" href="{!!  url($assets_load_list[$paymentproduct->purpose],array($paymentproduct->id)) !!}" ><img src='{!!  url("public/images/addedit.png") !!}' width="33" height="35" alt="entermarks" /></a>
                                  </td>
                                </tr>
                          @endforeach
                           @else
                       <div class="md-card-content">

                       O records found!

                          @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ (new App\Presenters\UIKitPresenter()) instantiates the custom defined pagination html class so it looks different from the default bootstrap laravel one  }} --}}
                    {{-- {{ $transcripts->appends(old()) adds the request or query parameters from the flash session onto the generated url for the pagination.   }} --}}
                    {!!  (new App\Presenters\UIKitPresenter($paymentproducts->appends(old()) ))->render() !!}
                </div>

</div>

    

@endsection

@section("javascript")
<script>
</script>
@endsection