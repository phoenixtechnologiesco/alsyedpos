@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Customer")}}</h5>
          </div>
          <div class="card-body-custom">
            <form id="customer_store" method="post" action="{{ route('customer.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
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
                  <div class="card-body-custom col-12 ">
                    <div class="row">
                      <div class="col-3 ">
                        <div class="form-group">
                          <label for="customer_ref_no" class="col-12 control-label">&nbsp;&nbsp;{{__(" Reference No.")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_ref_no" class="form-control col-12" value="{{ old('customer_ref_no', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_ref_no'])
                            </div>
                        </div>
                      </div>
                      <div class="col-3 ">
                        <div class="form-group">
                            <label for="customer_type" class="col-12 control-label">&nbsp;&nbsp;{{__(" Customer Type")}}</label>
                            <div class=" col-12">
                              <select name="customer_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                    <option value="general">General</option>
                                    <option value="distributer">Distributer</option>
                                    <option value="reseller">Reseller</option>
                              </select>
                              @include('alerts.feedback', ['field' => 'customer_type'])
                            </div>
                        </div>
                      </div>
                      <div class="col-3 ">
                          <div class="form-group">
                            <label for="customer_name" class="col-12 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_name" class="form-control col-12" value="{{ old('customer_name', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_name'])
                            </div>
                          </div>
                      </div>
                      <div class="col-3 ">
                        <div class="form-group">
                          <label for="customer_shop_name" class="col-12 control-label">&nbsp;&nbsp;{{__(" Shop Name")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_shop_name" class="form-control col-12" value="{{ old('customer_shop_name', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_shop_name'])
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-6 ">
                          <div class="form-group">
                            <label for="customer_shop_info" class="col-12 control-label">&nbsp;&nbsp;{{__(" Shop Description")}}</label>
                              <div class=" col-12">
                                <input type="text" name="customer_shop_info" rows="2" class="form-control col-12" value="{{ old('customer_shop_info', '') }}">
                                @include('alerts.feedback', ['field' => 'customer_shop_info'])
                              </div>
                          </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_balance_paid" class="col-12 control-label">&nbsp;&nbsp;{{__(" Balance Paid")}}</label>
                            <div class=" col-12 input-group mb-1">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input type="number" name="customer_balance_paid" class="form-control" value="{{ old('customer_balance_paid', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_balance_paid'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                          <div class="form-group">
                            <label for="customer_balance_dues" class="col-12 control-label">&nbsp;&nbsp;{{__(" Balance Dues")}}</label>
                              <div class=" col-12 input-group mb-1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rs">Rs: </span>
                                </div>
                                <input type="number" name="customer_balance_dues" class="form-control" value="{{ old('customer_balance_dues', '') }}">
                                @include('alerts.feedback', ['field' => 'customer_balance_dues'])
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_sale_rate" class="col-12 control-label">&nbsp;&nbsp;{{__(" Sale Rate")}}</label>
                            <div class=" col-12">
                              <select name="customer_sale_rate" class="form-control col-12">
                                <option value="cash">Cash</option>
                                <option value="credit">Credit</option>
                                <option value="nonbulk">Non Bulk Buyer</option>
                              </select>
                              @include('alerts.feedback', ['field' => 'customer_sale_rate'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_credit_limit" class="col-12 control-label">&nbsp;&nbsp;{{__(" Credit Limit")}}</label>
                            <div class=" col-12 input-group mb-1">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input type="number" name="customer_credit_limit" class="form-control col-12" value="{{ old('customer_credit_limit', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_credit_limit'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_credit_duration" class="col-12 control-label">&nbsp;&nbsp;{{__(" Credit Duration")}}</label>
                            <div class=" col-12">
                              <input type="number" name="customer_credit_duration" class="form-control col-12" value="{{ old('customer_credit_duration', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_credit_duration'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                          <div class="form-group">
                            <label for="customer_credit_type" class="col-12 control-label">&nbsp;&nbsp;{{__(" Credit Type")}}</label>
                              <div class=" col-12">
                                <select name="customer_credit_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Credit Type">
                                  <option value="">Select</option>
                                  <option value="days">Days</option>
                                  <option value="months">Months</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'customer_credit_type'])
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-6">
                        <div class="form-group">
                          <label for="customer_email" class="col-12 control-label">&nbsp;&nbsp;{{__(" Email")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_email" class="form-control col-12" value="{{ old('customer_email', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_email'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-6">
                          <div class="form-group">
                            <label for="customer_alternate_email" class="col-12 control-label">&nbsp;&nbsp;{{__(" Alternate Email")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_alternate_email" class="form-control col-12" value="{{ old('customer_alternate_email', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_alternate_email'])
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_cnic_number" class="col-12 control-label">&nbsp;&nbsp;{{__(" Cnic Number")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_cnic_number" class="form-control col-12" value="{{ old('customer_cnic_number', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_cnic_number'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_phone_number" class="col-12 control-label">&nbsp;&nbsp;{{__(" Phone Number")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_phone_number" class="form-control col-12" value="{{ old('customer_phone_number', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_phone_number'])
                            </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                          <div class="form-group">
                            <label for="customer_office_number" class="col-12 control-label">&nbsp;&nbsp;{{__(" Office Number")}}</label>
                            <div class=" col-12">
                              <input type="text" name="customer_office_number" class="form-control col-12" value="{{ old('customer_office_number', '') }}">
                              @include('alerts.feedback', ['field' => 'customer_office_number'])
                            </div>
                          </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_alternate_number" class="col-12 control-label">&nbsp;&nbsp;{{__("Alternate Phone")}}</label>
                          <div class=" col-12">
                            <input type="text" name="customer_alternate_number" class="form-control col-12" value="{{ old('customer_alternate_number', '') }}">
                            @include('alerts.feedback', ['field' => 'customer_alternate_number'])
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-3">
                        <div class="form-group">
                          <label for="status" class="col-12 control-label">&nbsp;&nbsp;{{__(" Status")}}</label>
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
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_zipcode" class="col-12 control-label">&nbsp;&nbsp;{{__(" Zip Code")}}</label>
                          <div class=" col-12">
                            <input type="text" name="customer_zipcode" class="form-control" value="{{ old('customer_zipcode', '') }}">
                            @include('alerts.feedback', ['field' => 'customer_zipcode'])
                          </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_town" class="col-12 control-label">&nbsp;&nbsp;{{__(" Town")}}</label>
                          <div class=" col-12">
                            <input type="text" name="customer_town" class="form-control" value="{{ old('customer_town', '') }}">
                            @include('alerts.feedback', ['field' => 'customer_town'])
                          </div>
                        </div>
                      </div>
                      <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_area" class="col-12 control-label">&nbsp;&nbsp;{{__(" Area")}}</label>
                          <div class=" col-12">
                            <input type="text" name="customer_area" class="form-control" value="{{ old('customer_area', '') }}">
                            @include('alerts.feedback', ['field' => 'customer_area'])
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-12 ">
                        <div class="form-group">
                          <label for="customer_shop_address" class="col-12 control-label">&nbsp;&nbsp;{{__(" Shop Address")}}</label>
                          <div class=" col-12">
                            <input type="text" name="customer_shop_address" class="form-control col-12" value="{{ old('customer_shop_address', '') }}">
                            @include('alerts.feedback', ['field' => 'customer_shop_address'])
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col-12 ">
                        <div class="form-group">
                          <label for="customer_resident_address" class="col-12 control-label">&nbsp;&nbsp;{{__(" Residential Address")}}</label>
                          <div class=" col-12">
                            <input type="text" name="customer_resident_address" class="form-control col-12" value="{{ old('customer_resident_address', '') }}">
                            @include('alerts.feedback', ['field' => 'customer_resident_address'])
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer row">
                  <div class=" col-6">
                    <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round ">{{__('Back')}}</a>
                  </div>
                  <div class=" col-6">
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
  <script>
    $(function (){
      $('#customer_store').validate({
        rules: {
          customer_ref_no: 'required',
          customer_name: 'required',
          customer_type: 'required',
          customer_balance_paid: 'required',
          customer_balance_dues: 'required',
          customer_sale_rate: 'required',
          status_id: 'required',
        },
        messages: {
          customer_ref_no: 'Please Enter Customer Ref No',
          customer_name: 'Please Enter Customer Name',
          customer_type: 'Please Enter Customer Type',
          customer_balance_paid: 'Please Enter Customer Balance Paid',
          customer_balance_dues: 'Please Enter Customer Balance Dues',
          customer_sale_rate: 'Please Enter Customer Payment Method Cash/Credit',
          status_id: 'Please Select Status',
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
        submitHandler: function(form) {
          form.submit();
        }
      });
    });
  </script>
@endsection