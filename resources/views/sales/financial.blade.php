@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Party Balance Sheet")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('sale.financial') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
              @include('alerts.success')
              <div class="row">
                <div class="card-body-custom col-12">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="form-first-col-3">
                          <div class="form-group">
                            <label for="customer_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Customer")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                </span>
                              </div>
                                <input type="text" name="customer_code" id="customercodesearch" placeholder="Search Customer by code" class="form-control col-12" value="{{ old('customer_code') }}" />
                                <input readonly type="hidden" name="sale_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="sale_customer_id" id="customer_id" class="form-control col-12" value="" />
                                {{-- <input type="hidden" name="customer_code" id="allcustomers" class="form-control col-12"  /> --}}
                                  <?php $snameArray = []; $snamecodeArray = []; ?>
                                  @foreach($customers as $one_customer) 
                                    <div class="customernames_array" style="display: none">{{ $snameArray[] = $one_customer->customer_name }}</div>
                                    <div class="customernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_customer->customer_name.", ".($one_customer->customer_ref_no) }}</div>
                                  @endforeach
                              @include('alerts.feedback', ['field' => 'customer_code'])
                            </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-3">
                          <div class="form-group">
                            <label readonly for="sale_customer_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                                <input readonly type="text" name="sale_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="sale_customer_id" id="customer_id" class="form-control col-12" value="0" />
                              @include('alerts.feedback', ['field' => 'sale_customer_name'])
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="customer_status" class="form-col-12 control-label">{{__(" Customer Status")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="customer_status" id="customer_status" class="form-control col-12" value="">
                                @include('alerts.feedback', ['field' => 'customer_status'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="sale_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Amount Paid")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="sale_amount_paid" id="customer_balance_paid" class="form-control" value="{{ old('sale_amount_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'sale_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-2">
                          <div class="form-group">
                            <label for="sale_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="sale_amount_dues" id="customer_balance_dues" class="form-control" value="{{ old('sale_amount_dues', '') }}">
                              @include('alerts.feedback', ['field' => 'sale_amount_dues'])
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <div class=" col-12">
                          <div class="table-responsive-custom" style="overflow-x:hidden">
                            <table id="financialtable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
                              <thead class="thead-dark">
                                <tr class="thead-dark-custom">
                                  <th class="text-center"></th>
                                  <th class="text-center">Invoice #</th>
                                  <th class="text-center">Invoice Date</th>
                                  <th class="text-center">Sale ID</th>
                                  <th class="text-center">Amount Paid</th>
                                  <th class="text-center">Amount Dues</th>
                                  <th class="text-center">Payment Method</th>
                                  <th class="text-center">Payment Type</th>
                                  <th class="text-center">Cheque #</th>
                                  <th class="text-center">Balance Amount</th>
                                </tr>
                              </thead>
                              {{-- <tbody class="customer-payments">
                                @foreach ($payments as $key => $value)
                                  <tr class="row table-info">
                                    <td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td>
                                    <td class="col-2 mycol text-center"   >{{ "abc" }}</td>
                                    <td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td>
                                    <td class="col-2 mycol text-center"   >{{ "abc" }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td>
                                    <td class="col-1 mycol text-center"   >{{ "abc" }}</td> 
                                    <td class="col-1 lastcol text-center" >{{ $value->customer_amount_dues }}</td>
                                  </tr>
                                @endforeach
                              </tbody> --}}
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- customer list modal -->
              <div id="customer-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content-pos">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Customers List</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="row">
                            <div class=" col-6 ">
                              <div class="form-group">
                                <label for="customer_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("Customer Name")}}</label>
                                <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text barcode">
                                      <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                    </span>
                                  </div>
                                  {{-- <div class="input-group pos"> --}}
                                    <input type="text" name="customer_name" id="customercodesearch" placeholder="Customer Name" class="form-control customercodesearch"  />
                                    {{-- <select required name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Customer..." style="width: 100px">
                                      @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                      @endforeach
                                    </select> --}}
                                  {{-- </div> --}}
                                  @include('alerts.feedback', ['field' => 'customer_name'])
                                </div>
                              </div>
                            </div>
                            <div class=" col-6 ">
                              <div class="form-group">
                                <label for="customer_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Customer Code")}}</label>
                                <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text barcode">
                                      <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                    </span>
                                  </div>
                                  <input type="hidden" name="customer_code_hidden" value="customer_code">
                                  {{-- <div class="input-group pos"> --}}
                                    <input type="text" name="customer_code" id="customercodeSearch" placeholder="Customer Code" class="form-control"  />
                                    {{-- <select required name="customer_code" id="customer_code" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Customer..." style="width: 100px">
                                      @foreach($customers as $customer)
                                        <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                      @endforeach
                                    </select> --}}
                                  {{-- </div> --}}
                                  @include('alerts.feedback', ['field' => 'customer_code'])
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class=" col-12 ">
                              <div class="form-group">
                                <div class=" col-12">
                                  <div class="table-responsive-sm" style="height:300px; overflow-x:hidden">
                                    <table id="myTable" class="table table-sm table-hover table-striped table-fixed table-bordered display compact order-column">
                                      <thead class="thead pos" >{{-- style="position: sticky; top: 0; z-index: 1" --}}
                                        <tr>
                                            <th>RefID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($customers as $key => $value)
                                        <tr>
                                          <td>{{ $value->customer_ref_no }}</td>
                                          <td>{{ $value->customer_name }}</td>
                                          <td>{{ $value->status_id }}</td>
                                          <td class="text-right">
                                            <a type="button" href="{{ route('customer.edit', ['customer' => $value->customer_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="+" title="+">
                                              <i class="fa fa-plus-square"></i>
                                            </a>
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mt-3">
                              <button id="submit-btn" type="button" class="btn btn-primary">submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer row">
                <div class=" form-col-12">
                  <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
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

{{-- <script type="text/javascript">
  // $("#customer_id").on('change', function () {
  $(document).on('change', '#customer_id', function(e){
    customer_id = $(this).val();
    $('.customer-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->customer_amount_dues }}</td></tr>');
   });
</script> --}}

<script type="text/javascript">

  var dt;
  var customer_id;
  var customer_name;
  var status_id;
  var customer_balance_paid;
  var customer_balance_dues;
  var customer_total_balance;
  var customer_credit_duration;
  var customer_credit_type;
  var customersnames_array = JSON.parse('<?php echo json_encode($snameArray); ?>');
  var customersnamescodes_array = JSON.parse('<?php echo json_encode($snamecodeArray); ?>');

  $("#customercodesearch").on('focus', function () {
    // $("#customercodesearch" ).autocomplete({
    $(this).autocomplete({
      source: customersnamescodes_array,
      autoFocus:true,
      minLength: 0,
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
      url: 'searchcustomerpayments',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        customer_id = data['customer'][0]["customer_id"];
        customer_name = data['customer'][0]["customer_name"];
        status_id = data['customer'][0]["status_id"];
        customer_balance_paid = data['customer'][0]["customer_balance_paid"];
        customer_balance_dues = data['customer'][0]["customer_balance_dues"];
        customer_total_balance = data['customer'][0]["customer_total_balance"];
        customer_credit_duration = data['customer'][0]["customer_credit_duration"];
        customer_credit_type = data['customer'][0]["customer_credit_type"];
        // $('#customer_name option').removeAttr('selected');
        // // $('#customer_name option[value='+customer_id+']').removeAttr('selected');
        // $('#customer_name option[value='+customer_id+']').attr('selected', 'selected');
        // $('#customer_name option[value='+customer_id+']').attr('status_id', status_id);
        $('#customer_name').val(customer_name);
        $('#customer_id').val(customer_id).change();

        // $('.customer-payments').html(data['payments']);
        // $('.customer-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->customer_amount_dues }}</td></tr>');
        if(status_id == 1){
        $('#customer_status').val('Active');
        }
        // else{
        //   $('#customer_status').val('Inactive');
        // }
        $('#customer_balance_paid').val(customer_balance_paid);
        $('#customer_balance_dues').val(customer_balance_dues);
        // $('#customer_total_balance').val(customer_total_balance);

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

  $("#customer_id").on('change', function () {
    customer_id = $(this).val();
    dt = $('#financialtable').on('preXhr.dt', function (e, settings, data) {
        data.customer_id = $("#customer_id").val();
        return data;
    }).DataTable();
    dt.ajax.reload(null, false).draw();
  });
  dt = $('#financialtable').DataTable( {
    serverSide: true,
    ajax: {
      url: '{{ route('api.financial_row_details') }}',
      // data: function(d){
      //   // 'sale_customer_id': $('#customer_id').val().serialize(),
      //   // return $('#customer_id').val();
      // },
      // dataSrc: "",
    },
    columns: [
        // {
        //     "className":      'dt-body-center',
        //     "orderable":      false,
        //     "searchable":     false,
        //     "targets": 0,
        //     "data":           null,
        //     "defaultContent": ''
        // },
        { className: 'dt-body-center', data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { className: 'dt-body-center', data: 'payment_invoice_id', name: 'payment_invoice_id' },
        // width:'25%', 
        { className: 'dt-body-center', data: 'payment_invoice_date', name: 'payment_invoice_date' },
        // width:'25%', 
        { className: 'dt-body-center', data: 'sale_id', name: 'sale_id',},
        { className: 'dt-body-center', data: 'payment_amount_paid', name: 'payment_amount_paid' },
        { className: 'dt-body-center', data: 'payment_amount_balance', name: 'payment_amount_balance',},
        { className: 'dt-body-center', data: 'payment_method', name: 'payment_method' },
        { className: 'dt-body-center', data: 'payment_type', name: 'payment_type' },
        { className: 'dt-body-center', data: 'payment_cheque_no', name: 'payment_cheque_no' },
        // { width:'25%', className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },
        { className: 'dt-body-center', data: 'customer_amount_dues', name: 'customer_amount_dues' },
        // {
        //       "targets": [ 12 ],
        //       "visible": false
        // },
    ],
    order: [[1, 'asc']],
    select: { style: 'multi',  selector: 'td:first-child'},
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: '<"offset-1"lfB>rt<"offset-1"ip>',
    // dom: '<"top"i>rt<"bottom"flp><"clear">',
    buttons: [
        {
            extend: 'pdf',
            exportOptions: {
                columns: ':visible:Not(.not-exported-sale)',
                rows: ':visible'
            },
            action: function(e, dt, button, config) {
                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
            },
            footer:true
        },
        {
            extend: 'csv',
            exportOptions: {
                columns: ':visible:Not(.not-exported-sale)',
                rows: ':visible'
            },
            action: function(e, dt, button, config) {
                $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
            },
            footer:true
        },
        {
            extend: 'print',
            exportOptions: {
                columns: ':visible:Not(.not-exported-sale)',
                rows: ':visible'
            },
            action: function(e, dt, button, config) {
                $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
            },
            footer:true
        },
        {
            extend: 'colvis',
            columns: ':gt(0)'
        }
    ],
    drawCallback: function () {
        var api = this.api();
    },
  });
  // //  create index for table at columns zero
  // dt.on('order.dt search.dt', function () {
  //   dt.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
  //         cell.innerHTML = i + 1;
  //     });
  // }).draw();

</script>

@endsection
