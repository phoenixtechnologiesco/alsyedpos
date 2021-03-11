@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Product")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('product.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
              @include('alerts.success')
              <div class="row">
                <div class="card-body-custom col-6">
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="warehouse_id" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Warehouse")}}</label>
                        <div class=" col-12">
                          {{-- <input type="text" name="warehouse_id" class="form-control col-12" value="{{ old('warehouse_id', '') }}">
                          @include('alerts.feedback', ['field' => 'warehouse_id']) --}}
                          <select name="warehouse_id" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                            {{-- <option selected value="NULL">Select</option> --}}
                          @foreach($warehouses as $single_warehouse)
                            <option value="{{ $single_warehouse->warehouse_id }}">{{ $single_warehouse->warehouse_name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_name" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Product Name")}}</label>
                        <div class=" col-12">
                          <input type="text" name="product_name" class="form-control col-12" value="{{ old('product_name', '') }}">
                          @include('alerts.feedback', ['field' => 'product_name'])
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_ref_no" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Reference No.")}}</label>
                          <div class=" col-12">
                            <input type="text" name="product_ref_no" class="form-control col-12" value="{{ old('product_ref_no', '') }}">
                            @include('alerts.feedback', ['field' => 'product_ref_no'])
                          </div>
                      </div>
                    </div>
                    {{-- <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_barcode" class=" col-10 control-label">&nbsp;&nbsp;{{__(" General Barcode")}}</label>
                            <div class=" col-12">
                              <input type="text" name="product_barcode" class="form-control col-12" value="{{ old('product_barcode', '') }}">
                              @include('alerts.feedback', ['field' => 'product_barcode'])
                            </div>
                        </div>
                    </div> --}}
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_company" class=" col-6 control-label">&nbsp;&nbsp;{{__(" Company")}}</label>
                            <div class=" col-12">
                              {{-- <input type="text" name="product_company" class="form-control col-12" value="{{ old('product_company', '') }}">
                              @include('alerts.feedback', ['field' => 'product_company']) --}}
                              <select name="product_company" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Company...">
                                <option selected value="NULL">Select</option>
                              @foreach($companies as $single_company)
                                <option value="{{ $single_company->company_name }}">{{ $single_company->company_name }}</option>
                              @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_brand" class=" col-6 control-label">&nbsp;&nbsp;{{__(" Brand")}}</label>
                            <div class=" col-12">
                              {{-- <input type="text" name="product_brand" class="form-control col-12" value="{{ old('product_brand', '') }}">
                              @include('alerts.feedback', ['field' => 'product_brand']) --}}
                              <select name="product_brand" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                <option selected value="NULL">Select</option>
                              @foreach($brands as $single_brand)
                                <option value="{{ $single_brand->brand_name }}">{{ $single_brand->brand_name }}</option>
                              @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                  </div>
                    <hr style="width:80%;text-align:right;margin-left:5">
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_quantity_total" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Total Quantity")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_quantity_total" class="form-control col-12" value="{{ old('product_quantity_total', '') }}">
                              @include('alerts.feedback', ['field' => 'product_quantity_total'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_quantity_available" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Available Quantity")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_quantity_available" class="form-control col-12" value="{{ old('product_quantity_available', '') }}">
                              @include('alerts.feedback', ['field' => 'product_quantity_available'])
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_damage_quantity" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Damage Quantity")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_damage_quantity" class="form-control col-12" value="{{ old('product_damage_quantity', '') }}">
                              @include('alerts.feedback', ['field' => 'product_damage_quantity'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_alert_quantity" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Alert Quantity")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_alert_quantity" class="form-control col-12" value="{{ old('product_alert_quantity', '') }}">
                            @include('alerts.feedback', ['field' => 'product_alert_quantity'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_pieces_total" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Total Pieces")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_pieces_total" class="form-control col-12" value="{{ old('product_pieces_total', '') }}">
                            @include('alerts.feedback', ['field' => 'product_pieces_total'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_pieces_available" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Available Pieces")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_pieces_available" class="form-control col-12" value="{{ old('product_pieces_available', '') }}">
                            @include('alerts.feedback', ['field' => 'product_pieces_available'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_packets_total" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Total Packets")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_packets_total" class="form-control col-12" value="{{ old('product_packets_total', '') }}">
                            @include('alerts.feedback', ['field' => 'product_packets_total'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_packets_available" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Available Packets")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_packets_available" class="form-control col-12" value="{{ old('product_packets_available', '') }}">
                            @include('alerts.feedback', ['field' => 'product_packets_available'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_cartons_total" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Total Cartons")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_cartons_total" class="form-control col-12" value="{{ old('product_cartons_total', '') }}">
                              @include('alerts.feedback', ['field' => 'product_cartons_total'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_cartons_available" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Available Cartons")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_cartons_available" class="form-control col-12" value="{{ old('product_cartons_available', '') }}">
                            @include('alerts.feedback', ['field' => 'product_cartons_available'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_piece_per_packet" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Pieces Per Packet")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_piece_per_packet" class="form-control col-12" value="{{ old('product_piece_per_packet', '') }}">
                              @include('alerts.feedback', ['field' => 'product_piece_per_packet'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_piece_per_carton" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Pieces Per Carton")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_piece_per_carton" class="form-control col-12" value="{{ old('product_piece_per_carton', '') }}">
                            @include('alerts.feedback', ['field' => 'product_piece_per_carton'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_packet_per_carton" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Packets Per Carton")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_packet_per_carton" class="form-control col-12" value="{{ old('product_packet_per_carton', '') }}">
                            @include('alerts.feedback', ['field' => 'product_packet_per_carton'])
                          </div>
                      </div>
                    </div>
                    {{-- <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_unit" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Product Unit")}}</label>
                          <div class=" col-12">
                            <input type="text" name="product_unit" class="form-control col-12" value="{{ old('product_unit', '') }}">
                            @include('alerts.feedback', ['field' => 'product_unit'])
                          </div>
                      </div>
                    </div> --}}
                  </div>
                  {{-- <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_expirydate" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Expiry Date")}}</label>
                        <div class=" col-12">
                          <input type="date" name="product_expirydate" class="form-control col-12" value="{{ old('product_expirydate', '') }}">
                          @include('alerts.feedback', ['field' => 'product_expirydate'])
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="attachedbarcodes" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Attached Barcodes")}}</label>
                          <div class=" col-12">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group" id="parent_div">
                        <div class=" col-12">
                            {{-- <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                            </div>
                            <div class="alert alert-success print-success-msg" style="display:none">
                            <ul></ul>
                            </div> --}}
                            <div class="table-responsive">
                              <table id="dynamic_field" class="table table-hover ">
                              {{-- <table id="dynamic_field" class="table table-hover table-striped order-list table-fixed"> --}}
                                <tbody>
                                  <tr>
                                    <td class="col-12 mytbl">
                                      <div class="form-group child_div">
                                        {{-- <label for="attachedbarcodes" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Enter Barcode")}}</label> --}}
                                        <div class=" col-12 input-group mb-1">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text barcode">
                                                <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                              </span>
                                          </div>
                                          <input type="text" name="attachedbarcodes[]" placeholder="Scan/Enter Barcode" class="form-control col-12"/>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          {{-- </form>  --}}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-3">
                      <a id="add-barfield" type="button"  class="btn btn-info btn-round text-white pull-right">Add More</a>
                    </div>
                  </div>
                </div>
                <div class="card-body-custom col-6">
                    <div class="row">
                      <div class="col-6">
                        <div class="row">
                          <div class=" col-12 ">
                              <div class="form-group">
                                <label for="product_trade_price_piece" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Trade Price(Piece)")}}</label>
                                <div class=" col-12 input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text rs">Rs: </span>
                                    </div>
                                    <input type="number" name="product_trade_price_piece" class="form-control col-12" value="{{ old('product_trade_price_piece', '') }}">
                                    @include('alerts.feedback', ['field' => 'product_trade_price_piece'])
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_credit_price_piece" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Credit Retail Price(Piece)")}}</label>
                              <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_credit_price_piece" class="form-control col-12" value="{{ old('product_credit_price_piece', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_credit_price_piece'])
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_cash_price_piece" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Cash Retail Price(Piece)")}}</label>
                              <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_cash_price_piece" class="form-control col-12" value="{{ old('product_cash_price_piece', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_cash_price_piece'])
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="row">
                          <div class=" col-12 ">
                              <div class="form-group">
                                <label for="product_nonbulk_price_piece" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Non Bulk Price(Piece)")}}</label>
                                <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                    <input type="number" name="product_nonbulk_price_piece" class="form-control col-12" value="{{ old('product_nonbulk_price_piece', '') }}">
                                    @include('alerts.feedback', ['field' => 'product_nonbulk_price_piece'])
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_nonbulk_price_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Non Bulk Price(packet)")}}</label>
                                <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_nonbulk_price_packet" class="form-control col-12" value="{{ old('product_nonbulk_price_packet', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_nonbulk_price_packet'])
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_nonbulk_price_carton" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Non Bulk Price(carton)")}}</label>
                                <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_nonbulk_price_carton" class="form-control col-12" value="{{ old('product_nonbulk_price_carton', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_nonbulk_price_carton'])
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                        <hr style="width:80%;text-align:right;margin-left:5">
                    <div class="row">
                      <div class="col-6">
                        <div class="row">
                          <div class=" col-12 ">
                              <div class="form-group">
                                <label for="product_trade_price_packet" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Trade Price(Packet)")}}</label>
                                <div class=" col-12 input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text rs">Rs: </span>
                                    </div>
                                    <input type="number" name="product_trade_price_packet" class="form-control col-12" value="{{ old('product_trade_price_packet', '') }}">
                                    @include('alerts.feedback', ['field' => 'product_trade_price_packet'])
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_credit_price_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Credit Retail Price(Packet)")}}</label>
                              <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_credit_price_packet" class="form-control col-12" value="{{ old('product_credit_price_packet', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_credit_price_packet'])
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_cash_price_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Cash Retail Price(Packet)")}}</label>
                              <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_cash_price_packet" class="form-control col-12" value="{{ old('product_cash_price_packet', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_cash_price_packet'])
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="row">
                          <div class=" col-12 ">
                              <div class="form-group">
                                <label for="product_trade_price_carton" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Trade Price(Carton)")}}</label>
                                <div class=" col-12 input-group mb-1">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text rs">Rs: </span>
                                    </div>
                                    <input type="number" name="product_trade_price_carton" class="form-control col-12" value="{{ old('product_trade_price_carton', '') }}">
                                    @include('alerts.feedback', ['field' => 'product_trade_price_carton'])
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_credit_price_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Credit Retail Price(Carton)")}}</label>
                              <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_credit_price_carton" class="form-control col-12" value="{{ old('product_credit_price_carton', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_credit_price_carton'])
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_cash_price_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Cash Retail Price(Carton)")}}</label>
                              <div class=" col-12 input-group mb-1">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_cash_price_carton" class="form-control col-12" value="{{ old('product_cash_price_carton', '') }}">
                                  @include('alerts.feedback', ['field' => 'product_cash_price_carton'])
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      <hr style="width:80%;text-align:right;margin-left:5">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class=" col-6 ">
                            <div class="form-group">
                              <label for="product_state" class=" col-8 control-label">&nbsp;&nbsp;{{__(" State")}}</label>
                              <div class=" col-12">
                                <input type="text" name="product_state" class="form-control col-12" value="{{ old('product_state', '') }}">
                                @include('alerts.feedback', ['field' => 'product_state'])
                              </div>
                            </div>
                          </div>
                          <div class=" col-6 ">
                            <div class="form-group">
                              <label for="status" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Status")}}</label>
                              <div class=" col-12">
                                <select name="status_id" class="form-control col-12">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                                {{-- <input type="text" name="status_id" class="form-control" value="{{ old('status', '') }}"> --}}
                                @include('alerts.feedback', ['field' => 'status_id'])
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class=" col-12 ">
                            <div class="form-group">
                                <label for="product_info" class=" col-8 control-label">&nbsp;&nbsp;{{__(" Product Description")}}</label>
                                <div class=" col-12">
                                  <textarea type="text" name="product_info" rows="3" class="form-control col-12" value="{{ old('product_info', '') }}"></textarea>
                                  {{-- <input type="text" name="info" class="form-control" value="{{ old('info', '') }}"> --}}
                                  @include('alerts.feedback', ['field' => 'product_info'])
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <!-- Modal -->
              {{-- <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-info" id="myModalLabel">Choose Image</h3>
                        <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body manufacturer-image-embed">
                        @if(isset($allimage))
                        <select class="image-picker show-html " name="image_id" id="select_img">
                            <option value=""></option>
                            @foreach($allimage as $key=>$image)
                            <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="modal-footer">

                        <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-info pull-left">Add Image</a>
                        <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                        <button type="button" class="btn btn-info" id="selected" data-dismiss="modal">Done</button>
                    </div>
                  </div>
                </div>
              </div> --}}
                {{-- <div class="row">
                  <div class=" col-12 ">
                      <div class="form-group">
                        <label for="image" class=" col-6 control-label">&nbsp;&nbsp;{{__(" Image")}}</label>
                        <div class=" col-12">
                          <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal">AddNew</button>
                          <!-- Main row -->
                          <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add File Here</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Click or Drop Images in the Box for Upload.</p>
                                        <form action="{{ url('admin/media/uploadimage') }}" files="true" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" disabled="disabled" id="compelete"
                                            data-dismiss="modal">Done</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div> --}}
              <!-- attach barcodes modal -->
              {{-- <div id="attachedbarcodes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Attach Barcodes</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="row">
                                <div class=" col-12 ">
                                  <div class="search-box form-group">
                                    <label for="attachedbarcodes" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Enter Barcode")}}</label>
                                    <div class=" col-12 input-group mb-1">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text barcode">
                                            <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                          </span>
                                      </div>
                                      <input type="text" name="attachedbarcodes[]" id="attachedbarcodes" placeholder="Scan/Enter Barcode" class="form-control"  />
                                      <a id="addmore" type="button" class="btn btn-info btn-round text-white pull-right" data-toggle="modal" data-target="#attachedbarcodes">Add More</a>
                                    </div>
                                    @include('alerts.feedback', ['field' => 'attachedbarcodes'])
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class=" col-12 ">
                                  <div class="form-group">
                                    <div class=" col-12">
                                      <form name="add_barcode" id="add_barcode">  
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                        </div>
                                        <div class="alert alert-success print-success-msg" style="display:none">
                                        <ul></ul>
                                        </div>
                                        <div class="table-responsive">
                                          <table id="dynamic_field" class="table table-hover order-list table-fixed">//table-striped
                                            <thead class="thead-dark" style="position: sticky; top: 0; z-index: 1">
                                              <tr>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td class="col-12">
                                                  <div class="form-group">
                                                    <label for="attachedbarcodes" class=" col-10 control-label">&nbsp;&nbsp;{{__(" Enter Barcode")}}</label>
                                                    <div class=" col-12 input-group mb-1">
                                                      <div class="input-group-prepend">
                                                          <span class="input-group-text barcode">
                                                            <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                                          </span>
                                                      </div>
                                                      <input type="text" name="attachedbarcodes[]" id="attachedbarcodes" placeholder="Scan/Enter Barcode" class="form-control"  />
                                                    </div>
                                                  </div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td class="col-12">
                                                  <div class="form-group">
                                                    <div class=" col-12 input-group mb-1">
                                                      <div class="input-group-prepend">
                                                          <span class="input-group-text barcode">
                                                            <a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a>
                                                          </span>
                                                      </div>
                                                      <input type="text" name="attachedbarcodes[]" id="attachedbarcodes" placeholder="Scan/Enter Barcode" class="form-control"  />
                                                    </div>
                                                  </div>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </form> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class=" col-2">
                                    <button id="submit-btn" name="submit-btn" type="button" class="btn btn-primary pull-left" value="Submit">Submit</button>
                                  </div>
                                  <div class=" col-7">
                                  </div>
                                  <div class=" col-3">
                                    <a id="addmore" type="button" rel="tooltip" class="btn btn-info btn-round text-white pull-right" data-toggle="modal" data-target="#attachedbarcodes">Add More</a>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div> --}}
              <div class="card-footer row">
                <div class=" col-6">
                  <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round ">{{__('Back')}}</a>
                </div>
                <div class=" col-6">
                  <button type="submit" class="btn btn-info btn-round pull-right">{{__('Save')}}</button>
                </div>
              </div>
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
  $(document).ready(function(){
    // var key; 
    $('#add-barfield').click(function(e) {
      e.preventDefault();
      $('table tbody').append('<tr class="mytr"><td class="col-12 mytbl"><div class="form-group"><div class=" col-12 input-group mb-1"><div class="input-group-prepend"><span class="input-group-text barcode"><a class="" id="product-list-btn"><i class="fa fa-barcode"></i></a></span></div><input type="text" name="attachedbarcodes[]" placeholder="Scan/Enter Barcode" class="form-control"/><a type="button"  class="btn btn-danger btn-round text-white pull-right delete-barfield">X</a></div></div></td></tr>');
      // var html = $('.child_div:first').parent().html();
      // $(html).insertBefore(this);
      // key++;
    });
    $(document).on("click", ".delete-barfield", function() {
      $(this).closest('.mytr').remove();
    });
  }); 
</script>

@endsection