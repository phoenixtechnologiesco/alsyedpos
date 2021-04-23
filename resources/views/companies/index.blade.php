@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('company.create') }}">Add company</a>
            <h4 class="card-title">Companies</h4>
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
            <table id="companyTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Parent Company</th>
                  <th class="text-center">Name</th>
                  {{-- <th class="text-center">Reference ID</th> --}}
                  <th class="text-center">Description</th>
                  <th class="disabled-sorting text-center">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach($companies as $key => $value)
                <tr>
                  <td>{{ $value->company_id }}</td>
                  <td>{{ $value->company_parent }}</td>
                  <td>{{ $value->company_name }}</td>
                  <td>{{ $value->company_ref_no }}</td>
                  <td>{{ $value->company_description }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('company.edit', ['company' => $value->company_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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
      var dt = $('#companyTable').DataTable({
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
        ajax: '{{ route('api.company_row_details') }}',
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
          { className: 'dt-body-center', data: 'company_parent', name: 'company_parent' },
          { className: 'dt-body-center', data: 'company_name', name: 'company_name' },
          // { className: 'dt-body-center', data: 'company_ref_no', name: 'company_ref_no' },
          { className: 'dt-body-center', data: 'company_description', name: 'company_description' },
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