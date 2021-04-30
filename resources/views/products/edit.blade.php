@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Product")}}</h5>
          </div>
          <div class="card-body-custom">
            <form id="product_update" method="post" action="{{ route('product.update', ['product' => $product[0]->product_id,]) }}" autocomplete="off" enctype="multipart/form-data">
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
                <div class="card-body-custom col-6 ">
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_ref_no" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Reference No.")}}</label>
                          <div class=" col-12">
                            <input type="text" name="product_ref_no" class="form-control col-12" value="{{ $product[0]->product_ref_no }}">
                            @include('alerts.feedback', ['field' => 'product_ref_no'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_name" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Product Name")}}</label>
                        <div class=" col-12">
                          <input type="text" name="product_name" class="form-control col-12" value="{{ $product[0]->product_name }}">
                          @include('alerts.feedback', ['field' => 'product_name'])
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <label for="warehouse_id" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Warehouse")}}</label>
                        <div class=" col-12">
                          {{-- <input type="text" name="warehouse_id" class="form-control col-12" value="{{ old('warehouse_id', '') }}">
                          @include('alerts.feedback', ['field' => 'warehouse_id']) --}}
                          <select name="warehouse_id" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                            {{-- <option selected value="NULL">Select</option> --}}
                          @foreach($warehouses as $single_warehouse)
                            <option @if($single_warehouse->warehouse_id == $product[0]->warehouse_id) selected @endif value="{{ $single_warehouse->warehouse_id }}">{{ $single_warehouse->warehouse_name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    {{-- <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_barcode" class=" col-12 control-label">&nbsp;&nbsp;{{__(" General Barcode")}}</label>
                            <div class=" col-12">
                              <input type="text" name="product_barcode" class="form-control col-12" value="{{ $product[0]->product_barcode }}">
                              @include('alerts.feedback', ['field' => 'product_barcode'])
                            </div>
                        </div>
                    </div> --}}
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_company" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Company")}}</label>
                            <div class=" col-12">
                              {{-- <input type="text" name="product_company" class="form-control col-12" value="{{ old('product_company', '') }}">
                              @include('alerts.feedback', ['field' => 'product_company']) --}}
                              <select name="product_company" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Company...">
                                <option selected value="NULL">Select</option>
                              @foreach($companies as $single_company)
                                <option @if($single_company->company_name == $product[0]->product_company) selected @endif value="{{ $single_company->company_name }}">{{ $single_company->company_name }}</option>
                              @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_brand" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Brand")}}</label>
                            <div class=" col-12">
                              {{-- <input type="text" name="product_brand" class="form-control col-12" value="{{ old('product_brand', '') }}">
                              @include('alerts.feedback', ['field' => 'product_brand']) --}}
                              <select name="product_brand" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                <option selected value="NULL">Select</option>
                              @foreach($brands as $single_brand)
                                <option @if($single_brand->brand_name == $product[0]->product_brand) selected @endif value="{{ $single_brand->brand_name }}">{{ $single_brand->brand_name }}</option>
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
                          <label for="product_quantity_total" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Total Quantity")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_quantity_total" class="form-control col-12" value="{{ $product[0]->product_quantity_total }}">
                              @include('alerts.feedback', ['field' => 'product_quantity_total'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_quantity_available" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Available Quantity")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_quantity_available" class="form-control col-12" value="{{ $product[0]->product_quantity_available }}">
                              @include('alerts.feedback', ['field' => 'product_quantity_available'])
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_damage_quantity" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Damage Quantity")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_damage_quantity" class="form-control col-12" value="{{ $product[0]->product_damage_quantity }}">
                              @include('alerts.feedback', ['field' => 'product_damage_quantity'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_alert_quantity" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Alert Quantity")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_alert_quantity" class="form-control col-12" value="{{ $product[0]->product_alert_quantity }}">
                            @include('alerts.feedback', ['field' => 'product_alert_quantity'])
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_unit" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Product Unit")}}</label>
                          <div class=" col-12">
                            <input type="text" name="product_unit" class="form-control col-12" value="{{ $product[0]->product_unit }}">
                            @include('alerts.feedback', ['field' => 'product_unit'])
                          </div>
                      </div>
                    </div>
                  </div> --}}
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_pieces_total" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Total Pieces")}}</label>
                          <div class=" col-12">
                            <input readonly type="number" name="product_pieces_total" class="form-control col-12" value="{{ $product[0]->product_pieces_total }}">
                            @include('alerts.feedback', ['field' => 'product_pieces_total'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_pieces_available" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Available Pieces")}}</label>
                          <div class=" col-12">
                            <input readonly type="number" name="product_pieces_available" class="form-control col-12" value="{{ $product[0]->product_pieces_available }}">
                            @include('alerts.feedback', ['field' => 'product_pieces_available'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_packets_total" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Total Packets")}}</label>
                          <div class=" col-12">
                            <input readonly type="number" name="product_packets_total" class="form-control col-12" value="{{ $product[0]->product_packets_total }}">
                            @include('alerts.feedback', ['field' => 'product_packets_total'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_packets_available" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Available Packets")}}</label>
                          <div class=" col-12">
                            <input readonly type="number" name="product_packets_available" class="form-control col-12" value="{{ $product[0]->product_packets_available }}">
                            @include('alerts.feedback', ['field' => 'product_packets_available'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_cartons_total" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Total Cartons")}}</label>
                            <div class=" col-12">
                              <input readonly type="number" name="product_cartons_total" class="form-control col-12" value="{{ $product[0]->product_cartons_total }}">
                              @include('alerts.feedback', ['field' => 'product_cartons_total'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_cartons_available" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Available Cartons")}}</label>
                          <div class=" col-12">
                            <input readonly type="number" name="product_cartons_available" class="form-control col-12" value="{{ $product[0]->product_cartons_available }}">
                            @include('alerts.feedback', ['field' => 'product_cartons_available'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="product_piece_per_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Pieces Per Packet")}}</label>
                            <div class=" col-12">
                              <input type="number" name="product_piece_per_packet" class="form-control col-12" min="1" value="{{ $product[0]->product_piece_per_packet }}">
                              @include('alerts.feedback', ['field' => 'product_piece_per_packet'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_piece_per_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Pieces Per Carton")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_piece_per_carton" class="form-control col-12" min="1" value="{{ $product[0]->product_piece_per_carton }}">
                            @include('alerts.feedback', ['field' => 'product_piece_per_carton'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_packet_per_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Packets Per Carton")}}</label>
                          <div class=" col-12">
                            <input type="number" name="product_packet_per_carton" class="form-control col-12" min="1" value="{{ $product[0]->product_packet_per_carton }}">
                            @include('alerts.feedback', ['field' => 'product_packet_per_carton'])
                          </div>
                      </div>
                    </div>
                    {{-- <div class=" col-6 ">
                      <div class="form-group">
                        <label for="attachedbarcodes" class=" col-12 control-label">{{__(" Attached Barcodes")}}</label>
                        <div class=" col-12">
                          <select name="attachedbarcodes[]" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Attached Barcodes...">
                            @foreach($attached_barcodes as $single_barcode)
                              <option value="{{ $single_barcode->product_barcodes }}">{{ $single_barcode->product_barcodes }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                  {{-- <div class="row">
                    <div class=" col-6 ">
                      <div class="form-group">
                        <label for="product_expirydate" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Expiry Date")}}</label>
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
                        <label for="attachedbarcodes" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Attached Barcodes")}}</label>
                          <div class=" col-12">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group" id="parent_div">
                        <div class=" col-12">
                          <div class="table-responsive">
                            <table id="dynamic_field" class="table table-hover ">
                            {{-- <table id="dynamic_field" class="table table-hover table-striped table-fixed"> --}}
                              <tbody>
                                @foreach($attached_barcodes as $single_barcode)
                                <tr class="mytr">
                                  <td class="col-12 mytbl">
                                    <div class="form-group child_div">
                                      {{-- <label for="attachedbarcodes" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Enter Barcode")}}</label> --}}
                                      <div class=" col-12 input-group ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text barcode">
                                            <a class=""><i class="fa fa-barcode"></i></a>
                                          </span>
                                        </div>
                                        <input type="text" name="attachedbarcodes[]" placeholder="Scan/Enter Barcode" class="form-control col-12" value="{{ $single_barcode->product_barcodes }}"/>
                                        <a type="button"  class="btn btn-danger btn-round text-white pull-right delete-barfield">X</a>
                                      </div>
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
                  <div class="row">
                    <div class=" form-first-col-4">
                    </div>
                    <div class=" form-col-3">
                      <a id="add-barfield" type="button"  class="btn btn-info btn-round text-white pull-right">Add More</a>
                    </div>
                  </div>
                </div>
                <div class="card-body-custom col-6 ">
                  <div class="row">
                    <div class="col-6">
                      <div class="row">
                        <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_trade_price_piece" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Trade Price(Pc)")}}</label>
                              <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_trade_price_piece" class="form-control col-12" value="{{ $product[0]->product_trade_price_piece }}">
                                  @include('alerts.feedback', ['field' => 'product_trade_price_piece'])
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_cash_price_piece" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Cash Price(Pc)")}}</label>
                            <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_cash_price_piece" class="form-control col-12" value="{{ $product[0]->product_cash_price_piece }}">
                                @include('alerts.feedback', ['field' => 'product_cash_price_piece'])
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_credit_price_piece" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Credit Price(Pc)")}}</label>
                            <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_credit_price_piece" class="form-control col-12" value="{{ $product[0]->product_credit_price_piece }}">
                                @include('alerts.feedback', ['field' => 'product_credit_price_piece'])
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_nonbulk_price_piece" class=" col-12 control-label">&nbsp;{{__("NonBulk Price(Pc)")}}</label>
                              <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                  <input type="number" name="product_nonbulk_price_piece" class="form-control col-12" value="{{ $product[0]->product_nonbulk_price_piece }}">
                                  @include('alerts.feedback', ['field' => 'product_nonbulk_price_piece'])
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_nonbulk_price_packet" class=" col-12 control-label">&nbsp;{{__("NonBulk Price(Pckt)")}}</label>
                              <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_nonbulk_price_packet" class="form-control col-12" value="{{ $product[0]->product_nonbulk_price_packet }}">
                                @include('alerts.feedback', ['field' => 'product_nonbulk_price_packet'])
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_nonbulk_price_carton" class=" col-12 control-label">&nbsp;{{__("NonBulk Price(Crtn)")}}</label>
                              <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_nonbulk_price_carton" class="form-control col-12" value="{{ $product[0]->product_nonbulk_price_carton }}">
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
                              <label for="product_trade_price_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Trade Price(Pckt)")}}</label>
                              <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_trade_price_packet" class="form-control col-12" value="{{ $product[0]->product_trade_price_packet }}">
                                  @include('alerts.feedback', ['field' => 'product_trade_price_packet'])
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_cash_price_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Cash Price(Pckt)")}}</label>
                            <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_cash_price_packet" class="form-control col-12" value="{{ $product[0]->product_cash_price_packet }}">
                                @include('alerts.feedback', ['field' => 'product_cash_price_packet'])
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_credit_price_packet" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Credit Price(Pckt)")}}</label>
                            <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_credit_price_packet" class="form-control col-12" value="{{ $product[0]->product_credit_price_packet }}">
                                @include('alerts.feedback', ['field' => 'product_credit_price_packet'])
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class=" col-12 ">
                            <div class="form-group">
                              <label for="product_trade_price_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Trade Price(Crtn)")}}</label>
                              <div class=" col-12 input-group ">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rs">Rs: </span>
                                  </div>
                                  <input type="number" name="product_trade_price_carton" class="form-control col-12" value="{{ $product[0]->product_trade_price_carton }}">
                                  @include('alerts.feedback', ['field' => 'product_trade_price_carton'])
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_cash_price_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Cash Price(Crtn)")}}</label>
                            <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_cash_price_carton" class="form-control col-12" value="{{ $product[0]->product_cash_price_carton }}">
                                @include('alerts.feedback', ['field' => 'product_cash_price_carton'])
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-12 ">
                          <div class="form-group">
                            <label for="product_credit_price_carton" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Credit Price(Crtn)")}}</label>
                            <div class=" col-12 input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="product_credit_price_carton" class="form-control col-12" value="{{ $product[0]->product_credit_price_carton }}">
                                @include('alerts.feedback', ['field' => 'product_credit_price_carton'])
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
                            <label for="product_state" class=" col-12 control-label">&nbsp;&nbsp;{{__(" State")}}</label>
                            <div class=" col-12">
                              <input type="text" name="product_state" class="form-control col-12" value="{{ $product[0]->product_state }}">
                              @include('alerts.feedback', ['field' => 'product_state'])
                            </div>
                          </div>
                        </div>
                        <div class=" col-6 ">
                          <div class="form-group">
                            <label for="status" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Status")}}</label>
                            <div class=" col-12">
                              <select name="status_id" class="form-control col-12">
                                <option @if($product[0]->status_id == 1) selected @endif value="1">Active</option>
                                <option @if($product[0]->status_id == 0) selected @endif value="0">Inactive</option>
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
                              <label for="product_info" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Product Description")}}</label>
                              <div class=" col-12">
                                <textarea type="text" name="product_info" rows="3" class="form-control col-12" value="{{ $product[0]->product_info }}">{{ $product[0]->product_info }}</textarea>
                                {{-- <input type="text" name="info" class="form-control" value="{{ $product[0]->info }}"> --}}
                                @include('alerts.feedback', ['field' => 'product_info'])
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
                  <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
                  <form action="{{ route('product.destroy', $product[0]->product_id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger btn-round pull-right">{{__('Delete')}}</button>
                  </form>
                </div>
              </div>
            {{-- </form> --}}
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
    $('#add-barfield').click(function(e) {
      e.preventDefault();
      $('table tbody').append('<tr class="mytr"><td class="col-12 mytbl"><div class="form-group"><div class="col-12 input-group "><div class="input-group-prepend"><span class="input-group-text barcode"><a class=""><i class="fa fa-barcode"></i></a></span></div><input type="text" name="attachedbarcodes[]" placeholder="Scan/Enter Barcode" class="form-control"/><a type="button"  class="btn btn-danger btn-round text-white pull-right delete-barfield">X</a></div></div></td></tr>');
      var html = $('.child_div:first').parent().html();
      $(html).insertBefore(this);
    });
    $(document).on("click", ".delete-barfield", function() {
      $(this).closest('.mytr').remove();
      // $(this).closest('.tr').remove();
    });
  }); 
