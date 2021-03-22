@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info btn-round text-white pull-right" href="{{ route('customer.create') }}">{{ __('Add Customer') }}</a>
            <h4 class="card-title">{{ __('Customers') }}</h4>
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
            <table id="customerTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center"></th>
                  <th class="text-center">Ref_No</th>
                  <th class="text-center">Customer Type</th>
                  <th class="text-center">Customer Name</th>
                  <th class="text-center">Shop Name</th>
                  <th class="text-center">Shop Description</th>
                  <th class="text-center">Shop Town</th>
                  <th class="text-center">Shop Area</th>
                  <th class="text-center">Balance Paid</th>
                  <th class="text-center">Balance Dues</th>
                  <th class="text-center">Credit Duration</th>
                  <th class="text-center">Credit Type</th>
                  <th class="text-center">Credit Limit</th>
                  <th class="text-center">Sale Rate</th>
                  <th class="disabled-sorting text-center">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($customers as $key => $value)
                <tr>
                  <td>{{ $value->customer_id }}</td>
                  <td>{{ $value->customer_ref_no }}</td>
                  <td>{{ $value->customer_type }}</td> 
                  <td>{{ $value->customer_name }}</td>
                  <td>{{ $value->customer_shop_name }}</td>
                  <td>{{ $value->customer_shop_info }}</td>
                  <td>{{ $value->customer_town }}, {{ $value->customer_area }}</td>
                  <td>{{ $value->customer_balance_paid }}</td> 
                  <td>{{ $value->customer_balance_dues }}</td>
                  <td>{{ $value->customer_credit_duration }}-{{ $value->customer_credit_type }}</td>
                  <td>{{ $value->customer_credit_limit }}</td> 
                  <td>{{ $value->customer_sale_rate }}</td> 
                  <td class="text-right">
                    <a type="button" href="{{ route('customer.edit', ['customer' => $value->customer_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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
<script type="text/javascript">
  $(document).ready(function() {
      var dt = $('#customerTable').DataTable({
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
        ajax: '{{ route('api.customer_row_details') }}',
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
          { className: 'dt-body-center', data: 'customer_ref_no', name: 'customer_ref_no' },
          { className: 'dt-body-center', data: 'customer_type', name: 'customer_type' },
          { className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },
          { className: 'dt-body-center', data: 'customer_shop_name', name: 'customer_shop_name' },
          { className: 'dt-body-center', data: 'customer_shop_info', name: 'customer_shop_info' },
          { className: 'dt-body-center', data: 'customer_town', name: 'customer_town' },
          { className: 'dt-body-center', data: 'customer_area', name: 'customer_area' },
          { className: 'dt-body-center', data: 'customer_balance_paid', name: 'customer_balance_paid' },
          { className: 'dt-body-center', data: 'customer_balance_dues', name: 'customer_balance_dues' },
          { className: 'dt-body-center', data: 'customer_credit_duration', name: 'customer_credit_duration' },
          { className: 'dt-body-center', data: 'customer_credit_type', name: 'customer_credit_type' },
          { className: 'dt-body-center', data: 'customer_credit_limit', name: 'customer_credit_limit' },
          { className: 'dt-body-center', data: 'customer_sale_rate', name: 'customer_sale_rate' },
          { className: 'dt-body-center', data: 'action', name: 'action'},
          // { className: 'dt-body-center', width:'25%', data: 'name', name: 'name' },
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