@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('Edit') }} {{ $user->name }}
            </div>
            <div class="card-body">
                <form id="user_update" method="POST" action="{{ route('users.update', ['user' =>  $user->id,]) }}" autocomplete="off" >
                  {{-- action="/users/{{ $user->id }}" --}}
                    @csrf
                    @method('PUT')
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
                                    <input class="form-control col-12" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $user->name }}" required autofocus>
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
                                      <input class="form-control col-12" type="text" placeholder="{{ __('Username') }}" name="email" value="{{ $user->email }}" required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-col-3">
                                <div class="form-group">
                                  <label for="password" class=" col-12 control-label">&nbsp;&nbsp;{{__(" New Password")}}</label>
                                  <div class="form-col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="user-list-btn">
                                          *
                                          {{-- <i class="fa fa-user"></i> --}}
                                        </a>
                                      </span>
                                    </div>
                                    <input class="form-control col-12" type="text" minlength="6" placeholder="{{ __(" New Password") }}" name="password" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="form-last-col-3">
                                <div class="form-group">
                                  <label for="password_confirmation" class=" col-12 control-label">&nbsp;&nbsp;{{__(" New Confirm Password")}}</label>
                                  <div class="form-col-12 input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text barcode">
                                        <a class="" id="user-list-btn">
                                          *
                                          {{-- <i class="fa fa-user"></i> --}}
                                        </a>
                                      </span>
                                    </div>
                                    <input class="form-control col-12" type="text" minlength="6" placeholder="{{ __(' New Confirm Password') }}" name="password_confirmation" value="{{ old('password_confirmation', '') }}">
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
                        <button type="submit" class="btn btn-info btn-round pull-left">{{__('Update')}}</button>
                      </div>
                  </form>
                      <div class="col-6">
                        <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
</div>
@endsection

@section('javascript')
<script type="text/javascript">
  $(function (){
    $('#user_update').validate({
      rules: {
        name: 'required',
        email: 'required',
      },
      messages: {
        name:  'Please Enter Full Name',
        email:  'Please Enter Username',
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