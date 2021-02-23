@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
            <i class="icon-calendar"></i> FullCalendar
            <div class="card-actions">
                <a href="http://angular-ui.github.io/ui-calendar/">
                <small class="text-muted">docs</small>
                </a>
            </div>
            </div>
            <div class="card-body">
            <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <!-- Plugins and scripts required by this views -->
    <script src="{{ asset('js/coreui/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/coreui/min/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/coreui/min/gcal.min.js') }}"></script>

    <!-- Custom scripts required by this view -->
    {{-- <script src="{{ asset('js/coreui/calendar.js') }}"></script> --}}
@endsection