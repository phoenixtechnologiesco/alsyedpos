@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Party Balance Sheet")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('sale.store') }}" autocomplete="off" enctype="multipart/form-data">
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
                                {{-- <input type="hidden" name="customer_code" id="allcustomers" class="form-control col-12"  /> --}}
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
                        <div class="form-col-3">
                          <div class="form-group">
                            <label readonly for="sale_customer_name" class="form-col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                            <div class="form-col-12 input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text barcode">
                                  <a class="" data-toggle="modal" data-target="#customer-list" id="product-list-btn"><i class="fa fa-user"></i></a>
                                </span>
                              </div>
                              {{-- <div class="input-group pos"> --}}
                                <input readonly type="text" name="sale_customer_name" id="customer_name" placeholder="Customer Name" class="form-control col-12" value="" />
                                <input readonly type="hidden" name="sale_customer_id" id="customer_id" class="form-control col-12" value="0" />
                                <?php $cust = 0 ; ?>
                             
                                {{-- <select readonly required name="sale_customer_name" id="customer_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 150px">
                                  @foreach($customers as $single_customer)
                                    <option status_id="{{$single_customer->status_id}}" value="{{$single_customer->customer_id}}">{{$single_customer->customer_name}}</option>
                                  @endforeach
                                </select> --}}
                              {{-- </div> --}}
                              @include('alerts.feedback', ['field' => 'sale_customer_name'])
                            </div>
                          </div>
                        </div>
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
                            <label for="sale_amount_paid" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Amount Paid")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="sale_amount_paid" id="customer_balance_paid" class="form-control" value="{{ old('sale_amount_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'sale_amount_paid'])
                            </div>
                          </div>
                        </div>
                        <div class="form-last-col-2">
                          <div class="form-group">
                            <label for="sale_amount_dues" class="form-col-12 control-label">&nbsp;&nbsp;{{__(" Customer Dues")}}</label>
                            <div class="form-col-12 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input readonly type="number" name="sale_amount_dues" id="customer_balance_dues" class="form-control" value="{{ old('sale_amount_dues', '') }}">
                              @include('alerts.feedback', ['field' => 'sale_amount_dues'])
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
                          <div class="table-responsive-custom" style="overflow-x:hidden">
                            <table id="myTable" class="table table-hover table-striped table-fixed table-bordered">
                              <thead class="thead-dark">
                                <tr class="row thead-dark-custom">
                                  <th class="col-1 firstcol text-center">Invoice #</th>
                                  <th class="col-1 mycol text-center"  >Invoice Date</th>
                                  <th class="col-2 mycol text-center"  >Sale</th>
                                  <th class="col-2 mycol text-center"  >Payment</th>
                                  <th class="col-2 mycol text-center"  >Return</th>
                                  <th class="col-1 mycol text-center"  >Method</th>
                                  <th class="col-1 mycol text-center"  >!</th>
                                  <th class="col-1 mycol text-center"  >Adjustment</th>
                                  <th class="col-1 lastcol text-center" >Balance Amount</th>
                                </tr>
                              </thead>
                              <tbody class="customer-payments">
                                {{-- @foreach ($payments as $key => $value)
                                  @if($value->payment_customer_id == $cust)
                                  <tr class="row table-info">
                                    <td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td>
                                    <td class="col-2 mycol text-center"   >{{ "abc" }}</td>
                                    <td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td>
                                    <td class="col-2 mycol text-center"   >{{ "abc" }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td>
                                    <td class="col-1 mycol text-center"   >{{ "abc" }}</td> 
                                    <td class="col-1 lastcol text-center" >{{ $value->customer_amount_dues }}</td>
                                  </tr>
                                  @endif
                                @endforeach --}}
                              </tbody>
                            </table>
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
              <div class="card-footer row">
                <div class=" form-col-12">
                  <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
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
  // $("#customer_id").on('change', function () {
  $(document).on('change', '#customer_id', function(e){
    customer_id = $(this).val();
    $('.customer-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->customer_amount_dues }}</td></tr>');
 
    // console.log($cust);
  });
</script>

<script type="text/javascript">

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
      url: 'searchcustomerpayments',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["customer_id"]);
        var customer_id = data['customer'][0]["customer_id"];
        var customer_name = data['customer'][0]["customer_name"];
        var status_id = data['customer'][0]["status_id"];
        var customer_balance_paid = data['customer'][0]["customer_balance_paid"];
        var customer_balance_dues = data['customer'][0]["customer_balance_dues"];
        var customer_total_balance = data['customer'][0]["customer_total_balance"];
        var customer_credit_duration = data['customer'][0]["customer_credit_duration"];
        var customer_credit_type = data['customer'][0]["customer_credit_type"];
        // $('#customer_name option').removeAttr('selected');
        // // $('#customer_name option[value='+customer_id+']').removeAttr('selected');
        // $('#customer_name option[value='+customer_id+']').attr('selected', 'selected');
        // $('#customer_name option[value='+customer_id+']').attr('status_id', status_id);
        $('#customer_name').val(customer_name);
        $('#customer_id').val(customer_id);

        $('.customer-payments').html(data['payments']);
        // $('.customer-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->customer_amount_dues }}</td></tr>');
        if(status_id == 1){
        $('#customer_status').val('Active');
        }
        // else{
        //   $('#customer_status').val('Inactive');
        // }
        $('#customer_balance_paid').val(customer_balance_paid);
        $('#customer_balance_dues').val(customer_balance_dues);
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

</script>

@endsection
