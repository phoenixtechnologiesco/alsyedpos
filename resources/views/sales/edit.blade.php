@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Sale")}}</h5>
          </div>
          <div class="card-body-custom">
            <form id="sale_update" method="post" action="{{ route('sale.update', ['sale' => $sale->sale_id,]) }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              @if($errors->any())
                <div class="form-group">
                  <div class="alert alert-danger">
                    <ul>
                      @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endif
              <div class="row">
                <div class="card-body-custom col-12">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        {{-- <div class="form-first-col-3">
                          <div class="form-group">
                            <label for="customer_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Customer")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                </span>
                              </div>
                              <-- <div class="input-group pos"> -->
                                <input disabled type="text" name="customer_code" id="customercodesearch" placeholder="Search Customer by code" class="form-control col-12" value="{{ old('customer_code') }}" />
                              <-- </div> -->
                              @include('alerts.feedback', ['field' => 'customer_code'])
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-first-col-4">
                          <div class="form-group">
                            <label readonly for="sale_customer_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input readonly type="text" name="sale_customer_name" id="customer_name" placeholder="customer Name" class="form-control col-12" value="{{ $customer->customer_name }}" />
                                <input readonly type="hidden" name="sale_customer_id" id="customer_id" class="form-control col-12" value="{{ $customer->customer_id }}" />
                                <?php $snameArray = []; $snamecodeArray = []; ?>
                                @foreach($customers as $one_customer) 
                                  <div class="customernames_array" style="display: none">{{ $snameArray[] = $one_customer->customer_name }}</div>
                                  <div class="customernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_customer->customer_name.", ".($one_customer->customer_ref_no) }}</div>
                                @endforeach
                                {{-- <select readonly required name="sale_customer_name" id="customer_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 150px">
                                  @foreach($customers as $single_customer)
                                    <option @if($sale->sale_customer_id == $single_customer->customer_id) selected @endif status_id="{{$single_customer->status_id}}" value="{{$single_customer->customer_id}}">{{$single_customer->customer_name}}</option>
                                    ?php if($sale->sale_customer_id == $single_customer->customer_id) $customerstatus = $single_customer->status_id; ?>
                                  @endforeach
                                </select> --}}
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'sale_customer_name'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="customer_status" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Status")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="customer_status" id="customer_status" class="form-control col-12" value="@if($customer->status_id == 1) Active @else Inactive @endif">
                                @include('alerts.feedback', ['field' => 'customer_status'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="sale_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Sale Amount Paid")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="sale_amount_paid" id="sale_balance_paid" class="form-control" value="{{ $sale->sale_amount_paid }}">
                              <input readonly type="hidden" name="customer_balance_paid" id="customer_balance_paid" class="form-control" value="{{ $customer->customer_balance_paid }}">
                              @include('alerts.feedback', ['field' => 'sale_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="sale_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Sale Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="sale_amount_dues" id="sale_balance_dues" class="form-control" value="{{ $sale->sale_amount_dues }}">
                              <input readonly type="hidden" name="customer_balance_dues" id="customer_balance_dues" class="form-control" value="{{ $customer->customer_balance_dues }}">
                              @include('alerts.feedback', ['field' => 'sale_amount_dues'])
                            </div>
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
                      </div>
                      <div class="row">
                        <div class="form-first-col-2">
                          <div class="form-group">
                            <label for="sale_payment_method" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Payment Method")}}</label>
                              <div class="form-col-12">
                                {{-- <input readonly type="text" name="sale_payment_method" class="form-control col-12" value="{{ old('sale_payment_method', 'Cash') }}"> --}}
                                <select readonly required id="sale_payment_method" name="sale_payment_method" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Method...">
                                  <option @if($sale->sale_payment_method == 'cash') selected @endif value="cash">Cash</option>
                                  <option @if($sale->sale_payment_method == 'credit') selected @endif value="credit">Credit</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'sale_payment_method'])
                              </div>
                          </div>
                        </div>
                        {{-- <div class="form-col-2">
                          <div class="form-group">
                            <label for="sale_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Invoice ID")}}</label>
                              <div class="form-col-12">
                                <div class="myrow">
                                  <input readonly type="text" name="sale_invoice_id" class="form-control form-col-10" value="{{ $sale->sale_invoice_id }}">
                                  <button type="button" href="{{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                    <i class="fa fa-file-text-o"></i>
                                  </button>
                                </div>
                                @include('alerts.feedback', ['field' => 'sale_invoice_id'])
                              </div>
                          </div>
                        </div> --}}
                        <div class="form-col-3">
                          <div class="form-group">
                            {{-- <label for="available_stock" class=" form-col-12 control-label">{{__(" Available Pcs/Pkts/Crtns")}}</label> --}}
                            <div class="row">
                              <div class=" form-first-col-4">
                                <label for="" class=" form-col-12 control-label">{{__(" Avail.Pcs")}}</label>
                                <input readonly type="number" name="available_pcs" id="available_pcs" class="form-control col-12" value="">
                              </div>
                              <div class=" form-col-4">
                                <label for="" class=" form-col-12 control-label">{{__(" Avail.Pkts")}}</label>
                                <input readonly type="number" name="available_pkts" id="available_pkts" class="form-control col-12" value="">
                              </div>
                              <div class=" form-last-col-4">
                                <label for="" class=" form-col-12 control-label">{{__(" Aval.Crtns")}}</label>
                                <input readonly type="number" name="available_crtns" id="available_crtns" class="form-control col-12" value="">
                              </div>
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
                              <input readonly type="date" name="sale_invoice_date" class="form-control" value="{{ $sale->sale_invoice_date }}">
                              @include('alerts.feedback', ['field' => 'sale_invoice_date'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="row">
                            <div class="form-col-6">
                              <label for="payterm_duratype" class="form-col-12 control-label">{{__("Payterm")}}</label>
                                <div class="form-col-12">
                                  <input readonly type="text" name="payterm_duratype" id="payterm_duratype" class="form-control col-12" value="30 Days">
                                </div>
                            </div>
                            <div class="form-col-6">
                              <label for="customer_credit_limit" class=" form-col-12 control-label">{{__(" Credit Limit")}}</label>
                                <div class=" form-col-12">
                                  <input readonly type="number" name="customer_credit_limit" id="customer_credit_limit" class="form-control col-12" value="30000">
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-2">
                          <div class="form-group">
                            <label for="sale_document" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Upload Document")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <i class="fa fa-file-text-o"></i>
                                </span>
                              </div>
                              <input type="file" name="sale_document" id="sale_document" class="form-control col-12" value="{{ $sale->sale_document }}">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $mytotal_items = 0; $mytotal_quantity = 0; ?>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <div class=" col-12">
                          <div class="table-responsive-custom" >
                            <table id="myTable" class="table table-hover table-fixed table-bordered order-list">
                              <thead class="thead-dark" >
                                <tr class="row thead-dark-custom">
                                  <th class="col-2 firstcol" scope="col">Barcode</th>
                                  <th class="col-3 mycol" scope="col">Product</th>
                                  <th class="col-1 mycol" scope="col">Pcs</th>
                                  <th class="col-1 mycol" scope="col">Pkts</th>
                                  <th class="col-1 mycol" scope="col">Crtns</th>
                                  <th class="col-1 mycol" scope="col">Price</th>
                                  <th class="col-1 mycol" scope="col">Discount</th>
                                  <th class="col-1 mycol" scope="col">Total</th>
                                  <th class="col-1 lastcol" scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody class="sale-product">
                                <?php $i=1; $j = 1; $mytotal_quantity = 0; $mytotal_discount = 0; $mysubtotal_amount = 0; $mygrandtotal_amount = 0; ?>
                                @foreach($saleproducts as $singlesaleproduct)
                                  <?php
                                    $myproduct_quantity = $singlesaleproduct->sale_quantity_total;
                                    $myproduct_discount = $singlesaleproduct->sale_trade_discount;
                                    $myproduct_unit_price = $singlesaleproduct->sale_trade_price_piece;
                                
                                    $mytotal_items = $j;
                                    $mytotal_quantity = $mytotal_quantity + $myproduct_quantity;
                                    $mytotal_discount = $mytotal_discount + $myproduct_discount;
                                
                                    $myproduct_sub_total = $singlesaleproduct->sale_product_sub_total;
                                    $mysubtotal_amount = $mysubtotal_amount + $myproduct_sub_total;
                                    $mygrandtotal_amount = $mysubtotal_amount + $sale->sale_free_amount + $sale->sale_add_amount;
                                    $j++; 
                                    ?>
                                @endforeach
                                @foreach($saleproducts as $oneselectedproduct)
                                  <tr class="row prtr">
                                    <td class="col-2 firstcol" scope="col">
                                      <input readonly type="text" name="sale_products_barcode[]" id="sale_products_barcode{{$i}}" class="form-control col-12" placeholder="Scan/Search barcode" value="{{ $oneselectedproduct->sale_product_barcode }}">
                                    </td>
                                    <td class="col-3 mycol" scope="col">
                                      <input readonly type="text" name="product_name[]" id="product_name{{$i}}" class="form-control col-12" placeholder="Search product by name/code" value="{{ $oneselectedproduct->sale_product_name }}">
                                      <input readonly type="hidden" name="product_code[]" id="product_code{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_product_ref_no }}">
                                      <input readonly type="hidden" name="product_id[]" id="product_id{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->product_id }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_products_pieces[]" id="sale_products_pieces{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_pieces_total }}">
                                      <input readonly type="hidden" name="sale_pieces_per_packet[]" id="sale_pieces_per_packet{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_piece_per_packet }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_products_packets[]" id="sale_products_packets{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_packets_total }}">
                                      <input readonly type="hidden" name="sale_packets_per_carton[]" id="sale_packets_per_carton{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_packet_per_carton }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_products_cartons[]" id="sale_products_cartons{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_cartons_total }}">
                                      <input readonly type="hidden" name="sale_pieces_per_carton[]" id="sale_pieces_per_carton{{$i}}" class="form-control col-12" value="{{ $oneselectedproduct->sale_piece_per_carton }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_products_unit_price[]" id="sale_products_unit_price{{$i}}" class="form-control col-12"  value="{{ $oneselectedproduct->sale_trade_price_piece }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_products_discount[]" id="sale_products_discount{{$i}}" class="form-control col-12"  value="{{ $oneselectedproduct->sale_trade_discount }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_products_sub_total[]" id="sale_products_sub_total{{$i}}" class="form-control col-12"  value="{{ $oneselectedproduct->sale_product_sub_total }}">
                                    </td>
                                    <td class="col-1 lastcol" align="center">
                                      <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm delete-productfield" id="delete-productfield{{$i}}" row-id="{{$i}}" data-original-title="X" title="X"><i class="fa fa-times"></i></button>
                                    </td>
                                  </tr>
                                  <?php $i++; ?>
                                @endforeach
                                <tr class="row table-info" >
                                  <td class="col-2 firstcol" scope="col">
                                    <input type="text" name="sale_products_barcode_i" id="sale_products_barcode_i" class="form-control col-12" placeholder="Barcode Search/Scan" value="{{ old('sale_products_barcode_i', '') }}">
                                  </td>
                                  <td class="col-3 mycol" scope="col">
                                    <div class="col-12 mytblcol input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text barcode">
                                          <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                        </span>
                                      </div>
                                      <input type="text" name="product_name_i" id="product_name_i" class="form-control col-12" placeholder="Product search by name/code" value="{{ old('product_name_i', '') }}">
                                      <input type="hidden" name="product_code_i" id="product_code_i" value="{{ old('product_code_i', '') }}">
                                      <input type="hidden" name="product_id_i" id="product_id_i" value="{{ old('product_id_i', '') }}">
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
                                    <input type="number" name="sale_products_pieces_i" min="0" id="sale_products_pieces_i" class="form-control col-12" min="0" value="{{ old('sale_products_pieces_i', '0') }}">
                                    <input type="hidden" name="sale_pieces_per_packet_i" min="0" id="sale_pieces_per_packet_i" class="form-control col-12" min="0" value="{{ old('sale_pieces_per_packet_i', '5') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="sale_products_packets_i" min="0" id="sale_products_packets_i" class="form-control col-12" min="0" value="{{ old('sale_products_packets_i', '0') }}">
                                    <input type="hidden" name="sale_packets_per_carton_i" min="0" id="sale_packets_per_carton_i" class="form-control col-12" min="0" value="{{ old('sale_packets_per_carton_i', '4') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="sale_products_cartons_i" min="0" id="sale_products_cartons_i" class="form-control col-12" min="0" value="{{ old('sale_products_cartons_i', '0') }}">
                                    <input type="hidden" name="sale_pieces_per_carton_i" min="0" id="sale_pieces_per_carton_i" class="form-control col-12" min="0" value="{{ old('sale_pieces_per_carton_i', '20') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input readonly type="number" name="sale_products_unit_price_i" min="0" id="sale_products_unit_price_i" class="form-control col-12"  value="{{ old('sale_products_unit_price_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="sale_products_discount_i" min="0" id="sale_products_discount_i" class="form-control col-12"  value="{{ old('sale_products_discount_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input readonly type="number" name="sale_products_sub_total_i" min="0" id="sale_products_sub_total_i" class="form-control col-12"  value="'{{ old('sale_products_sub_total_i', '') }}'">
                                  </td>
                                  <td class="col-1 lastcol" scope="col">
                                      {{-- <button id="add_button" type="button" class="btn btn-info btn-round pull-right">{{__('Add')}}</button> --}}
                                      <button id="add_button" type="button" rel="tooltip" class="btn btn-info btn-round pull-right " data-original-title="+" title="+"><i class="fa fa-plus"></i></button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <div class=" col-12">
                          <div class="table-responsive-custom" >
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
                                      <input readonly type="text" name="sale_total_items" id="sale_total_items" class="form-control col-12" value="{{ $mytotal_items }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="text" name="sale_total_qty" id="sale_total_qty" class="form-control col-12" value="{{ $mytotal_quantity }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input type="number" name="sale_free_piece" class="form-control col-12" value="{{ $sale->sale_free_piece }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input type="number" name="sale_free_amount" id="sale_free_amount" class="form-control col-12"  value="{{ $sale->sale_free_amount }}">
                                    </td>
                                    <td class="col-2 mycol" scope="col">
                                      <input readonly type="number" name="sale_total_price" id="sale_total_price" class="form-control col-12"  value="{{ $mysubtotal_amount }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input type="number" name="sale_add_amount" id="sale_add_amount" class="form-control col-12"  value="{{ $sale->sale_add_amount }}">
                                    </td>
                                    <td class="col-1 mycol" scope="col">
                                      <input readonly type="number" name="sale_discount" id="sale_discount" class="form-control col-12"  value="{{ $mytotal_discount }}">
                                    </td>
                                    <td class="col-2 mycol" scope="col">
                                      <input readonly type="number" name="sale_grandtotal_price" id="sale_grandtotal_price" id="sale_grandtotal_price" class="form-control col-12"  value="{{ $mygrandtotal_amount }}">
                                    </td>
                                    <td class="col-2 lastcol" scope="col">
                                      <input type="number" name="sale_amount_recieved" id="sale_amount_recieved" class="form-control col-12"  value="{{ old('sale_amount_recieved', '0') }}">
                                    </td>
                                  </tr>
                                </div>
                              </thead>
                              <tbody class="">
                              </tbody>
                              <tfoot class="thead-dark">
                                <tr class="row tfoot-dark-custom">
                                  {{-- <th class="col-1 mycol" scope="col">Invoice Id</th> --}}
                                  {{-- <th class="col-3 mycol" scope="col" style="text-align: center">Invoice Date</th> --}}
                                  {{-- <th class="col-2 mycol" scope="col">Document</th> --}}
                                  <th class="col-8 firstcol" scope="col">Remarks</th>
                                  <th class="col-2 mycol" scope="col">Payment Status</th>
                                  <th class="col-2 lastcol" scope="col">Invoice ID</th>
                                </tr>
                                <tr class="row table-info" >
                                  {{-- <td class="col-1 mycol" scope="col">
                                    <input type="text" name="sale_invoice_id" class="form-control col-12" value="{{ old('sale_invoice_id', '') }}">
                                  </td>
                                  <td class="col-3 midcol" scope="col">
                                    <div class="row">
                                      <input type="text" name="sale_invoice_date" class="form-control col-9" value="{{ old('sale_invoice_date', '') }}">
                                      <button type="button" href="{{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon col-2" title="Re-Open">
                                        <i class="fa fa-file-text-o"></i>
                                      </button>
                                    </div>
                                  </td> --}}
                                  {{-- <td class="col-2 mycol" scope="col">
                                    <input type="file" name="sale_document" id="sale_document" class="form-control col-12" value="{{ old('sale_document', '') }}">
                                  </td> --}}
                                  <td class="col-8 firstcol" scope="col">
                                    <input type="text" name="sale_note" class="form-control col-12" value="{{ $sale->sale_note }}" >
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
                                    <input readonly type="text" name="sale_invoice_id" class="form-control form-col-12" value="{{ $sale->sale_invoice_id }}">
                                    {{-- <button type="button" href="{{ route('sale.edit', ['sale' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                      <i class="fa fa-file-text-o"></i>
                                    </button> --}}
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
                          <?php $productArray = []; $nameArray = []; $codeArray = []; ?>
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
                </div>
                <!-- payment modal -->
                {{-- <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 id="exampleModalLabel" class="modal-title">Finalize sale</h5>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                          </div>
                          <div class="modal-body">
                              <div class="row">
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
                              </div>
                          </div>
                      </div>
                  </div>
                </div> --}}
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
                                  <label for="customer_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("customer Name")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                      </span>
                                    </div>
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="customer_name" id="customercodesearch" placeholder="customer Name" class="form-control customercodesearch"  />
                                      {{-- <select required name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Scustomer..." style="width: 100px">
                                        @foreach($customers as $customer)
                                          <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'customer_name'])
                                  </div>
                                </div>
                              </div>
                              <div class=" col-6 ">
                                <div class="form-group">
                                  <label for="customer_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" customer Code")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                      </span>
                                    </div>
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="customer_code" id="customercodeSearch" placeholder="customer Code" class="form-control"  />
                                      {{-- <select required name="customer_code" id="customer_code" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px">
                                        @foreach($customers as $customer)
                                          <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                        @endforeach
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
                                    <div class=" col-12 input-group ">
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
                                      <table id="myTable" class="table table-sm table-hover table-striped table-fixed table-bordered display compact order-column">
                                        <thead class="thead pos" >{{-- style="position: sticky; top: 0; z-index: 1" --}}
                                          {{-- <tr>
                                              <th>RefID</th>
                                              <th>Barcode</th>
                                              <th>Product</th>
                                              <th>T.P</th>
                                              <th>Cash(Pc)</th>
                                              <th>Cash(Pk)</th>
                                              <th>Credit</th>
                                              <th>Non Bulk</th>
                                              <th>Available</th>
                                              <th>Action</th>
                                              $table->integer('product_total_quantity');
                                          </tr> --}}
                                          <tr>
                                            {{-- <th>Ref.Id</th> --}}
                                            <th colspan="2">Product Info</th>
                                            {{-- <th>Barcode</th> --}}
                                            {{-- <th colspan="2">Company/Brand</th> --}}
                                            {{-- <th>Brand</th> --}}
                                            {{-- <th colspan="3">Total Quantity</th> --}}
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
                                            <th class="disabled-sorting text-left">Edit</th>
                                          </tr>
                                          <tr>
                                            {{-- <th>Ref.Id</th> --}}
                                            <th>Name</th>
                                            <th>Barcode</th>
                                            {{-- <th>Company</th>
                                            <th>Brand</th> --}}
                                            {{-- <th>Pc</th>
                                            <th>Pkt</th>
                                            <th>Crt</th> --}}
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
                                            <th class="disabled-sorting text-left">Edit</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($products as $key => $value)
                                          <tr>
                                            <td>{{ $value->product_name }}</td>
                                            <!-- <td>{ $value->product_ref_no }}</td> -->
                                            <td>{{ $value->product_barcode }}</td>
                                            <td>{{ $value->product_pieces_available }}</td>
                                            <td>{{ $value->product_packets_available }}</td>
                                            <td>{{ $value->product_cartons_available }}</td>
                                            <td>{{ $value->product_trade_price_piece }}</td>
                                            <td>{{ $value->product_trade_price_packet }}</td>
                                            <td>{{ $value->product_trade_price_carton }}</td>
                                            <td>{{ $value->product_cash_price_piece }}</td>
                                            <td>{{ $value->product_cash_price_packet }}</td>
                                            <td>{{ $value->product_cash_price_carton }}</td>
                                            <td>{{ $value->product_credit_price_piece }}</td>
                                            <td>{{ $value->product_credit_price_packet }}</td>
                                            <td>{{ $value->product_credit_price_carton }}</td>
                                            <!-- <td>{ $value->product_nonbulk_price_piece }}</td> -->
                                            <td class="text-right">
                                              <a type="button" href="{{ route('product.edit', ['product' => $value->product_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="+" title="+">
                                                <i class="fa fa-plus-square"></i>
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
                                    <label>sale Note</label>
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
                <!-- customer list modal -->
                <div id="customer-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content-pos">
                      <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Customers List</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="row">
                              <div class=" col-6 ">
                                <div class="form-group">
                                  <label for="customer_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("Customer Name")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                      </span>
                                    </div>
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="customer_name" id="customercodesearch" placeholder="Customer Name" class="form-control customercodesearch"  />
                                      {{-- <select required name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Customer..." style="width: 100px">
                                        @foreach($customers as $customer)
                                          <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'customer_name'])
                                  </div>
                                </div>
                              </div>
                              <div class=" col-6 ">
                                <div class="form-group">
                                  <label for="customer_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Customer Code")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                      </span>
                                    </div>
                                    <input type="hidden" name="customer_code_hidden" value="customer_code">
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="customer_code" id="customercodeSearch" placeholder="Customer Code" class="form-control"  />
                                      {{-- <select required name="customer_code" id="customer_code" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Customer..." style="width: 100px">
                                        @foreach($customers as $customer)
                                          <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'customer_code'])
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class=" col-12 ">
                                <div class="form-group">
                                  <div class=" col-12">
                                    <div class="table-responsive-sm" style="height:300px; overflow-x:hidden">
                                      <table id="myTable" class="table table-sm table-hover table-striped table-fixed table-bordered display compact order-column">
                                        <thead class="thead pos" >{{-- style="position: sticky; top: 0; z-index: 1" --}}
                                          <tr>
                                              <th>RefID</th>
                                              <th>Name</th>
                                              <th>Status</th>
                                              <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($customers as $key => $value)
                                          <tr>
                                            <td>{{ $value->customer_ref_no }}</td>
                                            <td>{{ $value->customer_name }}</td>
                                            <td>{{ $value->status_id }}</td>
                                            <td class="text-right">
                                              <a type="button" href="{{ route('customer.edit', ['customer' => $value->customer_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="+" title="+">
                                                <i class="fa fa-plus-square"></i>
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
                            <div class="mt-3">
                                <button id="submit-btn" type="button" class="btn btn-primary">submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer row">
                <div class="col-6">
                  <button type="submit" class="btn btn-info btn-round pull-left">{{__('Update')}}</button>
                </div>
            </form>
                <div class="col-6">
                  <a type="button"  href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
                  <form action="{{ route('sale.destroy', $sale->sale_id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger btn-round pull-right">{{__('Delete')}}</button>
                  </form>
                </div>
              </div>
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

<script>
  $(function (){
    $('#sale_update').validate({
      rules: {
        customer_code: 'required',
        sale_payment_method: 'required',
        // product_name: 'required',
        // product_code: 'required',
        // sale_grandtotal_price: 'required',
        sale_amount_recieved: 'required',
      },
      messages: {
        customer_code:  'Please Enter Supplier Name',
        sale_payment_method:  'Please Enter Sale Payment Method',
        // product_name:  'Please Enter Product Name',
        // product_code:  'Please Enter Product Code',
        // sale_grandtotal_price:  'Please Enter Product',
        sale_amount_recieved:  'Please Enter Amount Paid',
      },
      errorElement: 'em',
      errorPlacement: function ( error, element ) {
        error.addClass( 'invalid-feedback' );
        if ( element.prop( 'type' ) === 'checkbox' ) {
          error.insertAfter( element.parent( 'label' ) );
        } else {
          error.insertAfter( element );
        }
      },
      errorClass: "error fail-alert",
      validClass: "valid success-alert",
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' );
      },
      unhighlight: function (element, errorClass, validClass) {
        // $( element ).addClass( 'is-valid' ).removeClass( 'is-invalid' );
        $( element ).removeClass( 'is-invalid' );
      }
    });
    $.validator.setDefaults( {
      // debug: true,
      // success: "valid",
      // submitHandler: function () {
      //   alert( 'submitted!' );
      // },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>

<script type="text/javascript">

  var total_items;
  var total_quantity;
  var total_discount
  var subtotal_amount;
  var grandtotal_amount;
  var sale_free_amount;
  var sale_add_amount;
  var sale_amount_recieved;
  var sale_return_change;
  var product_quantity;
  var product_sub_total;
  var my_total_qty;
  var i = 1;

  var rowindex;
  var customer_sale_rate;
  var row_product_price;
  var pos;
  
  var rownum = <?php echo $i; ?>;

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
    // var pieces_per_packet = $('#pieces_per_packet').val();
    total_items = $('#sale_total_items').val();
    total_quantity = $('#sale_total_qty').val();
    sale_free_amount = $('#sale_free_amount').val();
    sale_add_amount = $('#sale_add_amount').val();
    subtotal_amount = $('#sale_total_price').val();
    total_discount = $('#sale_discount').val();
    grandtotal_amount = $('#sale_grandtotal_price').val();
    sale_amount_recieved = $('#sale_amount_recieved').val();

    product_quantity = Number(product_pieces)+Number(product_packets*pieces_per_packet)+Number(product_cartons*pieces_per_carton);

    // var data = $(".sale-product").row( $(this).parents('row prtr') ).data();
    // var data = $(".sale-product").find('.prtr').html();
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
    // $('#sale_products_pieces_i').val(Number(0));
    // $('#sale_products_packets_i').val(Number(0));
    // $('#sale_products_cartons_i').val(Number(0));
    // $('#sale_pieces_per_packet_i').val(Number(0));
    // $('#sale_packets_per_carton_i').val(Number(0));
    // $('#sale_pieces_per_carton_i').val(Number(0));
    // $('#sale_products_unit_price_i').val(Number(0));
    // $('#sale_products_discount_i').val(Number(0));
    // $('#sale_products_sub_total_i').val(Number(0));

    if(product_name !== "" && product_quantity !== 0 && product_unit_price !== 0 && repeated !== 1){

      product_quantity = Number(product_pieces)+Number(product_packets*pieces_per_packet)+Number(product_cartons*pieces_per_carton);

      if(product_quantity == 0 || product_unit_price == 0){
        product_discount = 0;
        product_unit_price = 0;
      }

      total_items = Number(total_items) + 1;
      total_quantity = Number(total_quantity) + (Number(product_quantity));
      total_discount = Number(total_discount) + Number(product_discount);

      product_sub_total = Number(product_unit_price)*(Number(product_quantity))-Number(product_discount);
      if(product_quantity == 0){
        product_sub_total = 0;
      }
      subtotal_amount = Number(subtotal_amount) + Number(product_sub_total);
      grandtotal_amount = Number(subtotal_amount) + Number(sale_free_amount) + Number(sale_add_amount);
      
      $('.sale-product').prepend('<tr class="row prtr"><td class="col-2 firstcol" scope="col"><input readonly type="text" name="sale_products_barcode[]" id="sale_products_barcode'+rownum+'" class="form-control col-12" placeholder="Scan/Search barcode" value='+product_barcode+'></td><td class="col-3 mycol" scope="col"><input readonly type="text" name="product_name[]" id="product_name'+rownum+'" class="form-control col-12" placeholder="Search product by name/code" value="'+product_name+'"><input readonly type="hidden" name="product_code[]" id="product_code'+rownum+'" class="form-control col-12" value='+product_ref+'><input readonly type="hidden" name="product_id[]" id="product_id'+rownum+'" class="form-control col-12" value='+product_id+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_pieces[]" id="sale_products_pieces'+rownum+'" class="form-control col-12" value='+product_pieces+'><input readonly type="hidden" name="sale_pieces_per_packet[]" id="sale_pieces_per_packet'+rownum+'" class="form-control col-12" value='+pieces_per_packet+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_packets[]" id="sale_products_packets'+rownum+'" class="form-control col-12" value='+product_packets+'><input readonly type="hidden" name="sale_packets_per_carton[]" id="sale_packets_per_carton'+rownum+'" class="form-control col-12" value='+packets_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="sale_products_cartons[]" id="sale_products_cartons'+rownum+'" class="form-control col-12" value='+product_cartons+'><input readonly type="hidden" name="sale_pieces_per_carton[]" id="sale_pieces_per_carton'+rownum+'" class="form-control col-12" value='+pieces_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_unit_price[]" id="sale_products_unit_price'+rownum+'" class="form-control col-12"  value='+product_unit_price+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_discount[]" id="sale_products_discount'+rownum+'" class="form-control col-12"  value='+product_discount+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="sale_products_sub_total[]" id="sale_products_sub_total'+rownum+'" class="form-control col-12"  value='+product_sub_total+'></td><td class="col-1 lastcol" align="center"><button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm delete-productfield" id="delete-productfield'+rownum+'" row-id="'+rownum+'" data-original-title="X" title="X"><i class="fa fa-times"></i></button></td></tr>');
      // alert(rownum);
      rownum++;
      // alert(rownum);
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
  $(document).on('change', '#sale_add_amount', function(e){
    grandtotal_amount = Number(grandtotal_amount) - Number(sale_add_amount);
    sale_add_amount = $('#sale_add_amount').val();
    grandtotal_amount = Number(grandtotal_amount) + Number(sale_add_amount);
    $('#sale_grandtotal_price').val(Number(0));
    $('#sale_grandtotal_price').val(grandtotal_amount);
  });
  $(document).on('change', '#sale_free_amount', function(e){
    grandtotal_amount = Number(grandtotal_amount) + Number(sale_free_amount);
    sale_free_amount = $('#sale_free_amount').val();
    grandtotal_amount = Number(grandtotal_amount) - Number(sale_free_amount);
    $('#sale_grandtotal_price').val(Number(0));
    $('#sale_grandtotal_price').val(grandtotal_amount);
  });
  $(document).on('change', "#sale_amount_recieved", function(e){
    grandtotal_amount = $('#sale_grandtotal_price').val();
    sale_amount_recieved = $('#sale_amount_recieved').val();
    if(Number(sale_amount_recieved) >= Number(grandtotal_amount)){
      sale_return_change = Number(sale_amount_recieved) -  Number(grandtotal_amount);
      $('#sale_return_change').val(sale_return_change);
    }
    if(Number(sale_amount_recieved) < Number(grandtotal_amount)){
      alert('Amount recieved should be greater than the Grand Total Amount');
      $('#sale_amount_recieved').val(Number(0));
    }
  });
  $(document).on("click", ".delete-productfield", function(event) {

    if(confirm('Do you really want to delete this?')){
      rowid = $(this).attr('row-id');
      thisproduct_discount = $('#sale_products_discount'+rowid).val();
      thisproduct_sub_total = $('#sale_products_sub_total'+rowid).val();
      thisproduct_pieces = $('#sale_products_pieces'+rowid).val();
      thisproduct_packets = $('#sale_products_packets'+rowid).val();
      thisproduct_cartons = $('#sale_products_cartons'+rowid).val();
      thispieces_per_packet = $('#sale_pieces_per_packet'+rowid).val();
      thispieces_per_carton = $('#sale_pieces_per_carton'+rowid).val();

      product_quantity = (Number(thisproduct_pieces)+Number(thisproduct_packets*thispieces_per_packet)+Number(thisproduct_cartons*thispieces_per_carton));
      sale_amount_recieved = $('#sale_amount_recieved').val();
      total_quantity = $('#sale_total_qty').val();
      total_items = $('#sale_total_items').val();
      subtotal_amount = $('#sale_total_price').val();
      grandtotal_amount = $('#sale_grandtotal_price').val();
      // rowindex = $(this).closest('tr').index();
      total_quantity = Number(total_quantity) - Number(product_quantity);
      total_items = Number(total_items) - 1;
      total_discount = Number(total_discount) - Number(thisproduct_discount);
      console.log(total_quantity);
      // var product_sub_total = $('#sale_products_sub_total').val();
      subtotal_amount = Number(subtotal_amount) - Number(thisproduct_sub_total);
      grandtotal_amount = Number(grandtotal_amount) - Number(thisproduct_sub_total);

      $('#sale_total_qty').val(Number(0));
      $('#sale_total_qty').val(total_quantity);
      $('#sale_total_items').val(Number(0));
      $('#sale_total_items').val(total_items);
      $('#sale_discount').val(Number(0));
      $('#sale_discount').val(total_discount);
      $('#sale_total_price').val(Number(0));
      $('#sale_total_price').val(subtotal_amount);
      $('#sale_grandtotal_price').val(Number(0));
      $('#sale_grandtotal_price').val(grandtotal_amount);
      if(sale_amount_recieved >= grandtotal_amount){
        sale_return_change = Number(sale_amount_recieved) -  Number(grandtotal_amount);
        $('#sale_return_change').val(sale_return_change);
      }
      else{
          $('#sale_return_change').val(Number(0));
      }

      $(this).closest('.prtr').remove();

    }

  });

  $(document).on('change', "#sale_products_pieces_i", function(e){
    sale_product_name = $('#product_name_i').val();
    data = sale_product_name.split(',')[0];
    // console.log(data);
    productSearch2(data);
  });
  $(document).on('change', "#sale_products_packets_i", function(e){
    sale_product_name = $('#product_name_i').val();
    data = sale_product_name.split(',')[0];
    // console.log(data);
    productSearch3(data);
  });
  $(document).on('change', "#sale_products_cartons_i", function(e){
    sale_product_name = $('#product_name_i').val();
    data = sale_product_name.split(',')[0];
    // console.log(data);
    productSearch4(data);
  });

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
        $('#pieces_per_carton').val(Number(0));
        $('#pieces_per_carton').val(pieces_per_carton);
        $('#pieces_per_packet').val(Number(0));
        $('#pieces_per_packet').val(pieces_per_packet);
        $('#packets_per_carton').val(Number(0));
        $('#packets_per_carton').val(packets_per_carton);
        $('#sale_products_unit_price_i').val(Number(0));
        $('#sale_products_unit_price_i').val(product_cash_price_piece)
        // $('#sale_products_unit_price_i').val('');
        // $('#sale_products_unit_price_i').val(product_credit_price_piece)
        $('#available_pcs').val(catchproduct_pieces);
        $('#available_pkts').val(catchproduct_packets);
        $('#available_crtns').val(catchproduct_cartons);
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
        // console.log(data);
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
        // console.log(data);
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
        // console.log(data);
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
        // console.log(data);
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
      // select: $('#purchase_product_barcode').val();
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
          // console.log(data);
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
      url: '{{ route("searchcustomer") }}',
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
        var customer_balance_dues = data[0]["customer_balance_dues"];
        // var customer_total_balance = data[0]["customer_total_balance"];
        // $('#customer_name option').removeAttr('selected');
        // // $('#customer_name option[value='+customer_id+']').removeAttr('selected');
        // $('#customer_name option[value='+customer_id+']').attr('selected', 'selected');
        // $('#customer_name option[value='+customer_id+']').attr('status_id', status_id);
        $('#customer_name').val(customer_name);
        $('#customer_id').val(customer_id);
        if(status_id == 1){
        $('#customer_status').val('Active');
        }
        // else{
        //   $('#customer_status').val('Inactive');
        // }
        // $('#customer_balance_paid').val(customer_balance_paid);
        // $('#customer_balance_dues').val(customer_balance_dues);
        // $('#customer_total_balance').val(customer_total_balance);
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
</script>

@endsection
