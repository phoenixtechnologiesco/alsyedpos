@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('sale.returnadd') }}">Add Sale Return</a>
            <h4 class="card-title">Sale Returns</h4>
            <div class="col-12 mt-2">
                                        </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="salereturnTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th colspan="1" class="text-center">Customer Info</th>
                  <th colspan="2" class="text-center">SaleReturn Info</th>
                  <th colspan="2" class="text-center">Total Items/Qty</th>
                  <th colspan="3" class="text-center">SaleReturn Amount</th>
                  <th colspan="2" class="text-center">Payment Info</th>
                  <th colspan="2" class="text-center">Invoice Info</th>
                  <th colspan="1" class="text-center">Cashier Info</th>
                  {{-- <th colspan="1" class="disabled-sorting text-center">Actions</th> --}}
                </tr>
                <tr>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Ref_No</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Items</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Total Price</th>
                  <th class="text-center">Amount Returned</th>
                  <th class="text-center">Amount Dues</th>
                  <th class="text-center">Pay Method</th>
                  <th class="text-center">Pay Status</th>
                  <th class="text-center">Invoice Id</th>
                  <th class="text-center">Invoice Date</th>
                  <th class="text-center">Created By</th>
                  {{-- <th>Warehouse</th> --}}
                  {{-- <th class="disabled-sorting text-center">Edit</th> --}}
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($salereturns as $key => $value)
                <tr>
                  <td>{{ $value->sale_return_return_id }}</td>
                  <td>{{ $value->sale_return_return_ref_no }}</td>
                  <td>{{ $value->customer_name }}</td> 
                  <td>{{ $value->sale_return_return_status }}</td>
                  <td>{{ $value->sale_return_return_invoice_date }}</td>
                  <td>{{ $value->sale_return_return_grandtotal_price }}</td>
                  <td>{{ $value->sale_return_return_amount_return }}</td>
                  <td>{{ $value->sale_return_return_amount_dues }}</td>
                  <td>{{ $value->sale_return_return_payment_method }}</td> 
                  <td>{{ $value->sale_return_return_payment_status }}</td>
                  <td>{{ $value->sale_return_return_invoice_id }}</td> 
                  <td>{{ $value->sale_return_return_invoice_date }}</td>
                  <-- <td>{{ $value->customer_credit_duration." ".$value->customer_credit_type }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('salereturn.edit', ['salereturn' => $value->sale_return_return_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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

<script>
      var dt = $('#salereturnTable').DataTable({
        // processing: true,
        // autoWidth: true,
        serverSide: true,
        // fixedColumns: true,
        // scrollCollapse: true,
        // scroller:       true,
        // searching:      true,
        // paging:         true,
        // info:           false,
        ajax: '{{ route('api.salereturn_row_details') }}',
        columns: [
          { className: 'dt-body-center', data: 'sale_return_id', name: 'sale_return_id' },
          { width:'25%', className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },
          { className: 'dt-body-center', data: 'sale_return_ref_no', name: 'sale_return_ref_no' },
          { className: 'dt-body-center', data: 'sale_return_status', name: 'sale_return_status' },
          { className: 'dt-body-center', data: 'sale_return_total_items', name: 'sale_return_total_items' },
          { className: 'dt-body-center', data: 'sale_return_total_quantity', name: 'sale_return_total_quantity' },
          { className: 'dt-body-center', data: 'sale_return_grandtotal_price', name: 'sale_return_grandtotal_price' },
          { className: 'dt-body-center', data: 'sale_return_amount_return', name: 'sale_return_amount_return' },
          { className: 'dt-body-center', data: 'sale_return_amount_dues', name: 'sale_return_amount_dues' },
          { className: 'dt-body-center', data: 'sale_return_payment_method', name: 'sale_return_payment_method' },
          { className: 'dt-body-center', data: 'sale_return_payment_status', name: 'sale_return_payment_status' },
          { width:'25%', className: 'dt-body-center', data: 'sale_return_invoice_id', name: 'sale_return_invoice_id' },
          { width:'25%', className: 'dt-body-center', data: 'sale_return_invoice_date', name: 'sale_return_invoice_date' },
          { width:'25%', className: 'dt-body-center', data: 'name', name: 'name' },
          // { data: 'warehouse_name', name: 'warehouse_name' },
          // { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']]
      });
  
</script>

@endsection
