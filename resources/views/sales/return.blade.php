@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('sale.create') }}">Add Sale Return</a>
            <h4 class="card-title">Sale Returns</h4>
            <div class="col-12 mt-2">
                                        </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Ref_No</th>
                  <th>Customer Name</th>
                  <th>Sale Status</th>
                  <th>Sale Date</th>
                  <th>Grandtotal Price</th>
                  <th>Amount Paid</th>
                  <th>Amount Dues</th>
                  <th>Payment Method</th>
                  <th>Payment Status</th>
                  <!-- <th>Invoice Id</th>
                  <th>Invoice Date</th> -->
                  <th>Payterm DuraType</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              <tbody>
                @foreach ($salereturns as $key => $value)
                <tr>
                  <td>{{ $value->sale_id }}</td>
                  <td>{{ $value->sale_ref_no }}</td>
                  <td>{{ $value->customer_name }}</td> 
                  <td>{{ $value->sale_status }}</td>
                  <td>{{ $value->sale_invoice_date }}</td>
                  <td>{{ $value->sale_grandtotal_price }}</td>
                  <td>{{ $value->sale_amount_paid }}</td>
                  <td>{{ $value->sale_amount_dues }}</td>
                  <td>{{ $value->sale_payment_method }}</td> 
                  <td>{{ $value->sale_payment_status }}</td>
                  <td>{{ $value->customer_credit_duration." ".$value->customer_credit_type }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('sale.edit', ['sale' => $value->sale_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
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
@endsection
