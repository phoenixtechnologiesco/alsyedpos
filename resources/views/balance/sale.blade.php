@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Balance Sheet SaleWise</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="balancesaleTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customer RefNo</th>
                  <th>Customer Name</th>
                  <th>Customer Balance Paid</th>
                  <th>Customer Balance Dues</th>
                  <th>Sale Total Amount</th>
                  <th>Sale Amount Paid</th>
                  <th>Sale Amount Dues</th>
                  {{-- <th>Sale Total Balance</th> --}}
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($saleledgers as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value['customer_ref_no'] }}</td>
                  <td>{{ $value['customer_name'] }}</td>
                  <td>{{ $value['customer_balance_paid'] }}</td>
                  <td>{{ $value['customer_balance_dues'] }}</td>
                  <td>{{ $value['sale_total_balance'] }}</td>
                  <td>{{ $value['sale_amount_paid'] }}</td>
                  <td>{{ $value['sale_amount_dues'] }}</td>
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
  var dt = $('#balancesaleTable').DataTable({
    // processing: true,
    // autoWidth: true,
    serverSide: true,
    // fixedColumns: true,
    // scrollCollapse: true,
    // scroller:       true,
    // searching:      true,
    // paging:         true,
    // info:           false,
    ajax: '{{ route('api.balance_sale_row_details') }}',
    columns: [
      { className: 'dt-body-center', data: 'customer_id', name: 'customer_id' },
      { className: 'dt-body-center', data: 'customer_ref_no', name: 'customer_ref_no' },
      { width:'25%', className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },
      { className: 'dt-body-center', data: 'customer_balance_paid', name: 'customer_balance_paid' },
      { className: 'dt-body-center', data: 'customer_balance_dues', name: 'customer_balance_dues' },
      { className: 'dt-body-center', data: 'sale_total_balance', name: 'sale_total_balance' },
      { className: 'dt-body-center', data: 'sale_amount_paid', name: 'sale_amount_paid' },
      { className: 'dt-body-center', data: 'sale_amount_dues', name: 'sale_amount_dues' },
      // { data: 'action', name: 'action', orderable: false, searchable: false }
    ],

    order: [[1, 'asc']]
  });

</script>

@endsection