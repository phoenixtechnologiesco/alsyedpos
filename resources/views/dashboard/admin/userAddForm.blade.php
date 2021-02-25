@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('Add User') }} </div>
            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}" autocomplete="off" >
                  {{-- action="/users/{{ $user->id }}" --}}
                    @csrf
                    @method('POST')
                    <div class="row">
                      <div class="card-body col-12">
                        <div class="row">
                          <div class="col-12">
                            <div class="row">
                              <div class="form-first-col-3">
                                <div class="form-group">
                                  <label for="name" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Full Name")}}</label>
                                  <div class="form-col-12 input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text barcode">
                                          <svg class="c-icon c-icon-sm">
                                              <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                          </svg>
                                        </span>
                                    </div>
                                    <input class="form-control col-12" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', '') }}" required autofocus>
                                  </div>
                                </div>
                              </div>
                              <div class="form-col-3">
                                <div class="form-group">
                                  <label for="name" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Username")}}</label>
                                  <div class="form-col-12 input-group ">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text barcode">
                                          <a class="" id="user-list-btn"><i class="fa fa-user"></i></a>
                                        </span>
                                      </div>
                                      <input class="form-control col-12" type="text" placeholder="{{ __('Username') }}" name="email" value="{{ old('email', '') }}" required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-col-3">
                                <div class="form-group">
                                  <label for="password" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Password")}}</label>
                                  <div class="form-col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="user-list-btn">
                                          *
                                          {{-- <i class="fa fa-user"></i> --}}
                                        </a>
                                      </span>
                                    </div>
                                    <input class="form-control col-12" type="password" placeholder="{{ __('Password') }}" name="password" value="{{ old('password', '') }}" required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-last-col-3">
                                <div class="form-group">
                                  <label for="password_confirmation" class=" col-12 control-label">&nbsp;&nbsp;{{__(" Confirm Password")}}</label>
                                  <div class="form-col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="user-list-btn">
                                          *
                                          {{-- <i class="fa fa-user"></i> --}}
                                        </a>
                                      </span>
                                    </div>
                                    <input class="form-control col-12" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" value="{{ old('password_confirmation', '') }}" required >
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-block btn-primary">{{ __('Back') }}</a>  --}}
                    <div class="card-footer row">
                      <div class="col-6">
                        <button type="submit" class="btn btn-info btn-round pull-left">{{__('Save')}}</button>
                      </div>
                  </form>
                      <div class="col-6">
                        <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
                      </div>
                    </div>
                {{-- </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')

@endsection