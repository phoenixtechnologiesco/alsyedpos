@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info btn-round text-white pull-right" href="{{ route('purchase.returnadd') }}">Add Purchase Return</a>
            <h4 class="card-title">Purchase Returns</h4>
            <div class="col-12">
              @if (Session::has('message'))
                <div class="alert alert-success alert-block alert-dismissible fade show w-100 ml-auto" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{Session::get('message') }}</strong>
                </div>
              @elseif(Session::has('error'))
                <div class="alert alert-danger alert-block alert-dismissible fade show w-100 ml-auto" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>    
                  <strong>{{Session::get('error') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="purchasereturnTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Supplier Name</th>
                  <th class="text-center">P.Return Ref_No</th>
                  <th class="text-center">P.Return Status</th>
                  <th class="text-center">P.Return Date</th>
                  <th class="text-center">Grandtotal Price</th>
                  <th class="text-center">Amount Paid</th>
                  <th class="text-center">Amount Dues</th>
                  <th class="text-center">Payment Method</th>
                  <th class="text-center">Payment Status</th>
                  <th class="text-center">Invoice Id</th>
                  <th class="text-center">Invoice Date</th>
                  {{-- <th class="disabled-sorting text-center">Actions</th> --}}
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($purchasereturns as $key => $value)
                <tr>
                  <td>{{ $value->purchase_return_id }}</td>
                  <td>{{ $value->purchase_return_ref_no }}</td>
                  <td>{{ $value->supplier_name}}</td> 
                  <td>{{ $value->purchase_return_status }}</td>
                  <td>{{ $value->purchase_return_date }}</td>
                  <td>{{ $value->purchase_return_grandtotal_price }}</td>
                  <td>{{ $value->purchase_return_amount_paid }}</td>
                  <td>{{ $value->purchase_return_amount_dues }}</td>
                  <td>{{ $value->purchase_return_payment_method }}</td> 
                  <td>{{ $value->purchase_return_payment_status }}</td>
                  <td>{{ $value->purchase_return_invoice_id }}</td> 
                  <td>{{ $value->purchase_return_invoice_date }}</td>
                  <-- <td class="text-right">
                    <a type="button" href="{{ route('purchase.edit', ['purchase' => $value->purchase_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td> -->
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
<script type="text/javascript">
  $(document).ready(function() {
    var dt = $('#purchasereturnTable').DataTable({
      // processing: true,
      // autoWidth: true,
      serverSide: true,
      // fixedColumns: true,
      // scrollCollapse: true,
      // scroller:       true,
      // searching:      true,
      // paging:         true,
      // info:           false,
      // rowReorder: true,      
      ajax: '{{ route('api.purchasereturn_row_details') }}',
      columns: [
        // {
        //   "className":      'dt-body-center',
        //   "orderable":      false,
        //   "searchable":     false,
        //   // "targets": 0,
        //   "data":           null,
        //   "defaultContent": ''
        //   // "data": null, 
        //   // "render": function (data, type, full, meta) {
        //   //   return meta.row + 1;
        //   // },
        // },
        { className: 'dt-body-center', data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { className: 'dt-body-center', data: 'supplier_name', name: 'supplier_name' },
        { className: 'dt-body-center', data: 'purchase_return_ref_no', name: 'purchase_return_ref_no' },
        { className: 'dt-body-center', data: 'purchase_return_status', name: 'purchase_return_status' },
        { className: 'dt-body-center', data: 'purchase_return_date', name: 'purchase_return_date' },
        { className: 'dt-body-center', data: 'purchase_return_grandtotal_price', name: 'purchase_return_grandtotal_price' },
        { className: 'dt-body-center', data: 'purchase_return_amount_paid', name: 'purchase_return_amount_paid' },
        { className: 'dt-body-center', data: 'purchase_return_amount_dues', name: 'purchase_return_amount_dues' },
        { className: 'dt-body-center', data: 'purchase_return_payment_method', name: 'purchase_return_payment_method' },
        { className: 'dt-body-center', data: 'purchase_return_payment_status', name: 'purchase_return_payment_status' },
        { className: 'dt-body-center', data: 'purchase_return_invoice_id', name: 'purchase_return_invoice_id' },
        { className: 'dt-body-center', data: 'purchase_return_invoice_date', name: 'purchase_return_invoice_date' },
        // { className: 'dt-body-center', data: 'action', name: 'action'},
        // {
        //       "targets": [ 12 ],
        //       "visible": false
        // },
      ],
      // .unshift({data : 'Index'}),
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
    //  create index for table at columns zero
    // dt.on('order.dt search.dt', function () {
    //   dt.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
    //         cell.innerHTML = i + 1;
    //         // dt.cell(cell).invalidate('dom');
    //     });
    // }).draw();
  });
</script>
@endsection