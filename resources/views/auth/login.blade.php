@extends('dashboard.authBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-header">
                <center>
                  <div class="logo">
                      <a class="logo" data-toggle="tooltip" data-placement="bottom" title="Al-Syed Store POS">
                      <img class="img-fluid" src="{{asset('assets/img/alsyedstorelogo.png')}}" alt="">
                      </a>
                  </div>
                  <div>
                    <h3>Al-Syed POS</h3>
                  </div>
                </center>
              </div>
              <div class="card-body">
                <center>
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                </center>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <svg class="c-icon">
                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                          </svg>
                        </span>
                      </div>
                      <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <svg class="c-icon">
                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                          </svg>
                        </span>
                      </div>
                      <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                    </div>
                    <div class="row">
                      <div class="col-12 text-center">
                          <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                      </div>
                      </form>
                      {{-- <div class="col-6 text-right">
                          <a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ __('Forgot Your Password?') }}</a>
                      </div> --}}
                    </div>
              </div>
            </div>
            {{-- <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  @if (Route::has('password.request'))
                    <a href="{{ route('register') }}" class="btn btn-primary active mt-3">{{ __('Register') }}</a>
                  @endif
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection