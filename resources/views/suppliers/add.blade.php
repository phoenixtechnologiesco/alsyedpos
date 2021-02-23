@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Supplier")}}</h5>
          </div>
          <div class="card-body-custom">
            <form method="post" action="{{ route('supplier.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
              @include('alerts.success')
                <div class="row">
                  <div class="card-body-custom col-12 ">
                    <div class="row">
                      <div class="col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_ref_no" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Reference No.")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_ref_no" class="form-control col-12" value="{{ old('supplier_ref_no', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_ref_no'])
                            </div>
                        </div>
                      </div>
                      <div class="col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_type" class="col-sm-2 col-md-10 control-label">&nbsp;&nbsp;{{__(" Supplier Type")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <select name="supplier_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                              <option value="general">General</option>
                              <option value="booker">Booker</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'supplier_type'])
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 ">
                          <div class="form-group">
                            <label for="supplier_name" class="col-sm-2 col-md-10 control-label">&nbsp;&nbsp;{{__(" Supplier Name")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_name" class="form-control col-12" value="{{ old('supplier_name', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_name'])
                            </div>
                          </div>
                      </div>
                      <div class="col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_shop_name" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Shop Name")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_shop_name" class="form-control col-12" value="{{ old('supplier_shop_name', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_shop_name'])
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-md-6 ">
                          <div class="form-group">
                            <label for="supplier_shop_info" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Shop Description")}}</label>
                              <div class="col-sm-10 col-md-12">
                                <input type="text" name="supplier_shop_info" rows="2" class="form-control col-12" value="{{ old('supplier_shop_info', '') }}">
                                @include('alerts.feedback', ['field' => 'supplier_shop_info'])
                              </div>
                          </div>
                      </div>
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_balance_paid" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Balance Paid")}}</label>
                            <div class="col-sm-10 col-md-12 input-group mb-1">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input type="number" name="supplier_balance_paid" class="form-control" value="{{ old('supplier_balance_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_balance_paid'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-md-3 ">
                          <div class="form-group">
                            <label for="supplier_balance_dues" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Balance Dues")}}</label>
                              <div class="col-sm-10 col-md-12 input-group mb-1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="supplier_balance_dues" class="form-control" value="{{ old('supplier_balance_dues', '') }}">
                                @include('alerts.feedback', ['field' => 'supplier_balance_dues'])
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-md-6">
                        <div class="form-group">
                          <label for="supplier_email" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Email")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_email" class="form-control col-12" value="{{ old('supplier_email', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_email'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-md-6">
                          <div class="form-group">
                            <label for="supplier_alternate_email" class="col-sm-2 col-md-6 control-label">&nbsp;&nbsp;{{__(" Alternate Email")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_alternate_email" class="form-control col-12" value="{{ old('supplier_alternate_email', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_alternate_email'])
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_cnic_number" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Cnic Number")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_cnic_number" class="form-control col-12" value="{{ old('supplier_cnic_number', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_cnic_number'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_phone_number" class="col-sm-2 col-md-8 control-label">&nbsp;&nbsp;{{__(" Phone Number")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_phone_number" class="form-control col-12" value="{{ old('supplier_phone_number', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_phone_number'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-md-3 ">
                          <div class="form-group">
                            <label for="supplier_office_number" class="col-sm-2 col-md-10 control-label">&nbsp;&nbsp;{{__(" Office Number")}}</label>
                            <div class="col-sm-10 col-md-12">
                              <input type="text" name="supplier_office_number" class="form-control col-12" value="{{ old('supplier_office_number', '') }}">
                              @include('alerts.feedback', ['field' => 'supplier_office_number'])
                            </div>
                          </div>
                      </div>
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_alternate_number" class="col-sm-2 col-md-12 control-label">&nbsp;&nbsp;{{__(" Alternate Phone Number")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <input type="text" name="supplier_alternate_number" class="form-control col-12" value="{{ old('supplier_alternate_number', '') }}">
                            @include('alerts.feedback', ['field' => 'supplier_alternate_number'])
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-md-3">
                        <div class="form-group">
                          <label for="status_id" class="col-sm-2 col-md-12 control-label">&nbsp;&nbsp;{{__(" Status")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <select name="status_id" class="form-control col-12">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                            {{-- <input type="text" name="status_id" class="form-control" value="{{ old('supplier_status', '') }}"> --}}
                            @include('alerts.feedback', ['field' => 'status_id'])
                          </div>
                        </div>
                      </div>
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_zipcode" class="col-sm-2 col-md-6 control-label">&nbsp;&nbsp;{{__(" Zip Code")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <input type="text" name="supplier_zipcode" class="form-control" value="{{ old('supplier_zipcode', '') }}">
                            @include('alerts.feedback', ['field' => 'supplier_zipcode'])
                          </div>
                        </div>
                      </div>
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_town" class="col-sm-2 col-md-6 control-label">&nbsp;&nbsp;{{__(" Town")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <input type="text" name="supplier_town" class="form-control" value="{{ old('supplier_town', '') }}">
                            @include('alerts.feedback', ['field' => 'supplier_town'])
                          </div>
                        </div>
                      </div>
                      <div class=" col-md-3 ">
                        <div class="form-group">
                          <label for="supplier_area" class="col-sm-2 col-md-6 control-label">&nbsp;&nbsp;{{__(" Area")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <input type="text" name="supplier_area" class="form-control" value="{{ old('supplier_area', '') }}">
                            @include('alerts.feedback', ['field' => 'supplier_area'])
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-md-12 ">
                        <div class="form-group">
                          <label for="supplier_shop_address" class="col-sm-2 col-md-6 control-label">&nbsp;&nbsp;{{__(" Shop Address")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <input type="text" name="supplier_shop_address" class="form-control col-12" value="{{ old('supplier_shop_address', '') }}">
                            @include('alerts.feedback', ['field' => 'supplier_shop_address'])
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-md-12 ">
                        <div class="form-group">
                          <label for="supplier_resident_address" class="col-sm-2 col-md-6 control-label">&nbsp;&nbsp;{{__(" Residential Address")}}</label>
                          <div class="col-sm-10 col-md-12">
                            <input type="text" name="supplier_resident_address" class="form-control col-12" value="{{ old('supplier_resident_address', '') }}">
                            @include('alerts.feedback', ['field' => 'supplier_resident_address'])
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer row">
                  <div class="col-sm-10 col-md-6">
                    <button type="button" class="btn btn-secondary btn-round ">{{__('Back')}}</button>
                  </div>
                  <div class="col-sm-10 col-md-6">
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
@endsection