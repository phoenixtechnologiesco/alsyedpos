<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/alsyedstorelogo.png') }}" />
    <title>{{ __('Al-Syed General Store') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: "text-lowercase";
        }

        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        .custom-td {
            border: none;
        }

        tr {
            border-bottom: 1px dotted #ddd;
        }

        td,
        th {
            padding: 7px 0;
            width: 50%;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: left;
        }

        .custom-td2 {
            padding: 7px 0;
            width: 65%;
        }

        .custom-td3 {
            padding: 7px 0;
            width: 35%;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        small {
            font-size: 11px;
        }

        table .thead-dark-custom {
            color: #fff;
            background-color: #2f353a;
            border-color: #40484f;
        }

        table .firstcol {
            padding: 0.3rem;
            padding-left: 25px;
            padding-right: 2.5px;
            vertical-align: top;
            border-top: 0px solid;
            border-top-color: #d8dbe0;
        }

        table .midcol {
            padding: 0.3rem;
            padding-left: 17px;
            padding-right: 2.5px;
            vertical-align: top;
            border-top: 0px solid;
            border-top-color: #d8dbe0;
        }

        table .mycol {
            padding: 0.3rem;
            padding-left: 2.5px;
            padding-right: 2.5px;
            vertical-align: top;
            border-top: 0px solid;
            border-top-color: #d8dbe0;
        }

        table .lastcol {
            padding: 0.3rem;
            padding-left: 2.5px;
            padding-right: 25px;
            vertical-align: top;
            border-top: 0px solid;
            border-top-color: #d8dbe0;
        }

        table .singlecol {
            padding: 0.3rem;
            padding-left: 25px;
            padding-right: 25px;
            vertical-align: top;
            border-top: 0px solid;
            border-top-color: #d8dbe0;
        }

        table .form-col-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
            position: relative;
            /* width: 100%; */
            padding-right: 5px;
            padding-left: 5px;
        }

        table .form-col-1 {
            -ms-flex: 0 0 8.33333333%;
            flex: 0 0 8.33333333%;
            max-width: 8.33333333%;
            position: relative;
            /* width: 100%; */
            padding-right: 5px;
            padding-left: 5px;
        }

        table .form-col-2 {
            -ms-flex: 0 0 16.66666667%;
            flex: 0 0 16.66666667%;
            max-width: 16.66666667%;
            position: relative;
            /* width: 100%; */
            padding-right: 5px;
            padding-left: 5px;
        }

        table .form-col-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
            position: relative;
            /* width: 100%; */
            padding-right: 5px;
            padding-left: 5px;
        }


        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 0;
            }

            body {
                margin: 0.5cm;
                margin-bottom: 1.6cm;
            }
        }

    </style>
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div style="max-width:400px;margin:0 auto">
        <div id="receipt-data">
            {{-- <div class="centered">
                <div class="row">
                    <div class="form-col-6">
                        <img src="{{asset('assets/img/alsyedstorelogo.png')}}" height="60" width="84" style="margin:5px 0;filter: brightness(0);">&nbsp;
                    </div>
                </div>
            </div> --}}
            <table>
                <thead>
                    <tr class="custom-td">
                        <td class="custom-td" style="text-align:left"><img
                                src="{{ asset('assets/img/alsyedstorelogo.png') }}" height="60" width="84"
                                style="margin:5px 0;filter: brightness(0);">&nbsp;</td>
                        <td class="custom-td"><strong>{{ __('Al-Syed General Store') }}</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="custom-td">
                        <th class="custom-td" style="text-align:left">
                            @if ($warehouse_data)
                                {{ $warehouse_data->warehouse_name }}
                            @endif
                        </th>
                        {{-- <th class="custom-td" style="text-align:right">{{$warehouse_data->warehouse_location}}</th> --}}
                        <th class="custom-td" style="text-align:right">
                            <strong>{{ 'By: ' . $user_data->name }}</strong>
                        </th>

                    </tr>
                </tbody>
            </table>
            <hr>
            <table>
                <tbody>
                    <tr class="custom-td">
                        <td class="custom-td" style="text-align:left">
                            <strong>{{ 'Invoice #: ' . $sale_data->sale_invoice_id }}</strong>
                        </td>
                        {{-- <td class="custom-td3" style="text-align:right"><strong>{{"By: ".$user_data->name}}</strong></td> --}}
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr class="custom-td">
                        <td class="custom-td">
                            {{ $customer_data['customer_name'] . ' ' . $customer_data['customer_ref_no'] }}</td>
                        <td class="custom-td" style="text-align:right">{{ $sale_data->created_at }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-bordered">
                <thead class="thead-dark-custom">
                    <tr class="row">
                        <th colspan="3" class="mycol form-col-2" style="text-align:left">
                            <strong>{{ __('Product') }}</strong>
                        </th>
                        {{-- <th colspan="1" class="mycol form-col-1" style="text-align:left"><strong>{{__(' ')}}</strong></th> --}}
                        <th colspan="2" class="mycol form-col-2" style="text-align:left">
                            <strong>{{ __('Qty') }}</strong>
                        </th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left">
                            <strong>{{ __(' ') }}</strong>
                        </th>
                        <th colspan="2" class="mycol form-col-2" style="text-align:left">
                            <strong>{{ __('Disc.') }}</strong>
                        </th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left">
                            <strong>{{ __(' ') }}</strong>
                        </th>
                        <th colspan="2" class="mycol form-col-2" style="text-align:left">
                            <strong>{{ __('Amount') }}</strong>
                        </th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left">
                            <strong>{{ __(' ') }}</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sale_quantity_all = 0;
                    $unit_price_all = 0;
                    $total_sale_quantity = 0;
                    ?>
                    @foreach ($sale_products_data as $sale_product)
                        <?php
                        $product_data = \App\Models\Product::where('product_id', $sale_product->product_id)->first();
                        $product_name = $product_data->product_name;
                        $sale_quantity_all += $sale_product->sale_quantity_total;
                        // $unit_price_all += number_format((float)($sale_product->sale_product_sub_total /
                        $sale_product->sale_quantity_total;
                        $sale_packets_number = $sale_product->sale_packets_number;
                        $sale_cartons_number = $sale_product->sale_cartons_number;
                        $sale_pieces_number = $sale_product->sale_pieces_number;
                        ?>
                        <tr class="row">
                            <td colspan="3" class="mycol form-col-2" style="text-align:left;">{{ $product_name }}
                            </td>
                            {{-- <td colspan="1" class="mycol form-col-1" style="text-align:left;"></td> --}}
                            <td colspan="2" class="mycol form-col-2" style="text-align:left;">
                                @if ($sale_cartons_number !== 0)
                                    {{ number_format((int) $sale_cartons_number) . 'crtns ' }}@endif @if ($sale_packets_number !== 0)
                                        {{ number_format((int) $sale_packets_number) . 'pckts ' }}@endif
                                    @if ($sale_pieces_number !== 0)
                                        {{ number_format((int) $sale_pieces_number) . 'pcs' }}@endif
                            </td>
                            <td colspan="1" class="mycol form-col-1" style="text-align:left;"></td>
                            {{-- {{number_format((float)($sale_product->sale_product_sub_total / $sale_product->sale_quantity_total), 2, '.', '')}} --}}
                            <td colspan="2" class="mycol form-col-2" style="text-align:left;">
                                {{ number_format((float) $sale_product->sale_trade_discount, 2, '.', '') }}</td>
                            <td colspan="1" class="mycol form-col-1" style="text-align:left;"></td>
                            <td colspan="2" class="mycol form-col-2" style="text-align:left;">
                                |{{ number_format((float) $sale_product->sale_product_sub_total /**$sale_product->sale_quantity_total*/, 2, '.', '') }}|
                            </td>
                            <td colspan="1" class="mycol form-col-1" style="text-align:left;"></td>
                            <?php $total_sale_quantity += $sale_product->sale_quantity_total; ?>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="row">
                        <th colspan="2" class="mycol form-col-2" style="text-align:left;">{{ __('Total') }}</th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                        <th colspan="2" class="mycol form-col-2" style="text-align:left;">
                            {{-- {{number_format((integer)$total_sale_quantity)}}{{__('pcs')}} --}}
                        </th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                        <th colspan="2" class="mycol form-col-2" style="text-align:left;">
                            {{ number_format((float) $sale_data->sale_discount, 2, '.', '') }}</th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                        <th colspan="2" class="mycol form-col-2" style="text-align:left;">
                            |{{ number_format((float) $sale_data->sale_grandtotal_price, 2, '.', '') }}|</th>
                        <td colspan="1" class="mycol form-col-1" style="text-align:left;"></td>
                    </tr>
                    {{-- @if ($sale_data->sale_discount)
                    <tr>
                        <th colspan="2">{{__('Order Discount')}}</th>
                        <th style="text-align:right">{{number_format((float)$sale_data->sale_discount, 2, '.', '')}}</th>
                    </tr>
                    @endif --}}
                    <tr>
                        <th colspan="9" class="mycol form-col-1" style="text-align:left;">
                            {{ __('Previous Balance') }}
                        </th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left;">
                            {{ number_format((float) $customer_data->previous, 2, '.', '') }}</th>
                        {{-- <th colspan="2" class="mycol form-col-3" style="text-align:left;">
                            @if ($customer_data->customer_balance_dues !== 0)
                                {{ number_format((float) $customer_data->customer_balance_dues - $sale_data->sale_grandtotal_price, 2, '.', '') }}
                            @else {{ number_format(0.0, 2, '.', '') }} @endif
                        </th> --}}
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                    </tr>
                    <tr>
                        <th colspan="9" class="mycol form-col-1" style="text-align:left;">{{ __('Net Balance') }}
                        </th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">
                            {{-- {{ number_format((float) $customer_data->customer_balance_dues /*+$sale_data->sale_grandtotal_price*/, 2, '.', '') }} --}}
                            {{ number_format((float) ($customer_data->previous + $sale_data->sale_grandtotal_price), 2, '.', '') }}
                        </th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                    </tr>
                    <tr>
                        <th colspan="9" class="mycol form-col-1" style="text-align:left;">
                            {{ __('Payment Recieved') }}
                        </th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">
                            {{ number_format((float) $sale_data->sale_amount_paid, 2, '.', '') }}</th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                    </tr>
                    <tr>
                        <th colspan="9" class="mycol form-col-1" style="text-align:left;">{{ __('Payment Dues') }}
                        </th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">
                            @if ($customer_data->customer_balance_dues !== 0)
                                {{ number_format((float) ($customer_data->previous + $sale_data->sale_grandtotal_price) /*+($sale_data->sale_amount_dues)*/ - (float) $sale_data->sale_amount_paid, 2, '.', '') }}
                            @else {{ number_format(0, '.', '') }} @endif
                        </th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left;"></th>
                    </tr>
                </tfoot>
            </table>
            <table>
                <tbody>
                    {{-- @foreach ($payment_data as $payment_data)
                    <tr style="background-color:#ddd;">
                        <td style="padding: 5px;width:30%">{{__('Paid By')}}: {{$payment_data->payment_method}}</td>
                        <td style="padding: 5px;width:40%">{{__('Amount')}}: {{number_format((float)$payment_data->payment_amount_paid, 2, '.', '')}}</td>
                        <td style="padding: 5px;width:30%">{{__('Change')}}: {{number_format((float)$payment_data->payment_amount_dues, 2, '.', '')}}</td>
                    </tr>                
                    @endforeach --}}
                    {{-- <tr>
                        <td class="centered" colspan="3">{{__('Thank you for shopping with us. Please come again')}}</td>
                    </tr> --}}
                    {{-- <tr>
                        <td class="centered" colspan="3">
                            ?php echo '<img style="margin-top:10px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($sale_data->sale_ref_no, 'C128') . '" width="300" alt="barcode" />';?>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <div class="centered" style="margin:0px 0 50px">
                <p class="text-lowercase">
                    {{ __('Thanks for shopping! No return No exchange after 15 days or without receipt. (T & C apply).') }}
                    <br>
                    {{ __('To order online visit our website www.alsyedstore.com.') }}
                    <br>
                    {{ __('For retailers: www.alsyedwholesale.pk.') }}
                </p>
                <p>
                    {{ __('Contact Number') }}: @if ($warehouse_data)
                        {{ $warehouse_data->warehouse_phone_number }}@endif
                </p>
                <hr>
                <small>{{ __('Powered By: Phoenix Technologies') }}</small>
                <br>
                <small>{{ __('+923152776517') }}</small>
                @php
                    // $website = strtolower(lcfirst("www.phoenixtechnologies.co"));
                @endphp
                <small>{{ __('www.phoenixtechnologies.co') }}</small>
            </div>
            @if (preg_match('~[0-9]~', url()->previous()))
                @php $url = '../../sale/pos'; @endphp
            @else
                @php $url = url()->previous(); @endphp
            @endif
        </div>
        <div class="hidden-print">
            <table>
                <tbody>
                    <tr class="custom-td">
                        <td class="custom-td"><a href="{{ url()->previous() }}" class="btn btn-info"><i
                                    class="fa fa-arrow-left"></i> {{ __(' Back') }}</a></td>
                        <td class="custom-td" style="text-align:right"><button onclick="window.print();"
                                class="btn btn-primary"><i class="dripicons-print"></i> {{ __(' Print') }}</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script type="text/javascript">
    function auto_print() {
        window.print()
    }
    setTimeout(auto_print, 1000);

</script>

</html>
