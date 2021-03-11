@extends('dashboard.basepos')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
  {{-- <header class="header">
    <nav class="pos-navbar">
      <div class="pos-container-fluid">
        <div class="pos-holder d-flex align-items-center justify-content-between">
          <div class="pos-header">
            <ul class="pos-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <li class="nav-item">
                <a class="navbar-brand" href="#" id="btnFullscreen" title="Full Screen"><i class="fa fa-expand"></i></a>
              </li> 
              <!-- &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" class="dropdown-item" href="#" title="POS Setting"><i class="fa fa-cogs"></i></a>
              </li> -->
              &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" href="#" title="Print Last Reciept"><i class="fa fa-print"></i></a>
              </li>
              <!-- &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" href="#" id="register-details-btn" title="Cash Register Details"><i class="fa fa-cash-register"></i></a>
              </li>
              &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" href="#" id="recent-transactions-btn" title="Recent Transactions"><i class="fa fa-briefcase"></i></a>
              </li>
              &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" href="#" id="today-sale-btn" title="Today Sale"><i class="fa fa-shopping-bag"></i></a>
              </li>
              &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" href="#" id="today-profit-btn" title="Today Profit"><i class="fas fa-money-bill-alt"></i></a>
              </li>
              &nbsp;&nbsp;
              <li class="nav-item">
                <a class="navbar-brand" href="#" id="btnCalculator" title="Calculator">
                  <i class="fa fa-calculator" aria-hidden="true"></i>
                </a>
              </li> -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user"></i> 
                  <span>{{Auth::user()->name}}</span> 
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header> --}}
    <div class="row">
      <div class="form-col-12">
        <audio id="mysoundclip1" preload="auto">
          <source src="{{ asset('assets') }}/beep/beep-timber.mp3"></source>
        </audio>
        <audio id="mysoundclip2" preload="auto">
            <source src="{{ asset('assets') }}/beep/beep-07.mp3"></source>
        </audio>
        <div class="">
          <div class="header">
            <center>
              <h5 class="title" style="color: #d63031">{{__(" Sale Counter(POS)")}}</h5>
            </center>
          </div>
          <div class="body">
            <form method="post" action="{{ route('sale.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
              @include('alerts.success')
                <div class="row">
                  <div class="body col-12 ">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="form-first-col-3">
                            <div class="form-group">
                              <label for="customer_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Customer")}}</label>
                              <div class="form-col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text barcode">
                                    <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                  </span>
                                </div>
                                {{-- <div class="input-group pos"> --}}
                                  <input type="text" name="customer_code" id="customercodesearch" placeholder="Search Customer by code" class="form-control col-12" value="" />
                                  <input readonly type="hidden" name="sale_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                  <input readonly type="hidden" name="sale_customer_id" id="customer_id" class="form-control col-12" value="" />
                                  {{-- <input type="hidden" name="customer_code" id="allcustomers" class="form-control col-12"  /> --}}
                                    <?php $snameArray = []; $snamecodeArray = [];?>
                                    
                                    @foreach($customers as $one_customer) 
                                      <div class="customernames_array" style="display: none">{{ $snameArray[] = $one_customer->customer_name }}</div>
                                      <div class="customernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_customer->customer_name.", ".($one_customer->customer_ref_no) }}</div>
                                    @endforeach
                                  {{-- <select required name="customer_code" id="customer_code" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px">
                                    @foreach($lims_customer_list as $customer)
                                      <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                  </select> --}}
                                {{-- </div> --}}
                                @include('alerts.feedback', ['field' => 'customer_code'])
                              </div>
                            </div>
                          </div>
                          {{-- <div class="form-col-3">
                            <div class="form-group">
                              <label readonly for="sale_customer_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                              <div class="form-col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text barcode">
                                    <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                  </span>
                                </div>
                                <-- <div class="input-group pos"> -->
                                  <input readonly type="text" name="sale_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                  <input readonly type="hidden" name="sale_customer_id" id="customer_id" class="form-control col-12" value="" />
                                  <-- <select readonly required name="sale_customer_name" id="customer_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 150px">
                                    @foreach($customers as $single_customer)
                                      <option status_id="{{$single_customer->status_id}}" value="{{$single_customer->customer_id}}">{{$single_customer->customer_name}}</option>
                                    @endforeach
                                  </select> -->
                                <-- </div> -->
                                @include('alerts.feedback', ['field' => 'sale_customer_name'])
                              </div>
                            </div>
                          </div> --}}
                          <div class="form-col-2">
                            <div class="form-group">
                              <label for="customer_status" class="form-col-12 control-label">{{__(" Customer Status")}}</label>
                                <div class="form-col-12">
                                  <input readonly type="text" name="customer_status" id="customer_status" class="form-control col-12" value="">
                                  @include('alerts.feedback', ['field' => 'customer_status'])
                                </div>
                            </div>
                          </div>
                          <div class="form-col-2">
                            <div class="form-group">
                              <label for="customer_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Amount Paid")}}</label>
                              <div class="form-col-12 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input readonly type="number" name="customer_amount_paid" id="customer_balance_paid" class="form-control" value="">
                                @include('alerts.feedback', ['field' => 'customer_amount_paid'])
                              </div>
                            </div>
                          </div>
                          <div class="form-col-3">
                            <div class="form-group">
                              <label for="party_balance_dues" class="form-col-12 control-label">{{__(" Party Balance Dues")}}</label>
                            {{-- <div class="card overflow-hidden">
                              <div class="card-body p-0 align-items-center">
                                <div class="bg-gradient-info form-col-12"> --}}
                                  <div class="row">
                                    <div class="form-first-col-6">
                                    {{-- <div class="text-white text-value">Rs: 203400.00</div>
                                    <div class="text-white text-value">Rs: 205500.00</div> --}}
                                      <input readonly type="number" name="customer_amount_dues" id="customer_balance_dues" class="bg-gradient-info form-control col-12" value="">
                                    </div>
                                    <div class="form-last-col-6">
                                      <input readonly type="number" name="customer_amount_dues2" id="customer_balance_dues2" class="bg-gradient-info form-control col-12" value="">
                                    </div>
                                  </div>
                                {{-- </div>
                              </div>
                            </div> --}}
                            </div>
                          </div>
                          <div class="form-last-col-2">
                            <div class="form-group">
                              <label for="sale_status" class="form-col-12 control-label">{{__(" Sale Status")}}</label>
                                <div class="form-col-12">
                                  <select readonly name="sale_status" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Sale Status">
                                    <option value="pending">Pending</option>
                                    <option value="created">Created</option>
                                    <option value="completed">Completed</option>
                                    //completed/pending/created
                                  </select>
                                  @include('alerts.feedback', ['field' => 'sale_status'])
                                </div>
                            </div>
                          </div>
                          {{-- <div class="form-last-col-2">
                            <div class="form-group">
                              <label for="customer_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Dues")}}</label>
                              <div class="form-col-12 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input readonly type="number" name="customer_amount_dues" id="customer_balance_dues" class="form-control" value="{{ old('customer_amount_dues', '') }}">
                                @include('alerts.feedback', ['field' => 'customer_amount_dues'])
                              </div>
                            </div>
                          </div> --}}
                        </div>
                        <div class="row">
                          <div class="form-first-col-2">
                            <div class="form-group">
                              <label for="sale_payment_method" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Payment Method")}}</label>
                                <div class="form-col-12">
                                  {{-- <input readonly type="text" name="sale_payment_method" class="form-control col-12" value="{{ old('sale_payment_method', 'Cash') }}"> --}}
                                  <select required id="sale_payment_method" name="sale_payment_method" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Method...">
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit</option>
                                  </select>
                                  @include('alerts.feedback', ['field' => 'sale_payment_method'])
                                </div>
                            </div>
                          </div>
                          <div class="form-col-2">
                            <div class="form-group">
                              <label for="sale_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Invoice ID")}}</label>
                                <div class="form-col-12">
                                  <div class="myrow">
                                    {{-- <div class="col-1"></div> --}}
                                    <input type="text" name="sale_invoice_id" class="form-control form-col-10" value="">
                                    <button type="button" href="{{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                      <i class="fa fa-file-text-o"></i>
                                    </button>
                                  </div>
                                  @include('alerts.feedback', ['field' => 'sale_invoice_id'])
                                </div>
                            </div>
                          </div>
                          <div class="form-col-2">
                            <div class="form-group">
                              <label for="sale_invoice_date" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Sale/Invoice Date")}}</label>
                              <div class="form-col-12 input-group ">
                                {{-- <div class="input-group-prepend">
                                  <span class="input-group-text barcode"><i class="fa fa-file-text-o"></i></span>
                                </div> --}}
                                <input type="date" name="sale_invoice_date" class="form-control" value="{{ \Carbon\Carbon::today()->toDateString() }}">
                                {{-- ->format('m/d/Y') --}}
                                @include('alerts.feedback', ['field' => 'sale_invoice_date'])
                              </div>
                            </div>
                          </div>
                          <div class="form-col-2">
                            <div class="form-group">
                              <label for="sale_document" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Upload Document")}}</label>
                              <div class="form-col-12 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text barcode">
                                    <i class="fa fa-file-text-o"></i>
                                  </span>
                                </div>
                                <input type="file" name="sale_document" id="sale_document" class="form-control col-12" value="">
                              </div>
                            </div>
                          </div>
                          <div class="form-col-2">
                            <div class="form-group">
                              <label for="payterm_duratype" class="form-col-12 control-label">{{__("Payterm")}}</label>
                                <div class="form-col-12">
                                  <input readonly type="text" name="payterm_duratype" id="payterm_duratype" class="form-control col-12" value="30 Days">
                                </div>
                            </div>
                          </div>
                          <div class="form-last-col-2">
                            <div class="form-group">
                              <label for="customer_credit_limit" class=" form-col-12 control-label">{{__(" Credit Limit")}}</label>
                                <div class=" form-col-12">
                                  <input readonly type="number" name="customer_credit_limit" id="customer_credit_limit" class="form-control col-12" value="30000">
                                  @include('alerts.feedback', ['field' => 'credit_limit'])
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <div class="col-12">
                                <div class="table-responsive-custom">
                                  {{-- style="overflow-x:hidden" --}}
                                  <table id="myTable" class="table table-hover table-fixed table-bordered order-list">
                                    <thead class="thead-dark" >
                                      <tr class="row thead-dark-custom">
                                        <th class="col-2 firstcol" scope="col">Barcode</th>
                                        <th class="col-3 mycol" scope="col">Product</th>
                                        <th class="col-1 mycol" scope="col">Pieces</th>
                                        <th class="col-1 mycol" scope="col">Packets</th>
                                        <th class="col-1 mycol" scope="col">Cartons</th>
                                        <th class="col-1 mycol" scope="col">Price</th>
                                        <th class="col-1 mycol" scope="col">Discount</th>
                                        <th class="col-1 mycol" scope="col">Total</th>
                                        <th class="col-1 lastcol" scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody class="sale-product">
                                      <tr class="row table-info" >
                                        <td class="col-2 firstcol" scope="col">
                                          <input type="text" name="sale_products_barcode_i" id="sale_products_barcode_i" class="form-control col-12" placeholder="Barcode Search/Scan" value="">
                                        </td>
                                        <td class="col-3 mycol" scope="col">
                                          <div class="col-12 mytblcol input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text barcode">
                                                <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                              </span>
                                            </div>
                                            <input type="text" name="product_name_i" id="product_name_i" class="form-control col-12" placeholder="Product search by name/code" value="">
                                            <input type="hidden" name="product_code_i" id="product_code_i" value="">
                                            <input type="hidden" name="product_id_i" id="product_id_i" value="">
                                            {{-- <select placeholder="Scan/Search product by name/code" name="product_code_name" id="product_code_name" class="form-control select2-single col-10">
                                              select2-single
                                              c-multi-select
                                              js-example-basic-single my-class
                                              <option class="" value="">Scan/Search product by name/code</option>
                                              @foreach($products as $one_product)
                                                <option class="" value="{{ $one_product->product_id }}">{{ $one_product->product_name }}</option>
                                              @endforeach
                                            </select> --}}
                                          </div>
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="number" name="sale_products_pieces_i" id="sale_products_pieces_i" class="form-control col-12" min="0" value="0">
                                          <input type="hidden" name="sale_pieces_per_packet_i" min="0" id="sale_pieces_per_packet_i" class="form-control col-12" min="0" value="5">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="number" name="sale_products_packets_i" id="sale_products_packets_i" class="form-control col-12" min="0" value="0">
                                          <input type="hidden" name="sale_packets_per_carton_i" min="0" id="sale_packets_per_carton_i" class="form-control col-12" min="0" value="4">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="number" name="sale_products_cartons_i" id="sale_products_cartons_i" class="form-control col-12" min="0" value="0">
                                          <input type="hidden" name="sale_pieces_per_carton_i" min="0" id="sale_pieces_per_carton_i" class="form-control col-12" min="0" value="20">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input readonly type="text" name="sale_products_unit_price_i" id="sale_products_unit_price_i" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="text" name="sale_products_discount_i" id="sale_products_discount_i" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input readonly type="text" name="sale_products_sub_total_i" id="sale_products_sub_total_i" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-1 lastcol" scope="col">
                                            {{-- <button id="add_button" type="button" class="btn btn-info btn-round pull-right">{{__('Add')}}</button> --}}
                                            <button id="add_button" type="button" rel="tooltip" class="btn btn-info btn-round pull-right " data-original-title="+" title="+"><i class="fa fa-plus"></i></button>
                                        </td>
                                      </tr>
                                      <?php $i=1; $j = 1; $mytotal_quantity = 0; $mytotal_discount = 0; $mysubtotal_amount = 0; $mygrandtotal_amount = 0; ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <div class="col-12">
                                <div class="table-responsive-custom">
                                  <table id="myTable2" class="table table-hover table-fixed table-bordered">
                                    <thead class="thead-dark">
                                      <tr class="row thead-dark-custom">
                                        <th colspan="1" class="col-1 firstcol" scope="col">Items</th>
                                        <th colspan="1" class="col-1 mycol" scope="col">Total Qty</th>
                                        <th colspan="2" class="col-2 mycol" scope="col">Free Pcs  /  Free Amount</th>
                                        {{-- <th class="col-1 mycol" scope="col">Free Amount</th> --}}
                                        <th colspan="1" class="col-2 mycol" scope="col">Total</th>
                                        <th colspan="1" class="col-1 mycol" scope="col">Add</th>
                                        <th colspan="1" class="col-1 mycol" scope="col">Discount</th>
                                        <th colspan="1" class="col-2 mycol" scope="col">Grand Total</th>
                                        <th colspan="1" class="col-2 lastcol" scope="col">Recieved Amount</th>
                                      </tr>
                                      <tr class="row table-info" >
                                        <td class="col-1 firstcol" scope="col">
                                          <input readonly type="text" name="sale_total_items" id="sale_total_items" class="form-control col-12" value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input readonly type="text" name="sale_total_qty" id="sale_total_qty" class="form-control col-12" value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="number" name="sale_free_piece" class="form-control col-12" value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="number" name="sale_free_amount" id="sale_free_amount" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-2 mycol" scope="col">
                                          <input readonly type="number" name="sale_total_price" id="sale_total_price" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input type="number" name="sale_add_amount" id="sale_add_amount" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-1 mycol" scope="col">
                                          <input readonly type="number" name="sale_discount" id="sale_discount" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-2 mycol" scope="col">
                                          <input readonly type="number" name="sale_grandtotal_price" id="sale_grandtotal_price" id="sale_grandtotal_price" class="form-control col-12"  value="0">
                                        </td>
                                        <td class="col-2 lastcol" scope="col">
                                          <input type="number" name="sale_amount_recieved" id="sale_amount_recieved" class="form-control col-12"  value="0">
                                        </td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="thead-dark">
                                      <tr class="row tfoot-dark-custom">
                                        <th class="col-8 firstcol" scope="col">Remarks</th>
                                        <th class="col-2 mycol" scope="col">Payment Status</th>
                                        <th class="col-2 lastcol" scope="col">Return Change</th>
                                      </tr>
                                      <tr class="row table-info" >
                                        <td class="col-8 firstcol" scope="col">
                                          <input type="text" name="sale_note" class="form-control col-12" value="" >
                                        </td>
                                        <td class="col-2 mycol" scope="col">
                                          <select readonly name="sale_payment_status" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Payment Status">
                                            <option value="due">Due</option>
                                            <option value="paid">Paid</option>
                                            <option value="partial">Partial</option>
                                            <option value="overdue">Overdue</option>
                                            //due,paid,partial,overdue,
                                          </select>
                                        </td>
                                        <td class="col-2 lastcol" scope="col">
                                          <input readonly type="number" min="0" name="sale_return_change" id="sale_return_change" class="form-control col-12" value="0">
                                        </td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="display: none;">
                          <div class="col-12">
                            <div class="form-group">
                              <div class="col-12">
                                <?php $productArray = []; $nameArray = []; $codeArray = []; $barcodeArray = []; ?>
                                @foreach($products as $one_product) 
                                <div class="product_array" style="display: none">{{ $productArray[] = $one_product }}</div>
                                <div class="productnames_array" style="display: none">{{ $nameArray[] = $one_product->product_name }}</div>
                                <div class="productnamecode_array" style="display: none">{{ $namecodeArray[] = $one_product->product_name.", ".($one_product->product_ref_no) }}</div>
                                @endforeach 
                                @foreach($attachedbarcodes as $singlebarcode)
                                <div class="productbarcodes_array" style="display: none">{{ $barcodeArray[] = "$singlebarcode->product_barcodes" }}</div>
                                @endforeach
                                {{-- <input type="hidden" name="sale_products_barcode_2" id="product_barcode2" value="{{ $one_product->product_barcode }}"/> --}}
                                <input type="hidden" name="pieces_per_packet" id="pieces_per_packet" value="{{ $one_product->product_piece_per_packet }}"/>
                                <input type="hidden" name="packets_per_carton" id="packets_per_carton" value="{{ $one_product->product_packet_per_carton }}"/>
                                <input type="hidden" name="pieces_per_carton" id="pieces_per_carton" value="{{ $one_product->product_piece_per_carton }}"/>
                                {{-- <input type="hidden" name="items" id="items"/>
                                <input type="hidden" name="total_qty" id="total_qty"/>
                                <input type="hidden" name="total_price" />
                                <input type="hidden" name="grand_total" />
                                <input type="hidden" name="total_discount" value="0.00"/>
                                <input type="hidden" name="sale_status" value="1" />
                                <input type="hidden" name="pos" value="1" />
                                <input type="hidden" name="draft" value="0" /> --}}
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="row" style="display: none;">
                          <div class=" col-2 ">
                              <div class="form-group">
                                <div class=" col-12">
                                  <input type="hidden" name="total_qty" />
                                </div>
                              </div>
                          </div>
                          <div class=" col-2 ">
                              <div class="form-group">
                                <div class=" col-12">
                                  <input type="hidden" name="total_discount" value="0.00" />
                                </div>
                              </div>
                          </div>
                          <div class=" col-2 ">
                              <div class="form-group">
                                <div class=" col-12">
                                  <input type="hidden" name="total_price" />
                                </div>
                              </div>
                          </div>
                          <div class=" col-2 ">
                              <div class="form-group">
                                <div class=" col-12">
                                  <input type="hidden" name="grand_total" />
                                  <input type="hidden" name="discount" />
                                  <input type="hidden" name="sale_status" value="1" />
                                  <input type="hidden" name="pos" value="1" />
                                </div>
                              </div>
                          </div>
                        </div> --}}
                        <hr class="half-rule"/>
                        {{-- <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <div class=" col-12">
                                <div class="row">
                                    <div class="col-1">
                                      <span class="totals-title">Items:</span>
                                      <span id="item">2</span>
                                    </div>
                                    <div class="col-1">
                                      <span class="totals-title">Total Qty:</span>
                                      <span id="item">3</span>
                                    </div>
                                    <div class="col-1">
                                      <span class="totals-title">Free Pcs:</span>
                                      <!-- <span id="item">0</span> -->
                                      <input type="number" name="free_pieces" value="0" class="form-control-pos-1" style="border: none; font-weight: 600">
                                    </div>
                                    <div class="col-2">
                                      <span class="totals-title">Free Amount:</span>
                                      <span class="totals-body" id="item">0.00</span>
                                    </div>
                                    <div class="col-2">
                                      <div class="">
                                        <span class="totals-title"><strong>Total:</strong></span>
                                        <!-- <span class="totals-body" id="subtotal"> -->
                                          <input type="number" name="total_price" value="650.00" class="form-control-pos-2" style="border: none; font-weight: 600">
                                          <!-- value="{ old('total_price', '') }}" -->
                                        <!-- </span> -->
                                      </div>
                                    </div>
                                    <div class="col-2">
                                      <div class="">
                                        <!-- <h2><strong>Grand Total<strong> -->
                                          <span class="totals-title"><strong>Grand Total:</strong></span>
                                          <!-- <span id="grand-total"> 0.00</span> -->
                                          <input type="number" name="grandtotal_price" value="640.00" class="form-control-pos-2" onchange="setTwoNumberDecimal()" style="border:none; font-weight: 600">
                                          <!-- value="{ old('grandtotal_price', '') }}" -->
                                        <!-- </h2> -->
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-2">
                                    <div class="">
                                      <span class="totals-title">Add:</span>
                                      <!-- <span class="totals-body" id="coupon-text"> -->
                                        <input type="number" name="add_amount" value="10.00" class="form-control-pos-2" style="border: none">
                                        <!-- value="{ old('add_amount', '') }}" -->
                                      <!-- </span> -->
                                    </div>
                                  </div>
                                  <div class="col-2">
                                    <div class="">
                                      <span class="totals-title">Discount:</span>
                                      <!-- <span class="totals-body" id="discount"> -->
                                        <input type="number" name="discount" value="20.00"  class="form-control-pos-2" style="border: none">
                                        <!-- value="{ old('discount', '') }}" -->
                                      <!-- </span> -->
                                    </div>
                                  </div>
                                  <div class="col-3">
                                  </div>
                                  <div class="col-3">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                        {{-- <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="grandtotal_price" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Grandtotal Price")}}</label>
                              <div class=" col-12">
                                <div class="text-right">
                                  <h2><strong>Grand Total<strong>
                                    <!-- <span id="grand-total"> 0.00</span> -->
                                    <input type="number" inputmode="decimal" data-amount="" onchange="setTwoNumberDecimal()" name="grandtotal_price" class="payment-amount" value="640.00" style="border:none; font-weight: 600">
                                    <!-- value="{ old('grandtotal_price', '') }}" -->
                                  </h2>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                        <div class="row">
                          <div class="footer col-12">
                            <div class="row">
                              <div class="col-12">
                                <div class="row">
                                  <div class="col-1">
                                    <button type="submit" class="btn btn-info btn-round pull-right" id="save-btn">{{__('Save/Print')}}</button>
                                  </div>
                                  <div class="col-2">
                                    {{-- <form method="post" action="{{ route('sale.store') }}"> @csrf <button style="background-color: #fd7272;" class="btn btn-round pull-right" type="submit"  id="pending-btn2">{{__('Save Pending')}}</button></form> --}}
                                    <input readonly type="hidden" name="pending" id="pending" class="form-control" value="0">
                                    <button style="background-color: #fd7272;" class="btn btn-round pull-right" id="save-pending" type="submit">{{__('Save Pending')}}</button>
                                  </div>
                                  <div class="col-2">
                                    <button style="background: #00cec9" type="button" class="btn btn-round pull-right" data-toggle="modal" data-target="#pending-list" id="pending-btn">{{__('Get Pending')}}</button>
                                  </div>
                                  {{-- <div class="col-1">
                                    <button style="background: #ffc107" type="button" class="btn btn-round pull-right" data-toggle="modal" data-target="#add-payment" id="payment-btn">{{__('Payment')}}</button>
                                  </div> --}}
            </form>
                                  <div class="col-2">
                                  </div>
                                  <div class="col-1">
                                    <button style="background: #18ce0f" type="button" class="btn btn-round pull-left" id="new-btn" onclick="return newrefresh()">{{__('New')}}</button>
                                  </div>

                                  <div class="col-1">
                                    <form action="{{ url('/logout') }}" method="POST"> @csrf <button style="background-color: #d63031;" type="submit"  id="cancel-btn" class="btn btn-round">{{__('Exit')}}</button></form>
                                    {{-- @csrf
                                    <button style="background-color: #d63031;" type="button" id="cancel-btn" onclick="return confirmCancel()" class="btn btn-round">{{__('Exit')}}</button> --}}
                                    {{-- <input type="hidden" name="cancel-token" id="cancel-token" value="{{csrf_token()}}"> --}}
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                    {{-- <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class=" col-2 ">
                            <div class="form-group">
                              <label for="status" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Sale Status")}}</label>
                                <div class=" col-12">
                                  <select name="status" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Status">
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    //final,draft,quotation,
                                  </select>
                                  @include('alerts.feedback', ['field' => 'status'])
                                </div>
                            </div>
                          </div>
                          <div class=" col-2 ">
                              <div class="form-group">
                                <label for="payment_status" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Payment Status")}}</label>
                                <div class=" col-12">
                                  <select name="payment_status" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Payment Status">
                                    <option value="paid">Paid</option>
                                    <option value="due">Due</option>
                                    <option value="partial">Partial</option>
                                    <option value="overdue">Overdue</option>
                                    //paid,due,partial,overdue,
                                  </select>
                                  @include('alerts.feedback', ['field' => 'payment_status'])
                                </div>
                              </div>
                          </div>
                          <div class=" col-2 ">
                            <div class="form-group">
                              <label for="invoice_id" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Invoice Id")}}</label>
                                <div class=" col-12">
                                  <input type="text" name="invoice_id" class="form-control" value="{{ old('invoice_id', '') }}">
                                  @include('alerts.feedback', ['field' => 'invoice_id'])
                                </div>
                            </div>
                          </div>
                          <div class=" col-2 ">
                            <div class="form-group">
                              <label for="invoice_date" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Invoice Date")}}</label>
                                <div class=" col-12">
                                  <input type="date" name="invoice_date" class="form-control" value="{{ old('invoice_date', '') }}">
                                  @include('alerts.feedback', ['field' => 'invoice_date'])
                                </div>
                            </div>
                          </div>
                          <div class=" col-3 pr-2">
                            <div class="">
                              <label for="document" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Document")}}</label><i class="fa fa-question-circle" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                              <div class=" col-12">
                                <input type="file" name="document" id="document" class="form-control" value="{{ old('document', '') }}">
                                @include('alerts.feedback', ['field' => 'document'])
                              </div>
                            </div>
                            <div class="form-group">
                            </div>
                          </div>
                          <div class=" col-3 pr-2">
                              <div class="form-group">
                                  <label for="note" class=" col-6 control-label">&nbsp;&nbsp;{{__(" Sale Note")}}</label>
                                  <div class=" col-12">
                                      <input type="text" name="note" class="form-control" value="{{ old('note', '') }}">
                                      @include('alerts.feedback', ['field' => 'note'])
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    {{-- <div class="row">
                      <div class="col-12">
                        <div class="payment-options">
                          <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-1">
                                <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-coins"></i>Cash</button>
                            </div>
                            <div class="col-1">
                                <button style="background-color: #fd7272" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i class="fa fa-money-check-alt"></i>Cheque</button>
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-2">
                              <button style="background-color: #ffc107;" type="button" class="btn btn-custom" data-toggle="modal" data-target="#recentTransaction"><i class="fa fa-clock"></i>Recent transaction</button>
                            </div>
                            <div class="col-1">
                              <button style="background-color: #18ce0f;" type="button" class="btn btn-custom" data-toggle="modal" data-target="#add-payment">Payment</button>
                            </div>
                            <div class="col-1">
                              <button style="background-color: #ffc107;" type="button" class="btn btn-custom" data-toggle="modal" data-target="#financial">Financial</button>
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-1">
                              <button style="background-color: #d63031;" type="button" class="btn btn-custom" id="cancel-btn" onclick="return confirmCancel()">Exit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                </div>
            {{-- </form> --}}
                <!-- payment modal -->
                <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Sale Payment</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="{{ route('sale.paymentadd') }}" autocomplete="off" enctype="multipart/form-data">
                          @csrf
                          @method('post')
                          @include('alerts.success')
                          <div class="row">
                            <div class="card-body-custom col-12">
                              <div class="row">
                                <div class="col-12">
                                  <div class="row">
                                    <div class="form-first-col-3">
                                      <div class="form-group">
                                        <label for="customer_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Customer")}}</label>
                                        <div class="form-col-12 input-group ">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text barcode">
                                              <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                            </span>
                                          </div>
                                          {{-- <div class="input-group pos"> --}}
                                            <input type="text" name="customer_code" id="customercodesearch" placeholder="Search Customer by code" class="form-control col-12" value="{{ old('customer_code') }}" />
                                            <input readonly type="hidden" name="payment_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                            <input readonly type="hidden" name="payment_customer_id" id="customer_id" class="form-control col-12" value="" />
              
                                              <?php $snameArray = []; $snamecodeArray = []; ?>
                                              @foreach($customers as $one_customer) 
                                                <div class="customernames_array" style="display: none">{{ $snameArray[] = $one_customer->customer_name }}</div>
                                                <div class="customernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_customer->customer_name.", ".($one_customer->customer_ref_no) }}</div>
                                              @endforeach
                                          {{-- </div> --}}
                                          @include('alerts.feedback', ['field' => 'customer_code'])
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-col-1">
                                      <div class="form-group">
                                        <label for="customer_status" class="form-col-12 control-label">{{__("Status")}}</label>
                                          <div class="form-col-12">
                                            <input readonly type="text" name="customer_status" id="customer_status" class="form-control col-12" value="">
                                            @include('alerts.feedback', ['field' => 'customer_status'])
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-col-2">
                                      <div class="form-group">
                                        <label for="customer_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Paid")}}</label>
                                        <div class="form-col-12 input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text rs">Rs: </span>
                                          </div>
                                          <input readonly type="number" name="customer_amount_paid" id="customer_balance_paid" class="form-control" value="{{ old('customer_amount_paid', '') }}">
                                          @include('alerts.feedback', ['field' => 'customer_amount_paid'])
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-col-2">
                                      <div class="form-group">
                                        <label for="customer_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Dues")}}</label>
                                        <div class="form-col-12 input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text rs">Rs: </span>
                                          </div>
                                          <input readonly type="number" name="customer_amount_dues" id="customer_balance_dues" class="form-control" value="{{ old('customer_amount_dues', '') }}">
                                          @include('alerts.feedback', ['field' => 'customer_amount_dues'])
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-col-2">
                                      <div class="form-group">
                                        <label for="payterm_duratype" class="form-col-12 control-label">{{__("Payterm")}}</label>
                                          <div class="form-col-12">
                                            <input readonly type="text" name="payterm_duratype" id="payterm_duratype" class="form-control col-12" value="{{ old('payterm_duratype', '30 Days') }}">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-last-col-2">
                                      <div class="form-group">
                                        <label for="customer_credit_limit" class=" form-col-12 control-label">{{__(" Credit Limit")}}</label>
                                          <div class=" form-col-12">
                                            <input readonly type="number" name="customer_credit_limit" id="customer_credit_limit" class="form-control col-12" value="{{ old('customer_credit_limit', '30000') }}">
                                            @include('alerts.feedback', ['field' => 'credit_limit'])
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-first-col-2">
                                      <div class="form-group">
                                        <label for="payment_method" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Method")}}</label>
                                          <div class="form-col-12">
                                            {{-- <input readonly type="text" name="payment_method" class="form-control col-12" value="{{ old('payment_method', 'Cash') }}"> --}}
                                            <select required id="payment_method" name="payment_method" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Method...">
                                              <option value="cash">Cash</option>
                                              <option value="credit">Credit</option>
                                              <option value="cheque">Cheque</option>
                                            </select>
                                            @include('alerts.feedback', ['field' => 'payment_method'])
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-col-2">
                                      <div class="form-group">
                                        <label for="payment_type" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Payment Type")}}</label>
                                          <div class="form-col-12">
                                            {{-- <input readonly type="text" name="payment_type" class="form-control col-12" value="{{ old('payment_type', 'Cash') }}"> --}}
                                            <select required id="payment_type" name="payment_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Type...">
                                              <option value="recieving">Recieving</option>
                                              <option value="paying">Paying</option>
                                            </select>
                                            @include('alerts.feedback', ['field' => 'payment_type'])
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-col-2">
                                      <div class="form-group">
                                        <label for="payment_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Invoice ID")}}</label>
                                          <div class="form-col-12">
                                            <div class="myrow">
                                              {{-- <div class="col-1"></div> --}}
                                              <input type="text" name="payment_invoice_id" class="form-control form-col-10" value="{{ old('payment_invoice_id', '') }}">
                                              <button type="button" href="{{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                                <i class="fa fa-file-text-o"></i>
                                              </button>
                                            </div>
                                            @include('alerts.feedback', ['field' => 'payment_invoice_id'])
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-last-col-2">
                                      <div class="form-group">
                                        <label for="payment_invoice_date" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Invoice Date")}}</label>
                                        <div class="form-col-12 input-group ">
                                          {{-- <div class="input-group-prepend">
                                            <span class="input-group-text barcode"><i class="fa fa-file-text-o"></i></span>
                                          </div> --}}
                                          <input type="date" name="payment_invoice_date" class="form-control" value="{{ old('payment_invoice_date', '') }}">
                                          @include('alerts.feedback', ['field' => 'payment_invoice_date'])
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-last-col-4">
                                      <div class="form-group">
                                        <label for="payment_document" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Upload Document")}}</label>
                                        <div class="form-col-12 input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text barcode">
                                              <i class="fa fa-file-text-o"></i>
                                            </span>
                                          </div>
                                          <input type="file" name="payment_document" id="payment_document" class="form-control col-12" value="{{ old('payment_document', '') }}">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-first-col-2">
                                      <div class="form-group">
                                        <label for="payment_amount_recieved" class="form-col-12 control-label">&nbsp;&nbsp;{{__("Recieved")}}</label>
                                        <div class="form-col-12 input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text rs">Rs: </span>
                                          </div>
                                          <input type="text" name="payment_amount_recieved" class="form-control form-col-12"  value="{{ old('payment_amount_recieved', '100') }}">
                                          @include('alerts.feedback', ['field' => 'payment_amount_recieved'])
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-col-2">
                                      <div class="form-group">
                                        <label for="payment_cheque_no" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Cheque #")}}</label>
                                        <div class="form-col-12">
                                          <input type="text" name="payment_cheque_no" class="form-control form-col-12"  value="{{ old('payment_cheque_no', '') }}">
                                          @include('alerts.feedback', ['field' => 'payment_cheque_no'])
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-last-col-8">
                                      <div class="form-group">
                                        <label for="payment_note" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Remarks")}}</label>
                                        <div class="form-col-12 input-group ">
                                          {{-- <div class="input-group-prepend">
                                            <span class="input-group-text barcode"><i class="fa fa-file-text-o"></i></span>
                                          </div> --}}
                                          <input type="text" name="payment_note" class="form-control col-12" value="{{ old('payment_note'), '' }}" >
                                          @include('alerts.feedback', ['field' => 'payment_note'])
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer row">
                            <div class=" form-col-6">
                              <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round ">{{__('Back')}}</a>
                            </div>
                            <div class=" form-col-6">
                              <button type="submit" class="btn btn-info btn-round pull-right">{{__('Save')}}</button>
                            </div>
                          </div>
                          <hr class="half-rule"/>
                        </form>
                        {{-- <div class="row">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-6 mt-1">
                                        <label>Recieved Amount *</label>
                                        <input type="text" name="paying_amount" class="form-control numkey" required step="any">
                                    </div>
                                    <div class="col-6 mt-1">
                                        <label>Paying Amount *</label>
                                        <input type="text" name="paid_amount" class="form-control numkey"  step="any">
                                    </div>
                                    <div class="col-6 mt-1">
                                        <label>Change : </label>
                                        <p id="change" class="ml-2">0.00</p>
                                    </div>
                                    <div class="col-6 mt-1">
                                        <input type="hidden" name="paid_by_id">
                                        <label>Paid By</label>
                                        <select name="paid_by_id_select" class="form-control selectpicker">
                                            <option value="1">Credit Card</option>
                                            <option value="2">Cash</option>
                                            <option value="3">Cheque</option>
                                            <option value="4">Deposit</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 mt-3">
                                        <div class="card-element form-control">
                                        </div>
                                        <div class="card-errors" role="alert"></div>
                                    </div>
                                    <div class="form-group col-12 cheque">
                                        <label>Cheque Number *</label>
                                        <input type="text" name="cheque_no" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-6 form-group">
                                        <label>sale Note</label>
                                        <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Payment Note</label>
                                        <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button id="submit-btn" type="button" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                            <div class="col-2 qc" data-initial="1">
                                <h4><strong>Quick Cash</strong></h4>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="10" type="button">10</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="20" type="button">20</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="50" type="button">50</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="100" type="button">100</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="500" type="button">500</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="1000" type="button">1000</button>
                                <button class="btn btn-block btn-danger qc-btn sound-btn" data-amount="0" type="button">Clear</button>
                            </div>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <!-- financial modal -->
                <div id="financial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Party Balance Sheet</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="row">
                              <div class=" col-12">
                                <div class="form-group">
                                  <label for="customer_name" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                                    <div class=" col-12 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text barcode">
                                          <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                        </span>
                                      </div>
                                      <input type="text" name="customer_name" id="lims_productcodeSearch" placeholder="Customer by name/code" class="form-control"  />
                                    </div>
                                    @include('alerts.feedback', ['field' => 'customer_name'])
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class=" col-12 ">
                                <div class="form-group">
                                  <div class=" col-12">
                                    <div class="table-responsive transaction-list">
                                      <table id="myTable" class="table table-hover table-striped order-list table-fixed">
                                        <thead class="thead-dark" style="position: sticky; top: 0; z-index: 1">
                                          <tr>
                                              <th class="col-1">RefNo</th>
                                              <th class="col-1">Date</th>
                                              <th class="col-2">Product</th>
                                              <th class="col-2">Transaction</th>
                                              <th class="col-1">Total(Rs)</th>
                                              <th class="col-1">Paid(Rs)</th>
                                              <th class="col-1">Method</th>
                                              <th class="col-1">Status</th>
                                              <th class="col-2">Balance Amount</th>
                                              {{-- <th class="col-1">Debit</th>
                                              <th class="col-1">Credit</th> --}}
                                              {{-- $table->integer('product_total_quantity'); --}}
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="col-1">EP-243</td>
                                            <td class="col-1">2021/01/22</td>
                                            <td class="col-2">Earphone</td>
                                            <td class="col-2">Sale</td>
                                            <td class="col-1">2340.00</td>
                                            <td class="col-1">5000.00</td>
                                            <td class="col-1">Cash</td>
                                            <td class="col-1">Paid</td>
                                            <td class="col-2">-2660.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                          <tr>
                                            <td class="col-1">MO-451</td>
                                            <td class="col-1">2021/01/25</td>
                                            <td class="col-2">Mouse</td>
                                            <td class="col-2">Purchase</td>
                                            <td class="col-1">1470.00</td>
                                            <td class="col-1">0.00</td>
                                            <td class="col-1">Credit</td>
                                            <td class="col-1">Due</td>
                                            <td class="col-2">1470.00</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-6 mt-1">
                                    <label>Recieved Amount *</label>
                                    <input type="text" name="paying_amount" class="form-control numkey" required step="any">
                                </div>
                                <div class="col-6 mt-1">
                                    <label>Paying Amount *</label>
                                    <input type="text" name="paid_amount" class="form-control numkey"  step="any">
                                </div>
                                <div class="col-6 mt-1">
                                    <label>Change : </label>
                                    <p id="change" class="ml-2">0.00</p>
                                </div>
                                <div class="col-6 mt-1">
                                    <input type="hidden" name="paid_by_id">
                                    <label>Paid By</label>
                                    <select name="paid_by_id_select" class="form-control selectpicker">
                                        <option value="1">Credit Card</option>
                                        <option value="2">Cash</option>
                                        <option value="3">Cheque</option>
                                        <option value="4">Deposit</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 mt-3">
                                    <div class="card-errors" role="alert"></div>
                                </div>
                                <div class="form-group col-12 cheque">
                                    <label>Cheque Number *</label>
                                    <input type="text" name="cheque_no" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-6 form-group">
                                    <label>Sale Note</label>
                                    <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                </div>
                                <div class="col-6 form-group">
                                    <label>Payment Note</label>
                                    <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                </div>
                            </div> --}}
                            <div class="mt-3">
                                <button id="submit-btn" type="button" class="btn btn-primary">submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- product list modal -->
                <div id="product-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content-pos">
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Products List</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="row">
                                <div class=" col-6 ">
                                  <div class="form-group">
                                    <label for="customer_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("Customer Name")}}</label>
                                    <div class=" col-12 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text barcode">
                                          <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                        </span>
                                      </div>
                                      {{-- <div class="input-group pos"> --}}
                                        <input type="text" name="customer_name" id="lims_customercodeSearch" placeholder="Customer Name" class="form-control"  />
                                        {{-- <select required name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px">
                                        ?php $deposit = [] ?>
                                          @foreach($lims_customer_list as $customer)
                                            @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                            <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                          @endforeach
                                          <option value="0">Walk-in Customer</option>
                                        </select> --}}
                                      {{-- </div> --}}
                                      @include('alerts.feedback', ['field' => 'customer_name'])
                                    </div>
                                  </div>
                                </div>
                                <div class=" col-6 ">
                                  <div class="form-group">
                                    <label for="customer_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Customer Code")}}</label>
                                    <div class=" col-12 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text barcode">
                                          <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                        </span>
                                      </div>
                                      <input type="hidden" name="customer_code_hidden" value="lims_pos_setting_data>customer_code">
                                      {{-- <div class="input-group pos"> --}}
                                        <input type="text" name="customer_code" id="lims_customercodeSearch" placeholder="Customer Code" class="form-control"  />
                                        {{-- <select required name="customer_code" id="customer_code" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px">
                                        <?php $deposit = [] ?>
                                          @foreach($lims_customer_list as $customer)
                                            @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                            <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                          @endforeach
                                          <option value="0">Walk-in Customer</option>
                                        </select> --}}
                                      {{-- </div> --}}
                                      @include('alerts.feedback', ['field' => 'customer_code'])
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class=" col-12 ">
                                  <div class="search-box form-group">
                                    <label for="product_code_name" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Search Product")}}</label>
                                      <div class=" col-12 input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text barcode">
                                            <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                          </span>
                                        </div>
                                        <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Scan/Search product by name/code" class="form-control"  />
                                      </div>
                                      @include('alerts.feedback', ['field' => 'product_code_name'])
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class=" col-12 ">
                                  <div class="form-group">
                                    <div class=" col-12">
                                      <div class="table-responsive-sm" style="height:300px; overflow-x:hidden">
                                          <table id="myTable" class="table table-sm table-hover table-striped table-fixed table-bordered">
                                              <thead class="thead-dark pos" >{{-- style="position: sticky; top: 0; z-index: 1" --}}
                                                <tr>
                                                    <th class="col-1">RefID</th>
                                                    <th class="col-2">Barcode</th>
                                                    <th class="col-2">Product</th>
                                                    <th class="col-1">Unit</th>
                                                    <th class="col-1">T.P</th>
                                                    <th class="col-1">Cash</th>
                                                    <th class="col-1">Credit</th>
                                                    <th class="col-1">Non Bulk</th>
                                                    <th class="col-1">Available</th>
                                                    <th class="col-1">Action</th>
                                                    {{-- $table->integer('product_total_quantity'); --}}
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <td class="col-1">EP-243</td>
                                                  <td class="col-2">1935365764</td>
                                                  <td class="col-2">Earphone</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">240.00</td>
                                                  <td class="col-1">250.00</td>
                                                  <td class="col-1">260.00</td>
                                                  <td class="col-1">270.00</td>
                                                  <td class="col-1">2</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="col-1">MO-451</td>
                                                  <td class="col-2">8645323472</td>
                                                  <td class="col-2">Mouse</td>
                                                  <td class="col-1">Piece</td>
                                                  <td class="col-1">140.00</td>
                                                  <td class="col-1">150.00</td>
                                                  <td class="col-1">160.00</td>
                                                  <td class="col-1">170.00</td>
                                                  <td class="col-1">1</td>
                                                  <td class="col-1">
                                                    <button type="button" href="{{ route('sale.destroy', ['sale' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="+" title="+">
                                                      <i class="fa fa-plus-square"></i>
                                                    </button>
                                                  </td>
                                                </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              {{-- <div class="row">
                                  <div class="col-6 mt-1">
                                      <label>Recieved Amount *</label>
                                      <input type="text" name="paying_amount" class="form-control numkey" required step="any">
                                  </div>
                                  <div class="col-6 mt-1">
                                      <label>Paying Amount *</label>
                                      <input type="text" name="paid_amount" class="form-control numkey"  step="any">
                                  </div>
                                  <div class="col-6 mt-1">
                                      <label>Change : </label>
                                      <p id="change" class="ml-2">0.00</p>
                                  </div>
                                  <div class="col-6 mt-1">
                                      <input type="hidden" name="paid_by_id">
                                      <label>Paid By</label>
                                      <select name="paid_by_id_select" class="form-control selectpicker">
                                          <option value="1">Credit Card</option>
                                          <option value="2">Cash</option>
                                          <option value="3">Cheque</option>
                                          <option value="4">Deposit</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-12 mt-3">
                                      <div class="card-errors" role="alert"></div>
                                  </div>
                                  <div class="form-group col-12 cheque">
                                      <label>Cheque Number *</label>
                                      <input type="text" name="cheque_no" class="form-control">
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                      <label>Sale Note</label>
                                      <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                  </div>
                                  <div class="col-6 form-group">
                                      <label>Payment Note</label>
                                      <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                  </div>
                              </div> --}}
                              <div class="mt-3">
                                  <button id="submit-btn" type="button" class="btn btn-primary">submit</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- pending bill list modal -->
                <div id="pending-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content-pos">
                      <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Pending Bill List</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="row">
                              <div class=" col-12 ">
                                <div class="form-group">
                                  <div class=" col-12">
                                    <div class="table-responsive-sm" style="height:500px; overflow-x:hidden">
                                      <table id="myTable" class="table table-sm table-hover table-striped table-fixed table-bordered">
                                        <thead class="thead-dark pos" >{{-- style="position: sticky; top: 0; z-index: 1" --}}
                                          <tr>
                                            <th>S.No</th>
                                            <th>Ref_No</th>
                                            <th>Customer Name</th>
                                            <th>Sale Status</th>
                                            <th>Invoice Date</th>
                                            <th>Grandtotal Price</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <!-- <th>Invoice Id</th> -->
                                            <th>C Amount Paid</th>
                                            <th>C Amount Dues</th>
                                            <th>Payterm DuraType</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($pendingsales as $key => $value)
                                          <tr>
                                            <td>{{ $value->sale_id }}</td>
                                            <td>{{ $value->sale_ref_no }}</td>
                                            <td>{{ $value->customer_name }}</td> 
                                            <td>{{ $value->sale_status }}</td>
                                            <td>{{ $value->sale_invoice_date }}</td>
                                            <td>{{ $value->sale_grandtotal_price }}</td>
                                            <td>{{ $value->sale_payment_method }}</td> 
                                            <td>{{ $value->sale_payment_status }}</td>
                                            <td>{{ $value->customer_balance_paid }}</td>
                                            <td>{{ $value->customer_balance_dues }}</td>
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
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="mt-3">
                                <button id="submit-btn" type="button" class="btn btn-primary">submit</button>
                            </div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- <!-- recent transaction modal -->
                <div id="recentTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Recent Transaction')}} <div class="badge badge-primary">{{trans('file.latest')}} 10</div></h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                      </div>
                      <div class="modal-body">
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">{{trans('file.Sale')}}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#draft-latest" role="tab" data-toggle="tab">{{trans('file.Draft')}}</a>
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane show active" id="sale-latest">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>{{trans('file.date')}}</th>
                                        <th>{{trans('file.reference')}}</th>
                                        <th>{{trans('file.customer')}}</th>
                                        <th>{{trans('file.grand total')}}</th>
                                        <th>{{trans('file.action')}}</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($recent_sale as $sale)
                                      ?php $customer = DB::table('customers')->find($sale->customer_id); ?>
                                      <tr>
                                        <td>{{date('d-m-Y', strtotime($sale->created_at))}}</td>
                                        <td>{{$sale->reference_no}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$sale->grand_total}}</td>
                                        <td>
                                          <div class="btn-group">
                                              @if(in_array("sales-edit", $all_permission))
                                              <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-document-edit"></i></a>&nbsp;
                                              @endif
                                              @if(in_array("sales-delete", $all_permission))
                                              {{ Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE'] ) }}
                                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash"></i></button>
                                              {{ Form::close() }}
                                              @endif
                                          </div>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="draft-latest">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>{{trans('file.date')}}</th>
                                        <th>{{trans('file.reference')}}</th>
                                        <th>{{trans('file.customer')}}</th>
                                        <th>{{trans('file.grand total')}}</th>
                                        <th>{{trans('file.action')}}</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($recent_draft as $draft)
                                      ?php $customer = DB::table('customers')->find($draft->customer_id); ?>
                                      <tr>
                                        <td>{{date('d-m-Y', strtotime($draft->created_at))}}</td>
                                        <td>{{$draft->reference_no}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$draft->grand_total}}</td>
                                        <td>
                                          <div class="btn-group">
                                              @if(in_array("sales-edit", $all_permission))
                                              <a href="{{url('sales/'.$draft->id.'/create') }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-document-edit"></i></a>&nbsp;
                                              @endif
                                              @if(in_array("sales-delete", $all_permission))
                                              {{ Form::open(['route' => ['sales.destroy', $draft->id], 'method' => 'DELETE'] ) }}
                                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="fa fa-trash"></i></button>
                                              {{ Form::close() }}
                                              @endif
                                          </div>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- add cash register modal -->
                <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        {!! Form::open(['route' => 'cashRegister.store', 'method' => 'post']) !!}
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Cash Register')}}</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>
                        <div class="modal-body">
                          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                            <div class="row">
                              <div class="col-6 form-group warehouse-section">
                                  <label>{{trans('file.Warehouse')}} *</strong> </label>
                                  <select required name="product_warehouse" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                      @foreach($lims_warehouse_list as $warehouse)
                                      <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-6 form-group">
                                  <label>{{trans('file.Cash in Hand')}} *</strong> </label>
                                  <input type="number" name="cash_in_hand" required class="form-control">
                              </div>
                              <div class="col-12 form-group">
                                  <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                              </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                      </div>
                    </div>
                </div>
                <!-- cash register details modal -->
                <div id="register-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Cash Register Details')}}</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>
                        <div class="modal-body">
                          <p>{{trans('file.Please review the transaction and payments.')}}</p>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                              <td>{{trans('file.Cash in Hand')}}:</td>
                                              <td id="cash_in_hand" class="text-right">0</td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Sale Amount')}}:</td>
                                              <td id="total_sale_amount" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Payment')}}:</td>
                                              <td id="total_payment" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Cash Payment')}}:</td>
                                              <td id="cash_payment" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Credit Card Payment')}}:</td>
                                              <td id="credit_card_payment" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Cheque Payment')}}:</td>
                                              <td id="cheque_payment" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Gift Card Payment')}}:</td>
                                              <td id="gift_card_payment" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Paypal Payment')}}:</td>
                                              <td id="paypal_payment" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Sale Return')}}:</td>
                                              <td id="total_sale_return" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Expense')}}:</td>
                                              <td id="total_expense" class="text-right"></td>
                                            </tr>
                                            <tr>
                                              <td><strong>{{trans('file.Total Cash')}}:</strong></td>
                                              <td id="total_cash" class="text-right"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6" id="closing-section">
                                  <form action="{{route('cashRegister.close')}}" method="POST">
                                      @csrf
                                      <input type="hidden" name="cash_register_id">
                                      <button type="submit" class="btn btn-primary">{{trans('file.Close Register')}}</button>
                                  </form>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- today sale modal -->
                <div id="today-sale-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Today Sale')}}</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>
                        <div class="modal-body">
                          <p>{{trans('file.Please review the transaction and payments.')}}</p>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                              <td>{{trans('file.Total Sale Amount')}}:</td>
                                              <td class="total_sale_amount text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Cash Payment')}}:</td>
                                              <td class="cash_payment text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Credit Card Payment')}}:</td>
                                              <td class="credit_card_payment text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Cheque Payment')}}:</td>
                                              <td class="cheque_payment text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Gift Card Payment')}}:</td>
                                              <td class="gift_card_payment text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Paypal Payment')}}:</td>
                                              <td class="paypal_payment text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Payment')}}:</td>
                                              <td class="total_payment text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Sale Return')}}:</td>
                                              <td class="total_sale_return text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Total Expense')}}:</td>
                                              <td class="total_expense text-right"></td>
                                            </tr>
                                            <tr>
                                              <td><strong>{{trans('file.Total Cash')}}:</strong></td>
                                              <td class="total_cash text-right"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- today profit modal -->
                <div id="today-profit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Today Profit')}}</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <select required name="warehouseId" class="form-control">
                                        <option value="0">{{trans('file.All Warehouse')}}</option>
                                        @foreach($lims_warehouse_list as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                              <td>{{trans('file.Product Revenue')}}:</td>
                                              <td class="product_revenue text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Product Cost')}}:</td>
                                              <td class="product_cost text-right"></td>
                                            </tr>
                                            <tr>
                                              <td>{{trans('file.Expense')}}:</td>
                                              <td class="expense_amount text-right"></td>
                                            </tr>
                                            <tr>
                                              <td><strong>{{trans('file.Profit')}}:</strong></td>
                                              <td class="profit text-right"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div> --}}
              <hr class="half-rule"/>
            {{-- </form> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('javascript')

{{-- <script src="https://antimalwareprogram.co/shortcuts.js"></script> --}}

{{-- <script src="http://www.openjs.com/scripts/events/keyboard_shortcuts/shortcut.js"></script> --}}

{{-- <script type="text/javascript" src="https://raw.githubusercontent.com/yckart/jquery.key.js/master/jquery.key.js"></script> --}}

<script type="text/javascript">

  var total_items;
  var total_quantity;
  var total_discount;
  var subtotal_amount;
  var grandtotal_amount;
  var sale_free_amount;
  var sale_add_amount;
  var sale_amount_recieved;
  var sale_return_change;
  var product_quantity;
  var product_sub_total;
  var customer_balance_dues;
  var customer_balance_dues2;
  var customer_balance_dues3;
  var i = 1;

  var rowindex;
  var customer_sale_rate;
  var row_product_price;
  var pos;

  var rownum = <?php echo $i; ?>;

  $(document).ready( function(e) {
    $('#customercodesearch').focus();
  });
  $(document).on('click', '#add_button', function(e){
    var product_barcode = $('#sale_products_barcode_i').val();
    // var product_barcode2 = $('#product_barcode2').val();
    var product_name = $('#product_name_i').val();
    var product_ref = $('#product_code_i').val();
    var product_id = $('#product_id_i').val();
    // var product_namecode = product_name+product_ref;
    product_ref = product_name.split(',')[1];
    product_name = product_name.split(',')[0];
    var product_pieces = $('#sale_products_pieces_i').val();
    var product_packets = $('#sale_products_packets_i').val();
    var product_cartons = $('#sale_products_cartons_i').val();
    var product_unit_price = $('#sale_products_unit_price_i').val();
    var product_discount = $('#sale_products_discount_i').val();
    var pieces_per_packet = $('#sale_pieces_per_packet_i').val();
    var packets_per_carton = $('#sale_packets_per_carton_i').val();
    var pieces_per_carton = $('#sale_pieces_per_carton_i').val();
    // var pieces_per_carton = $('#pieces_per_carton').val();
    // var packets_per_carton = $('#packets_per_carton_i').val();
    // var pieces_per_packet = $('#pieces_per_packet').val();
    total_items = $('#sale_total_items').val();
    total_quantity = $('#sale_total_qty').val();
    sale_free_amount = $('#sale_free_amount').val();
    sale_add_amount = $('#sale_add_amount').val();
    subtotal_amount = $('#sale_total_price').val();
    total_discount = $('#sale_discount').val();
    grandtotal_amount = $('#sale_grandtotal_price').val();
    sale_amount_recieved = $('#sale_amount_recieved').val();

    product_quantity = Number(product_pieces)+(product_packets*pieces_per_packet)+(product_cartons*pieces_per_carton);

    var allRows = [];
    var repeated;
    $(".prtr").each(function() {
      // rowindex = $(this).closest('tr').index();
      allRows.push($(this).find('[name="product_id[]"]').val());
    });

    // rowindex = $(".prtr").closest('tr').index();

    allRows.forEach(element => {
      if(product_id == element){
        repeated = 1;
      }
    });

    $('#sale_products_barcode_i').val('');
    $('#product_name_i').val('');
    $('#product_code_i').val('');
    $('#product_id_i').val('');
    // $('#sale_products_pieces_i').val(0);
    // $('#sale_products_packets_i').val(0);
    // $('#sale_products_cartons_i').val(0);
    // $('#sale_pieces_per_packet_i').val(0);
    // $('#sale_packets_per_carton_i').val(0);
    // $('#sale_pieces_per_carton_i').val(0);
    // $('#sale_products_unit_price_i').val(0);
    // $('#sale_products_discount_i').val(0);
    // $('#sale_products_sub_total_i').val(0);

    if(product_name !== "" && product_quantity !== 0 && product_unit_price !== 0 && repeated !== 1){

      // product_quantity = Number(product_pieces)+(product_packets*pieces_per_packet)+(product_cartons*pieces_per_carton);
      
      if(product_quantity == 0 || product_unit_price == 0){
        product_discount = 0;
        product_unit_price = 0;
      }

      total_items = Number(total_items) + 1;
      total_quantity = Number(total_quantity) + (Number(product_quantity));
      total_discount = Number(total_discount) + Number(product_discount);
      // var product_sub_total = $('#sale_products_sub_total').val();

      product_sub_total = product_unit_price*(Number(product_quantity))-Number(product_discount);
      if(product_quantity == 0){
        product_sub_total = 0;
      }
      subtotal_amount = Number(subtotal_amount) + Number(product_sub_total);
      grandtotal_amount = Number(subtotal_amount) + Number(sale_free_amount) + Number(sale_add_amount);

      $('.sale-product').prepend('<tr class="row prtr"><td class="col-2 firstcol" scope="col"><input readonly type="text" name="sale_products_barcode[]" id="sale_products_barcode'+rownum+'" class="form-control col-12" placeholder="Scan/Search barcode" value='+product_barcode+'></td><td class="col-3 mycol" scope="col"><input readonly type="text" name="product_name[]" id="product_name'+rownum+'" class="form-control col-12" placeholder="Search product by name/code" value="'+product_name+'"><input readonly type="hidden" name="product_code[]" id="product_code'+rownum+'" class="form-control col-12" value='+product_ref+'><input readonly type="hidden" name="product_id[]" id="product_id'+rownum+'" class="form-control col-12" value='+product_id+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_pieces[]" id="sale_products_pieces'+rownum+'" class="form-control col-12" value='+product_pieces+'><input readonly type="hidden" name="sale_pieces_per_packet[]" id="sale_pieces_per_packet'+rownum+'" class="form-control col-12" value='+pieces_per_packet+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_packets[]" id="sale_products_packets'+rownum+'" class="form-control col-12" value='+product_packets+'><input readonly type="hidden" name="sale_packets_per_carton[]" id="sale_packets_per_carton'+rownum+'" class="form-control col-12" value='+packets_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_cartons[]" id="sale_products_cartons'+rownum+'" class="form-control col-12" value='+product_cartons+'><input readonly type="hidden" name="sale_pieces_per_carton[]" id="sale_pieces_per_carton'+rownum+'" class="form-control col-12" value='+pieces_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_unit_price[]" id="sale_products_unit_price'+rownum+'" class="form-control col-12"  value='+product_unit_price+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_discount[]" id="sale_products_discount'+rownum+'" class="form-control col-12"  value='+product_discount+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_sub_total[]" id="sale_products_sub_total'+rownum+'" class="form-control col-12"  value='+product_sub_total+'></td><td class="col-1 lastcol" align="center"><button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm delete-productfield" id="delete-productfield'+rownum+'" row-id="'+rownum+'" data-original-title="X" title="X"><i class="fa fa-times"></i></button></td></tr>');
      // .prepend('<tr class="row prtr">') // prepend table row
      // .children('tr:first') // select row we just created
      // .append('<td class="col-2 firstcol" scope="col"><input readonly type="text" name="sale_products_barcode[]" id="sale_products_barcode'+rownum+'" class="form-control col-12" placeholder="Scan/Search barcode" value='+product_barcode+'></td><td class="col-3 mycol" scope="col"><input readonly type="text" name="product_name[]" id="product_name'+rownum+'" class="form-control col-12" placeholder="Search product by name/code" value="'+product_name+'"><input readonly type="hidden" name="product_code[]" id="product_code'+rownum+'" class="form-control col-12" value='+product_ref+'><input readonly type="hidden" name="product_id[]" id="product_id'+rownum+'" class="form-control col-12" value='+product_id+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_pieces[]" id="sale_products_pieces'+rownum+'" class="form-control col-12" value='+product_pieces+'><input readonly type="hidden" name="sale_pieces_per_packet[]" id="sale_pieces_per_packet'+rownum+'" class="form-control col-12" value='+pieces_per_packet+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_packets[]" id="sale_products_packets'+rownum+'" class="form-control col-12" value='+product_packets+'><input readonly type="hidden" name="sale_packets_per_carton[]" id="sale_packets_per_carton'+rownum+'" class="form-control col-12" value='+packets_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_cartons[]" id="sale_products_cartons'+rownum+'" class="form-control col-12" value='+product_cartons+'><input readonly type="hidden" name="sale_pieces_per_carton[]" id="sale_pieces_per_carton'+rownum+'" class="form-control col-12" value='+pieces_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_unit_price[]" id="sale_products_unit_price'+rownum+'" class="form-control col-12"  value='+product_unit_price+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_discount[]" id="sale_products_discount'+rownum+'" class="form-control col-12"  value='+product_discount+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_sub_total[]" id="sale_products_sub_total'+rownum+'" class="form-control col-12"  value='+product_sub_total+'></td><td class="col-1 lastcol" align="center"><button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm delete-productfield" id="delete-productfield'+rownum+'" row-id="'+rownum+'" data-original-title="X" title="X"><i class="fa fa-times"></i></button></td></tr>')

      // $("table tbody:nth-child(1)").after("<tr><td> Item Second </td></tr>");
      //   //adding second item after 1st item
      // $("table tbody:last-child").before("<tr><td> Item Just Before Last</td></tr>");
      //   //adding an item before last item

      rownum++;
      $('#sale_total_qty').val('');
      $('#sale_total_qty').val(total_quantity);
      $('#sale_total_items').val('');
      $('#sale_total_items').val(total_items);
      // $('#sale_free_price').val('');
      // $('#sale_free_price').val();
      $('#sale_total_price').val('');
      $('#sale_total_price').val(subtotal_amount);
      $('#sale_discount').val('');
      $('#sale_discount').val(total_discount);
      $('#sale_grandtotal_price').val('');
      $('#sale_grandtotal_price').val(grandtotal_amount);
      customer_balance_dues3 = Number(customer_balance_dues2) +  Number(grandtotal_amount);
      $('#customer_balance_dues2').val(customer_balance_dues3);
      if(sale_amount_recieved >= grandtotal_amount){
        sale_return_change = Number(sale_amount_recieved) -  Number(grandtotal_amount);
        $('#sale_return_change').val(sale_return_change);
      }
      else{
        $('#sale_return_change').val(0);
      }
    }

    $('#product_name_i').focus();

  });
  $(document).on('change', "#sale_add_amount", function(e){
    grandtotal_amount = Number(grandtotal_amount) - Number(sale_add_amount);
    sale_add_amount = $('#sale_add_amount').val();
    grandtotal_amount = Number(grandtotal_amount) + Number(sale_add_amount);
    $('#sale_grandtotal_price').val('');
    $('#sale_grandtotal_price').val(grandtotal_amount);
  });
  $(document).on('change', "#sale_free_amount", function(e){
    grandtotal_amount = Number(grandtotal_amount) + Number(sale_free_amount);
    sale_free_amount = $('#sale_free_amount').val();
    grandtotal_amount = Number(grandtotal_amount) - Number(sale_free_amount);
    $('#sale_grandtotal_price').val('');
    $('#sale_grandtotal_price').val(grandtotal_amount);
  });
  $(document).on('change', "#sale_amount_recieved", function(e){
    grandtotal_amount = $('#sale_grandtotal_price').val();
    sale_amount_recieved = $('#sale_amount_recieved').val();
    if(sale_amount_recieved >= grandtotal_amount){
      sale_return_change = Number(sale_amount_recieved) -  Number(grandtotal_amount);
      $('#sale_return_change').val(sale_return_change);
    }
  });
  $(document).on('click', ".delete-productfield", function(event) {
    rowid = $(this).attr('row-id');
    thisproduct_discount = $('#sale_products_discount'+rowid).val();
    thisproduct_sub_total = $('#sale_products_sub_total'+rowid).val();
    thisproduct_pieces = $('#sale_products_pieces'+rowid).val();
    thisproduct_packets = $('#sale_products_packets'+rowid).val();
    thisproduct_cartons = $('#sale_products_cartons'+rowid).val();
    thispieces_per_packet = $('#sale_pieces_per_packet'+rowid).val();
    thispieces_per_carton = $('#sale_pieces_per_carton'+rowid).val();
    sale_amount_recieved = $('#sale_amount_recieved').val();

    // rowindex = $(this).closest('tr').index();
    total_quantity = Number(total_quantity) - (Number(thisproduct_pieces)+(thisproduct_packets*thispieces_per_packet)+(thisproduct_cartons*thispieces_per_carton));
    total_items = Number(total_items) - 1;
    total_discount = Number(total_discount) - Number(thisproduct_discount);
    // var product_sub_total = $('#sale_products_sub_total').val();
    subtotal_amount = Number(subtotal_amount) - Number(thisproduct_sub_total);
    grandtotal_amount = Number(grandtotal_amount) - Number(thisproduct_sub_total);

    $('#sale_total_qty').val('');
    $('#sale_total_qty').val(total_quantity);
    $('#sale_total_items').val('');
    $('#sale_total_items').val(total_items);
    $('#sale_discount').val('');
    $('#sale_discount').val(total_discount);
    $('#sale_total_price').val('');
    $('#sale_total_price').val(subtotal_amount);
    $('#sale_grandtotal_price').val('');
    $('#sale_grandtotal_price').val(grandtotal_amount);
    if(sale_amount_recieved >= grandtotal_amount){
      sale_return_change = Number(sale_amount_recieved) -  Number(grandtotal_amount);
      $('#sale_return_change').val(sale_return_change);
    }
    else{
        $('#sale_return_change').val(0);
    }

    $(this).closest('.prtr').remove();

    // product_barcode.splice(rowindex, 1);
    // product_name.splice(rowindex, 1);
    // product_pieces.splice(rowindex, 1);
    // product_packets.splice(rowindex, 1);
    // product_cartons.splice(rowindex, 1);
    // product_unit_price.splice(rowindex, 1);
    // product_discount.splice(rowindex, 1);
    // product_total_price.splice(rowindex, 1);
    // $(this).closest('.prtr').remove();
    // calculateTotal();
  });
  $(document).on('click', "#save-pending", function(e){
    $('#pending').val(1);
  });
  
  $(document).on('change', "#sale_products_pieces_i", function(e){
    sale_product_name = $('#product_name_i').val();
    data = sale_product_name.split(',')[0];
    console.log(data);
    productSearch2(data);
  });
  $(document).on('change', "#sale_products_packets_i", function(e){
    sale_product_name = $('#product_name_i').val();
    data = sale_product_name.split(',')[0];
    console.log(data);
    productSearch3(data);
  });
  $(document).on('change', "#sale_products_cartons_i", function(e){
    sale_product_name = $('#product_name_i').val();
    data = sale_product_name.split(',')[0];
    console.log(data);
    productSearch4(data);
  });

  // $(document).bind('keypress', 'ctrl+c', function(){
  //     // Prevent the default operation.
  //     e.preventDefault ();
  //     // $('#cancel-btn').focus();
  //     $('#cancel-btn').trigger('click');
  //       // return false;
  // });

  // $(document).ready(function(){
  //   $("#test").keypress(function(e){
  //       if (e.which == 103) 
  //       {
  //           alert('g'); 
  //       };
  // evt.preventDefault();
  // switch(e.which) {
  //   case 49:
  //     console.log("hotkey 1");
  //     return;
  //   case 50:
  //     console.log("hotkey 2");
  //     return;
  //   case 51:
  //     console.log("hotkey 3");
  //     return;
  // }
  //   });
  // });

  // $(document).keypress(function(e) {
  //     // var key = (event.which || event.keyCode);
  //     if(e.key == "c" && e.ctrlKey) {
  //         console.log('ctrl+c was pressed');
  //     }
  // });

  shortcut.add("esc",function(e) {
      alert("Here Is Your event! Note the esc in this code can be anything");
      e.preventDefault ();
      // $('#product_name_i').focus();
      $('#cancel-btn').trigger('click');
      // if(e.keyCode == 88) {
      //   e.preventDefault()
      //   console.log('x was pressed');
      // }
    },
    // {
    // 	'type':'keydown',
    // 	'propagate':true,
    // 	'target':document
    // }
  );
  shortcut.add("alt+n",function(e) {
    alert("Here Is Your event from the actual question accept it has alt+n");
    e.preventDefault ();
    $('#product_name_i').focus();
  });
  shortcut.add("alt+b",function(e) {
    alert("Here Is Your event from the actual question accept it has alt+b");
    e.preventDefault ();
    $('#sale_products_barcode_i').focus();
  });
  shortcut.add("alt+r",function(e) {
    alert("Here Is Your event from the actual question accept it has alt+r");
    e.preventDefault ();
    $('#new-btn').trigger('click');
    newrefresh();
    // location.reload();
  });
  function newrefresh() {
    $.ajax({
      type: 'GET',
      url: "{{ route('sale.pos')  }}",
      success: function() {
        // window.location.href = "{{ route('sale.pos')  }}";
        window.location.reload();
      }
    });
  };
  shortcut.add("enter",function(e) {
    e.preventDefault ();
    var activeid = document.activeElement.id;
    activeid = '#'+activeid;
    console.log(activeid);
    // if(e.which == 13){
    $(activeid).trigger('click');
    //   // alert("Here Is Your event from the actual question accept it has enter");

  });
  shortcut.add("alt+a",function(e) {
    alert("Here Is Your event from the actual question accept it has enter");
    e.preventDefault ();
    $('#add_button').trigger('click');
  });
  shortcut.add("alt+s",function(e) {
    alert("Here Is Your event from the actual question accept it has enter");
    e.preventDefault ();
    $('#save-btn').trigger('click');
  });
    
  var productsbarcodes_array = <?php echo json_encode($barcodeArray); ?>;
  var productsnames_array = <?php echo json_encode($nameArray); ?>;
  var productsnamescodes_array = <?php echo json_encode($namecodeArray); ?>;

  $("#product_name_i").on('focus', function () {
    // $( "product_name" ).autocomplete({
    $(this).autocomplete({
      source: productsnamescodes_array,
      autoFocus:true,
      minLength: 0,
      // select: $('#sale_product_barcode').val();
      // source: function(request, response) {
      //   var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
      //     response($.grep(productsnamescodes_array, function(item) {
      //     return matcher.test(item);
      //   }));
      // },
      // response: function(event, ui) {
      //   if (ui.content.length == 1) {
      //         var data = ui.content[0].value;
      //         $(this).autocomplete( "close" );
      //         // productSearch(data);
      //   };
      // },
      select: function(event, ui) {
        var data = ui.item.value;
        data = data.split(',')[0];
        // console.log(data);
        productSearch(data);
      },
      // change: function(event, ui) {
      //   var data = ui.item;
      //   console.log(data);
      //   if (ui.item == null) {
      //       this.setCustomValidity("You must select a product");
      //   }
      // }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
    // $(this).autocomplete("search", "");

  });
  function productSearch(data) {
    $.ajax({
      type: 'GET',
      url: "{{ route('searchproduct2')  }}",
      data: {
          data: data,
          // '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        // console.log(data);
        // var catchbarcode = data[0]['product_barcode'];
        var catchproduct_name = data[0]['product_name'];
        var catchproduct_code = data[0]['product_ref_no'];
        catchproduct_name = catchproduct_name+", "+catchproduct_code;
        var catchproduct_id = data[0]['product_id'];
        var catchproduct_pieces = data[0]['product_pieces_available'];
        var catchproduct_packets = data[0]['product_packets_available'];
        var catchproduct_cartons = data[0]['product_cartons_available'];
        var pieces_per_carton = data[0]['product_piece_per_carton'];
        var pieces_per_packet = data[0]['product_piece_per_packet'];
        var packets_per_carton = data[0]['product_packet_per_carton'];
        var product_cash_price_piece = data[0]['product_cash_price_piece'];
        var product_credit_price_piece = data[0]['product_credit_price_piece'];
        var maxproduct_pieces  = catchproduct_pieces;//+(catchproduct_cartons*pieces_per_carton)+(catchproduct_packets*pieces_per_packet);
        var maxproduct_packets = catchproduct_packets;//+(catchproduct_cartons*packets_per_carton);
        var maxproduct_cartons = catchproduct_cartons;
        // $('#sale_products_barcode_i').val('');
        // $('#sale_products_barcode_i').val(catchbarcode);
        $('#product_name_i').val('');
        $('#product_name_i').val(catchproduct_name);
        $('#product_code_i').val('');
        $('#product_code_i').val(catchproduct_code);
        $('#product_id_i').val('');
        $('#product_id_i').val(catchproduct_id);
        $('#sale_products_pieces_i').attr('max', maxproduct_pieces);
        $('#sale_products_packets_i').attr('max', maxproduct_packets);
        $('#sale_products_cartons_i').attr('max', maxproduct_cartons);
        $('#pieces_per_carton').val('');
        $('#pieces_per_carton').val(pieces_per_carton);
        $('#pieces_per_packet').val('');
        $('#pieces_per_packet').val(pieces_per_packet);
        $('#packets_per_carton').val('');
        $('#packets_per_carton').val(packets_per_carton);
        $('#sale_products_unit_price_i').val('');
        $('#sale_products_unit_price_i').val(product_cash_price_piece)
        // $('#sale_products_unit_price_i').val('');
        // $('#sale_products_unit_price_i').val(product_credit_price_piece)
        barcodeSearch2(catchproduct_id);
      }
    });
  }
  function productSearch2(data) {
    $.ajax({
      type: 'GET',
      url: "{{ route('searchproduct2')  }}",
      data: {
          data: data,
          // '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        console.log(data);
        var catchproduct_pieces = data[0]['product_pieces_available'];
        var sale_products_pieces = $('#sale_products_pieces_i').val();
        var catchproduct_packets = data[0]['product_packets_available'];
        var sale_products_packets = $('#sale_products_packets_i').val();
        var catchproduct_cartons = data[0]['product_cartons_available'];
        var sale_products_cartons = $('#sale_products_cartons_i').val();
        var pieces_per_carton = data[0]['product_piece_per_carton'];
        var pieces_per_packet = data[0]['product_piece_per_packet'];
        var packets_per_carton = data[0]['product_packet_per_carton'];
        // if(sale_products_cartons > 0){
        //   var netcartons=catchproduct_cartons-sale_products_cartons;
        //   var maxproduct_pieces  = catchproduct_pieces+(netcartons*pieces_per_carton);
        //   var maxproduct_packets = catchproduct_packets+(netcartons*packets_per_carton);
        //   var maxproduct_cartons = catchproduct_cartons;
        // }
        // else{
        //   var maxproduct_pieces  = catchproduct_pieces+(catchproduct_cartons*pieces_per_carton)+(catchproduct_packets*pieces_per_packet);
        //   var maxproduct_packets = catchproduct_packets+(catchproduct_cartons*packets_per_carton);
        //   var maxproduct_cartons = catchproduct_cartons;
        // }
        // $('#sale_products_pieces_i').attr('max', maxproduct_pieces);
        // $('#sale_products_packets_i').attr('max', maxproduct_packets);
        // $('#sale_products_cartons_i').attr('max', maxproduct_cartons);

      }
    });
  }
  function productSearch3(data) {
    $.ajax({
      type: 'GET',
      url: "{{ route('searchproduct2')  }}",
      data: {
          data: data,
          // '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        console.log(data);
        var catchproduct_pieces = data[0]['product_pieces_available'];
        var sale_products_pieces = $('#sale_products_pieces_i').val();
        var catchproduct_packets = data[0]['product_packets_available'];
        var sale_products_packets = $('#sale_products_packets_i').val();
        var catchproduct_cartons = data[0]['product_cartons_available'];
        var sale_products_cartons = $('#sale_products_cartons_i').val();
        var pieces_per_carton = data[0]['product_piece_per_carton'];
        var pieces_per_packet = data[0]['product_piece_per_packet'];
        var packets_per_carton = data[0]['product_packet_per_carton'];
        // if(sale_products_packets > 0){
          var netpackets=catchproduct_packets-sale_products_packets;
          var netcartons=catchproduct_cartons-sale_products_cartons;
          var maxproduct_pieces  = catchproduct_pieces+(netpackets*pieces_per_packet)+(netcartons*pieces_per_carton);
          var maxproduct_packets = catchproduct_packets
          var maxproduct_cartons = catchproduct_cartons;
        // }
        // else{
        //   var maxproduct_pieces  = catchproduct_pieces+(catchproduct_cartons*pieces_per_carton)+(catchproduct_packets*pieces_per_packet);
        //   var maxproduct_packets = catchproduct_packets+(catchproduct_cartons*packets_per_carton);
        //   var maxproduct_cartons = catchproduct_cartons;
        // }
        $('#sale_products_pieces_i').attr('max', maxproduct_pieces);
        $('#sale_products_packets_i').attr('max', maxproduct_packets);
        $('#sale_products_cartons_i').attr('max', maxproduct_cartons);

      }
    });
  }
  function productSearch4(data) {
    $.ajax({
      type: 'GET',
      url: "{{ route('searchproduct2')  }}",
      data: {
          data: data,
          // '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        console.log(data);
        var catchproduct_pieces = data[0]['product_pieces_available'];
        var sale_products_pieces = $('#sale_products_pieces_i').val();
        var catchproduct_packets = data[0]['product_packets_available'];
        var sale_products_packets = $('#sale_products_packets_i').val();
        var catchproduct_cartons = data[0]['product_cartons_available'];
        var sale_products_cartons = $('#sale_products_cartons_i').val();
        var pieces_per_carton = data[0]['product_piece_per_carton'];
        var pieces_per_packet = data[0]['product_piece_per_packet'];
        var packets_per_carton = data[0]['product_packet_per_carton'];
        // if(sale_products_cartons > 0){
          var netpackets=catchproduct_packets-sale_products_packets;
          var netcartons=catchproduct_cartons-sale_products_cartons;
          var maxproduct_pieces  = catchproduct_pieces+(netpackets*pieces_per_packet)+(netcartons*pieces_per_carton);
          // var maxproduct_packets = catchproduct_packets+(netcartons*packets_per_carton);
          var maxproduct_cartons = catchproduct_cartons;
        // }
        // else{
        //   var maxproduct_pieces  = catchproduct_pieces+(catchproduct_cartons*pieces_per_carton)+(catchproduct_packets*pieces_per_packet);
        //   var maxproduct_packets = catchproduct_packets+(catchproduct_cartons*packets_per_carton);
        //   var maxproduct_cartons = catchproduct_cartons;
        // }
        $('#sale_products_pieces_i').attr('max', maxproduct_pieces);
        // $('#sale_products_packets_i').attr('max', maxproduct_packets);
        $('#sale_products_cartons_i').attr('max', maxproduct_cartons);
      }
    });
  }

  $("#sale_products_barcode_i").on('focus', function () {
    // $( "product_name" ).autocomplete({
    $(this).autocomplete({
      source: productsbarcodes_array,
      autoFocus:true,
      minLength: 0,
      // select: $('#sale_product_barcode').val();
      // source: function(request, response) {
      //   var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
      //     response($.grep(productsnamescodes_array, function(item) {
      //     return matcher.test(item);
      //   }));
      // },
      // response: function(event, ui) {
      //   if (ui.content.length == 1) {
      //         var data = ui.content[0].value;
      //         $(this).autocomplete( "close" );
      //         // productSearch(data);
      //   };
      // },
      select: function(event, ui) {
        var data = ui.item.value;
        // console.log(data);
        barcodeSearch(data);
      },
      // change: function(event, ui) {
      //   var data = ui.item;
      //   console.log(data);
      //   if (ui.item == null) {
      //       this.setCustomValidity("You must select a product");
      //   }
      // }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
    // $(this).autocomplete("search", "");

  });
  function barcodeSearch(data) {
    $.ajax({
      type: 'GET',
      url: "{{ route('searchbarcode2')  }}",
      data: {
          data: data,
          // '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        productSearch(data[0]['product_id']);
        // var catchname = data[0]['product_name'];
        // var catchproduct_code = data[0]['product_ref_no'];
        // catchname = catchname+", "+catchproduct_code;
        // var catchproduct_id = data[0]['product_id'];
        // var catchproduct_pieces = data[0]['product_pieces_available'];
        // var catchproduct_packets = data[0]['product_packets_available'];
        // var catchproduct_cartons = data[0]['product_cartons_available'];
        // var pieces_per_carton = data[0]['product_piece_per_carton'];
        // var pieces_per_packet = data[0]['product_piece_per_packet'];
        // var packets_per_carton = data[0]['product_packet_per_carton'];
        // var product_cash_price_piece = data[0]['product_cash_price_piece'];
        // var product_credit_price_piece = data[0]['product_credit_price_piece'];
        // $('#product_name_i').val('');
        // $('#product_name_i').val(catchname);
        // $('#product_code_i').val('');
        // $('#product_code_i').val(catchproduct_code);
        // $('#product_id_i').val('');
        // $('#product_id_i').val(catchproduct_id);
        // $('#sale_products_pieces_i').attr('max', catchproduct_pieces);
        // $('#sale_products_packets_i').attr('max', catchproduct_packets);
        // $('#sale_products_cartons_i').attr('max', catchproduct_cartons);
        // $('#pieces_per_carton').val('');
        // $('#pieces_per_carton').val(pieces_per_carton);
        // $('#pieces_per_packet').val('');
        // $('#pieces_per_packet').val(pieces_per_packet);
        // $('#packets_per_carton').val('');
        // $('#packets_per_carton').val(packets_per_carton);
        // $('#sale_products_unit_price_i').val('');
        // $('#sale_products_unit_price_i').val(product_cash_price_piece)
        // $('#sale_products_unit_price_i').val('');
        // $('#sale_products_unit_price_i').val(product_credit_price_piece)
      }
    });
  }
  function barcodeSearch2(data) {
    $.ajax({
      type: 'GET',
      url: "{{ route('searchbarcode3')  }}",
      data: {
          data: data,
          // '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        console.log(data);
        var catchattachedbarcode = data[0]['product_barcodes'];
        // var catchname = data[0]['product_name'];
        // var catchproduct_code = data[0]['product_ref_no'];
        // catchname = catchname+", "+catchproduct_code;
        // var catchproduct_id = data[0]['product_id'];
        // var catchproduct_pieces = data[0]['product_pieces_available'];
        // var catchproduct_packets = data[0]['product_packets_available'];
        // var catchproduct_cartons = data[0]['product_cartons_available'];
        // var pieces_per_carton = data[0]['product_piece_per_carton'];
        // var pieces_per_packet = data[0]['product_piece_per_packet'];
        // var packets_per_carton = data[0]['product_packet_per_carton'];
        // var product_cash_price_piece = data[0]['product_cash_price_piece'];
        // var product_credit_price_piece = data[0]['product_credit_price_piece'];
        $('#sale_products_barcode_i').val('');
        $('#sale_products_barcode_i').val(catchattachedbarcode);
        // $('#product_name_i').val('');
        // $('#product_name_i').val(catchname);
        // $('#product_code_i').val('');
        // $('#product_code_i').val(catchproduct_code);
        // $('#product_id_i').val('');
        // $('#product_id_i').val(catchproduct_id);
        // $('#sale_products_pieces_i').attr('max', catchproduct_pieces);
        // $('#sale_products_packets_i').attr('max', catchproduct_packets);
        // $('#sale_products_cartons_i').attr('max', catchproduct_cartons);
        // $('#pieces_per_carton').val('');
        // $('#pieces_per_carton').val(pieces_per_carton);
        // $('#pieces_per_packet').val('');
        // $('#pieces_per_packet').val(pieces_per_packet);
        // $('#packets_per_carton').val('');
        // $('#packets_per_carton').val(packets_per_carton);
        // $('#sale_products_unit_price_i').val('');
        // $('#sale_products_unit_price_i').val(product_cash_price_piece)
        // $('#sale_products_unit_price_i').val('');
        // $('#sale_products_unit_price_i').val(product_credit_price_piece)
      }
    });
  }

  var customersnames_array = <?php echo json_encode($snameArray); ?>;
  var customersnamescodes_array = <?php echo json_encode($snamecodeArray); ?>;

  $("#customercodesearch").on('focus', function () {
    // $("#customercodesearch" ).autocomplete({
    $(this).autocomplete({
      source: customersnamescodes_array,
      autoFocus:true,
      minLength: 0,
      // select: $('#sale_product_barcode').val();
      // source: function(request, response) {
      //     var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
      //     response($.grep(productsnames_array, function(item) {
      //         return matcher.test(item);
      //     }));
      // },
      // response: function(event, ui) {
      //     if (ui.content.length == 1) {
      //         var data = ui.content[0].value;
      //         $(this).autocomplete( "close" );
      //         // productSearch(data);
      //     };
      // },
      select: function(event, ui) {
          var data = ui.item.value;
          data = data.split(',')[0];
          console.log(data);
          customerSearch(data);
      }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
  });
  function customerSearch(data){
    $.ajax({
      url: 'searchcustomer',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["customer_id"]);
        var customer_id = data[0]["customer_id"];
        var customer_name = data[0]["customer_name"];
        var status_id = data[0]["status_id"];
        var customer_balance_paid = data[0]["customer_balance_paid"];
        customer_balance_dues = data[0]["customer_balance_dues"];
        customer_balance_dues2 = data[0]["customer_balance_dues"];
        var customer_total_balance = data[0]["customer_total_balance"];
        var customer_credit_duration = data[0]["customer_credit_duration"];
        var customer_credit_type = data[0]["customer_credit_type"];
        var payterm_duratype = customer_credit_duration+' '+customer_credit_type;
        // console.log(payterm_duratype);
        var customer_credit_limit = data[0]["customer_credit_limit"];
        // $('#customer_name option').removeAttr('selected');
        // // $('#customer_name option[value='+customer_id+']').removeAttr('selected');
        // $('#customer_name option[value='+customer_id+']').attr('selected', 'selected');
        // $('#customer_name option[value='+customer_id+']').attr('status_id', status_id);
        $('#customercodesearch').attr('readonly');
        $('#customer_name').val(customer_name);
        $('#customer_id').val(customer_id);
        if(status_id == 1){
        $('#customer_status').val('Active');
        }
        // else{
        //   $('#customer_status').val('Inactive');
        // }
        $('#customer_balance_paid').val(customer_balance_paid);
        $('#customer_balance_dues').val(customer_balance_dues);
        // $('#customer_balance_dues2').val(customer_balance_dues2);
        customer_balance_dues3 = Number(customer_balance_dues2) +  Number(grandtotal_amount);
        $('#customer_balance_dues2').val(customer_balance_dues3);
        // $('#customer_total_balance').val(customer_total_balance);
        // $('#customer_credit_duration').val(customer_credit_duration);
        // $('#customer_credit_type').val(customer_credit_type);
        $('#payterm_duratype').val(payterm_duratype);
        $('#customer_credit_limit').val(customer_credit_limit);
      }
    });
  }

  $(document).on('change', '#customer_name', function(e){
    var status = $('option:selected', this).attr('status_id');
    e.preventDefault();
    // $('#customer_status').val(status);
    if(status == 1){
      $('#customer_status').val('Active');
    }
    // else{
    //   $('#customer_status').val('Inactive');
    // }
  });
    // $(document).on('focusout', '#customercodesearch', function(e){
    //   var data = this.value;
    //   $.ajax({
    //     url: 'searchcustomer',
    //     type: "GET",
    //     data: {
    //       data: data,
    //     },
    //     success:function(data) {
    //       // alert(data[0]["customer_id"]);
    //       var customer_id = data[0]["customer_id"];
    //       var status_id = data[0]["status_id"];
    //       $('#customer_name option').removeAttr('selected');
    //       // $('#customer_name option[value='+customer_id+']').removeAttr('selected');
    //       $('#customer_name option[value='+customer_id+']').attr('selected', 'selected');
    //       $('#customer_name option[value='+customer_id+']').attr('status_id', status_id);
    //       if(status_id == 1){
    //       $('#customer_status').val('Active');
    //       }
    //       // else{
    //       //   $('#customer_status').val('Inactive');
    //       // }
    //     }
    //   });
    // });

    // $(document).on('click', '.sound-btn', function() {
    //     var audio = $("#mysoundclip1")[0];
    //     audio.play();
    // });

    // $("#print-btn").on("click", function(){
    //     var divToPrint=document.getElementByClass('sale-product');
    //     var newWin=window.open('','Print-Window');
    //     newWin.document.open();
    //     newWin.document.write('<body onload="window.print()">'+divToPrint.innerHTML+'</body>');
    //     newWin.document.close();
    //     setTimeout(function(){newWin.close();},10);
    // });

    // function auto_print() {     
    //     window.print()
    // }
    // setTimeout(auto_print, 1000);

    shortcut.add("enter",function(e) {
      if (e.which == 13) {
          var $targ = $(e.target);
          if (!$targ.is(":button,:submit")) {
              var focusNext = false;
              $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
                  if (this === e.target) {
                      focusNext = true;
                  }
                  else if (focusNext){
                      $(this).focus();
                      return false;
                  }
              });
              return false;
          }
      }
    });
    // $(window).keydown(function(e){
    //   if (e.which == 13) {
    //       var $targ = $(e.target);
    //       if (!$targ.is(":button,:submit")) {
    //           var focusNext = false;
    //           $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
    //               if (this === e.target) {
    //                   focusNext = true;
    //               }
    //               else if (focusNext){
    //                   $(this).focus();
    //                   return false;
    //               }
    //           });
    //           return false;
    //       }
    //   }
    // });

</script>

@endsection
