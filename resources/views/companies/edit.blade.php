@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Company")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('company.update', ['company' => $company[0]->company_id,]) }}" autocomplete="off"
            enctype="multipart/form-data">
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
                <div class="col-6">
                    <div class="form-group">
                        <label>{{__(" Name")}}</label>
                            <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name" value="{{ $company[0]->company_name }}">
                            @include('alerts.feedback', ['field' => 'company_name'])
                    </div>
                </div>
                {{-- <div class="col-4">
                  <div class="form-group">
                    <label for="company_ref_no">{{__(" Ref No.")}}</label>
                    <input type="text" id="company_ref_no" name="company_ref_no" class="form-control" placeholder="Ref No." value="{{ $company[0]->company_ref_no }}">
                    @include('alerts.feedback', ['field' => 'company_ref_no'])
                  </div>
                </div> --}}
                <div class="col-6">
                  <div class="form-group">
                    <label for="company_parent">{{__(" Parent Company")}}</label>
                    {{-- <input type="text" id="company_parent" name="company_parent" class="form-control" placeholder="Parent ID" value="{{ $company[0]->company_parent }}">
                    @include('alerts.feedback', ['field' => 'company_parent']) --}}
                    <select name="company_parent" class="selectpicker form-control col-12" data-live-search="true" data-live-search-style="begins" title="Select Company...">
                        <option selected value="">Select</option>
                      @foreach($allcompanies as $single_company)
                        <option @if($single_company->company_name == $company[0]->company_parent) selected @endif value="{{ $single_company->company_name }}">{{ $single_company->company_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="company_description">{{__(" Description")}}</label>
                    {{-- <textarea type="text" rows="3" id="company_description" name="company_description" class="form-control" placeholder="Company Description" value="{{ $company[0]->company_description }}"></textarea> --}}
                    <input type="text" id="company_description" name="company_description" class="form-control" placeholder="Company Description" value="{{ $company[0]->company_description }}">
                    @include('alerts.feedback', ['field' => 'company_description'])
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
                  <form action="{{ route('company.destroy', $company[0]->company_id) }}" method="POST">
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
@endsection