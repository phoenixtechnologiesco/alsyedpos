<?php
/*
    $data = $menuel['elements']
*/

if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';    
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                $link=[];
                $link=explode('/', $data[$i]['href']);
                if( $data[$i]['slug'] === 'link' ){
                    if(!empty($link[2])){
                        echo '<li class="c-sidebar-nav-item">';
                        echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '" id="'.$link[2].'-report-link" >';
                        echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                    }
                    else{
                        echo '<li class="c-sidebar-nav-item">';
                        echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '" >';
                        echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                    }
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>


        <div class="c-sidebar-brand">
            <img class="c-sidebar-brand-full" src="{{ url('/assets/img/alsyedstorelogo.png') }}" width="80" height="63" alt="Al-Syed Logo">
            <div class="c-sidebar-brand-full text-right"><strong>Al-Syed POS</strong></div>
            <img class="c-sidebar-brand-minimized" src="{{ url('assets/img/alsyedstorelogo.png') }}" width="80" height="63" alt="Al-Syed Logo">
            <div class="c-sidebar-brand-minimized text-right"><strong>Al-Syed POS</strong></div>
        </div>
        <ul class="c-sidebar-nav">
            @if(isset($appMenus['sidebar menu']))
                @foreach($appMenus['sidebar menu'] as $index=>$menuel)
                    @if($menuel['slug'] === 'link')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ url($menuel['href']) }}" >
                            @if($menuel['hasIcon'] === true)
                                @if($menuel['iconType'] === 'coreui')
                                    <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                                @endif
                            @endif 
                            {{ $menuel['name'] }}
                            </a>
                        </li>
                    @elseif($menuel['slug'] === 'dropdown')
                        <?php renderDropdown($menuel) ?>
                    @elseif($menuel['slug'] === 'title')
                        <li class="c-sidebar-nav-title">
                            @if($menuel['hasIcon'] === true)
                                @if($menuel['iconType'] === 'coreui')
                                    <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                                @endif
                            @endif 
                            {{ $menuel['name'] }}
                        </li>
                    @endif
                    {{-- ?php $index++; ?> --}}
                @endforeach
            @endif
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>

    <!-- date modal -->
    <div id="date-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{'Date Report'}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'datereport', 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{'Start Date'}}</label>
                                    <input type="date" name="start_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{'End Date'}}</label>
                                    <input type="date" name="end_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />    
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{' '}}</label>
                                    <button type="submit" class="btn btn-primary">{{'Submit'}}</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- cashcredit modal -->
    <div id="cashcredit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{'Cashcredit Report'}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'cashcreditreport', 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{'Select Payment Method'}}</label>
                                    <div class="input-group">
                                        <select id="cashcredit" name="cashcredit" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins">
                                            <option value="cash">{{'Cash'}}</option>
                                            <option value="credit">{{'Credit'}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'Start Date'}}</label>
                                    <input type="date" name="start_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'End Date'}}</label>
                                    <input type="date" name="end_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />    
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>{{' '}}</label>
                                    <button type="submit" class="btn btn-primary">{{'Submit'}}</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- customer modal -->
    <div id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{'Customer Report'}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'customerreport', 'method' => 'post']) !!}
                    <?php 
                        $customer_list = DB::table('customers')->where('status_id', 1)->get();
                    ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{'Select Customer'}}</label>
                                    <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select Customer...">
                                        @foreach($customer_list as $customer)
                                        <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'Start Date'}}</label>
                                    <input type="date" name="start_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'End Date'}}</label>
                                    <input type="date" name="end_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />    
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>{{' '}}</label>
                                    <button type="submit" class="btn btn-primary">{{'Submit'}}</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- brand modal -->
    <div id="brand-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{'Brand Report'}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'brandreport', 'method' => 'post']) !!}
                    <?php 
                        $brand_list = DB::table('brands')->where('status_id', 1)->get();
                    ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{'Select Brand'}}</label>
                                    <select name="brand_name" class="selectpicker form-control" required data-live-search="true" id="brand-id" data-live-search-style="begins" title="Select Brand...">
                                        @foreach($brand_list as $brand)
                                        <option value="{{$brand->brand_name}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'Start Date'}}</label>
                                    <input type="date" name="start_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'End Date'}}</label>
                                    <input type="date" name="end_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />    
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>{{' '}}</label>
                                    <button type="submit" class="btn btn-primary">{{'Submit'}}</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- company modal -->
    <div id="company-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{'Company Report'}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'companyreport', 'method' => 'post']) !!}
                    <?php 
                        $company_list = DB::table('companies')->where('status_id', 1)->get();
                    ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{'Select Company'}}</label>
                                    <select name="company_name" class="selectpicker form-control" required data-live-search="true" id="brand-id" data-live-search-style="begins" title="Select Company...">
                                        @foreach($company_list as $company)
                                        <option value="{{$company->company_name}}">{{$company->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'Start Date'}}</label>
                                    <input type="date" name="start_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>{{'End Date'}}</label>
                                    <input type="date" name="end_date" class="daterangepicker-field form-control" value="{{date('Y-m-d')}}" />    
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>{{' '}}</label>
                                    <button type="submit" class="btn btn-primary">{{'Submit'}}</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    

    {{-- <ul id="report" class="collapse list-unstyled">
        <li id="profit-loss-report-menu">
          {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
          <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
          <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
          <a id="profitLoss-link" href="">{{'Summary Report'}}</a>
          {!! Form::close() !!}
        </li>
        <li id="best-seller-report-menu">
          <a href="{{url('report/best_seller')}}">{{'Best Seller'}}</a>
        </li>
        <li id="product-report-menu">
          {!! Form::open(['route' => 'report.product', 'method' => 'post', 'id' => 'product-report-form']) !!}
          <input type="hidden" name="start_date" value="2021-03-05" />
          <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
          <a id="report-link" href="">{{'Product Report'}}</a>
          {!! Form::close() !!}
        </li>
        <li id="daily-sale-report-menu">
          <a href="{{url('report/daily_sale/'.date('Y').'/'.date('m'))}}">{{'Daily Sale'}}</a>
        </li>
        <li id="monthly-sale-report-menu">
          <a href="{{url('report/monthly_sale/'.date('Y'))}}">{{'Monthly Sale'}}</a>
        </li>
        <li id="daily-purchase-report-menu">
          <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{'Daily Purchase'}}</a>
        </li>
        <li id="monthly-purchase-report-menu">
          <a href="{{url('report/monthly_purchase/'.date('Y'))}}">{{'Monthly Purchase'}}</a>
        </li>
        <li id="sale-report-menu">
          {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
          <input type="hidden" name="start_date" value="2021-03-05" />
          <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
          <a id="sale-report-link" href="">{{'Sale Report'}}</a>
          {!! Form::close() !!}
        </li>
        <li id="payment-report-menu">
          {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
          <input type="hidden" name="start_date" value="2021-03-05" />
          <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
          <a id="payment-report-link" href="">{{'Payment Report'}}</a>
          {!! Form::close() !!}
        </li>
        <li id="purchase-report-menu">
          {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
          <input type="hidden" name="start_date" value="2021-03-05" />
          <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
          <input type="hidden" name="warehouse_id" value="0" />
          <a id="purchase-report-link" href="">{{'Purchase Report'}}</a>
          {!! Form::close() !!}
        </li>
        <li id="qtyAlert-report-menu">
          <a href="{{route('report.qtyAlert')}}">{{'Product Quantity Alert'}}</a>
        </li>
        <li id="customer-report-menu">
          <a id="customer-report-link" href="">{{'Customer Report'}}</a>
        </li>
        <li id="supplier-report-menu">
          <a id="supplier-report-link" href="">{{'Supplier Report'}}</a>
        </li>
        <li id="due-report-menu">
          {!! Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']) !!}
          <input type="hidden" name="start_date" value="2021-03-05" />
          <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
          <a id="due-report-link" href="">{{'Due Report'}}</a>
          {!! Form::close() !!}
        </li>
    </ul> --}}