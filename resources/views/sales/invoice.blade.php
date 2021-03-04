<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/png" href="{{asset('assets/img/alsyedstorelogo.png')}}" />
    <title>{{__('Al-Syed General Store')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
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
        .custom-td{
            border: none;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        table .thead-dark-custom{
            color: #fff;
            background-color: #2f353a;
            border-color: #40484f;
        }

        table .firstcol{
            padding: 0.3rem;
            padding-left: 25px;
            padding-right: 2.5px;
            vertical-align: top;
            border-top: 0px solid;
            border-top-color: #d8dbe0;
        }
        table .midcol{
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
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
  </head>
  <body>
    <div style="max-width:400px;margin:0 auto">
        <div id="receipt-data">
            <div class="centered">
                <div class="row">
                    <div class="form-col-12">
                        <img src="{{asset('assets/img/alsyedstorelogo.png')}}" height="50" width="70" style="margin:5px 0;filter: brightness(0);">&nbsp;
                        {{-- <strong style="vertical-align:top">{{__('Al-Syed General Store')}}</strong> --}}
                    </div>
                </div>
            </div>
            <table >
                <thead>
                    <tr class="custom-td">
                        <th class="custom-td"><strong>{{__('Al-Syed General Store')}}</strong></th>
                        <th class="custom-td">{{$warehouse_data->warehouse_name}}</th>
                        {{-- <th class="custom-td">{{$warehouse_data->warehouse_name." ".$warehouse_data->warehouse_location}}</th> --}}
                    </tr class="custom-td">
                </thead>
                <tbody>
                    <tr class="custom-td">
                        <td class="custom-td" style="text-align:left"><strong>{{"Invoice #: ".$sale_data->sale_invoice_id}}</strong></td>
                        <td class="custom-td" style="text-align:right">{{$sale_data->sale_payment_method}}</td>
                    </tr>
                    <tr class="custom-td">
                        <td class="custom-td">{{$customer_data['customer_name']." ".$customer_data['customer_ref_no']}}</td>
                        <td class="custom-td" style="text-align:right">{{$sale_data->created_at}}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead class="thead-dark-custom">
                    <tr class="row">
                        <th colspan="1" class="mycol form-col-1" style="text-align:left"><strong>{{__('Product')}}</strong></th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left"><strong>{{__('Qty')}}</strong></th>
                        <th colspan="1" class="mycol form-col-2" style="text-align:left"><strong>{{__('U.Price')}}</strong></th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left"><strong>{{__(' ')}}</strong></th>
                        <th colspan="1" class="mycol form-col-2" style="text-align:left"><strong>{{__('Disc.')}}</strong></th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left"><strong>{{__(' ')}}</strong></th>
                        <th colspan="1" class="mycol form-col-3" style="text-align:left"><strong>{{__('Amount')}}</strong></th>
                        <th colspan="1" class="mycol form-col-1" style="text-align:left"><strong>{{__(' ')}}</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sale_quantity_all=0; $unit_price_all=0; ?>
                    @foreach($sale_products_data as $sale_product)
                    <?php 
                        $product_data = \App\Models\Product::where('product_id', $sale_product->product_id)->first();
                        $product_name = $product_data->product_name;
                        $sale_quantity_all += $sale_product->sale_quantity_total;
                        // $unit_price_all += number_format((float)($sale_product->sale_product_sub_total / $sale_product->sale_quantity_total), 2, '.', '');
                    ?>
                    <tr class="row">
                        <td colspan="1" class="mycol form-col-2" style="text-align:left;">{{$product_name}}</td>
                        <td colspan="1" class="mycol form-col-2" style="text-align:left;">{{$sale_product->sale_quantity_total}}{{__('pcs')}}</td>
                        {{-- {{number_format((float)($sale_product->sale_product_sub_total / $sale_product->sale_quantity_total), 2, '.', '')}} --}}
                        <td colspan="2" class="mycol form-col-3" style="text-align:left;">{{number_format((float)$sale_product->sale_product_sub_total, 2, '.', '')}}</td>
                        <td colspan="2" class="mycol form-col-2" style="text-align:left;">{{$sale_product->sale_trade_discount}}</td>
                        <td colspan="2" class="mycol form-col-3" style="text-align:left;">|{{number_format((float)($sale_product->sale_product_sub_total*$sale_product->sale_quantity_total), 2, '.', '')}}|</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="row">
                        <th colspan="1" class="mycol form-col-2" style="text-align:left;">{{__('Total')}}</th>
                        <th colspan="1" class="mycol form-col-2" style="text-align:left;">{{$sale_quantity_all}}{{__('pcs')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left;"></th>
                        <th colspan="2" class="mycol form-col-2" style="text-align:left;">{{number_format((float)$sale_data->sale_discount, 2, '.', '')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left;">|{{number_format((float)$sale_data->sale_grandtotal_price, 2, '.', '')}}|</th>
                    </tr>
                    {{-- @if($sale_data->sale_discount)
                    <tr>
                        <th colspan="2">{{__('Order Discount')}}</th>
                        <th style="text-align:right">{{number_format((float)$sale_data->sale_discount, 2, '.', '')}}</th>
                    </tr>
                    @endif --}}
                    <tr>
                        <th colspan="6" class="mycol form-col-1" style="text-align:left;">{{__('Grand total')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">{{number_format((float)$sale_data->sale_grandtotal_price, 2, '.', '')}}</th>
                    </tr>
                    <tr>
                        <th colspan="2" class="mycol form-col-1" style="text-align:left;">{{__('In Words: ')}}</th>
                        <th colspan="6" class="mycol form-col-3" style="text-align:left;"><span>{{str_replace("-"," ",$numberInWords)}}</span><span>{{__(' Rupees')}}</span></th>
                    </tr>
                    <tr>
                        <th colspan="6" class="mycol form-col-1" style="text-align:left;">{{__('Previous Balance')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">{{number_format((float)$customer_data->customer_balance_dues, 2, '.', '')}}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="mycol form-col-1" style="text-align:left;">{{__('Net Balance')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">{{number_format((float)$customer_data->customer_balance_dues+$sale_data->sale_grandtotal_price, 2, '.', '')}}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="mycol form-col-1" style="text-align:left;">{{__('Payment Recieved')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">{{number_format((float)$sale_data->sale_total_amount_paid, 2, '.', '')}}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="mycol form-col-1" style="text-align:left;">{{__('Payment Dues')}}</th>
                        <th colspan="2" class="mycol form-col-3" style="text-align:left">{{number_format((float)($customer_data->customer_balance_dues+$sale_data->sale_grandtotal_price)-($sale_data->sale_total_amount_dues), 2, '.', '')}}</th>
                    </tr>
                </tfoot>
            </table>
            <table>
                <tbody>
                    @foreach($payment_data as $payment_data)
                    <tr style="background-color:#ddd;">
                        <td style="padding: 5px;width:30%">{{__('Paid By')}}: {{$payment_data->payment_method}}</td>
                        <td style="padding: 5px;width:40%">{{__('Amount')}}: {{number_format((float)$payment_data->payment_amount_paid, 2, '.', '')}}</td>
                        <td style="padding: 5px;width:30%">{{__('Change')}}: {{number_format((float)$payment_data->payment_amount_dues, 2, '.', '')}}</td>
                    </tr>                
                    @endforeach
                    <tr>
                        <td class="centered" colspan="3">{{__('Thank you for shopping with us. Please come again')}}</td>
                    </tr>
                    <tr>
                        <td class="centered" colspan="3">
                        <?php echo '<img style="margin-top:10px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($sale_data->sale_ref_no, 'C128') . '" width="300" alt="barcode"   />';?>
                        <br>
                        <?php echo '<img style="margin-top:10px;" src="data:image/png;base64,' . DNS2D::getBarcodePNG($sale_data->sale_ref_no, 'QRCODE') . '" alt="barcode"   />';?>    
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="centered" style="margin:30px 0 50px">
                <small>{{__('Invoice Generated By')}} {{ $user_data->name }}.
                </small>
                <p>
                    <br>{{__(" Contact Number")}}: {{$warehouse_data->warehouse_phone_number}}
                </p>
            </div>
            @if(preg_match('~[0-9]~', url()->previous()))
                @php $url = '../../sale/pos'; @endphp
            @else
                @php $url = url()->previous(); @endphp
            @endif
        </div>
        <div class="hidden-print">
            <table >
                <tbody>
                    <tr class="custom-td">
                        <td class="custom-td"><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{__(" Back")}}</a></td>
                        <td class="custom-td" style="text-align:right"><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{__(" Print")}}</button></td>
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
