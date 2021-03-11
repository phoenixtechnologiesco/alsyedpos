@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Minimum Stock List</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Product RefNo</th>
                  <th>Product Name</th>
                  <th>Company/Brand</th>
                  <th>Product Quantity</th>
                  <th>Minimum Quantity</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              <tbody>
                @foreach ($products as $key => $value)
                <tr>
                  <td>{{ $value->product_id }}</td>
                  <td>{{ $value->product_ref_no }}</td>
                  <td>{{ $value->product_name }}</td>
                  <td>{{ $value->product_company."/".$value->product_brand }}</td>
                  <td>{{ $value->product_quantity_available }}</td> 
                  <td>{{ $value->product_alert_quantity }}</td>
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