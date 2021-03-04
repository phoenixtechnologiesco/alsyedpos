@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">BalanceSheet PurchaseWise</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="balancepurchaseTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Supplier RefNo</th>
                  <th>Supplier Name</th>
                  <th>Supplier Balance Paid</th>
                  <th>Supplier Balance Dues</th>
                  <th>Purchase Total Amount</th>
                  <th>Purchase Amount Paid</th>
                  <th>Purchase Amount Dues</th>
                  {{-- <th>Purchase Total Balance</th> --}}
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($purchaseledgers as $key => $value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value['supplier_ref_no'] }}</td>
                  <td>{{ $value['supplier_name'] }}</td>
                  <td>{{ $value['supplier_balance_paid'] }}</td>
                  <td>{{ $value['supplier_balance_dues'] }}</td>
                  <td>{{ $value['purchase_total_balance'] }}</td>
                  <td>{{ $value['purchase_amount_paid'] }}</td>
                  <td>{{ $value['purchase_amount_dues'] }}</td>
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

var dt = $('#balancepurchaseTable').DataTable({
    // processing: true,
    // autoWidth: true,
    serverSide: true,
    // fixedColumns: true,
    // scrollCollapse: true,
    // scroller:       true,
    // searching:      true,
    // paging:         true,
    // info:           false,
    ajax: '{{ route('api.balance_purchase_row_details') }}',
    columns: [
      { className: 'dt-body-center', data: 'supplier_id', name: 'supplier_id' },
      { className: 'dt-body-center', data: 'supplier_ref_no', name: 'supplier_ref_no' },
      { width:'25%', className: 'dt-body-center', data: 'supplier_name', name: 'supplier_name' },
      { className: 'dt-body-center', data: 'supplier_balance_paid', name: 'supplier_balance_paid' },
      { className: 'dt-body-center', data: 'supplier_balance_dues', name: 'supplier_balance_dues' },
      { className: 'dt-body-center', data: 'purchase_total_balance', name: 'purchase_total_balance' },
      { className: 'dt-body-center', data: 'purchase_amount_paid', name: 'purchase_amount_paid' },
      { className: 'dt-body-center', data: 'purchase_amount_dues', name: 'purchase_amount_dues' },
      // { data: 'action', name: 'action', orderable: false, searchable: false }
    ],

    order: [[1, 'asc']]
  });
</script>

@endsection