@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Payment")}}</h5>
          </div>
          <div class="card-body-custom">
            <form id="payment_store" method="post" action="{{ route('sale.paymentadd') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
              @include('alerts.success')
              @if($errors->any())
                <div class="form-group">
                  <div class="alert alert-danger">
                    <ul>
                      @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endif
              <div class="row">
                <div class="card-body-custom col-12">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="form-first-col-4">
                          <div class="form-group">
                            <label for="customer_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Customer")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input type="text" id="customercodesearch" name="customer_code" placeholder="Search Customer by code" class="form-control col-12" value="{{ old('customer_code') }}" />
                                <input readonly type="hidden" name="payment_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="{{ old('customer_name') }}" />
                                <input readonly type="hidden" name="payment_customer_id" id="customer_id" class="form-control col-12" value="{{ old('customer_id') }}" />
 
                                {{-- <input type="hidden" name="customer_code" id="allcustomers" class="form-control col-12"  /> --}}
                                  <?php $snameArray = []; $snamecodeArray = []; ?>
                                  @foreach($customers as $one_customer) 
                                    <div class="customernames_array" style="display: none">{{ $snameArray[] = $one_customer->customer_name }}</div>
                                    <div class="customernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_customer->customer_name.", ".($one_customer->customer_ref_no) }}</div>
                                  @endforeach
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'customer_code'])
                            </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-3">
                          <div class="form-group">
                            <label readonly for="payment_customer_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                              <div class="input-group pos">
                                <input readonly type="text" name="payment_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="payment_customer_id" id="customer_id" class="form-control col-12" value="" />
                                <-- <select readonly required name="payment_customer_name" id="customer_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 150px">
                                  @foreach($customers as $single_customer)
                                    <option status_id="{{$single_customer->status_id}}" value="{{$single_customer->customer_id}}">{{$single_customer->customer_name}}</option>
                                  @endforeach
                                </select> -->
                              </div>
                              @include('alerts.feedback', ['field' => 'payment_customer_name'])
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="customer_status" class="form-col-12 control-label">{{__("Status")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="customer_status" id="customer_status" class="form-control col-12" value="">
                                @include('alerts.feedback', ['field' => 'customer_status'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label for="customer_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Customer Paid")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="customer_amount_paid" id="customer_balance_paid" class="form-control" value="{{ old('customer_amount_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-3">
                          <div class="form-group">
                            <label for="customer_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Customer Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="customer_amount_dues" id="customer_balance_dues" class="form-control" value="{{ old('customer_amount_dues', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_amount_dues'])
                            </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-2">
                          <div class="form-group">
                            <label for="payterm_duratype" class="form-col-12 control-label">{{__("Payterm")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="payterm_duratype" id="payterm_duratype" class="form-control col-12" value="{{ old('payterm_duratype', '') }}">
                              </div>
                          </div>
                        </div> --}}
                        {{-- <div class="form-last-col-3">
                          <div class="form-group">
                            <label for="customer_credit_limit" class=" form-col-12 control-label">{{__("Credit Limit")}}</label>
                              <div class=" form-col-12">
                                <input readonly type="number" name="customer_credit_limit" id="customer_credit_limit" class="form-control col-12" value="{{ old('customer_credit_limit', '') }}">
                                @include('alerts.feedback', ['field' => 'credit_limit'])
                              </div>
                          </div>
                        </div> --}}
                      </div>
                      <div class="row">
                        <div class="form-first-col-3">
                          <div class="form-group">
                            <label for="payment_method" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Payment Method")}}</label>
                              <div class="form-col-12">
                                {{-- <input readonly type="text" name="payment_method" class="form-control col-12" value="{{ old('payment_method', 'Cash') }}"> --}}
                                <select required id="payment_method" name="payment_method" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Method...">
                                  <option value="cash">Cash</option>
                                  <option value="credit">Credit</option>
                                  <option value="cheque">Cheque</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'payment_method'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label for="payment_type" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Payment Type")}}</label>
                              <div class="form-col-12">
                                {{-- <input readonly type="text" name="payment_type" class="form-control col-12" value="{{ old('payment_type', 'Cash') }}"> --}}
                                <select required id="payment_type" name="payment_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Type...">
                                  <option value="recieving">Recieving</option>
                                  <option value="returning">Returning</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'payment_type'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label for="payment_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Payment Invoice No.")}}</label>
                              <div class="form-col-12">
                                <div class="myrow">
                                  <input type="text" id="payment_invoice_id" name="payment_invoice_id" class="form-control form-col-12" value="{{ old('payment_invoice_id', $payment_invoice_id) }}">
                                </div>
                                @include('alerts.feedback', ['field' => 'payment_invoice_id'])
                              </div>
                          </div>
                        </div>
                        <div class="form-last-col-3">
                          <div class="form-group">
                            <label for="payment_invoice_date" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Payment/Invoice Date")}}</label>
                            <div class="form-col-12 input-group ">
                              {{-- <div class="input-group-prepend">
                                <span class="input-group-text barcode"><i class="fa fa-file-text-o"></i></span>
                              </div> --}}
                              <input type="date" name="payment_invoice_date" class="form-control" value="{{ \Carbon\Carbon::today()->toDateString() }}">
                              @include('alerts.feedback', ['field' => 'payment_invoice_date'])
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-first-col-3">
                          <div class="form-group">
                            <label for="payment_cheque_no" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Cheque No.")}}</label>
                            <div class="form-col-12">
                              <input type="text" name="payment_cheque_no" class="form-control form-col-12"  value="{{ old('payment_cheque_no', '') }}">
                              @include('alerts.feedback', ['field' => 'payment_cheque_no'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label for="payment_cheque_date" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Cheque Date")}}</label>
                            <div class="form-col-12">
                              <input type="text" name="payment_cheque_date" class="form-control form-col-12"  value="{{ old('payment_cheque_date', '') }}">
                              @include('alerts.feedback', ['field' => 'payment_cheque_date'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label for="sale_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Sale Invoice No.")}}</label>
                              <div class="form-col-12">
                                <div class="myrow">
                                  <input type="text" id="sale_invoice_id" name="sale_invoice_id" class="form-control form-col-12" value="{{ old('sale_invoice_id', '') }}">
                                  <!-- <button type="button" href="{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                    <i class="fa fa-file-text-o"></i>
                                  </button> -->
                                </div>
                                @include('alerts.feedback', ['field' => 'sale_invoice_id'])
                              </div>
                          </div>
                        </div>
                        <div class="form-last-col-3">
                          <div class="form-group">
                            <label for="payment_document" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Upload Document")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <i class="fa fa-file-text-o"></i>
                                </span>
                              </div>
                              <input type="file" name="payment_document" id="payment_document" class="form-control col-12" value="{{ old('payment_document', '') }}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-first-col-3">
                          <div class="form-group">
                            <label for="payment_amount_recieved" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Recieved Amount")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input type="number" id="payment_amount_recieved" name="payment_amount_recieved" class="form-control form-col-12"  value="{{ old('payment_amount_recieved', '0') }}">
                              @include('alerts.feedback', ['field' => 'payment_amount_recieved'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-9">
                          <div class="form-group">
                            <label for="payment_note" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Remarks")}}</label>
                            <div class="form-col-12 input-group ">
                              {{-- <div class="input-group-prepend">
                                <span class="input-group-text barcode"><i class="fa fa-file-text-o"></i></span>
                              </div> --}}
                              <input type="text" name="payment_note" class="form-control col-12" value="{{ old('payment_note'), '' }}" >
                              @include('alerts.feedback', ['field' => 'payment_note'])
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer row">
                <div class=" form-col-6">
                  <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round ">{{__('Back')}}</a>
                </div>
                <div class=" form-col-6">
                  <button type="submit" id="save-btn" class="btn btn-info btn-round pull-right">{{__('Save')}}</button>
                </div>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')


<script type="text/javascript">

  $(function (){
    $("#payment_store").validate({
      rules: {
        customer_code: 'required',
        payment_invoice_date: 'required',
        payment_method: 'required',
        product_type: 'required',
        // payment_invoice_id: 'required',
        payment_amount_recieved: 'required',
      },
      messages: {
        customer_code:  'Please Enter Customer Name',
        payment_invoice_date:  'Please Enter Payment Date',
        payment_method:  'Please Enter Payment Method',
        payment_type:  'Please Enter Payment Type',
        // payment_invoice_id: 'Please Enter Payment Invoice No.',
        payment_amount_recieved:  'Please Enter Payment Amount Recieved',
      },
      errorElement: 'em',
      errorPlacement: function ( error, element ) {
        error.addClass( 'invalid-feedback' );
        if( element.prop( 'type' ) === 'checkbox' ) {
          error.insertAfter( element.parent( 'label' ) );
        }
        else {
          error.insertAfter( element );
        }
      },
      // errorElement: 'span',
      // errorPlacement: function (error, element) {
      //   error.addClass('invalid-feedback');
      //   element.closest('.form-group').append(error);
      // },
      errorClass: "error fail-alert",
      errorClass: "invalid",
      // validClass: "valid success-alert",
      // validClass: "success"
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).removeClass( 'is-invalid' );
      },
      // submitHandler: function(form) {
      //   form.submit();
      // },
    });
    $.validator.setDefaults( {
      // debug: true,
      // success: "valid",
      submitHandler: function (form) {
        form.submit();
      }
    });
  });

  var customersnames_array = <?php echo json_encode($snameArray); ?>;
  var customersnamescodes_array = <?php echo json_encode($snamecodeArray); ?>;

  $("#customercodesearch").on('focus', function () {
    // $("#customercodesearch" ).autocomplete({
    $(this).autocomplete({
      source: customersnamescodes_array,
      autoFocus:true,
      minLength: 0,
      // select: $('#payment_product_barcode').val();
      // source: function(request, response) {
      //     var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
      //     response($.grep(productsnames_array, function(item) {
      //         return matcher.test(item);
      //     }));
      // },
      // response: function(event, ui) {
      //     if (ui.content.length == 1) {
      //         var data = ui.content[0].value;
      //         $(this).autocomplete( "close" );
      //         // productSearch(data);
      //     };
      // },
      select: function(event, ui) {
          var data = ui.item.value;
          data = data.split(',')[0];
          console.log(data);
          customerSearch(data);
      }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
  });
  function customerSearch(data){
    $.ajax({
      url: '{{ route("searchcustomer") }}',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["customer_id"]);
        var customer_id = data[0]["customer_id"];
        var customer_name = data[0]["customer_name"];
        var status_id = data[0]["status_id"];
        var customer_balance_paid = data[0]["customer_balance_paid"];
        var customer_balance_dues = data[0]["customer_balance_dues"];
        var customer_total_balance = data[0]["customer_total_balance"];
        var customer_credit_duration = data[0]["customer_credit_duration"];
        var customer_credit_type = data[0]["customer_credit_type"];
        var payterm_duratype = customer_credit_duration+' '+customer_credit_type;
        var customer_credit_limit = data[0]["customer_credit_limit"];
        var customer_sale_rate = data[0]["customer_sale_rate"];
        // $('#customer_name option').removeAttr('selected');
        // // $('#customer_name option[value='+customer_id+']').removeAttr('selected');
        // $('#customer_name option[value='+customer_id+']').attr('selected', 'selected');
        // $('#customer_name option[value='+customer_id+']').attr('status_id', status_id);
        $('#customer_name').val(customer_name);
        $('#customer_id').val(customer_id);
        if(status_id == 1){
        $('#customer_status').val('Active');
        }
        // else{
        //   $('#customer_status').val('Inactive');
        // }
        $('#customer_balance_paid').val(customer_balance_paid);
        $('#customer_balance_dues').val(customer_balance_dues);
        // $('#customer_total_balance').val(customer_total_balance);
        // $('#customer_credit_duration').val(customer_credit_duration);
        // $('#customer_credit_type').val(customer_credit_type);
        $('#payterm_duratype').val(payterm_duratype);
        $('#customer_credit_limit').val(customer_credit_limit);
        $('#payment_method').val(customer_sale_rate);

      }
    });
  }

  $(document).on('change', '#customer_name', function(e){
    var status = $('option:selected', this).attr('status_id');
    e.preventDefault();
    // $('#customer_status').val(status);
    if(status == 1){
      $('#customer_status').val('Active');
    }
    // else{
    //   $('#customer_status').val('Inactive');
    // }
  });

</script>
@endsection
