@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info btn-round text-white pull-right" href="{{ route('supplier.create') }}">{{ __('Add Supplier') }}</a>
            <h4 class="card-title">{{ __('Suppliers') }}</h4>
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
            <table id="supplierTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Ref_No</th>
                  <th class="text-center">Supplier Name</th>
                  <th class="text-center">Supplier Type</th>
                  <th class="text-center">Shop Name</th>
                  <th class="text-center">Shop Description</th>
                  <th class="text-center">Shop Town</th>
                  <th class="text-center">Shop Area</th>
                  <th class="text-center">Balance Paid</th>
                  <th class="text-center">Balance Dues</th>
                  <th class="disabled-sorting text-center">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($suppliers as $key => $value)
                <tr>
                  <td>{{ $value->supplier_id }}</td>
                  <td>{{ $value->supplier_ref_no }}</td>
                  <td>{{ $value->supplier_type }}</td> 
                  <td>{{ $value->supplier_name }}</td>
                  <td>{{ $value->supplier_shop_name }}</td>
                  <td>{{ $value->supplier_shop_info }}</td>
                  <td>{{ $value->supplier_town }}, {{ $value->supplier_area }}</td>
                  <td>{{ $value->supplier_balance_paid }}</td> 
                  <td>{{ $value->supplier_balance_dues }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('supplier.edit', ['supplier' => $value->supplier_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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
      var dt = $('#supplierTable').DataTable({
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
        ajax: '{{ route('api.supplier_row_details') }}',
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
          { className: 'dt-body-center', searchable: false, data: 'DT_RowIndex', name: 'DT_RowIndex'},
          { className: 'dt-body-center', data: 'supplier_ref_no', name: 'supplier_ref_no' },
          { className: 'dt-body-center', data: 'supplier_name', name: 'supplier_name' },
          { className: 'dt-body-center', data: 'supplier_type', name: 'supplier_type' },
          { className: 'dt-body-center', data: 'supplier_shop_name', name: 'supplier_shop_name' },
          { className: 'dt-body-center', data: 'supplier_shop_info', name: 'supplier_shop_info' },
          { className: 'dt-body-center', data: 'supplier_town', name: 'supplier_town' },
          { className: 'dt-body-center', data: 'supplier_area', name: 'supplier_area' },
          { className: 'dt-body-center', data: 'supplier_balance_paid', name: 'supplier_balance_paid' },
          { className: 'dt-body-center', data: 'supplier_balance_dues', name: 'supplier_balance_dues' },
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