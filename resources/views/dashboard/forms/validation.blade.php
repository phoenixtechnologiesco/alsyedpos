@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <i class="icon-note"></i> Validation - jQuery Validation Plugin
              <div class="card-actions">
                <a href="https://github.com/jzaefferer/jquery-validation">
                  <small class="text-muted">docs</small>
                </a>
              </div>
            </div>
            <div class="card-body">
              This jQuery plugin makes simple clientside form validation easy, whilst still offering plenty of customization options. It makes a good choice if you’re building something new from scratch, but also when you’re trying to integrate something into an existing
              application with lots of existing markup. The plugin comes bundled with a useful set of validation methods, including URL and email validation, while providing an API to write your own methods. All bundled methods come with default error
              messages in english and translations into 37 other languages.
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <h6>Simple Form</h6>
                  <form id="signupForm">
                    <div class="form-group">
                      <label class="col-form-label" for="firstname">First name</label>
                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="lastname">Last name</label>
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="email">Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="col-form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="col-form-label" for="confirm_password">Confirm password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="agree" name="agree" value="agree"> Please agree to our policy
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Sign up</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</div>
@endsection

@section('javascript')
    <!-- Plugins and scripts required by this views -->
    <script src="{{ asset('js/coreui/min/jquery.validate.min.js') }}"></script>

    <!-- Custom scripts required by this view -->
    {{-- <script src="{{ asset('js/coreui/validation.js') }}"></script> --}}
@endsection