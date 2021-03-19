@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('company.create') }}">Add company</a>
            <h4 class="card-title">Companies</h4>
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
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Parent Company</th>
                  <th>Name</th>
                  <th>Reference ID</th>
                  <th>Description</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              <tbody>
                @foreach($companies as $key => $value)
                <tr>
                  <td>{{ $value->company_id }}</td>
                  <td>{{ $value->company_parent }}</td>
                  <td>{{ $value->company_name }}</td>
                  <td>{{ $value->company_ref_no }}</td>
                  <td>{{ $value->company_description }}</td>
                  <td class="text-right">
                    <a type="button" href="{{ route('company.edit', ['company' => $value->company_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
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
      <!-- end col-12 -->
    </div>
    <!-- end row -->
  </div>
</div>
@endsection

@section('javascript')
@endsection