</script>

<script type="text/javascript">
  $(function (){
    $.validator.setDefaults( {
      // debug: true,
      // success: "valid",
      submitHandler: function (form) {
        form.submit();
      }
    });
    $("#product_update").validate({
      rules: {
        product_ref_no: 'required',
        product_name: 'required',
        product_quantity_total: 'required',
        product_quantity_available: 'required',
        // product_pieces_total: 'required'
        attachedbarcodes: 'required',
        product_trade_price_piece: 'required',
        product_credit_price_piece: 'required',
        product_cash_price_piece: 'required',
        status_id: 'required'
      },
      messages: {
        product_ref_no:  'Please Enter Product Ref No',
        product_name:  'Please Enter Product Name',
        product_quantity_total:  'Please Enter Product Total Quantity',
        product_quantity_available:  'Please Enter Product Available Quantity',
        // product_pieces_total: 'Please Enter Total Product Pieces',
        attachedbarcodes:  'Please Enter Attached Barcodes',
        product_trade_price_piece:  'Please Piece Trade Price',
        product_credit_price_piece:  'Please Enter Piece Credit Price',
        product_cash_price_piece:  'Please Enter Piece Cash Price',
        status_id: 'Please Select Status'
      },
      errorElement: 'em',
      errorPlacement: function ( error, element ) {
        error.addClass( 'invalid-feedback' );
        if( element.prop( 'type' ) === 'checkbox' ) {
          error.insertAfter( element.parent( 'label' ) );
        }
        else {
          error.insertAfter( element );
        }
      },
      // errorElement: 'span',
      // errorPlacement: function (error, element) {
      //   error.addClass('invalid-feedback');
      //   element.closest('.form-group').append(error);
      // },
      errorClass: "error fail-alert",
      errorClass: "invalid",
      // validClass: "valid success-alert",
      // validClass: "success"
      highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).removeClass( 'is-invalid' );
      },
      // submitHandler: function(form) {
      //   form.submit();
      // },
    });
  });
</script>

@endsection