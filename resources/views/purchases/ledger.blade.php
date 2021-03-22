@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Ledger Sheet")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('purchase.ledger') }}" autocomplete="off" enctype="multipart/form-data">
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
                            <label for="supplier_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Supplier")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#supplier-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input type="text" name="supplier_code" id="suppliercodesearch" placeholder="Search supplier by code" class="form-control col-12" value="{{ old('supplier_code') }}" />
                                <input readonly type="hidden" name="purchase_supplier_name" id="supplier_name" placeholder="Supplier Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="purchase_supplier_id" id="supplier_id" class="form-control col-12" value="" />
                                <?php $cust = 0 ; ?>
                                {{-- <input type="hidden" name="supplier_code" id="allsuppliers" class="form-control col-12"  /> --}}
                                  <?php $snameArray = []; $snamecodeArray = []; ?>
                                  @foreach($suppliers as $one_supplier) 
                                    <div class="suppliernames_array" style="display: none">{{ $snameArray[] = $one_supplier->supplier_name }}</div>
                                    <div class="suppliernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_supplier->supplier_name.", ".($one_supplier->supplier_ref_no) }}</div>
                                  @endforeach
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'supplier_code'])
                            </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-3">
                          <div class="form-group">
                            <label readonly for="purchase_supplier_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Supplier Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#supplier-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                                <input readonly type="hidden" name="purchase_supplier_name" id="supplier_name" placeholder="Supplier Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="purchase_supplier_id" id="ssupplier_id" class="form-control col-12" value="" />
                              @include('alerts.feedback', ['field' => 'purchase_supplier_name'])
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="supplier_status" class="form-col-12 control-label">{{__(" Supplier Status")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="supplier_status" id="supplier_status" class="form-control col-12" value="">
                                @include('alerts.feedback', ['field' => 'supplier_status'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="purchase_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Supplier Amount Paid")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="purchase_amount_paid" id="supplier_balance_paid" class="form-control" value="{{ old('purchase_amount_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'purchase_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-2">
                          <div class="form-group">
                            <label for="purchase_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Supplier Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="purchase_amount_dues" id="supplier_balance_dues" class="form-control" value="{{ old('purchase_amount_dues', '') }}">
                              @include('alerts.feedback', ['field' => 'purchase_amount_dues'])
                            </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-2">
                          <div class="form-group">
                            <label for="submit" class="form-col-12 control-label">&nbsp;&nbsp;{{__("  ")}}</label>
                            <div class="form-col-12">
                              <button class="btn btn-primary" type="submit" name="submit_button" id="submit_button">{{'Submit'}}</button>
                              @include('alerts.feedback', ['field' => 'submit'])
                            </div>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <div class=" col-12">
                          <div class="table-responsive-custom" style="overflow-x:hidden" >
                            <table id="ledgertable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
                              <thead class="thead-dark">
                                <tr class="thead-dark-custom">
                                  <th class="text-center"></th>
                                  <th class="text-center">Invoice #</th>
                                  <th class="text-center">Invoice Date</th>
                                  <th class="text-center">Purchase Id</th>
                                  <th class="text-center">Amount Paid</th>
                                  <th class="text-center">Amount Dues</th>
                                  <th class="text-center">Payment Method</th>
                                  <th class="text-center">Payment Type</th>
                                  <th class="text-center">Cheque #</th>
                                  <th class="text-center">Balance Amount</th>
                                </tr>
                              </thead>
                              {{-- <thead class="thead-dark">
                                <tr class="thead-dark-custom">
                                  <th class="col-1 firstcol text-center">Invoice #</th>
                                  <th class="col-1 mycol text-center"  >Invoice Date</th>
                                  <th class="col-2 mycol text-center"  >Purchase Id</th>
                                  <th class="col-2 mycol text-center"  >Amount Paid</th>
                                  <th class="col-2 mycol text-center"  >Amount Balance</th>
                                  <th class="col-1 mycol text-center"  >Payment Method</th>
                                  <th class="col-1 mycol text-center"  >Payment Type</th>
                                  <th class="col-1 mycol text-center"  >Cheque #</th>
                                  <th class="col-1 lastcol text-center" >Balance Amount</th>
                                </tr>
                              </thead> --}}
                              {{-- <tbody class="supplier-payments">
                                @foreach ($payments as $key => $value)
                                  <tr class="row table-info">
                                    <td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td>
                                    <td class="col-2 mycol text-center"   >{{ $value->purchase_id }}</td>
                                    <td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td>
                                    <td class="col-2 mycol text-center"   >{{ $value->payment_amount_balance }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_cheque_no }}</td> 
                                    <td class="col-1 lastcol text-center" >{{ $value->supplier_amount_dues }}</td>
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
              <!-- supplier list modal -->
              <div id="supplier-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content-pos">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">suppliers List</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="row">
                            <div class=" col-6 ">
                              <div class="form-group">
                                <label for="supplier_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("supplier Name")}}</label>
                                <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text barcode">
                                      <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                    </span>
                                  </div>
                                  {{-- <div class="input-group pos"> --}}
                                    <input type="text" name="supplier_name" id="suppliercodesearch" placeholder="supplier Name" class="form-control suppliercodesearch"  />
                                    {{-- <select required name="supplier_name" id="supplier_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 100px">
                                      @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                      @endforeach
                                    </select> --}}
                                  {{-- </div> --}}
                                  @include('alerts.feedback', ['field' => 'supplier_name'])
                                </div>
                              </div>
                            </div>
                            <div class=" col-6 ">
                              <div class="form-group">
                                <label for="supplier_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" supplier Code")}}</label>
                                <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text barcode">
                                      <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                    </span>
                                  </div>
                                  <input type="hidden" name="supplier_code_hidden" value="supplier_code">
                                  <input type="text" name="supplier_code" id="suppliercodeSearch" placeholder="supplier Code" class="form-control"  />
                                  @include('alerts.feedback', ['field' => 'supplier_code'])
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
                                        @foreach($suppliers as $key => $value)
                                        <tr>
                                          <td>{{ $value->supplier_ref_no }}</td>
                                          <td>{{ $value->supplier_name }}</td>
                                          <td>{{ $value->status_id }}</td>
                                          <td class="text-right">
                                            <a type="button" href="{{ route('supplier.edit', ['supplier' => $value->supplier_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="+" title="+">
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
  // $("#supplier_id").on('change', function () {
  $(document).on('change', '#supplier_id', function(e){
    supplier_id = $(this).val();
    $('.supplier-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->supplier_amount_dues }}</td></tr>');
    // console.log($cust);
  });
</script> --}}

<script type="text/javascript">
  var dt;
  var supplier_id;
  var supplier_name;
  var status_id;
  var supplier_balance_paid;
  var supplier_balance_dues;
  var supplier_total_balance;
  var supplier_credit_duration;
  var supplier_credit_type;
  var suppliersnames_array = JSON.parse('<?php echo json_encode($snameArray); ?>');
  var suppliersnamescodes_array = JSON.parse('<?php echo json_encode($snamecodeArray); ?>');

  $("#suppliercodesearch").on('focus', function () {
    // $("#suppliercodesearch" ).autocomplete({
    $(this).autocomplete({
      source: suppliersnamescodes_array,
      autoFocus:true,
      minLength: 0,
      // select: $('#purchase_product_barcode').val();
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
          // console.log(data);
          supplierSearch(data);
      }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
  });
  function supplierSearch(data){
    $.ajax({
      url: 'searchsupplierpayments',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["supplier_id"]);
        supplier_id = data['supplier'][0]["supplier_id"];
        supplier_name = data['supplier'][0]["supplier_name"];
        status_id = data['supplier'][0]["status_id"];
        supplier_balance_paid = data['supplier'][0]["supplier_balance_paid"];
        supplier_balance_dues = data['supplier'][0]["supplier_balance_dues"];
        supplier_total_balance = data['supplier'][0]["supplier_total_balance"];
        supplier_credit_duration = data['supplier'][0]["supplier_credit_duration"];
        supplier_credit_type = data['supplier'][0]["supplier_credit_type"];
        // $('#supplier_name option').removeAttr('selected');
        // // $('#supplier_name option[value='+supplier_id+']').removeAttr('selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('selected', 'selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('status_id', status_id);
        $('#supplier_name').val(supplier_name);
        $('#supplier_id').val(supplier_id).change();
        // $('.supplier-payments').html(data['payments']);
        
        // // $('.supplier-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->supplier_amount_dues }}</td></tr>');
        if(status_id == 1){
        $('#supplier_status').val('Active');
        }
        // else{
        //   $('#supplier_status').val('Inactive');
        // }
        $('#supplier_balance_paid').val(supplier_balance_paid);
        $('#supplier_balance_dues').val(supplier_balance_dues);
        // $('#supplier_total_balance').val(supplier_total_balance);

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

  $("#supplier_id").on('change', function () {
    supplier_id = $(this).val();
    dt = $('#ledgertable').on('preXhr.dt', function (e, settings, data) {
        data.supplier_id = $("#supplier_id").val();
        return data;
    }).DataTable();
    dt.ajax.reload(null, false).draw();
  });

  dt = $('#ledgertable').DataTable( {
    serverSide: true,
    ajax: {
      url: '{{ route('api.ledger_row_details') }}',
      // data: function(d){
      //   // 'purchase_supplier_id': $('#supplier_id').val().serialize(),
      //   // return $('#supplier_id').val();
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
        { className: 'dt-body-center', data : 'DT_RowIndex', name: 'DT_RowIndex'},
        { className: 'dt-body-center', data: 'payment_invoice_id', name: 'payment_invoice_id' },
        // width:'25%', 
        { className: 'dt-body-center', data: 'payment_invoice_date', name: 'payment_invoice_date' },
        // width:'25%', 
        { className: 'dt-body-center', data: 'purchase_id', name: 'purchase_id',},
        { className: 'dt-body-center', data: 'payment_amount_paid', name: 'payment_amount_paid' },
        { className: 'dt-body-center', data: 'payment_amount_balance', name: 'payment_amount_balance',},
        { className: 'dt-body-center', data: 'payment_method', name: 'payment_method' },
        { className: 'dt-body-center', data: 'payment_type', name: 'payment_type' },
        { className: 'dt-body-center', data: 'payment_cheque_no', name: 'payment_cheque_no' },
        // { width:'25%', className: 'dt-body-center', data: 'supplier_name', name: 'supplier_name' },
        { className: 'dt-body-center', data: 'supplier_amount_dues', name: 'supplier_amount_dues' },
        // {
        //       "targets": [ 12 ],
        //       "visible": false
        // },
    ],
    order: [[1, 'asc']],
    // order: [],
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
