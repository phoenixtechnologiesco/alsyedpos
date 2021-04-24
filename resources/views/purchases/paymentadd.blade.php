@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Purchase Payment")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('purchase.paymentadd') }}" autocomplete="off" enctype="multipart/form-data">
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
                        <div class="form-first-col-3">
                          <div class="form-group">
                            <label for="supplier_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Supplier")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#supplier-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input type="text" name="supplier_code" id="suppliercodesearch" placeholder="Search supplier by code" class="form-control col-12" value="{{ old('supplier_code') }}" />
                                <input readonly type="hidden" name="payment_supplier_name" id="supplier_name" placeholder="Supplier Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="payment_supplier_id" id="supplier_id" class="form-control col-12" value="" />
 
                                {{-- <input type="hidden" name="supplier_code" id="allsuppliers" class="form-control col-12"  /> --}}
                                  <?php $snameArray = []; $snamecodeArray = []; ?>
                                  @foreach($suppliers as $one_supplier) 
                                    <div class="suppliernames_array" style="display: none">{{ $snameArray[] = $one_supplier->supplier_name }}</div>
                                    <div class="suppliernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_supplier->supplier_name.", ".($one_supplier->supplier_ref_no) }}</div>
                                  @endforeach
                                {{-- <select required name="supplier_code" id="supplier_code" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 100px">
                                  @foreach($lims_supplier_list as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                  @endforeach
                                  <option value="0">Asif Ghafoor</option>
                                </select> --}}
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'supplier_code'])
                            </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-3">
                          <div class="form-group">
                            <label readonly for="payment_supplier_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Supplier Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#supplier-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                              <div class="input-group pos">
                                <input readonly type="text" name="payment_supplier_name" id="supplier_name" placeholder="Supplier Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="payment_supplier_id" id="supplier_id" class="form-control col-12" value="" />
                                <-- <select readonly required name="payment_supplier_name" id="supplier_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 150px">
                                  @foreach($suppliers as $single_supplier)
                                    <option status_id="{{$single_supplier->status_id}}" value="{{$single_supplier->supplier_id}}">{{$single_supplier->supplier_name}}</option>
                                  @endforeach
                                </select> -->
                              </div>
                              @include('alerts.feedback', ['field' => 'payment_supplier_name'])
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="supplier_status" class="form-col-12 control-label">{{__("Status")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="supplier_status" id="supplier_status" class="form-control col-12" value="">
                                @include('alerts.feedback', ['field' => 'supplier_status'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="supplier_amount_recieved" class="form-col-12 control-label">{{__("Supplier Recieve")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="supplier_amount_recieved" id="supplier_balance_recieved" class="form-control" value="{{ old('supplier_amount_recieved', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_amount_recieved'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="supplier_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Supplier Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="supplier_amount_dues" id="supplier_balance_dues" class="form-control" value="{{ old('supplier_amount_dues', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_amount_dues'])
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
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="payment_type" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Payment Type")}}</label>
                              <div class="form-col-12">
                                {{-- <input readonly type="text" name="payment_type" class="form-control col-12" value="{{ old('payment_type', 'Cash') }}"> --}}
                                <select required id="payment_type" name="payment_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Type...">
                                  <option value="paying">Paying</option>
                                  <option value="returning">Returning</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'payment_type'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label for="payment_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Purchase Invoice No.")}}</label>
                              <div class="form-col-12">
                                <div class="myrow">
                                  <input type="text" name="payment_invoice_id" class="form-control form-col-10" value="{{ old('payment_invoice_id', '') }}">
                                  <button type="button" href="{{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                    <i class="fa fa-file-text-o"></i>
                                  </button>
                                </div>
                                @include('alerts.feedback', ['field' => 'payment_invoice_id'])
                              </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-2">
                          <div class="form-group">
                            <label for="payment_cheque_date" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Cheque Date")}}</label>
                            <div class="form-col-12">
                              <input type="date" name="payment_cheque_date" class="form-control form-col-12"  value="{{ old('payment_cheque_date', '') }}">
                              @include('alerts.feedback', ['field' => 'payment_cheque_date'])
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-last-col-4">
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
                            <label for="payment_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Paid Amount")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input type="text" name="payment_amount_paid" class="form-control form-col-12"  value="{{ old('payment_amount_paid', '0') }}">
                              @include('alerts.feedback', ['field' => 'payment_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="payment_account_no" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Account #")}}</label>
                            <div class="form-col-12">
                              <input type="text" name="payment_account_no" class="form-control form-col-12"  value="{{ old('payment_account_no', '') }}">
                              @include('alerts.feedback', ['field' => 'payment_account_no'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="payment_cheque_no" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Cheque #")}}</label>
                            <div class="form-col-12">
                              <input type="text" name="payment_cheque_no" class="form-control form-col-12"  value="{{ old('payment_cheque_no', '') }}">
                              @include('alerts.feedback', ['field' => 'payment_cheque_no'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-5">
                          <div class="form-group">
                            <label for="payment_note" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Remarks")}}</label>
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
                  <button type="submit" class="btn btn-info btn-round pull-right">{{__('Save')}}</button>
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

  var suppliersnames_array = <?php echo json_encode($snameArray); ?>;
  var suppliersnamescodes_array = <?php echo json_encode($snamecodeArray); ?>;

  $("#suppliercodesearch").on('focus', function () {
    // $("#suppliercodesearch" ).autocomplete({
    $(this).autocomplete({
      source: suppliersnamescodes_array,
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
          suppliersearch(data);
      }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
  });

  function suppliersearch(data){
    $.ajax({
      url: '{{ route("searchsupplier") }}',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["supplier_id"]);
        var supplier_id = data[0]["supplier_id"];
        var supplier_name = data[0]["supplier_name"];
        var status_id = data[0]["status_id"];
        var supplier_balance_recieved = data[0]["supplier_balance_paid"];
        var supplier_balance_dues = data[0]["supplier_balance_dues"];
        var supplier_total_balance = data[0]["supplier_total_balance"];
        var supplier_credit_duration = data[0]["supplier_credit_duration"];
        var supplier_credit_type = data[0]["supplier_credit_type"];
        var payterm_duratype = supplier_credit_duration+' '+supplier_credit_type;
        console.log(payterm_duratype);
        var supplier_credit_limit = data[0]["supplier_credit_limit"];
        // $('#supplier_name option').removeAttr('selected');
        // // $('#supplier_name option[value='+supplier_id+']').removeAttr('selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('selected', 'selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('status_id', status_id);
        $('#supplier_name').val(supplier_name);
        $('#supplier_id').val(supplier_id);
        if(status_id == 1){
        $('#supplier_status').val('Active');
        }
        // else{
        //   $('#supplier_status').val('Inactive');
        // }
        $('#supplier_balance_recieved').val(supplier_balance_recieved);
        $('#supplier_balance_dues').val(supplier_balance_dues);
        // $('#supplier_total_balance').val(supplier_total_balance);
        // $('#supplier_credit_duration').val(supplier_credit_duration);
        // $('#supplier_credit_type').val(supplier_credit_type);
        $('#payterm_duratype').val(payterm_duratype);
        $('#supplier_credit_limit').val(supplier_credit_limit);
      }
    });
  }

  $(document).on('change', '#supplier_name', function(e){
    var status = $('option:selected', this).attr('status_id');
    e.preventDefault();
    // $('#supplier_status').val(status);
    if(status == 1){
      $('#supplier_status').val('Active');
    }
    // else{
    //   $('#supplier_status').val('Inactive');
    // }
  });

</script>
@endsection
