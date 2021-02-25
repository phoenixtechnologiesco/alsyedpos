@extends('dashboard.base')

@section('content')

<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Role</h4>
          </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="card-body col-12">
                        <input type="hidden" name="id" value="{{ $role->id }}"/>
                        <table class="table table-bordered datatable">
                          <tbody>
                            <tr>
                              <th>
                                Name
                              </th>
                              <td>
                                <input class="form-control" name="name" value="{{ $role->name }}" type="text"/>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                      {{-- <button class="btn btn-primary" type="submit">Save</button>
                      <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a> --}}
                    <div class="card-footer row">
                      <div class="col-6">
                        <button type="submit" class="btn btn-info btn-round pull-left">{{__('Update')}}</button>
                      </div>
                    </form>
                      <div class="col-6">
                        <a type="button" href="{{ URL::previous() }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
                        <form action="{{ route('roles.destroy', $role->id ) }}" method="POST">
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


@endsection