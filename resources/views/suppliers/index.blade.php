@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('supplier.create') }}">Add Supplier</a>
            <h4 class="card-title">Suppliers</h4>
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
                  <th>Supplier Name</th>
                  <th>Supplier Type</th>
                  <th>Shop Name</th>
                  <th>Shop Description</th>
                  <th>Shop Address</th>
                  <th>Balance Paid</th>
                  <th>Balance Dues</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              <tbody>
                @foreach ($suppliers as $key => $value)
                <tr>
                  <td>{{ $value->supplier_id }}</td>
                  <td>{{ $value->supplier_ref_no }}</td>
                  <td>{{ $value->supplier_type }}</td> 
                  <td>{{ $value->supplier_name }}</td>
                  <td>{{ $value->supplier_shop_name }}</td>
                  <td>{{ $value->supplier_shop_info }}</td>
                  <td>{{ $value->supplier_town }}, {{ $value->supplier_area }}</td>
                  <td>{{ $value->supplier_balance_paid }}</td> 
                  <td>{{ $value->supplier_balance_dues }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('supplier.edit', ['supplier' => $value->supplier_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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