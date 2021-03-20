@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info btn-round text-white pull-right" href="{{ route('purchase.returnadd') }}">Add Purchase Return</a>
            <h4 class="card-title">Purchase Returns</h4>
            <div class="col-12">
              @if (Session::has('message'))
                <div class="alert alert-success alert-block alert-dismissible fade show w-100 ml-auto" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{Session::get('message') }}</strong>
                </div>
              @elseif(Session::has('error'))
                <div class="alert alert-danger alert-block alert-dismissible fade show w-100 ml-auto" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>    
                  <strong>{{Session::get('error') }}</strong>
                </div>
              @endif
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
                  <th>P.Return Ref_No</th>
                  <th>Supplier Name</th>
                  <th>P.Return Status</th>
                  <th>P.Return Date</th>
                  <th>Grandtotal Price</th>
                  <th>Amount Paid</th>
                  <th>Amount Dues</th>
                  <th>Payment Method</th>
                  <th>Payment Status</th>
                  <th>Invoice Id</th>
                  <th>Invoice Date</th>
                  {{-- <th class="disabled-sorting text-right">Actions</th> --}}
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              <tbody>
                @foreach ($purchasereturns as $key => $value)
                <tr>
                  <td>{{ $value->purchase_return_id }}</td>
                  <td>{{ $value->purchase_return_ref_no }}</td>
                  <td>{{ $value->supplier_name}}</td> 
                  <td>{{ $value->purchase_return_status }}</td>
                  <td>{{ $value->purchase_return_date }}</td>
                  <td>{{ $value->purchase_return_grandtotal_price }}</td>
                  <td>{{ $value->purchase_return_amount_paid }}</td>
                  <td>{{ $value->purchase_return_amount_dues }}</td>
                  <td>{{ $value->purchase_return_payment_method }}</td> 
                  <td>{{ $value->purchase_return_payment_status }}</td>
                  <td>{{ $value->purchase_return_invoice_id }}</td> 
                  <td>{{ $value->purchase_return_invoice_date }}</td>
                  {{-- <td class="text-right">
                    <a type="button" href="{{ route('purchase.edit', ['purchase' => $value->purchase_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td> --}}
                </tr>
                @endforeach
              </tbody>
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
@endsection