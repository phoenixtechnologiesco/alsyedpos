@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Company")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('company.update', ['company' => $companies->company_id,]) }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__(" Name")}}</label>
                            <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name" value="{{ $companies->company_name }}">
                            @include('alerts.feedback', ['field' => 'company_name'])
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="company_ref_no">{{__(" Ref No.")}}</label>
                    <input type="text" id="company_ref_no" name="company_ref_no" class="form-control" placeholder="Ref No." value="{{ $companies->company_ref_no }}">
                    @include('alerts.feedback', ['field' => 'company_ref_no'])
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="company_parent">{{__(" Parent Company")}}</label>
                    {{-- <input type="text" id="company_parent" name="company_parent" class="form-control" placeholder="Parent ID" value="{{ $companies->company_parent }}">
                    @include('alerts.feedback', ['field' => 'company_parent']) --}}
                    <select name="company_parent" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Company...">
                        <option selected value="NULL">Select</option>
                      @foreach($allcompanies as $single_company)
                        <option @if($single_company->company_name == $companies->company_parent) selected @endif value="{{ $single_company->company_name }}">{{ $single_company->company_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="company_description">{{__(" Description")}}</label>
                    {{-- <textarea type="text" rows="3" id="company_description" name="company_description" class="form-control" placeholder="Company Description" value="{{ $companies->company_description }}"></textarea> --}}
                    <input type="text" id="company_description" name="company_description" class="form-control" placeholder="Company Description" value="{{ $companies->company_description }}">
                    @include('alerts.feedback', ['field' => 'company_description'])
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