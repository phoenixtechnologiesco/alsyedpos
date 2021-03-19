@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('sale.create') }}">Add Sale</a>
            <h4 class="card-title">Sales</h4>
            <div class="col-12">
              @if (Session::has('message'))
                <div class="alert alert-success alert-block alert-dismissible fade show w-50 ml-auto" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>    
                    <strong>{{Session::get('message') }}</strong>
                </div>
              @elseif(Session::has('error'))
                <div class="alert alert-danger alert-block alert-dismissible fade show w-50 ml-auto" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>    
                  <strong>{{Session::get('error') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!-- Here you can write extra buttons/actions for the toolbar -->
            </div>
            <table id="saleTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th colspan="1" class="text-center">Customer Info</th>
                  <th colspan="2" class="text-center">Sale Info</th>
                  <th colspan="2" class="text-center">Total Items/Qty</th>
                  <th colspan="3" class="text-center">Sale Amount</th>
                  <th colspan="2" class="text-center">Payment Info</th>
                  <th colspan="2" class="text-center">Invoice Info</th>
                  <th colspan="1" class="text-center">Cashier Info</th>
                  {{-- <th colspan="1" class="disabled-sorting text-center">Actions</th> --}}
                </tr>
                <tr>
                  <th></th>
                  <th class="text-center">S.No</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Ref_No</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Items</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Total Price</th>
                  <th class="text-center">Amount Paid</th>
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
                @foreach ($sales as $key => $value)
                <tr>
                  <td>{{ $value->sale_id }}</td>
                  <td>{{ $value->sale_ref_no }}</td>
                  <td>{{ $value->customer_name }}</td> 
                  <td>{{ $value->sale_status }}</td>
                  <-- <td>{{ $value->sale_date }}</td> -->
                  <td>{{ $value->sale_grandtotal_price }}</td>
                  <td>{{ $value->sale_amount_paid }}</td>
                  <td>{{ $value->sale_amount_dues }}</td>
                  <td>{{ $value->sale_payment_method }}</td> 
                  <td>{{ $value->sale_payment_status }}</td>
                  <td>{{ $value->sale_invoice_id }}</td> 
                  <td>{{ $value->sale_invoice_date }}</td>
                  <td>{{ $value->customer_credit_duration." ".$value->customer_credit_type }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('sale.edit', ['sale' => $value->sale_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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

    // var selected = [];

    // $('#saleTable').DataTable({
    //   // processing: true,
    //   serverSide: true,
    //   ajax: {
    //     "url": '{{ route('api.sale_row_attributes') }}',
    //     // "type": "POST"
    //   },
    //   "rowCallback": function( row, data ) {
    //       if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
    //           $(row).addClass('selected');
    //       }
    //   },
    //   columns: [
    //     { data: 'sale_id', name: 'sale_id' },
    //     { data: 'sale_ref_no', name: 'sale_ref_no' },
    //     { data: 'customer_name', name: 'customer_name' },
    //     { data: 'sale_status', name: 'sale_status' },
    //     { data: 'sale_grandtotal_price', name: 'sale_grandtotal_price' },
    //     { data: 'sale_amount_paid', name: 'sale_amount_paid' },
    //     { data: 'sale_amount_dues', name: 'sale_amount_dues' },
    //     { data: 'sale_payment_method', name: 'sale_payment_method' },
    //     { data: 'sale_payment_status', name: 'sale_payment_status' },
    //     { data: 'sale_invoice_id', name: 'sale_invoice_id' },
    //     { data: 'sale_invoice_date', name: 'sale_invoice_date' },
    //     { data: 'action', name: 'action', orderable: false, searchable: false }
    //   ]
    // });

    // $('#saleTable tbody').on('click', 'tr', function () {
    //   var id = this.id;
    //   var index = $.inArray(id, selected);

    //   if ( index === -1 ) {
    //       selected.push( id );
    //   } else {
    //       selected.splice( index, 1 );
    //   }

    //   $(this).toggleClass('selected');
    // });

      function format ( d ) {
        // $sales->sale_id
        return '<a type="button" href="sale/'+d.sale_id+'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
        // return 'Attached Barcodes: '+sum;
      }

      var dt = $('#saleTable').DataTable({
        // processing: true,
        // autoWidth: true,
        serverSide: true,
        // fixedColumns: true,
        // scrollCollapse: true,
        // scroller:       true,
        // searching:      true,
        // paging:         true,
        // info:           false,
        ajax: '{{ route('api.sale_row_details') }}',
        columns: [
          {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": ''
          },
          { className: 'dt-body-center', data: 'sale_id', name: 'sale_id' },
          { width:'25%', className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },
          { className: 'dt-body-center', data: 'sale_ref_no', name: 'sale_ref_no' },
          { className: 'dt-body-center', data: 'sale_status', name: 'sale_status' },
          { className: 'dt-body-center', data: 'sale_total_items', name: 'sale_total_items' },
          { className: 'dt-body-center', data: 'sale_total_quantity', name: 'sale_total_quantity' },
          { className: 'dt-body-center', data: 'sale_grandtotal_price', name: 'sale_grandtotal_price' },
          { className: 'dt-body-center', data: 'sale_amount_paid', name: 'sale_amount_paid' },
          { className: 'dt-body-center', data: 'sale_amount_dues', name: 'sale_amount_dues' },
          { className: 'dt-body-center', data: 'sale_payment_method', name: 'sale_payment_method' },
          { className: 'dt-body-center', data: 'sale_payment_status', name: 'sale_payment_status' },
          { width:'25%', className: 'dt-body-center', data: 'sale_invoice_id', name: 'sale_invoice_id' },
          { width:'25%', className: 'dt-body-center', data: 'sale_invoice_date', name: 'sale_invoice_date' },
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

      // $('#saleTable table tbody').on('click', 'td.details-control', function () {
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
  
      $('#saleTable tbody').on( 'click', 'tr td.details-control', function () {
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
