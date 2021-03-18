@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Add Company")}}</h5>
          </div>
          <div class="card-body">
            <form id="company_store" method="post" action="{{ route('company.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('post')
              @include('alerts.success')
                <div class="row">
                  <div class="col-4">
                      <div class="form-group">
                          <label>{{__(" Name")}}</label>
                              <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name" value="{{ old('company_name', '') }}">
                              @include('alerts.feedback', ['field' => 'company_name'])
                      </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="company_ref_no">{{__(" Ref No.")}}</label>
                      <input type="text" id="company_ref_no" name="company_ref_no" class="form-control" placeholder="Ref No." value="{{ old('company_ref_no', '')}}">
                      @include('alerts.feedback', ['field' => 'company_ref_no'])
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="company_parent">{{__(" Parent Company")}}</label>
                      {{-- <input type="text" id="company_parent" name="company_parent" class="form-control" placeholder="Parent ID" value="{{ old('company_parent', '')}}">
                      @include('alerts.feedback', ['field' => 'company_parent']) --}}
                      <select name="parent_company" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Company...">
                          <option selected value="NULL">Select</option>
                        @foreach($allcompanies as $single_company)
                          <option value="{{ $single_company->company_name }}">{{ $single_company->company_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="company_description">{{__(" Description")}}</label>
                      <textarea type="text" id="company_description" rows="3" id="company_description" name="company_description" class="form-control" placeholder="Company Description" value="{{ old('company_description', '') }}"></textarea>
                      {{-- <input type="text" id="company_description" name="company_description" class="form-control" placeholder="Company Description" value="{{ old('company_description', '')}}"> --}}
                      @include('alerts.feedback', ['field' => 'company_description'])
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

<script type="text/javascript">
  $(function (){
    $('#company_store').validate({
      rules: {
        company_name: 'required',
        company_ref_no: 'required',
      },
      messages: {
        company_name:  'Please Enter Company Name',
        company_ref_no:  'Please Enter Company Ref No',
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
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>

@endsection