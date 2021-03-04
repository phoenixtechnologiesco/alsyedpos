@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Report CashCreditWise</h4>
            <div class="col-12">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="balancecustomerTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customer RefNo</th>
                  <th>Customer Name</th>
                  <th>Customer Balance Paid</th>
                  <th>Customer Balance Dues</th>
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
                  <td>{{ $value->customer_name }}</td>
                  <td>{{ $value->customer_balance_paid }}</td>
                  <td>{{ $value->customer_balance_dues }}</td>
                </tr>
                @endforeach
              </tbody> --}}
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    <!-- end row -->
  </div>
</div>
@endsection

@section('javascript')

<script>

      var dt = $('#balancecustomerTable').DataTable({
        // processing: true,
        // autoWidth: true,
        serverSide: true,
        // fixedColumns: true,
        // scrollCollapse: true,
        // scroller:       true,
        // searching:      true,
        // paging:         true,
        // info:           false,
        ajax: '{{ route('api.balance_customer_row_details') }}',
        columns: [
          { className: 'dt-body-center', data: 'customer_id', name: 'customer_id' },
          { className: 'dt-body-center', data: 'customer_ref_no', name: 'customer_ref_no' },
          { width:'25%', className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },
          { className: 'dt-body-center', data: 'customer_balance_paid', name: 'customer_balance_paid' },
          { className: 'dt-body-center', data: 'customer_balance_dues', name: 'customer_balance_dues' },
          // { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']]
      });

</script>

@endsection