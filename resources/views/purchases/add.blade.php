@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Purchase")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('purchase.store') }}" autocomplete="off" enctype="multipart/form-data">
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
                            <label for="supplier_code" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Search Supplier")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#supplier-list" id="product-list-btn"><i class="fa fa-search"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input type="text" name="supplier_code" id="suppliercodesearch" placeholder="Search supplier by code" class="form-control col-12" value="{{ old('supplier_code') }}" />
                                {{-- <input type="hidden" name="supplier_code" id="allsuppliers" class="form-control col-12"  /> --}}
                                  <?php $snameArray = []; $snamecodeArray = []; ?>
                                  @foreach($suppliers as $one_supplier) 
                                    <div class="suppliernames_array" style="display: none">{{ $snameArray[] = $one_supplier->supplier_name }}</div>
                                    <div class="suppliernamecode_array" style="display: none">{{ $snamecodeArray[] = $one_supplier->supplier_name.", ".($one_supplier->supplier_ref_no) }}</div>
                                  @endforeach
                                {{-- <select required name="supplier_code" id="supplier_code" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 100px">
                                  @foreach($lims_supplier_list as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                  @endforeach
                                  <option value="0">Asif Ghafoor</option>
                                </select> --}}
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'supplier_code'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-3">
                          <div class="form-group">
                            <label readonly for="purchase_supplier_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Supplier Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#supplier-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input readonly type="text" name="purchase_supplier_name" id="supplier_name" placeholder="Supplier Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="purchase_supplier_id" id="supplier_id" class="form-control col-12" value="" />
                                {{-- <select readonly required name="purchase_supplier_name" id="supplier_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Supplier..." style="width: 150px">
                                  @foreach($suppliers as $single_supplier)
                                    <option status_id="{{$single_supplier->status_id}}" value="{{$single_supplier->supplier_id}}">{{$single_supplier->supplier_name}}</option>
                                  @endforeach
                                </select> --}}
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'purchase_supplier_name'])
                            </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="supplier_status" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Supplier Status")}}</label>
                              <div class="form-col-12">
                                <input readonly type="text" name="supplier_status" id="supplier_status" class="form-control col-12" value="">
                                @include('alerts.feedback', ['field' => 'supplier_status'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="purchase_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Supplier Amount Paid")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="purchase_amount_paid" id="supplier_balance_paid" class="form-control" value="{{ old('purchase_amount_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'purchase_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-2">
                          <div class="form-group">
                            <label for="purchase_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Supplier Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="purchase_amount_dues" id="supplier_balance_dues" class="form-control" value="{{ old('purchase_amount_dues', '') }}">
                              @include('alerts.feedback', ['field' => 'purchase_amount_dues'])
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-first-col-2">
                          <div class="form-group">
                            <label for="purchase_payment_method" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Payment Method")}}</label>
                              <div class="form-col-12">
                                {{-- <input readonly type="text" name="purchase_payment_method" class="form-control col-12" value="{{ old('purchase_payment_method', 'Cash') }}"> --}}
                                <select required id="purchase_payment_method" name="purchase_payment_method" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Payment Method...">
                                  <option value="cash">Cash</option>
                                  <option value="credit">Credit</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'purchase_payment_method'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="purchase_invoice_id" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Invoice ID")}}</label>
                              <div class="form-col-12">
                                <div class="myrow">
                                  {{-- <div class="col-1"></div> --}}
                                  <input type="text" name="purchase_invoice_id" class="form-control form-col-10" value="{{ old('purchase_invoice_', '') }}">
                                  <button type="button" href="{{ route('purchase.edit', ['purchase' => 1,]) }}" class="btn btn-sm btn-warning btn-icon form-col-2" title="Re-Open">
                                    <i class="fa fa-file-text-o"></i>
                                  </button>
                                </div>
                                @include('alerts.feedback', ['field' => 'purchase_invoice_id'])
                              </div>
                          </div>
                        </div>
                        <div class="form-col-2">
                          <div class="form-group">
                            <label for="purchase_invoice_date" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Purchase/Invoice Date")}}</label>
                            <div class="form-col-12 input-group ">
                              {{-- <div class="input-group-prepend">
                                <span class="input-group-text barcode"><i class="fa fa-file-text-o"></i></span>
                              </div> --}}
                              <input type="date" name="purchase_invoice_date" class="form-control" value="{{ old('purchase_invoice_date', '') }}">
                              @include('alerts.feedback', ['field' => 'purchase_invoice_date'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-4">
                          <div class="form-group">
                            <label for="purchse_document" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Upload Document")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <i class="fa fa-file-text-o"></i>
                                </span>
                              </div>
                              <input type="file" name="purchase_document" id="purchase_document" class="form-control col-12" value="{{ old('purchase_document', '') }}">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <div class=" col-12">
                          <div class="table-responsive" style="overflow-x:hidden">
                            <table id="myTable" class="table table-hover table-striped table-fixed order-list">
                              <thead class="thead-dark" style="position: sticky; top: 0; z-index: 1">
                                <tr class="row">
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
                              <tbody class="purchase-product">
                                <tr class="row table-info" >
                                  <td class="col-2 firstcol" scope="col">
                                    <input type="text" name="purchase_products_barcode_i" id="purchase_products_barcode_i" class="form-control col-12" placeholder="Barcode Search/Scan" value="{{ old('purchase_products_barcode_i', '') }}">
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
                                    <input type="number" name="purchase_products_pieces_i" id="purchase_products_pieces_i" class="form-control col-12" min="0" value="{{ old('purchase_products_pieces_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="purchase_products_packets_i" id="purchase_products_packets_i" class="form-control col-12" min="0" value="{{ old('purchase_products_packets_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="purchase_products_cartons_i" id="purchase_products_cartons_i" class="form-control col-12" min="0" value="{{ old('purchase_products_cartons_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="text" name="purchase_products_unit_price_i" id="purchase_products_unit_price_i" class="form-control col-12"  value="{{ old('purchase_products_unit_price_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="text" name="purchase_products_discount_i" id="purchase_products_discount_i" class="form-control col-12"  value="{{ old('purchase_products_discount_i', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input readonly type="text" name="purchase_products_sub_total_i" id="purchase_products_sub_total_i" class="form-control col-12"  value="{{ old('purchase_products_sub_total_i', '') }}">
                                  </td>
                                  <td class="col-1 lastcol" scope="col">
                                      {{-- <button id="add_button" type="button" class="btn btn-info btn-round pull-right">{{__('Add')}}</button> --}}
                                      <button id="add_button" type="button" rel="tooltip" class="btn btn-info btn-round pull-right " data-original-title="+" title="+"><i class="fa fa-plus"></i></button>
                                  </td>
                                </tr>
                              </tbody>
                              <tfoot class="thead-dark">
                                <tr class="row">
                                  <th class="col-2 firstcol" scope="col">Purchase Status</th>
                                  <th class="col-2 mycol" scope="col">Payment Status</th>
                                  {{-- <th class="col-1 mycol" scope="col">Invoice Id</th> --}}
                                  {{-- <th class="col-3 mycol" scope="col" style="text-align: center">Invoice Date</th> --}}
                                  {{-- <th class="col-2 mycol" scope="col">Document</th> --}}
                                  <th class="col-8 lastcol" scope="col">Remarks</th>
                                </tr>
                                <tr class="row table-info" >
                                  <td class="col-2 firstcol" scope="col">
                                    <select name="purchase_status" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Purchase Status">
                                      <option value="pending">Pending</option>
                                      <option value="ordered">Ordered</option>
                                      <option value="partial">Partial</option>
                                      <option value="received">Received</option>
                                      //received,partial,pending,ordered
                                    </select>
                                  </td>
                                  <td class="col-2 mycol" scope="col">
                                    <select name="purchase_payment_status" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Payment Status">
                                      <option value="paid">Paid</option>
                                      <option value="due">Due</option>
                                      <option value="partial">Partial</option>
                                      <option value="overdue">Overdue</option>
                                      //paid,due,partial,overdue,
                                    </select>
                                  </td>
                                  {{-- <td class="col-1 mycol" scope="col">
                                    <input type="text" name="purchase_invoice_id" class="form-control col-12" value="{{ old('purchase_invoice_id', '') }}">
                                  </td>
                                  <td class="col-3 midcol" scope="col">
                                    <div class="row">
                                      <input type="text" name="purchase_invoice_date" class="form-control col-9" value="{{ old('purchase_invoice_date', '') }}">
                                      <button type="button" href="{{ route('purchase.edit', ['purchase' => 1,]) }}" class="btn btn-sm btn-warning btn-icon col-2" title="Re-Open">
                                        <i class="fa fa-file-text-o"></i>
                                      </button>
                                    </div>
                                  </td> --}}
                                  {{-- <td class="col-2 mycol" scope="col">
                                    <input type="file" name="purchase_document" id="purchase_document" class="form-control col-12" value="{{ old('purchase_document', '') }}">
                                  </td> --}}
                                  <td class="col-8 lastcol" scope="col">
                                    <input type="text" name="purchase_note" class="form-control col-12" value="{{ old('purchase_note'), '' }}" >
                                  </td>
                                </tr>
                              </tfoot>
                              <tfoot class="thead-dark">
                                <tr class="row">
                                  <th colspan="1" class="col-1 firstcol" scope="col">Items</th>
                                  <th colspan="1" class="col-1 mycol" scope="col">Total Qty</th>
                                  <th colspan="2" class="col-2 mycol" scope="col">Free Pcs  /  Free Amount</th>
                                  {{-- <th class="col-1 mycol" scope="col">Free Amount</th> --}}
                                  <th colspan="1" class="col-2 mycol" scope="col">Total</th>
                                  <th colspan="1" class="col-1 mycol" scope="col">Add</th>
                                  <th colspan="1" class="col-1 mycol" scope="col">Discount</th>
                                  <th colspan="1" class="col-2 mycol" scope="col">Grand Total</th>
                                  <th colspan="1" class="col-2 lastcol" scope="col">Paid Amount</th>
                                </tr>
                                <tr class="row table-info" >
                                  <td class="col-1 firstcol" scope="col">
                                    <input readonly type="text" name="purchase_total_items" id="purchase_total_items" class="form-control col-12" value="{{ old('purchase_total_items', '') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input readonly type="text" name="purchase_total_qty" id="purchase_total_qty" class="form-control col-12" value="{{ old('purchase_total_qty', '') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="purchase_free_piece" class="form-control col-12" value="{{ old('purchase_free_piece', '0') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="number" name="purchase_free_amount" id="purchase_free_amount" class="form-control col-12"  value="{{ old('purchase_free_amount', '0.00') }}">
                                  </td>
                                  <td class="col-2 mycol" scope="col">
                                    <input readonly type="number" name="purchase_total_price" id="purchase_total_price" class="form-control col-12"  value="{{ old('purchase_total_price', '') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input type="text" name="purchase_add_amount" id="purchase_add_amount" class="form-control col-12"  value="{{ old('purchase_add_amount', '0.00') }}">
                                  </td>
                                  <td class="col-1 mycol" scope="col">
                                    <input readonly type="text" name="purchase_discount" id="purchase_discount" class="form-control col-12"  value="{{ old('purchase_discount', '') }}">
                                  </td>
                                  <td class="col-2 mycol" scope="col">
                                    <input readonly type="text" name="purchase_grandtotal_price" id="purchase_grandtotal_price" id="purchase_grandtotal_price" class="form-control col-12"  value="{{ old('purchase_grandtotal_price', '') }}">
                                  </td>
                                  <td class="col-2 lastcol" scope="col">
                                    <input type="text" name="purchase_amount_recieved" class="form-control col-12"  value="{{ old('purchase_amount_recieved', '100') }}">
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
                          {{-- <input type="hidden" name="purchase_products_barcode_2" id="product_barcode2" value="{{ $one_product->product_barcode }}"/> --}}
                          <input type="hidden" name="pieces_per_packet" id="pieces_per_packet" value="{{ $one_product->product_piece_per_packet }}"/>
                          <input type="hidden" name="packets_per_carton" id="packets_per_carton" value="{{ $one_product->product_packet_per_carton }}"/>
                          <input type="hidden" name="pieces_per_carton" id="pieces_per_carton" value="{{ $one_product->product_piece_per_carton }}"/>
                          {{-- <input type="hidden" name="items" id="items"/>
                          <input type="hidden" name="total_qty" id="total_qty"/>
                          <input type="hidden" name="total_price" />
                          <input type="hidden" name="grand_total" />
                          <input type="hidden" name="total_discount" value="0.00"/>
                          <input type="hidden" name="purchase_status" value="1" />
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
                              <h5 id="exampleModalLabel" class="modal-title">Finalize purchase</h5>
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
                                              <label>purchase Note</label>
                                              <textarea rows="3" class="form-control" name="purchase_note"></textarea>
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
                                  <label for="supplier_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("supplier Name")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                      </span>
                                    </div>
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="supplier_name" id="suppliercodesearch" placeholder="Supplier Name" class="form-control suppliercodesearch"  />
                                      {{-- <select required name="supplier_name" id="supplier_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select SSupplier..." style="width: 100px">
                                        @foreach($suppliers as $supplier)
                                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'supplier_name'])
                                  </div>
                                </div>
                              </div>
                              <div class=" col-6 ">
                                <div class="form-group">
                                  <label for="supplier_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Supplier Code")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                      </span>
                                    </div>
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="supplier_code" id="suppliercodeSearch" placeholder="Supplier Code" class="form-control"  />
                                      {{-- <select required name="supplier_code" id="supplier_code" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 100px">
                                        @foreach($suppliers as $supplier)
                                          <option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'supplier_code'])
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
                                    <label>purchase Note</label>
                                    <textarea rows="3" class="form-control" name="purchase_note"></textarea>
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
                <!-- supplier list modal -->
                <div id="supplier-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content-pos">
                      <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Suppplers List</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="row">
                              <div class=" col-6 ">
                                <div class="form-group">
                                  <label for="supplier_name" class=" col-10 control-label">&nbsp;&nbsp;{{__("supplier Name")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" data-toggle="modal" data-target="#product-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                      </span>
                                    </div>
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="supplier_name" id="suppliercodesearch" placeholder="Supplier Name" class="form-control suppliercodesearch"  />
                                      {{-- <select required name="supplier_name" id="supplier_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 100px">
                                        @foreach($suppliers as $supplier)
                                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'supplier_name'])
                                  </div>
                                </div>
                              </div>
                              <div class=" col-6 ">
                                <div class="form-group">
                                  <label for="supplier_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Supplier Code")}}</label>
                                  <div class=" col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                      </span>
                                    </div>
                                    <input type="hidden" name="supplier_code_hidden" value="supplier_code">
                                    {{-- <div class="input-group pos"> --}}
                                      <input type="text" name="supplier_code" id="suppliercodeSearch" placeholder="Supplier Code" class="form-control"  />
                                      {{-- <select required name="supplier_code" id="supplier_code" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 100px">
                                        @foreach($suppliers as $supplier)
                                          <option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                                        @endforeach
                                      </select> --}}
                                    {{-- </div> --}}
                                    @include('alerts.feedback', ['field' => 'supplier_code'])
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
                                            @foreach($suppliers as $key => $value)
                                            <tr>
                                              <td>{{ $value->supplier_ref_no }}</td>
                                              <td>{{ $value->supplier_name }}</td>
                                              <td>{{ $value->status_id }}</td>
                                              <td class="text-right">
                                                <a type="button" href="{{ route('supplier.edit', ['supplier' => $value->supplier_id,]) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="+" title="+">
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
              <div class="card-footer-custom row">
                <div class="col-sm-10 col-6">
                  <button type="button" class="btn btn-secondary btn-round ">{{__('Back')}}</button>
                </div>
                <div class="col-sm-10 col-6">
                  <button type="submit" class="btn btn-info btn-round pull-right">{{__('Save')}}</button>
                </div>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')

<script type="text/javascript">

  var total_items = [];
  var total_quantity = [];
  var total_discount = [];
  var subtotal_amount = [];
  var grandtotal_amount;
  var purchase_free_amount;
  var purchase_add_amount;
  var i = 1;
  // var productArray = [];
  var product_code = [];
  var product_name = [];
  var product_qty = [];
  var product_type = [];
  var product_id = [];
  var product_list = [];
  var qty_list = [];

  // array data with selection
  var product_price = [];
  var product_discount = [];
  var unit_name = [];
  var unit_operator = [];
  var unit_operation_value = [];
  // temporary array
  var temp_unit_name = [];
  var temp_unit_operator = [];
  var temp_unit_operation_value = [];

  var rowindex;
  var customer_sale_rate;
  var row_product_price;
  var pos;
  // <?php $productArray = []; ?>

  // $(document).ready(function() {
  //   // $('.js-example-basic-single').select2();
  //   $('#product_code_name5').select2({
  //     theme: 'classic'
  //   });
  // });
  // $(document).ready(function() {
    
  //   $(document).on('focusout', '#product_code_name4', function(e){
  //     var search_data = this.value;
  //     $.ajax({
  //         type: 'GET',
  //         url: 'searchproduct',
  //         data: {
  //             data: search_data
  //       },
  //       success:function(data) {
  //         var product_id = data[0]["product_id"];
  //         var status_id = data[0]["status_id"];
  //         // var product_name = data[0]["product_name"];
  //         // $.each( data, function ( i, id ) {
  //         //   $('table tbody').append('<tr class="row prtr"><td class="col-2 firstcol">'+data[i].product_barcode+'</td><td class="col-3 mycol">'+data[i].product_name+'</td><td class="col-1 mycol">'+data[i].product_pieces_total+'</td><td class="col-1 mycol">'+data[i].product_packets_total+'</td><td class="col-1 mycol">'+data[i].product_cartons_total+'</td><td class="col-1 mycol">'+data[i].product_trade_price_piece+'</td><td class="col-1 mycol">'+data[i].product_state+'</td><td class="col-1 mycol">'+data[i].product_pieces_total*data[i].product_trade_price_piece+'</td><td class="col-1 lastcol" align="center">  <button type="button" href="{{ route('purchase.create', ['purchase' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="X" title="X">    <i class="fa fa-times"></i>  </button></td></tr>');
  //         //   // $('table tbody').append('<tr class="row prtr"><td class="col-2 firstcol">{{ $value->product_barcode }}</td><td class="col-3 mycol">{{ $value->product_name }}</td><td class="col-1 mycol">{{ $value->product_pieces_total }}</td><td class="col-1 mycol">{{ $value->product_packets_total }}</td><td class="col-1 mycol">{{ $value->product_cartons_total }}</td><td class="col-1 mycol">{{ $value->product_trade_price_piece }}</td><td class="col-1 mycol">{{ $value->product_state }}</td><td class="col-1 mycol">{{ $value->product_pieces_total*$value->product_trade_price_piece }}</td><td class="col-1 lastcol" align="center">  <button type="button" href="{{ route('purchase.destroy', ['purchase' => 1,]) }}" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="X" title="X">    <i class="fa fa-times"></i>  </button></td></tr>');
  //         // });
  //         $('#product_name option').removeAttr('selected');
  //         // $('#product_name option[value='+product_id+']').removeAttr('selected');
  //         $('#product_name option[value='+product_id+']').attr('selected', 'selected');
  //         $('#product_name option[value='+product_id+']').attr('status_id', status_id);
  //       }
  //     });
  //   });

  //   function productSearch(data) {
  //     // $.ajax({
  //     //     type: 'GET',
  //     //     url: 'searchproduct',
  //     //     data: {
  //     //         data: data
  //     //     },
  //     //     success: function(data) {
  //     //       console.log(data);
  //     //       var flag = 1;
  //     //       $(".product-code").each(function(i) {
  //     //           if ($(this).val() == data[1]) {
  //     //               rowindex = i;
  //     //               var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
  //     //               $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
  //     //               checkQuantity(String(qty), true);
  //     //               flag = 0;
  //     //           }
  //     //       });
  //     //       $("input[name='product_code_name6']").val('');
  //     //       // if(flag){
  //     //       //     var newRow = $("<tr>");
  //     //       //     var cols = '';
  //     //       //     temp_unit_name = (data[6]).split(',');
  //     //       //     cols += '<td>' + data[0] + '</td>';
  //     //       //     cols += '<td>' + data[1] + '</td>';
  //     //       //     cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" step="any" required/></td>';
  //     //       //     cols += '<td><input type="number" class="form-control qty" name="pkt[]" value="1" step="any" /></td>';
  //     //       //     cols += '<td><input type="number" class="form-control qty" name="crt[]" value="1" step="any" /></td>';
  //     //       //     cols += '<td class="net_unit_price"></td>';
  //     //       //     cols += '<td class="discount">0.00</td>';
  //     //       //     cols += '<td class="sub-total"></td>';
  //     //       //     cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
  //     //       //     cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
  //     //       //     cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
  //     //       //     cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
  //     //       //     cols += '<input type="hidden" class="discount-value" name="discount[]" />';
  //     //       //     cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';
                
  //     //       //     // name="purchase_total_items"
  //     //       //     // name="purchase_total_qty"
  //     //       //     // name="purchase_free_piece"
  //     //       //     // name="purchase_free_amount"
  //     //       //     // name="purchase_total_price"
  //     //       //     // name="purchase_add_amount"
  //     //       //     // name="purchase_discount"
  //     //       //     // name="purchase_grandtotal_price"
  //     //       //     // name="purchase_amount_recieved"

  //     //       //     newRow.append(cols);
  //     //       //     $("table.order-list tbody").append(newRow);

  //     //       //     pos = product_code.indexOf(data[1]);
  //     //       //     if(!data[11] && product_warehouse_price[pos]) {
  //     //       //         product_price.push(parseFloat(product_warehouse_price[pos] * currency['exchange_rate']) + parseFloat(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate));
  //     //       //     }
  //     //       //     else {
  //     //       //         product_price.push(parseFloat(data[2]));
  //     //       //     }
  //     //       //     product_discount.push('0.00');
  //     //       //     // unit_name.push(data[6]);
  //     //       //     // unit_operator.push(data[7]);
  //     //       //     // unit_operation_value.push(data[8]);
  //     //       //     rowindex = newRow.index();
  //     //       //     checkQuantity(1, true);
  //     //       // }
  //     //     }
  //     // });
  //   }

  //   function calculateRowProductData(quantity) {
  //     // $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(6)').text((product_discount[rowindex] * quantity).toFixed(2));
  //     // $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed(2));
  //     // if (tax_method[rowindex] == 1) {
  //     //     var net_unit_price = row_product_cost - product_discount[rowindex];
  //     //     var sub_total = (net_unit_price * quantity);

  //     //     $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(5)').text(net_unit_price.toFixed(2));
  //     //     $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
  //     //     $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(8)').text(sub_total.toFixed(2));
  //     //     $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
  //     // }
  //     // calculateTotal();
  //   }

  //   // function calculateTotal() {
  //   //   // //Sum of quantity
  //   //   // var total_qty = 0;
  //   //   // $(".qty").each(function() {

  //   //   //     if ($(this).val() == '') {
  //   //   //         total_qty += 0;
  //   //   //     } else {
  //   //   //         total_qty += parseFloat($(this).val());
  //   //   //     }
  //   //   // });
  //   //   // $("#total-qty").text(total_qty);
  //   //   // $('input[name="total_qty"]').val(total_qty);

  //   //   // //Sum of discount
  //   //   // var total_discount = 0;
  //   //   // $(".discount").each(function() {
  //   //   //     total_discount += parseFloat($(this).text());
  //   //   // });
  //   //   // $("#total-discount").text(total_discount.toFixed(2));
  //   //   // $('input[name="total_discount"]').val(total_discount.toFixed(2));

  //   //   // //Sum of subtotal
  //   //   // var total = 0;
  //   //   // $(".sub-total").each(function() {
  //   //   //     total += parseFloat($(this).text());
  //   //   // });
  //   //   // $("#total").text(total.toFixed(2));
  //   //   // $('input[name="total_cost"]').val(total.toFixed(2));

  //   //   // calculateGrandTotal();
  //   // }

  //   function calculateGrandTotal() {
  //     //   var item = $('table.order-list tbody tr:last').index();

  //     //   var total_qty = parseFloat($('#total-qty').text());
  //     //   var subtotal = parseFloat($('#total').text());
  //     //   var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
  //     //   var order_discount = parseFloat($('input[name="order_discount"]').val());
  //     //   var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());

  //     //   if (!order_discount)
  //     //       order_discount = 0.00;
  //     //   if (!shipping_cost)
  //     //       shipping_cost = 0.00;

  //     //   item = ++item + '(' + total_qty + ')';
  //     //   order_tax = (subtotal - order_discount) * (order_tax / 100);
  //     //   var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

  //     //   $('#item').text(item);
  //     //   $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
  //     //   $('#subtotal').text(subtotal.toFixed(2));
  //     //   $('#order_tax').text(order_tax.toFixed(2));
  //     //   $('input[name="order_tax"]').val(order_tax.toFixed(2));
  //     //   $('#order_discount').text(order_discount.toFixed(2));
  //     //   $('#shipping_cost').text(shipping_cost.toFixed(2));
  //     //   $('#grand_total').text(grand_total.toFixed(2));
  //     //   $('input[name="grand_total"]').val(grand_total.toFixed(2));
  //   }

  // });

</script>

<script>
  $(document).on('click', '#add_button', function(e){
    var product_barcode = $('#purchase_products_barcode_i').val();
    // var product_barcode2 = $('#product_barcode2').val();
    var product_name = $('#product_name_i').val();
    var product_ref = $('#product_code_i').val();
    var product_id = $('#product_id_i').val();
    // var product_namecode = product_name+product_ref;
    product_ref = product_name.split(',')[1];
    product_name = product_name.split(',')[0];
    var product_pieces = $('#purchase_products_pieces_i').val();
    var product_packets = $('#purchase_products_packets_i').val();
    var product_cartons = $('#purchase_products_cartons_i').val();
    var product_unit_price = $('#purchase_products_unit_price_i').val();
    var product_discount = $('#purchase_products_discount_i').val();
    var pieces_per_carton = $('#pieces_per_carton').val();
    var pieces_per_packet = $('#pieces_per_packet').val();
    var packets_per_carton = $('#packets_per_carton').val();
    purchase_free_amount = $('#purchase_free_amount').val();
    purchase_add_amount = $('#purchase_add_amount').val();

    var product_quantity = Number(product_pieces)+(product_packets*pieces_per_packet)+(product_cartons*pieces_per_carton);
    if(product_quantity == 0 || product_unit_price == 0){
      product_discount = 0;
      product_unit_price = 0;
    }

    total_items = Number(total_items) + 1;
    total_quantity = Number(total_quantity) + (Number(product_quantity));
    total_discount = Number(total_discount) + Number(product_discount);
    // var product_sub_total = $('#purchase_products_sub_total').val();

    var product_sub_total = product_unit_price*(Number(product_quantity))-Number(product_discount);
    if(product_quantity == 0){
      product_sub_total = 0;
    }
    subtotal_amount = Number(subtotal_amount) + Number(product_sub_total);
    grandtotal_amount = Number(subtotal_amount) + Number(purchase_free_amount) + Number(purchase_add_amount);

    if(product_name !== "" && product_quantity !== 0 ){
      $('.purchase-product').append('<tr class="row prtr"><td class="col-2 firstcol" scope="col"><input readonly type="text" name="purchase_products_barcode[]" id="purchase_products_barcode'+i+'" class="form-control col-12" placeholder="Scan/Search barcode" value='+product_barcode+'></td><td class="col-3 mycol" scope="col"><input readonly type="text" name="product_name[]" id="product_name'+i+'" class="form-control col-12" placeholder="Search product by name/code" value="'+product_name+'"><input readonly type="hidden" name="product_code[]" id="product_code'+i+'" class="form-control col-12" value='+product_ref+'><input readonly type="hidden" name="product_id[]" id="product_id'+i+'" class="form-control col-12" value='+product_id+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="purchase_products_pieces[]" id="purchase_products_pieces'+i+'" class="form-control col-12" value='+product_pieces+'><input readonly type="hidden" name="purchase_pieces_per_packet[]" id="purchase_pieces_per_packet'+i+'" class="form-control col-12" value='+pieces_per_packet+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="purchase_products_packets[]" id="purchase_products_packets'+i+'" class="form-control col-12" value='+product_packets+'></td><td class="col-1 mycol" scope="col"><input readonly type="number" name="purchase_products_cartons[]" id="purchase_products_cartons'+i+'" class="form-control col-12" value='+product_cartons+'><input readonly type="hidden" name="purchase_pieces_per_carton[]" id="purchase_pieces_per_carton'+i+'" class="form-control col-12" value='+pieces_per_carton+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="purchase_products_unit_price[]" id="purchase_products_unit_price'+i+'" class="form-control col-12"  value='+product_unit_price+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="purchase_products_discount[]" id="purchase_products_discount'+i+'" class="form-control col-12"  value='+product_discount+'></td><td class="col-1 mycol" scope="col"><input readonly type="text" name="purchase_products_sub_total[]" id="purchase_products_sub_total'+i+'" class="form-control col-12"  value='+product_sub_total+'></td><td class="col-1 lastcol" align="center"><button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm delete-productfield" id="delete-productfield'+i+'" row-id="'+i+'" data-original-title="X" title="X"><i class="fa fa-times"></i></button></td></tr>');
      i++;
      $('#purchase_total_qty').val('');
      $('#purchase_total_qty').val(total_quantity);
      $('#purchase_total_items').val('');
      $('#purchase_total_items').val(total_items);
      // $('#purchase_free_price').val('');
      // $('#purchase_free_price').val();
      $('#purchase_total_price').val('');
      $('#purchase_total_price').val(subtotal_amount);
      $('#purchase_discount').val('');
      $('#purchase_discount').val(total_discount);
      $('#purchase_grandtotal_price').val('');
      $('#purchase_grandtotal_price').val(grandtotal_amount);
    }

  });
  $(document).on('change', "#purchase_add_amount", function(e){
    grandtotal_amount = Number(grandtotal_amount) - Number(purchase_add_amount);
    purchase_add_amount = $('#purchase_add_amount').val();
    grandtotal_amount = Number(grandtotal_amount) + Number(purchase_add_amount);
    $('#purchase_grandtotal_price').val('');
    $('#purchase_grandtotal_price').val(grandtotal_amount);
  });
  $(document).on('change', "#purchase_free_amount", function(e){
    grandtotal_amount = Number(grandtotal_amount) + Number(purchase_free_amount);
    purchase_free_amount = $('#purchase_free_amount').val();
    grandtotal_amount = Number(grandtotal_amount) - Number(purchase_free_amount);
    $('#purchase_grandtotal_price').val('');
    $('#purchase_grandtotal_price').val(grandtotal_amount);
  });
  $(document).on('click', ".delete-productfield", function(event) {
    rowid = $(this).attr('row-id');
    thisproduct_discount = $('#purchase_products_discount'+rowid).val();
    thisproduct_sub_total = $('#purchase_products_sub_total'+rowid).val();
    thisproduct_pieces = $('#purchase_products_pieces'+rowid).val();
    thisproduct_packets = $('#purchase_products_packets'+rowid).val();
    thisproduct_cartons = $('#purchase_products_cartons'+rowid).val();
    thispieces_per_packet = $('#purchase_pieces_per_packet'+rowid).val();
    thispieces_per_carton = $('#purchase_pieces_per_carton'+rowid).val();

    // rowindex = $(this).closest('tr').index();
    var my_total_qty = this.value;
    total_quantity = Number(total_quantity) - (Number(thisproduct_pieces)+(thisproduct_packets*thispieces_per_packet)+(thisproduct_cartons*thispieces_per_carton));
    total_items = Number(total_items) - 1;
    total_discount = Number(total_discount) - Number(thisproduct_discount);
    // var product_sub_total = $('#purchase_products_sub_total').val();
    subtotal_amount = Number(subtotal_amount) - Number(thisproduct_sub_total);
    grandtotal_amount = Number(grandtotal_amount) - Number(thisproduct_sub_total);

    $('#purchase_total_qty').val('');
    $('#purchase_total_qty').val(total_quantity);
    $('#purchase_total_items').val('');
    $('#purchase_total_items').val(total_items);
    $('#purchase_discount').val('');
    $('#purchase_discount').val(total_discount);
    $('#purchase_total_price').val('');
    $('#purchase_total_price').val(subtotal_amount);
    $('#purchase_grandtotal_price').val('');
    $('#purchase_grandtotal_price').val(grandtotal_amount);

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

  function calculateTotal() {
    // //Sum of quantity
    // var total_qty = 0;
    // $(".qty").each(function() {

    //     if ($(this).val() == '') {
    //         total_qty += 0;
    //     } else {
    //         total_qty += parseFloat($(this).val());
    //     }
    // });
    // $("#total-qty").text(total_qty);
    // $('input[name="total_qty"]').val(total_qty);

    // //Sum of discount
    // var total_discount = 0;
    // $(".discount").each(function() {
    //     total_discount += parseFloat($(this).text());
    // });
    // $("#total-discount").text(total_discount.toFixed(2));
    // $('input[name="total_discount"]').val(total_discount.toFixed(2));

    // //Sum of subtotal
    // var total = 0;
    // $(".sub-total").each(function() {
    //     total += parseFloat($(this).text());
    // });
    // $("#total").text(total.toFixed(2));
    // $('input[name="total_cost"]').val(total.toFixed(2));

    // calculateGrandTotal();
  }
    
  var productsnames_array = <?php echo json_encode($nameArray); ?>;
  var productsnamescodes_array = <?php echo json_encode($namecodeArray); ?>;

  $("#product_name_i").on('focus', function () {
    // $( "product_name" ).autocomplete({
    $(this).autocomplete({
      source: productsnamescodes_array,
      autoFocus:true,
      minLength: 0,
      // select: $('#purchase_product_barcode').val();
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
        url: "{{ route('searchproduct')  }}",
        data: {
            data: data,
            // '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          var catchbarcode = data[0]['product_barcode'];
          var catchproduct_code = data[0]['product_ref_no'];
          var catchproduct_id = data[0]['product_id'];
          var pieces_per_carton = data[0]['product_piece_per_carton'];
          var pieces_per_packet = data[0]['product_piece_per_packet'];
          var packets_per_carton = data[0]['product_packet_per_carton'];
          // console.log(total_items);
          $('#purchase_products_barcode_i').val('');
          $('#purchase_products_barcode_i').val(catchbarcode);
          $('#product_code_i').val('');
          $('#product_code_i').val(catchproduct_code);
          $('#product_id_i').val('');
          $('#product_id_i').val(catchproduct_id);
          $('#pieces_per_carton').val('');
          $('#pieces_per_carton').val(pieces_per_carton);
          $('#pieces_per_packet').val('');
          $('#pieces_per_packet').val(pieces_per_packet);
          $('#packets_per_carton').val('');
          $('#packets_per_carton').val(packets_per_carton);
          // $('#product_barcode2').val(data[0]['product_barcode']);
        }
    });
  }

  var suppliersnames_array = <?php echo json_encode($snameArray); ?>;
  var suppliersnamescodes_array = <?php echo json_encode($snamecodeArray); ?>;

  $("#suppliercodesearch").on('focus', function () {
    // $("#suppliercodesearch" ).autocomplete({
    $(this).autocomplete({
      source: suppliersnamescodes_array,
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
          console.log(data);
          supplierSearch(data);
      }
    }).on('click', function(event) {  
            // $(this).trigger('keydown.autocomplete');
            $(this).autocomplete("search", $(this).val());
            // .focus(function(){
    });
  });

  function supplierSearch(data){
    $.ajax({
      url: 'searchsupplier',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["supplier_id"]);
        var supplier_id = data[0]["supplier_id"];
        var supplier_name = data[0]["supplier_name"];
        var status_id = data[0]["status_id"];
        var supplier_balance_paid = data[0]["supplier_balance_paid"];
        var supplier_balance_dues = data[0]["supplier_balance_dues"];
        var supplier_total_balance = data[0]["supplier_total_balance"];
        // $('#supplier_name option').removeAttr('selected');
        // // $('#supplier_name option[value='+supplier_id+']').removeAttr('selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('selected', 'selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('status_id', status_id);
        $('#supplier_name').val(supplier_name);
        $('#supplier_id').val(supplier_id);
        if(status_id == 1){
        $('#supplier_status').val('Active');
        }
        // else{
        //   $('#supplier_status').val('Inactive');
        // }
        $('#supplier_balance_paid').val(supplier_balance_paid);
        $('#supplier_balance_dues').val(supplier_balance_dues);
        // $('#supplier_total_balance').val(supplier_total_balance);
      }
    });
  }

  $(document).on('change', '#supplier_name', function(e){
    var status = $('option:selected', this).attr('status_id');
    e.preventDefault();
    // $('#supplier_status').val(status);
    if(status == 1){
      $('#supplier_status').val('Active');
    }
    // else{
    //   $('#supplier_status').val('Inactive');
    // }
  });
    // $(document).on('focusout', '#suppliercodesearch', function(e){
    //   var data = this.value;
    //   $.ajax({
    //     url: 'searchsupplier',
    //     type: "GET",
    //     data: {
    //       data: data,
    //     },
    //     success:function(data) {
    //       // alert(data[0]["supplier_id"]);
    //       var supplier_id = data[0]["supplier_id"];
    //       var status_id = data[0]["status_id"];
    //       $('#supplier_name option').removeAttr('selected');
    //       // $('#supplier_name option[value='+supplier_id+']').removeAttr('selected');
    //       $('#supplier_name option[value='+supplier_id+']').attr('selected', 'selected');
    //       $('#supplier_name option[value='+supplier_id+']').attr('status_id', status_id);
    //       if(status_id == 1){
    //       $('#supplier_status').val('Active');
    //       }
    //       // else{
    //       //   $('#supplier_status').val('Inactive');
    //       // }
    //     }
    //   });
    // });

</script>

@endsection

