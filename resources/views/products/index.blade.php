@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info btn-round text-white pull-right" href="{{ route('product.create') }}">Add Product</a>
            <h4 class="card-title">Products</h4>
            <div class="col-12">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="productTable" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="600px">
              <thead>
                <tr>
                  {{-- <th>Ref.Id</th> --}}
                  <th></th>
                  <th colspan="3">Product Info</th>
                  {{-- <th colspan="2">Company/Brand</th> --}}
                  <th colspan="3">Total Quantity</th>
                  {{-- <th>Totl.Pkt</th>
                  <th>Totl.Crt</th> --}}
                  <th colspan="3">Aval Quantity</th>
                  {{-- <th>Aval.Pkt</th>
                  <th>Aval.Crt</th> --}}
                  {{-- <th>Damage Qty</th> --}}
                  {{-- <th>Piece Carton</th> --}}
                  <th colspan="3">Trade Price</th>
                  {{-- <th>T.P.Pkt</th>
                  <th>T.P.Crt</th> --}}
                  <th colspan="3">Cash Price</th>
                  {{-- <th>Cash.P.Pkt</th>
                  <th>Cash.P.Crt</th> --}}
                  <th colspan="3">Credit Price</th>
                  {{-- <th>Credit.P.Pkt</th>
                  <th>Credit.P.Crt</th> --}}
                  {{-- <th>Expiry</th> --}}
                  {{-- <th>Status</th> --}}
                  {{-- <th class="disabled-sorting text-left">Edit</th> --}}
                </tr>
                <tr>
                  {{-- <th>Ref.Id</th> --}}
                  <th></th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Brand</th>
                  <th>Pc</th>
                  <th>Pkt</th>
                  <th>Crt</th>
                  <th>Pc</th>
                  <th>Pkt</th>
                  <th>Crt</th>
                  {{-- <th>Damage Qty</th> --}}
                  {{-- <th>Piece Carton</th> --}}
                  <th>Pc</th>
                  <th>Pkt</th>
                  <th>Crt</th>
                  <th>Pc</th>
                  <th>Pkt</th>
                  <th>Crt</th>
                  <th>Pc</th>
                  <th>Pkt</th>
                  <th>Crt</th>
                  {{-- <th>Expiry</th> --}}
                  {{-- <th>Status</th> --}}
                  {{-- <th class="disabled-sorting text-left">Edit</th> --}}
                </tr>
              </thead>
              {{-- <tfoot>
                <tr>
                </tr>
              </tfoot> --}}
              {{-- <tbody>
                @foreach ($products as $key => $value)
                  <tr>
                    <!-- <td>{ $value->product_ref_no }}</td> -->
                    <!-- <td>{ $value->product_warehouse }}</td> -->
                    <td>{{ $value->product_name }}</td>
                    <td>{{ $value->product_barcode }}</td> 
                    <td>{{ $value->product_company }}</td>
                    <td>{{ $value->product_brands }}</td>
                    <td>{{ $value->product_pieces_total }}/{{ $value->product_packets_total }}/{{ $value->product_cartons_total }}</td>
                    <td>{{ $value->product_pieces_available }}/{{ $value->product_packets_available }}/{{ $value->product_cartons_available }}</td>
                    <!-- <td>{ $value->product_damage_quantity }}</td>
                    <td>{{ $value->product_piece_per_carton }}</td>  -->
                    <td>{{ $value->product_trade_price_piece }}/{{ $value->product_trade_price_packet }}/{{ $value->product_trade_price_carton }}</td> 
                    <td>{{ $value->product_cash_price_piece }}/{{ $value->product_cash_price_packet }}/{{ $value->product_cash_price_carton }}</td>
                    <td>{{ $value->product_credit_price_piece }}/{{ $value->product_credit_price_packet }}/{{ $value->product_credit_price_carton }}</td>
                    <!-- <td>{ $value->product_expirydate }}</td>
                    <td>{ $value->status_id }}</td> -->
                    <td class="text-right">
                      <a type="button" href="{{ route('product.edit', ['product' => $value->product_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody> --}}
            </table>

            {{-- <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12 col-6">
                  <div class="dataTables_length" id="DataTables_Table_0_length">
                    <label>Show 
                      <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="custom-select custom-select-sm form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select> entries
                    </label>
                  </div>
                </div>
                <div class="col-sm-12 col-6">
                  <div id="DataTables_Table_0_filter" class="dataTables_filter">
                    <label>Search:
                      <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="DataTables_Table_0">
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-striped table-bordered datatable dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                    <thead>
                      <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 220px;">Username</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending" style="width: 188px;">Date registered</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 82px;">Role</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 91px;">Status</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 190px;">Actions</th></tr>
                    </thead>
                    <tbody>
                      <tr role="row" class="odd">
                        <td class="sorting_1">Adam Alister</td>
                        <td>2012/01/21</td>
                        <td>Staff</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="even">
                        <td class="sorting_1">Adinah Ralph</td>
                        <td>2012/06/01</td>
                        <td>Admin</td>
                        <td><span class="badge badge-dark">Inactive</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="odd">
                        <td class="sorting_1">Ajith Hristijan</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="even">
                        <td class="sorting_1">Alphonse Ivo</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="odd">
                        <td class="sorting_1">Anton Phunihel</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="even">
                        <td class="sorting_1">Bao Gaspar</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="odd">
                        <td class="sorting_1">Bernhard Shelah</td>
                        <td>2012/06/01</td>
                        <td>Admin</td>
                        <td><span class="badge badge-dark">Inactive</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="even">
                        <td class="sorting_1">Bünyamin Kasper</td>
                        <td>2012/08/23</td>
                        <td>Staff</td>
                        <td><span class="badge badge-danger">Banned</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="odd">
                        <td class="sorting_1">Carlito Roffe</td>
                        <td>2012/08/23</td>
                        <td>Staff</td>
                        <td><span class="badge badge-danger">Banned</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      <tr role="row" class="even">
                        <td class="sorting_1">Chidubem Gottlob</td>
                        <td>2012/02/01</td>
                        <td>Staff</td>
                        <td><span class="badge badge-danger">Banned</span></td>
                        <td>
                          <a class="btn btn-success" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                          </a>
                          <a class="btn btn-info" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg>
                          </a>
                          <a class="btn btn-danger" href="#">
                            <svg class="c-icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                            </svg>
                          </a>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-5">
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                    Showing 1 to 10 of 32 entries
                  </div>
                </div>
                <div class="col-sm-12 col-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">
                          Previous
                        </a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">
                          1
                        </a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">
                          2
                        </a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">
                          3
                        </a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0" class="page-link">
                          4
                        </a>
                      </li>
                      <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0" class="page-link">
                          Next
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div> --}}

            <!-- <table id="productTable" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  {{-- <th>Ref.Id</th> --}}
                  <th>Name</th>
                  <th>Barcode</th>
                  <th>Company</th>
                  <th>Brand</th>
                  <th>Totl.Pc/Pkt/Crt</th>
                  <th>Aval.Pc/Pkt/Crt</th>
                  {{-- <th>Damage Qty</th> --}}
                  {{-- <th>Piece Carton</th> --}}
                  <th>T.P(P/P/C)</th>
                  <th>Cash.P(P/P/C)</th>
                  <th>Credit.P(P/P/C)</th>
                  {{-- <th>Expiry</th> --}}
                  {{-- <th>Status</th> --}}
                  <th class="disabled-sorting text-right">Edit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                        <td>Anton Phunihel</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td>
                                <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                                <a class="btn btn-info" href="#">
                                        <i class="fa fa-edit "></i>
                                </a>
                        </td>
                </tr>
                <tr>
                        <td>Alphonse Ivo</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td>
                                <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                                <a class="btn btn-info" href="#">
                                        <i class="fa fa-edit "></i>
                                </a>
                        </td>
                </tr>
                <tr>
                        <td>Thancmar Theophanes</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td>
                                <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                                <a class="btn btn-info" href="#">
                                        <i class="fa fa-edit "></i>
                                </a>
                        </td>
                </tr>
                <tr>
                        <td>Walerian Khwaja</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td>
                                <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                                <a class="btn btn-info" href="#">
                                        <i class="fa fa-edit "></i>
                                </a>
                        </td>
                </tr>
                <tr>
                        <td>Clemens Janko</td>
                        <td>2012/02/01</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Chidubem Gottlob</td>
                        <td>2012/02/01</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Hristofor Sergio</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Tadhg Griogair</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Pollux Beaumont</td>
                        <td>2012/01/21</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Adam Alister</td>
                        <td>2012/01/21</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Carlito Roffe</td>
                        <td>2012/08/23</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Sana Amrin</td>
                        <td>2012/08/23</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Adinah Ralph</td>
                        <td>2012/06/01</td>
                        <td>Admin</td>
                        <td>
                        <span class="badge badge-dark">Inactive</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Dederick Mihail</td>
                        <td>2012/06/01</td>
                        <td>Admin</td>
                        <td>
                        <span class="badge badge-dark">Inactive</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Hipólito András</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Fricis Arieh</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Scottie Maximilian</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Bao Gaspar</td>
                        <td>2012/01/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Tullio Luka</td>
                        <td>2012/02/01</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Felice Arseniy</td>
                        <td>2012/02/01</td>
                        <td>Admin</td>
                        <td>
                        <span class="badge badge-dark">Inactive</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Finlay Alf</td>
                        <td>2012/02/01</td>
                        <td>Admin</td>
                        <td>
                        <span class="badge badge-dark">Inactive</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Theophilus Nala</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Sullivan Robert</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Kristóf Filiberto</td>
                        <td>2012/01/21</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Kuzma Edvard</td>
                        <td>2012/01/21</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-success">Active</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Bünyamin Kasper</td>
                        <td>2012/08/23</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Crofton Arran</td>
                        <td>2012/08/23</td>
                        <td>Staff</td>
                        <td>
                        <span class="badge badge-danger">Banned</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Bernhard Shelah</td>
                        <td>2012/06/01</td>
                        <td>Admin</td>
                        <td>
                        <span class="badge badge-dark">Inactive</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Grahame Miodrag</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Innokentiy Celio</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Kostandin Warinhari</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
                <tr>
                        <td>Ajith Hristijan</td>
                        <td>2012/03/01</td>
                        <td>Member</td>
                        <td>
                        <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                          <a class="btn btn-info" href="#">
                            <i class="fa fa-edit "></i>
                          </a>
                        </td>
                </tr>
              </tbody>
            </table> -->
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
    <!-- Plugins and scripts required by this views -->
    {{-- <script src="{{ asset('js/coreui/dataTables.coreui.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/coreui/jquery.dataTables.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/coreui/dataTables.bootstrap4.min.js') }}"></script> --}}

    <!-- Custom scripts required by this view -->
    {{-- <script src="{{ asset('js/coreui/datatables.js') }}"></script> --}}

    {{-- <script>
      $(document).ready( function () {
          $('#productTable').DataTable();
      });
    </script> --}}
    {{-- <script id="detailss-template" type="text/x-handlebars-template">
      @verbatim
          <table class="table">
              <tr>
                  <td>Full name:</td>
                  <td>{{product_name}}</td>
              </tr>
              <tr>
                  <td>Email:</td>
                  <td>{{product_name}}</td>
              </tr>
              <tr>
                  <td>Extra info:</td>
                  <td>And any further details here (images etc)...</td>
              </tr>
          </table>
      @endverbatim
    </script> --}}

    <script>
      // var template = Handlebars.compile($("#details-template").html());
      function format ( d ) {
        var sum = [];
        $.each( d.barcodes, function ( i, id ) {
          sum[i] = "&nbsp;"+"&nbsp;"+"&nbsp;"+d.barcodes[i].product_barcodes;
          // sum[i] = 'Attached Barcodes: '+"&nbsp;"+"&nbsp;"+"&nbsp;"+d.barcodes[i].product_barcodes+'<br>';
        });
        // $products->product_id
        return '<a href="product/'+d.product_id+'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a>'+'&nbsp;&nbsp;'+'Attached Barcodes: '+sum;
        // return 'Attached Barcodes: '+sum;
      }
      var dt = $('#productTable').DataTable({
        // processing: true,
        serverSide: true,
        ajax: '{{ route('api.product_row_details') }}',
        columns: [
          {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": ''
          },
          { data: 'product_name', name: 'product_name', },
          { data: 'product_company', name: 'product_company' },
          { data: 'product_brand', name: 'product_brand' },
          { data: 'product_pieces_total', name: 'product_pieces_total' },
          { data: 'product_packets_total', name: 'product_packets_total' },
          { data: 'product_cartons_total', name: 'product_cartons_total' },
          { data: 'product_pieces_available', name: 'product_pieces_available' },
          { data: 'product_packets_available', name: 'product_packets_available' },
          { data: 'product_cartons_available', name: 'product_cartons_available' },
          { data: 'product_trade_price_piece', name: 'product_trade_price_piece' },
          { data: 'product_trade_price_packet', name: 'product_trade_price_packet' },
          { data: 'product_trade_price_carton', name: 'product_trade_price_carton' },
          { data: 'product_cash_price_piece', name: 'product_cash_price_piece' },
          { data: 'product_cash_price_packet', name: 'product_cash_price_packet' },
          { data: 'product_credit_price_carton', name: 'product_credit_price_carton' },
          { data: 'product_credit_price_piece', name: 'product_credit_price_piece' },
          { data: 'product_credit_price_packet', name: 'product_credit_price_packet' },
          { data: 'product_credit_price_carton', name: 'product_credit_price_carton' },
          // { data: 'action', name: 'action'},
        ],
        order: [[1, 'asc']]
      });

      // $('#productTable table tbody').on('click', 'td.details-control', function () {
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
  
      $('#productTable tbody').on( 'click', 'tr td.details-control', function () {
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


      // var selected = [];

      // $('#productTable').DataTable({
      //   processing: true,
      //   serverSide: true,
      //   ajax: {
      //     "url": '{{ route('api.product_row_attributes') }}',
      //     // "type": "POST"
      //   },
      //   "rowCallback": function( row, data ) {
      //       if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
      //           $(row).addClass('selected');
      //       }
      //   },
      //   columns: [
      //     { data: 'product_name', name: 'product_name' },
      //     { data: 'product_barcode', name: 'product_barcode' },
      //     { data: 'product_company', name: 'product_company' },
      //     { data: 'product_brand', name: 'product_brand' },
      //     { data: 'product_pieces_total', name: 'product_pieces_total' },
      //     { data: 'product_packets_total', name: 'product_packets_total' },
      //     { data: 'product_cartons_total', name: 'product_cartons_total' },
      //     { data: 'product_pieces_available', name: 'product_pieces_available' },
      //     { data: 'product_packets_available', name: 'product_packets_available' },
      //     { data: 'product_cartons_available', name: 'product_cartons_available' },
      //     { data: 'product_trade_price_piece', name: 'product_trade_price_piece' },
      //     { data: 'product_trade_price_packet', name: 'product_trade_price_packet' },
      //     { data: 'product_trade_price_carton', name: 'product_trade_price_carton' },
      //     { data: 'product_cash_price_piece', name: 'product_cash_price_piece' },
      //     { data: 'product_cash_price_packet', name: 'product_cash_price_packet' },
      //     { data: 'product_credit_price_carton', name: 'product_credit_price_carton' },
      //     { data: 'product_credit_price_piece', name: 'product_credit_price_piece' },
      //     { data: 'product_credit_price_packet', name: 'product_credit_price_packet' },
      //     { data: 'product_credit_price_carton', name: 'product_credit_price_carton' },
      //     // { data: 'action', name: 'action', orderable: false, searchable: false }
      //   ]
      // });

      // $('#productTable tbody').on('click', 'tr', function () {
      //   var id = this.id;
      //   var index = $.inArray(id, selected);
 
      //   if ( index === -1 ) {
      //       selected.push( id );
      //   } else {
      //       selected.splice( index, 1 );
      //   }
 
      //   $(this).toggleClass('selected');
      // });

    </script>
@endsection