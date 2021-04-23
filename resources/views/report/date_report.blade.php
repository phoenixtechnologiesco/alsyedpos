@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h3 class="text-center">{{'Date Report'}}</h3>
                        </div>
                        <div class="card-body-custom">
                            {!! Form::open(['route' => 'datereport', 'method' => 'post']) !!}
                            <div class="row">
                                <div class="card-body-custom col-12 ">
                                    <div class="row">
                                        <div class="col-8 offset-1">
                                            <div class="form-group">
                                                <label><strong>{{'Choose Your Date'}}</strong> &nbsp;</label>
                                                <div class="input-group">
                                                    {{-- <input type="text" class="daterangepicker-field form-control" value="{{$start_date}} To {{$end_date}}" required /> --}}
                                                    <label>&nbsp;<strong>{{'From'}}</strong>&nbsp;</label>
                                                    <input type="date" name="start_date" class="daterangepicker-field form-control" value="{{$start_date}}" required/>
                                                    <label>&nbsp;<strong>{{'To'}}</strong>&nbsp;</label>
                                                    <input type="date" name="end_date" class="daterangepicker-field form-control" value="{{$end_date}}" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label><strong>{{''}}</strong> &nbsp;</label>
                                                <div class="input-group">
                                                    <button class="btn btn-primary" type="submit">{{'Submit'}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <div class="row">
                                <ul class="nav nav-tabs ml-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#customer-sale" role="tab" data-toggle="tab">{{'Sale'}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#customer-payments" role="tab" data-toggle="tab">{{'Payment'}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#customer-return" role="tab" data-toggle="tab">{{'Return'}}</a>
                                    </li>
                                </ul>
                                <div class="card-body-custom col-12">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active" id="customer-sale">
                                            <div class="table-responsive mb-4" style="overflow-x: hidden">
                                                <table id="sale-table" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="1000px" style="width: 1000px;">
                                                    <thead>
                                                        <tr>
                                                            <th class="not-exported-sale"></th>
                                                            <th>{{'Date'}}</th>
                                                            <th>{{'Reference No'}}</th>
                                                            <th>{{'Warehouse'}}</th>
                                                            <th>{{'Product'}} ({{'Qty'}})</th>
                                                            <th>{{'Grand Total'}}</th>
                                                            <th>{{'Paid'}}</th>
                                                            <th>{{'Due'}}</th>
                                                            <th>{{'Status'}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($sale_data as $key=>$sale)
                                                        <tr>
                                                            <td>{{$key}}</td>
                                                            <td>{{date('d/m/Y', strtotime($sale->created_at->toDateString())) . ' '. $sale->created_at->toTimeString()}}</td>
                                                            <td>{{$sale->sale_invoice_id}}</td>
                                                            <td>{{$sale->warehouse->warehouse_name}}</td>
                                                            <td>
                                                                {{-- {{ dd($product_sale_data) }} --}}
                                                                @foreach($product_sale_data[$key] as $product_saledata)
                                                                <?php 
                                                                    $product = App\Models\Product::where('product_id', $product_saledata->product_id)->select('product_name')->get()->toArray();
                                                                ?>
                                                                {{$product[0]['product_name'].' ('.$product_saledata->sale_quantity_total.')'}}
                                                                <br>
                                                                @endforeach
                                                            </td>
                                                            <td>{{$sale->sale_grandtotal_price}}</td>
                                                            <td>{{$sale->sale_amount_paid}}</td>
                                                            <td>{{$sale->sale_amount_dues}}</td>
                                                            {{-- <td>{{number_format((float)($sale->sale_grandtotal_price - $sale->sale_amount_paid), 2, '.', '')}}</td> --}}
                                                            @if($sale->sale_status == 'completed')
                                                            <td><div class="badge badge-success">{{'Completed'}}</div></td>
                                                            @else
                                                            <td><div class="badge badge-danger">{{'Pending'}}</div></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="tfoot active">
                                                        <tr>
                                                            <th></th>
                                                            <th>Total:</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>0.00</th>
                                                            <th>0.00</th>
                                                            <th>0.00</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="customer-payments">
                                            <div class="table-responsive mb-4" style="overflow-x: hidden">
                                                <table id="payment-table" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="1000px" style="width: 1000px;">
                                                    <thead>
                                                        <tr>
                                                            <th class="not-exported-payment"></th>
                                                            <th>{{'Date'}}</th>
                                                            <th>{{'Payment Reference'}}</th>
                                                            <th>{{'Sale Reference'}}</th>
                                                            <th>{{'Amount'}}</th>
                                                            <th>{{'Paid Method'}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($payment_data as $key=>$payment)
                                                            <tr>
                                                                <td></td>
                                                                {{-- <td>{{$key}}</td> --}}
                                                                <td>{{date('d/m/Y', strtotime($payment->created_at))}}</td>
                                                                <td>{{$payment->payment_ref_no}}</td>
                                                                <td>{{$payment->sale_reference}}</td>
                                                                <td>{{$payment->payment_amount_paid}}</td>
                                                                <td>{{$payment->payment_method}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="tfoot active">
                                                        <tr>
                                                            <th></th>
                                                            <th>Total:</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>0.00</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="customer-return">
                                            <div class="table-responsive mb-4" style="overflow-x: hidden">
                                                <table id="return-table" class="table table-sm table-striped table-bordered dataTable display compact hover order-column" cellspacing="0" width="1000px" style="width: 1000px;">
                                                    <thead>
                                                        <tr>
                                                            <th class="not-exported-return"></th>
                                                            <th>{{'Date'}}</th>
                                                            <th>{{'Reference'}}</th>
                                                            <th>{{'Warehouse'}}</th>
                                                            <th>{{'Biller'}}</th>
                                                            <th>{{'Product'}} ({{'qty'}})</th>
                                                            <th>{{'Grand Total'}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($return_data as $key=>$return)
                                                        <tr>
                                                            <td></td>
                                                            {{-- <td>{{$key}}</td> --}}
                                                            <td>{{date('d/m/Y', strtotime($return->created_at->toDateString())) . ' '. $return->created_at->toTimeString()}}</td>
                                                            <td>{{$return->sale_return_ref_no}}</td>
                                                            <td>{{$return->warehouse->warehouse_name}}</td>
                                                            <td>{{$return->cashier->name}}</td>
                                                            <td>
                                                                @foreach($product_return_data[$key] as $productreturn_data)
                                                                <?php 
                                                                    $product = App\Models\Product::where('product_id',$productreturn_data->product_id)->select('product_name')->get()->toArray();
                                                                    // dd($product);
                                                                ?>
                                                                    {{$product[0]['product_name'].' ('.$productreturn_data->salereturn_quantity_total.')'}}
                                                                @endforeach
                                                            </td>
                                                            <td>{{number_format((float)($return->sale_return_grandtotal_price), 2, '.', '')}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="tfoot active">
                                                        <tr>
                                                            <th></th>
                                                            <th>Total:</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>0.00</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>

@endsection

@section('javascript')

    <script type="text/javascript">
        $("ul#report").siblings('a').attr('aria-expanded','true');
        $("ul#report").addClass("show");
        $("ul#report #customer-report-menu").addClass("active");

        // $('.selectpicker').selectpicker('refresh');

        var dt = $('#sale-table').DataTable( {
            // serverSide: true,
            // ajax: '{{ route('api.sale_row_details') }}',
            // columns: [
            //     {
            //         "className":      'details-control',
            //         "orderable":      false,
            //         "searchable":     false,
            //         "data":           null,
            //         "defaultContent": ''
            //     },
            //     { width:'25%', className: 'dt-body-center', data: 'customer_name', name: 'customer_name' },

            //     { className: 'dt-body-center', data: 'sale_ref_no', name: 'sale_ref_no' },
            //     { className: 'dt-body-center', data: 'sale_status', name: 'sale_status' },
            //     { className: 'dt-body-center', data: 'sale_total_items', name: 'sale_total_items' },
            //     { className: 'dt-body-center', data: 'sale_total_quantity', name: 'sale_total_quantity' },
            //     { className: 'dt-body-center', data: 'sale_grandtotal_price', name: 'sale_grandtotal_price' },
            //     { className: 'dt-body-center', data: 'sale_amount_paid', name: 'sale_amount_paid' },
            //     { className: 'dt-body-center', data: 'sale_amount_dues', name: 'sale_amount_dues' },
            // //  { className: 'dt-body-center', data: 'sale_payment_status', name: 'sale_payment_status' },
            // //  { width:'25%', className: 'dt-body-center', data: 'sale_invoice_id', name: 'sale_invoice_id' },
            // //  { width:'25%', className: 'dt-body-center', data: 'sale_invoice_date', name: 'sale_invoice_date' },
            //     // {
            //     //       "targets": [ 12 ],
            //     //       "visible": false
            //     // },
            // //  // { data: 'warehouse_name', name: 'warehouse_name' },
            //     // { data: 'action', name: 'action', orderable: false, searchable: false }
            // ],
            // order: [[1, 'asc']],
            order: [],
            columnDefs: [
                {
                    "orderable": false,
                    'targets': 0
                },
                {
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                    return data;
                    },
                    'checkboxes': {
                    'selectRow': true,
                    'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            select: { style: 'multi',  selector: 'td:first-child'},
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: '<"offset-1"lfB>rt<"offset-1"ip>',
            // dom: '<"top"i>rt<"bottom"flp><"clear">',
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-sale)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_sale(dt, true);
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                        datatable_sum_sale(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-sale)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_sale(dt, true);
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                        datatable_sum_sale(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-sale)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_sale(dt, true);
                        $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                        datatable_sum_sale(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'colvis',
                    columns: ':gt(0)'
                }
            ],
            drawCallback: function () {
                var api = this.api();
                datatable_sum_sale(api, false);
            }
        } );
        function datatable_sum_sale(dt_selector, is_calling_first) {
            // console.log(dt_selector);
            if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
                var rows = dt_selector.rows( '.selected' ).indexes();
                // console.log(rows);
                $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
                $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
                $( dt_selector.column( 7 ).footer() ).html(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum().toFixed(2));
            }
            // else {
            //     console.log(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum().toFixed(2));
            //     $( dt_selector.column( 5 ).footer() ).html(dt_selector.column( 5, {page:'current'} ).data().sum().toFixed(2));
            //     $( dt_selector.column( 6 ).footer() ).html(dt_selector.column( 6, {page:'current'} ).data().sum().toFixed(2));
            //     $( dt_selector.column( 7 ).footer() ).html(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum().toFixed(2));
            // }
        }

        $('#payment-table').DataTable( {
            order: [],
            columnDefs: [
                {
                    "orderable": false,
                    'targets': 0
                },
                {
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                    return data;
                    },
                    'checkboxes': {
                    'selectRow': true,
                    'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            select: { style: 'multi',  selector: 'td:first-child'},
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: '<"offset-1"lfB>rt<"offset-1"ip>',
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-payment)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_payment(dt, true);
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                        datatable_sum_payment(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-payment)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_payment(dt, true);
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                        datatable_sum_payment(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-payment)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_payment(dt, true);
                        $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                        datatable_sum_payment(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'colvis',
                    columns: ':gt(0)'
                }
            ],
            drawCallback: function () {
                var api = this.api();
                datatable_sum_payment(api, false);
            }
        } );
        function datatable_sum_payment(dt_selector, is_calling_first) {
            if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
                var rows = dt_selector.rows( '.selected' ).indexes();

                $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            }
            // else {
            //     $( dt_selector.column( 4 ).footer() ).html(dt_selector.column( 4, {page:'current'} ).data().sum().toFixed(2));
            // }
        }

        $('#return-table').DataTable( {
            order: [],
            columnDefs: [
                {
                    "orderable": false,
                    'targets': 0
                },
                {
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                    return data;
                    },
                    'checkboxes': {
                    'selectRow': true,
                    'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            select: { style: 'multi',  selector: 'td:first-child'},
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: '<"offset-1"lfB>rt<"offset-1"ip>',
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-return)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_return(dt, true);
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                        datatable_sum_return(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-return)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_return(dt, true);
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                        datatable_sum_return(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported-return)',
                        rows: ':visible'
                    },
                    action: function(e, dt, button, config) {
                        datatable_sum_return(dt, true);
                        $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                        datatable_sum_return(dt, false);
                    },
                    footer:true
                },
                {
                    extend: 'colvis',
                    columns: ':gt(0)'
                }
            ],
            drawCallback: function () {
                var api = this.api();
                datatable_sum_return(api, false);
            }
        } );
        function datatable_sum_return(dt_selector, is_calling_first) {
            if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
                var rows = dt_selector.rows( '.selected' ).indexes();

                $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
            }
            // else {
            //     $( dt_selector.column( 6 ).footer() ).html(dt_selector.column( 6, {page:'current'} ).data().sum().toFixed(2));
            // }
        }

        // $(".daterangepicker-field").daterangepicker({
        // callback: function(startDate, endDate, period){
        //     var start_date = startDate.format('YYYY-MM-DD');
        //     var end_date = endDate.format('YYYY-MM-DD');
        //     var title = start_date + ' To ' + end_date;
        //     $(this).val(title);
        //     $('input[name="start_date"]').val(start_date);
        //     $('input[name="end_date"]').val(end_date);
        // }
        // });

    </script>

@endsection