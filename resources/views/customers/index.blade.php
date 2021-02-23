@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('customer.create') }}">Add Customer</a>
            <h4 class="card-title">Customers</h4>
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
                  <th>Customer Type</th>
                  <th>Customer Name</th>
                  <th>Shop Name</th>
                  <th>Shop Description</th>
                  <th>Shop Address</th>
                  <th>Balance Paid</th>
                  <th>Balance Dues</th>
                  <th>Credit DuraType</th>
                  <th>Credit Limit</th>
                  <th>Sale Rate</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              <tbody>
                @foreach ($customers as $key => $value)
                <tr>
                  <td>{{ $value->customer_id }}</td>
                  <td>{{ $value->customer_ref_no }}</td>
                  <td>{{ $value->customer_type }}</td> 
                  <td>{{ $value->customer_name }}</td>
                  <td>{{ $value->customer_shop_name }}</td>
                  <td>{{ $value->customer_shop_info }}</td>
                  <td>{{ $value->customer_town }}, {{ $value->customer_area }}</td>
                  <td>{{ $value->customer_balance_paid }}</td> 
                  <td>{{ $value->customer_balance_dues }}</td>
                  <td>{{ $value->customer_credit_duration }}-{{ $value->customer_credit_type }}</td>
                  <td>{{ $value->customer_credit_limit }}</td> 
                  <td>{{ $value->customer_sale_rate }}</td> 
                  <td class="text-right">
                    <a type="button" href="{{ route('customer.edit', ['customer' => $value->customer_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                
                </tr>
                @endforeach
                {{-- <tr>
                  <td>{{ $customers[1]->customer_id }}</td>
                  <td>{{ $customers[1]->customer_ref_no }}</td>
                  <td>{{ $customers[1]->customer_type }}</td> 
                  <td>{{ $customers[1]->customer_name }}</td>
                  <td>{{ $customers[1]->customer_shop_name }}</td>
                  <td>{{ $customers[1]->customer_shop_info }}</td>
                  <td>{{ $customers[1]->customer_town }}, {{ $customers[1]->customer_area }}</td>
                  <td>{{ $customers[1]->customer_balance_paid }}</td> 
                  <td>{{ $customers[1]->customer_balance_dues }}</td>
                  <td>{{ $customers[1]->customer_credit_duration }}-{{ $customers[1]->customer_credit_type }}</td>
                  <td>{{ $customers[1]->customer_credit_limit }}</td> 
                  <td>{{ $customers[1]->customer_sale_rate }}</td> 
                  <td class="text-right">
                    <a type="button" href="{{ route('customer.edit', ['customer' => $customers[1]->customer_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                </tr> --}}
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