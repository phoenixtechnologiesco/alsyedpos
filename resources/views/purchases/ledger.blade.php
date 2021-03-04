@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Ledger Sheet")}}</h5>
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
                                <input readonly type="hidden" name="purchase_supplier_id" id="supplier_id" class="form-control col-12" value="0" />
                                <?php $cust = 0 ; ?>
                             
                                {{-- <select readonly required name="purchase_supplier_name" id="supplier_name" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select supplier..." style="width: 150px">
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
                            <label for="supplier_status" class="form-col-12 control-label">{{__(" Supplier Status")}}</label>
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
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <div class=" col-12">
                          <div class="table-responsive-custom" style="overflow-x:hidden">
                            <table id="myTable" class="table table-hover table-striped table-fixed table-bordered" cellspacing="0" width="100%">
                              <thead class="thead-dark">
                                <tr class="row thead-dark-custom">
                                  <th class="col-1 firstcol text-center">Invoice #</th>
                                  <th class="col-1 mycol text-center"  >Invoice Date</th>
                                  <th class="col-2 mycol text-center"  >Purchase</th>
                                  <th class="col-2 mycol text-center"  >Payment</th>
                                  <th class="col-2 mycol text-center"  >Return</th>
                                  <th class="col-1 mycol text-center"  >Method</th>
                                  <th class="col-1 mycol text-center"  >!</th>
                                  <th class="col-1 mycol text-center"  >Cheque #</th>
                                  <th class="col-1 lastcol text-center" >Balance Amount</th>
                                </tr>
                              </thead>
                              <tbody class="supplier-payments">
                                {{-- @foreach ($payments as $key => $value)
                                  @if($value->payment_supplier_id == $cust)
                                  <tr class="row table-info">
                                    <td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td>
                                    <td class="col-2 mycol text-center"   >{{ "abc" }}</td>
                                    <td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td>
                                    <td class="col-2 mycol text-center"   >{{ "abc" }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td>
                                    <td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td>
                                    <td class="col-1 mycol text-center"   >{{ "abc" }}</td> 
                                    <td class="col-1 lastcol text-center" >{{ $value->supplier_amount_dues }}</td>
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
                        <h5 id="exampleModalLabel" class="modal-title">suppliers List</h5>
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
                                    <input type="text" name="supplier_name" id="suppliercodesearch" placeholder="supplier Name" class="form-control suppliercodesearch"  />
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
                                <label for="supplier_code" class=" col-10 control-label">&nbsp;&nbsp;{{__(" supplier Code")}}</label>
                                <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text barcode">
                                      <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                    </span>
                                  </div>
                                  <input type="hidden" name="supplier_code_hidden" value="supplier_code">
                                  {{-- <div class="input-group pos"> --}}
                                    <input type="text" name="supplier_code" id="suppliercodeSearch" placeholder="supplier Code" class="form-control"  />
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
  // $("#supplier_id").on('change', function () {
  $(document).on('change', '#supplier_id', function(e){
    supplier_id = $(this).val();
    $('.supplier-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->supplier_amount_dues }}</td></tr>');
 
    // console.log($cust);
  });
</script>

<script type="text/javascript">

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
      url: 'searchsupplierpayments',
      type: "GET",
      data: {
        data: data,
      },
      success:function(data) {
        // alert(data[0]["supplier_id"]);
        var supplier_id = data['supplier'][0]["supplier_id"];
        var supplier_name = data['supplier'][0]["supplier_name"];
        var status_id = data['supplier'][0]["status_id"];
        var supplier_balance_paid = data['supplier'][0]["supplier_balance_paid"];
        var supplier_balance_dues = data['supplier'][0]["supplier_balance_dues"];
        var supplier_total_balance = data['supplier'][0]["supplier_total_balance"];
        var supplier_credit_duration = data['supplier'][0]["supplier_credit_duration"];
        var supplier_credit_type = data['supplier'][0]["supplier_credit_type"];
        // $('#supplier_name option').removeAttr('selected');
        // // $('#supplier_name option[value='+supplier_id+']').removeAttr('selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('selected', 'selected');
        // $('#supplier_name option[value='+supplier_id+']').attr('status_id', status_id);
        $('#supplier_name').val(supplier_name);
        $('#supplier_id').val(supplier_id);

        $('.supplier-payments').html(data['payments']);
        // $('.supplier-payments').html('<tr class="row table-info"><td class="col-1 firstcol text-center">{{ $value->payment_invoice_id }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_invoice_date }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-2 mycol text-center"   >{{ $value->payment_amount_paid }}</td><td class="col-2 mycol text-center"   >{{ "abc" }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_method }}</td><td class="col-1 mycol text-center"   >{{ $value->payment_type }}</td><td class="col-1 mycol text-center"   >{{ "abc" }}</td> <td class="col-1 lastcol text-center" >{{ $value->supplier_amount_dues }}</td></tr>');
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

</script>

@endsection
