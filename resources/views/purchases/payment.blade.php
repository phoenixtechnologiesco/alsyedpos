@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info btn-round text-white pull-right" href="{{ route('purchase.paymentcreate') }}">Add Payment</a>
            <h4 class="card-title">{{__(" Payment List")}}</h4>
            <div class="col-12">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!-- Here you can write extra buttons/actions for the toolbar -->
            </div>
            <table id="paymentTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th colspan="3" class="text-center">Cust/Supl Info</th>
                  <th colspan="5" class="text-center">Payment Info</th>
                  <th colspan="2" class="text-center">Payment Amount</th>
                  <th colspan="2" class="text-center">Invoice Info</th>
                  <th colspan="1" class="text-center">Cashier Info</th>
                  {{-- <th colspan="1" class="disabled-sorting text-center">Actions</th> --}}
                </tr>
                <tr>
                  <th></th>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Supp/C Recieved/P</th>
                  <th class="text-center">Supp/C Dues</th>
                  <th class="text-center">Type</th>
                  <th class="text-center">Ref_No</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Method</th>
                  <th class="text-center">Sale/Purchase</th>
                  <th class="text-center">Amount Paid</th>
                  <th class="text-center">Amount Dues</th>
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
                @foreach ($payments as $key => $value)
                <tr>
                  <td>{{ $value->payment_id }}</td>
                  <td>{{ $value->payment_ref_no }}</td>
                  <td>{{ $value->supplier_name }}</td> 
                  <td>{{ $value->payment_status }}</td>
                  <-- <td>{{ $value->payment_date }}</td> -->
                  <td>{{ $value->payment_amount_paid }}</td>
                  <td>{{ $value->payment_amount_dues }}</td>
                  <td>{{ $value->payment_payment_method }}</td> 
                  <td>{{ $value->payment_payment_status }}</td>
                  <td>{{ $value->payment_invoice_id }}</td> 
                  <td>{{ $value->payment_invoice_date }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('payment.edit', ['payment' => $value->payment_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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
  
      function format ( d ) {
        // $purchases->purchase_id
        return '<a type="button" href="purchase/'+d.purchase_id+'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
        // return 'Attached Barcodes: '+sum;
      }

      var dt = $('#paymentTable').DataTable({
        // processing: true,
        // autoWidth: true,
        serverSide: true,
        // fixedColumns: true,
        // scrollCollapse: true,
        // scroller:       true,
        // searching:      true,
        // paging:         true,
        // info:           false,
        ajax: '{{ route('api.payment_p_row_details') }}',
        columns: [
          {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": ''
          },
          { className: 'dt-body-center', data: 'payment_id', name: 'payment_id' },
          { width:'25%', className: 'dt-body-center', data: 'supplier_name', name: 'supplier_name' },
          { className: 'dt-body-center', data: 'supplier_amount_recieved', name: 'supplier_amount_recieved' },
          { className: 'dt-body-center', data: 'supplier_amount_dues', name: 'supplier_amount_dues' },
          { className: 'dt-body-center', data: 'payment_type', name: 'payment_type' },
          { className: 'dt-body-center', data: 'payment_ref_no', name: 'payment_ref_no' },
          { className: 'dt-body-center', data: 'payment_status', name: 'payment_status' },
          { className: 'dt-body-center', data: 'payment_method', name: 'payment_method' },
          { className: 'dt-body-center', data: 'purchase_id', name: 'purchase_id' },
          { className: 'dt-body-center', data: 'payment_amount_paid', name: 'payment_amount_paid' },
          { className: 'dt-body-center', data: 'payment_amount_balance', name: 'payment_amount_balance' },
          { width:'25%', className: 'dt-body-center', data: 'payment_invoice_id', name: 'payment_invoice_id' },
          { width:'25%', className: 'dt-body-center', data: 'payment_invoice_date', name: 'payment_invoice_date' },
          { width:'25%', className: 'dt-body-center', data: 'name', name: 'name' },
          // {
          //       "targets": [ 12 ],
          //       "visible": false
          // },
          // { data: 'warehouse_name', name: 'warehouse_name' },
          // { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']]
      });

      // $('#paymentTable table tbody').on('click', 'td.details-control', function () {
      //   var tr = $(this).closest('tr');
      //   var row = mytable.row( tr );

      //   if ( row.child.isShown() ) {
      //     // This row is already open - close it
      //     row.child.hide();
      //     tr.removeClass('shown');
      //   }
      //   else {
      //     // Open this row
      //     row.child( template(row.data()) ).show();
      //     tr.addClass('shown');
      //   }
      // });

      // Array to track the ids of the details displayed rows
      var detailRows = [];
  
      $('#paymentTable tbody').on( 'click', 'tr td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = dt.row( tr );
          var idx = $.inArray( tr.attr('id'), detailRows );

          // console.log(row.data());
  
          if ( row.child.isShown() ) {
              tr.removeClass( 'details' );
              row.child.hide();
  
              // Remove from the 'open' array
              detailRows.splice( idx, 1 );
          }
          else {
              tr.addClass( 'details' );
              row.child( format( row.data() ) ).show();
  
              // Add to the 'open' array
              if ( idx === -1 ) {
                  detailRows.push( tr.attr('id') );
              }
          }
      } );
  
      // On each draw, loop over the `detailRows` array and show any child rows
      dt.on( 'draw', function () {
          $.each( detailRows, function ( i, id ) {
              $('#'+id+' td.details-control').trigger( 'click' );
          } );
      } );
</script>

@endsection
