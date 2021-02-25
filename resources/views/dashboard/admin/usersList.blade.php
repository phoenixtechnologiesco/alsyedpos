@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <a class="btn btn-info btn-round text-white pull-right" href="{{ route('users.create') }}">{{ __('Add User') }}</a>
              <h4 class="card-title">{{ __('Users List') }}</h4>
              <div class="col-12">
              </div>
              {{-- <i class="fa fa-align-justify"></i> {{ __('Users List') }} --}}
            </div>
            <div class="card-body">
                <table class="table table-responsive-sm table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Roles</th>
                    <th>Action</th>
                    {{-- <th></th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->menuroles }}</td>
                      <td>
                        @if( $you->id !== $user->id )
                          <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                        @endif
                      </td>
                      {{-- <td>
                        @if( $you->id !== $user->id )
                        <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-block btn-danger">Delete User</button>
                        </form>
                        @endif
                      </td> --}}
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('javascript')

@endsection

