@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-4">
          <div class="row dragdrop">
            <div class="col-md-12">
              <div class="card card-accent-secondary">
                <div class="card-header drag">
                  Drag &amp; Drop Card
                </div>
                <div class="card-body">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                  ea commodo consequat.
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-accent-primary">
                <div class="card-header drag">
                  Drag &amp; Drop Card
                </div>
                <div class="card-body">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                  ea commodo consequat.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row dragdrop">
            <div class="col-md-12">
              <div class="card card-accent-success">
                <div class="card-header drag">
                  Drag &amp; Drop Card
                </div>
                <div class="card-body">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                  ea commodo consequat.
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-accent-warning">
                <div class="card-header drag">
                  Drag &amp; Drop Card
                </div>
                <div class="card-body">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                  ea commodo consequat.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row dragdrop">
            <div class="col-md-12">
              <div class="card card-accent-info">
                <div class="card-header drag">
                  Drag &amp; Drop Card
                </div>
                <div class="card-body">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                  ea commodo consequat.
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-accent-danger">
                <div class="card-header drag">
                  Drag &amp; Drop Card
                </div>
                <div class="card-body">
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                  ea commodo consequat.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('javascript')
    <!-- Plugins and scripts required by this views -->
    <script src="{{ asset('js/coreui/min/jquery-ui.min.js') }}"></script>

    <!-- Custom scripts required by this view -->
    <script src="{{ asset('js/coreui/draggable-cards.js') }}"></script>
@endsection