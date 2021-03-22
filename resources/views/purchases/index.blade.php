@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('purchase.create') }}">Add Purchase</a>
            <h4 class="card-title">Purchases</h4>
            <div class="col-12">
              @if (Session::has('message'))
                <div class="alert alert-success alert-block alert-dismissible fade show w-100 ml-auto" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>    
                    <strong>{{Session::get('message') }}</strong>
                </div>
              @elseif(Session::has('error'))
                <div class="alert alert-danger alert-block alert-dismissible fade show w-100 ml-auto" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>    
                  <strong>{{Session::get('error') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="purchaseTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th colspan="1" class="text-center">Supplier</th>
                  <th colspan="2" class="text-center">Purchase Info</th>
                  <th colspan="2" class="text-center">Total Items/Qty</th>
                  <th colspan="3" class="text-center">Purchase Amount</th>
                  <th colspan="2" class="text-center">Payment Info</th>
                  <th colspan="2" class="text-center">Invoice Info</th>
                  <th colspan="1" class="disabled-sorting text-center">Actions</th>
                </tr>
                <tr>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Ref_No</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Items</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Paid</th>
                  <th class="text-center">Dues</th>
                  <th class="text-center">Method</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Inv.No</th>
                  <th class="text-center">Inv Date</th>
                  {{-- <th>Warehouse</th> --}}
                  <th class="disabled-sorting text-center">Edit</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($purchases as $key => $value)
                <tr>
                  <td>{{ $value->purchase_id }}</td>
                  <td>{{ $value->purchase_ref_no }}</td>
                  <td>{{ $value->supplier_name}}</td> 
                  <td>{{ $value->purchase_status }}</td>
                  <-- <td>{{ $value->purchase_date }}</td> -->
                  <td>{{ $value->purchase_grandtotal_price }}</td>
                  <td>{{ $value->purchase_amount_paid }}</td>
                  <td>{{ $value->purchase_amount_dues }}</td>
                  <td>{{ $value->purchase_payment_method }}</td> 
                  <td>{{ $value->purchase_payment_status }}</td>
                  <td>{{ $value->purchase_invoice_id }}</td>
                  <td>{{ $value->purchase_invoice_date }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('purchase.edit', ['purchase' => $value->purchase_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody> --}}
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-12 -->
    </div>
    <!-- end row -->
  </div>
</div>
@endsection

@section('javascript')

<script>

      var dt = $('#purchaseTable').DataTable({
        // processing: true,
        // autoWidth: true,
        serverSide: true,
        // fixedColumns: true,
        // scrollCollapse: true,
        // scroller:       true,
        // searching:      true,
        // paging:         true,
        // info:           false,
        ajax: '{{ route('api.purchase_row_details') }}',
        columns: [
          // {
          //   "className":      'details-control',
          //   "orderable":      false,
          //   "searchable":     false,
          //   "data":           null,
          //   "defaultContent": ''
          // },
          { className: 'dt-body-center', data: 'DT_RowIndex', name: 'DT_RowIndex'},
          { width:'25%', className: 'dt-body-center', data: 'supplier_name', name: 'supplier_name' },
          { className: 'dt-body-center', data: 'purchase_ref_no', name: 'purchase_ref_no' },
          { className: 'dt-body-center', data: 'purchase_status', name: 'purchase_status' },
          { className: 'dt-body-center', data: 'purchase_total_items', name: 'purchase_total_items' },
          { className: 'dt-body-center', data: 'purchase_total_quantity', name: 'purchase_total_quantity' },
          { className: 'dt-body-center', data: 'purchase_grandtotal_price', name: 'purchase_grandtotal_price' },
          { className: 'dt-body-center', data: 'purchase_amount_paid', name: 'purchase_amount_paid' },
          { className: 'dt-body-center', data: 'purchase_amount_dues', name: 'purchase_amount_dues' },
          { className: 'dt-body-center', data: 'purchase_payment_method', name: 'purchase_payment_method' },
          { className: 'dt-body-center', data: 'purchase_payment_status', name: 'purchase_payment_status' },
          { width:'25%', className: 'dt-body-center', data: 'purchase_invoice_id', name: 'purchase_invoice_id' },
          { width:'25%', className: 'dt-body-center', data: 'purchase_invoice_date', name: 'purchase_invoice_date' },
          { className: 'dt-body-center', data: 'action', name: 'action'},
          // { className: 'dt-body-center', width:'25%', data: 'name', name: 'name' },
          // {
          //       "targets": [ 12 ],
          //       "visible": false
          // },
          // { data: 'warehouse_name', name: 'warehouse_name' },
          // { data: 'action', name: 'action', orderable: false, searchable: false }
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

</script>

@endsection