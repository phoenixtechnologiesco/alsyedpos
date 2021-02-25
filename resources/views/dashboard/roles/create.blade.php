@extends('dashboard.base')

@section('content')


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Create New Role</h4>
          </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="row">
                      <div class="card-body col-12">
                        <table class="table table-bordered datatable">
                            <tbody>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <td>
                                        <input class="form-control" name="name" type="text"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer row">
                      <div class="col-6">
                        <button type="submit" class="btn btn-info btn-round pull-left">{{__('Save')}}</button>
                      </div>
                    </form>
                      <div class="col-6">
                        <a type="button" href="{{ route('roles.index') }}" class="btn btn-secondary btn-round pull-right">{{__('Back')}}</a>
                      </div>
                    </div>
                </form>
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