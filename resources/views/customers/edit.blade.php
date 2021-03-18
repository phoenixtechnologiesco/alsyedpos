@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Customer")}}</h5>
          </div>
          <div class="card-body-custom">
            <form id="customer_update" method="post" action="{{ route('customer.update', ['customer' => $customer[0]->customer_id,]) }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              <div class="row">
                <div class="card-body-custom col-12 ">
                  <div class="row">
                    <div class="col-3 ">
                      <div class="form-group">
                        <label for="customer_ref_no" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Reference No.")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_ref_no" class="form-control col-12" value="{{ $customer[0]->customer_ref_no }}">
                            @include('alerts.feedback', ['field' => 'customer_ref_no'])
                          </div>
                      </div>
                    </div>
                    <div class="col-3 ">
                      <div class="form-group">
                          <label for="customer_type" class="col-sm-2 col-10 control-label">&nbsp;&nbsp;{{__(" Customer Type")}}</label>
                          <div class="col-sm-10 col-12">
                            <select name="customer_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                              <option value="general" {{ $customer[0]->customer_type == 'general' ? 'selected' : '' }}>General</option>
                              <option value="distributer" {{ $customer[0]->customer_type == 'distributer' ? 'selected' : '' }}>Distributer</option>
                              <option value="reseller" {{ $customer[0]->customer_type == 'reseller' ? 'selected' : '' }}>Reseller</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'customer_type'])
                          </div>
                      </div>
                    </div>
                    <div class="col-3 ">
                        <div class="form-group">
                          <label for="customer_name" class="col-sm-2 col-10 control-label">&nbsp;&nbsp;{{__(" Customer Name")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_name" class="form-control col-12" value="{{ $customer[0]->customer_name }}">
                            @include('alerts.feedback', ['field' => 'customer_name'])
                          </div>
                        </div>
                    </div>
                    <div class="col-3 ">
                      <div class="form-group">
                        <label for="customer_shop_name" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Shop Name")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_shop_name" class="form-control col-12" value="{{ $customer[0]->customer_shop_name }}">
                            @include('alerts.feedback', ['field' => 'customer_shop_name'])
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6 ">
                        <div class="form-group">
                          <label for="customer_shop_info" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Shop Description")}}</label>
                            <div class="col-sm-10 col-12">
                              <input type="text" name="customer_shop_info" rows="2" class="form-control col-12" value="{{ $customer[0]->customer_shop_info }}">
                              @include('alerts.feedback', ['field' => 'customer_shop_info'])
                            </div>
                        </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_balance_paid" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Balance Paid")}}</label>
                          <div class="col-sm-10 col-12 input-group mb-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text rs">Rs: </span>
                            </div>
                            <input type="number" name="customer_balance_paid" class="form-control" value="{{ $customer[0]->customer_balance_paid }}">
                            @include('alerts.feedback', ['field' => 'customer_balance_paid'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_balance_dues" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Balance Dues")}}</label>
                            <div class="col-sm-10 col-12 input-group mb-1">
                              <div class="input-group-prepend">
                                <span class="input-group-text rs">Rs: </span>
                              </div>
                              <input type="number" name="customer_balance_dues" class="form-control" value="{{ $customer[0]->customer_balance_dues }}">
                              @include('alerts.feedback', ['field' => 'customer_balance_dues'])
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_sale_rate" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Sale Rate")}}</label>
                          <div class="col-sm-10 col-12">
                            <select name="customer_sale_rate" class="form-control col-12">
                              <option value="cash" {{ $customer[0]->customer_sale_rate == 'cash' ? 'selected' : '' }}>Cash</option>
                              <option value="credit" {{ $customer[0]->customer_sale_rate == 'credit' ? 'selected' : '' }}>Credit</option>
                              <option value="nonbulk" {{ $customer[0]->customer_sale_rate == 'nonbulk' ? 'selected' : '' }}>Non Bulk Buyer</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'customer_sale_rate'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_credit_limit" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Credit Limit")}}</label>
                          <div class="col-sm-10 col-12 input-group mb-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text rs">Rs: </span>
                            </div>
                            <input type="number" name="customer_credit_limit" class="form-control col-12" value="{{ $customer[0]->customer_credit_limit }}">
                            @include('alerts.feedback', ['field' => 'customer_credit_limit'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_credit_duration" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Credit Duration")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="number" name="customer_credit_duration" class="form-control col-12" value="{{ $customer[0]->customer_credit_duration }}">
                            @include('alerts.feedback', ['field' => 'customer_credit_duration'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_credit_type" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Credit Type")}}</label>
                            <div class="col-sm-10 col-12">
                              <select name="customer_credit_type" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Credit Type">
                                <option value="">Select</option>
                                <option value="days" {{ $customer[0]->customer_credit_type == 'days' ? 'selected' : '' }}>Days</option>
                                <option value="months" {{ $customer[0]->customer_credit_type == 'months' ? 'selected' : '' }}>Months</option>
                              </select>
                              @include('alerts.feedback', ['field' => 'customer_credit_type'])
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-6">
                      <div class="form-group">
                        <label for="customer_email" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Email")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_email" class="form-control col-12" value="{{ $customer[0]->customer_email }}">
                            @include('alerts.feedback', ['field' => 'customer_email'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-6">
                        <div class="form-group">
                          <label for="customer_alternate_email" class="col-sm-2 col-6 control-label">&nbsp;&nbsp;{{__(" Alternate Email")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_alternate_email" class="form-control col-12" value="{{ $customer[0]->customer_alternate_email }}">
                            @include('alerts.feedback', ['field' => 'customer_alternate_email'])
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_cnic_number" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Cnic Number")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_cnic_number" class="form-control col-12" value="{{ $customer[0]->customer_cnic_number }}">
                            @include('alerts.feedback', ['field' => 'customer_cnic_number'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_phone_number" class="col-sm-2 col-8 control-label">&nbsp;&nbsp;{{__(" Phone Number")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_phone_number" class="form-control col-12" value="{{ $customer[0]->customer_phone_number }}">
                            @include('alerts.feedback', ['field' => 'customer_phone_number'])
                          </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                        <div class="form-group">
                          <label for="customer_office_number" class="col-sm-2 col-10 control-label">&nbsp;&nbsp;{{__(" Office Number")}}</label>
                          <div class="col-sm-10 col-12">
                            <input type="text" name="customer_office_number" class="form-control col-12" value="{{ $customer[0]->customer_office_number }}">
                            @include('alerts.feedback', ['field' => 'customer_office_number'])
                          </div>
                        </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_alternate_number" class="col-sm-2 col-12 control-label">&nbsp;&nbsp;{{__(" Alternate Phone Number")}}</label>
                        <div class="col-sm-10 col-12">
                          <input type="text" name="customer_alternate_number" class="form-control col-12" value="{{ $customer[0]->customer_alternate_number }}">
                          @include('alerts.feedback', ['field' => 'customer_alternate_number'])
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-3">
                      <div class="form-group">
                        <label for="status" class="col-sm-2 col-12 control-label">&nbsp;&nbsp;{{__(" Status")}}</label>
                        <div class="col-sm-10 col-12">
                          <select name="status_id" class="form-control col-12">
                            <option value="1" {{ $customer[0]->status_id == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $customer[0]->status_id == 0 ? 'selected' : '' }}>Inactive</option>
                          </select>
                          {{-- <input type="text" name="status_id" class="form-control" value="{{ $customer[0]->status }}"> --}}
                          @include('alerts.feedback', ['field' => 'status_id'])
                        </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_zipcode" class="col-sm-2 col-6 control-label">&nbsp;&nbsp;{{__(" Zip Code")}}</label>
                        <div class="col-sm-10 col-12">
                          <input type="text" name="customer_zipcode" class="form-control" value="{{ $customer[0]->customer_zipcode }}">
                          @include('alerts.feedback', ['field' => 'customer_zipcode'])
                        </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_town" class="col-sm-2 col-6 control-label">&nbsp;&nbsp;{{__(" Town")}}</label>
                        <div class="col-sm-10 col-12">
                          <input type="text" name="customer_town" class="form-control" value="{{ $customer[0]->customer_town }}">
                          @include('alerts.feedback', ['field' => 'customer_town'])
                        </div>
                      </div>
                    </div>
                    <div class=" col-3 ">
                      <div class="form-group">
                        <label for="customer_area" class="col-sm-2 col-6 control-label">&nbsp;&nbsp;{{__(" Area")}}</label>
                        <div class="col-sm-10 col-12">
                          <input type="text" name="customer_area" class="form-control" value="{{ $customer[0]->customer_area }}">
                          @include('alerts.feedback', ['field' => 'customer_area'])
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <label for="customer_shop_address" class="col-sm-2 col-6 control-label">&nbsp;&nbsp;{{__(" Shop Address")}}</label>
                        <div class="col-sm-10 col-12">
                          <input type="text" name="customer_shop_address" class="form-control col-12" value="{{ $customer[0]->customer_shop_address }}">
                          @include('alerts.feedback', ['field' => 'customer_shop_address'])
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=" col-12 ">
                      <div class="form-group">
                        <label for="customer_resident_address" class="col-sm-2 col-6 control-label">&nbsp;&nbsp;{{__(" Residential Address")}}</label>
                        <div class="col-sm-10 col-12">
                          <input type="text" name="customer_resident_address" class="form-control col-12" value="{{ $customer[0]->customer_resident_address }}">
                          @include('alerts.feedback', ['field' => 'customer_resident_address'])
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
                  <form action="{{ route('customer.destroy', $customer[0]->customer_id) }}" method="POST">
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
    $('#customer_update').validate({
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