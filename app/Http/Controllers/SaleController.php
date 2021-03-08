<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use App\Models\SaleProducts;
use App\Models\SaleReturn;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use NumberToWords\NumberToWords;
use Auth;
use DB;
use Input;
use Session;
use Response;
use Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales
     *
     * @param  \App\Sale  $model
     * @return \Illuminate\View\View
     */
    public function index(Sale $model, Customer $model2)
    {
        // $sales = $model->paginate(15)->items();
        $sales = Sale::join('customers', 'sales.sale_customer_id', '=', 'customers.customer_id')->get();
        $customers = Customer::where('status_id', 1)->get();

        return view('sales.index', compact('sales', 'customers') );
        // return view('sales.index', ['sales' => $sales]);
    }

    public function getRowDetailsData()
    {
        $sales = Sale::join('customers', 'sales.sale_customer_id', '=', 'customers.customer_id')->join('users', 'sales.sale_added_by', '=', 'users.id')->join('warehouses', 'sales.warehouse_id', '=', 'warehouses.warehouse_id')->select('sales.*', 'customers.customer_name', 'users.name', 'warehouses.warehouse_name')->get();
        $customers = Customer::where('status_id', 1)->get();
        // dd($sales);
        return Datatables::of($sales)
        ->addColumn('action', function ($sales) {
            return '<a type="button" href="sale/'. $sales->sale_id.'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
        })
        // ->editColumn('sale_id', '{{$sale_id}}')
        ->make(true);
    }

    public function return(SaleReturn $model, Customer $model2)
    {
        // $salereturns = SaleReturn::join('sales', 'sale_returns.sale_id', '=', 'sales.sale_id')->get();
        $salereturns = SaleReturn::join('customers', 'sale_returns.sale_return_customer_id', '=', 'customers.customer_id')->get();
        $customers = Customer::where('status_id', 1)->get();

        return view('sales.return', compact('salereturns', 'customers') );
    }

    public function getRowDetailsData2()
    {
        $salereturns = SaleReturn::join('customers', 'sale_returns.sale_return_customer_id', '=', 'customers.customer_id')->join('users', 'sale_returns.sale_return_returned_by', '=', 'users.id')->select('sale_returns.*', 'customers.customer_name', 'users.name')->get();
        $customers = Customer::where('status_id', 1)->get();
        // dd($salereturns);
        return Datatables::of($salereturns)
        // ->editColumn('salereturn_id', '{{$salereturn_id}}')
        ->make(true);
    }

    public function returnadd(SaleReturn $model, Customer $model2, sale $model3)
    {
        $salereturns = SaleReturn::all();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();
        return view('sales.returnadd', compact('salereturns', 'customers', 'products') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sale $model, Customer $model2, Product $model3)
    {
        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();
        return view('sales.add', compact('sales', 'customers', 'products') );
        // return view('sales.add', ['sales' => $model->paginate(15)->items(), 'customers' => $model2->paginate(15)->items(), 'sales' => $model3->paginate(15)->items()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pos(Sale $model, Customer $model2, Product $model3)
    {
        $sales = Sale::all();
        $pendingsales = Sale::where('sale_status', 'pending')->join('customers', 'sales.sale_customer_id', '=', 'customers.customer_id')->get();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();

        return view('sales.pos', compact('sales', 'pendingsales', 'customers', 'products') );
        // return view('sales.pos', ['sales' => $sales, 'pendingsales' => $pendingsales, 'customers' => $customers, 'sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function financial(Sale $model)
    {
        // $sales = $model->paginate(15)->items();
        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::all();
        $payments = Payment::all();

        return view('sales.financial', compact('sales', 'customers', 'products', 'payments') );
        // return view('sales.financial', ['sales' => $sales, 'customers' => $customers, 'payments' => $payments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $validate = Validator::make($request->all(), [ 
        //     'sale_customer_id'         => 'required',
        //     // 'sale_customer_name'       => '',
        //     'sale_total_items'         => '',//'sale_product_items'
        //     'sale_total_qty'           => '',//'sale_product_quantity'
        //     'sale_free_piece'          => '',
        //     'sale_free_amount'         => '',
        //     'sale_status'              => '',
        //     'sale_note'                => '',
        //     // 'sale_date'                => '',
        //     'sale_total_price'         => '',
        //     'sale_add_amount'          => '',
        //     'sale_discount'            => '',
        //     'sale_grandtotal_price'    => '',
        //     'sale_total_amount_paid'   => '',
        //     'sale_total_amount_dues'   => '',
        //     'sale_payment_method'      => '',
        //     'sale_payment_status'      => '',
        //     'sale_document'            => '',
        //     'sale_invoice_id'          => '',
        //     'sale_invoice_date'        => '',
        //     'sale_added_by'            => '',
        //     // 'sale_payment_id'          => '',
        //     'warehouse_id'                 => '',
        // ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $sale_ref_no = $random = Str::random(8); //str_random
        //$sale_adds = $request->except('document');
        //$sale_adds['ref_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $sale_grandtotal_price = $request->sale_grandtotal_price;
        $sale_amount_recieved = $request->sale_amount_recieved;
        $customer_amount_paid = $request->customer_amount_paid;
        $customer_amount_dues = $request->customer_amount_dues;
        $sale_amount_dues = $sale_grandtotal_price;

        if($sale_amount_recieved > $sale_grandtotal_price){
            $customer_amount_paid = $customer_amount_paid + $sale_amount_recieved;
            $customer_amount_dues = $customer_amount_dues - ($sale_amount_recieved - $sale_grandtotal_price);
            $sale_amount_dues = $sale_grandtotal_price - $sale_amount_recieved;
        }
        else{
            $customer_amount_paid = $customer_amount_paid + $sale_amount_recieved;
            $customer_amount_dues = $customer_amount_dues + ($sale_grandtotal_price - $sale_amount_recieved);
            $sale_amount_dues = $sale_grandtotal_price - $sale_amount_recieved;
        }

        $customer_id = $request->sale_customer_id;
        $customer_name = $request->sale_customer_name;
        $customer_edits = array(
            'customer_balance_paid' 	=> $customer_amount_paid,
            'customer_balance_dues' 	=> $customer_amount_dues,
            // 'customer_total_balance'    => $request->customer_total_balance,
        );

        $update = DB::table('customers')->where('customer_id','=', $customer_id)->update($customer_edits);

        $sale_adds = array(
            'sale_ref_no'           => $sale_ref_no,
            'sale_customer_id'      => $request->sale_customer_id,
            'sale_total_items'      => $request->sale_total_items,//'sale_product_items'
            'sale_total_quantity'   => $request->sale_total_qty,//'sale_product_quantity'
            'sale_free_piece'       => $request->sale_free_piece,
            'sale_free_amount'      => $request->sale_free_amount,
            'sale_status'           => $request->sale_status,
            'sale_note'             => $request->sale_note,
            // 'sale_date'             => $request->sale_date,
            'sale_total_price'      => $request->sale_total_price,
            'sale_add_amount'       => $request->sale_add_amount,
            'sale_discount'         => $request->sale_discount,
            'sale_grandtotal_price' => $sale_grandtotal_price,
            'sale_amount_paid'      => $sale_amount_recieved,
            'sale_amount_dues'      => $sale_amount_dues,
            'sale_payment_method'   => $request->sale_payment_method,
            'sale_payment_status'   => $request->sale_payment_status,
            'sale_document'         => $request->sale_document,
            'sale_invoice_id'       => $request->sale_invoice_id,
            'sale_invoice_date'     => $request->sale_invoice_date,
            // 'sale_payment_id'       => $request->sale_payment_id,
            // 'warehouse_id'              => $request->warehouse_id,
            'sale_added_by' 	    => Auth::user()->id,
            'created_at'	 			=> date('Y-m-d h:i:s'),
        );
        $document = $request->sale_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->sale_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/sale', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $sale_adds['sale_document'] = $documentName;
        }

        $product_barcodes = $request->sale_products_barcode;
        // $sale_warehouses = $request->sale_products_warehouse;
        $product_names = $request->sale_name;
        $product_codes = $request->sale_code;
        $product_ids = $request->sale_id;
        $products_pieces = $request->sale_products_pieces;
        $pieces_per_packet = $request->sale_pieces_per_packet;
        $products_packets = $request->sale_products_packets;
        $packets_per_carton = $request->sale_packets_per_carton;
        $products_cartons = $request->sale_products_cartons;
        $pieces_per_carton = $request->sale_pieces_per_carton;
        $products_unit_prices = $request->sale_products_unit_price;
        $products_discounts = $request->sale_products_discount;
        $products_sub_totals = $request->sale_products_sub_total;

        $save = DB::table('sales')->insert($sale_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('sales')->insertGetId($sale_adds)
        
        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            $sale_product_adds[$key] = array(
                'sale_id'                    => $id,
                'product_id'                 => $single_id,
                'sale_product_ref_no'        => $product_codes[$key],
                'sale_product_name'          => $product_names[$key],
                'sale_product_barcode'       => $product_barcodes[$key],
                'warehouse_id'               => $product[$key]->warehouse_id,
                'sale_piece_per_packet'      => $pieces_per_packet[$key],
                'sale_packet_per_carton'     => $packets_per_carton[$key],
                'sale_piece_per_carton'      => $pieces_per_carton[$key],
                'sale_pieces_total'          => $products_pieces[$key],
                'sale_packets_total'         => $products_packets[$key],
                'sale_cartons_total'         => $products_cartons[$key],
                'sale_quantity_total'        => $products_quantity_total[$key],
                'sale_trade_discount'        => $products_discounts[$key],
                'sale_trade_price_piece'     => $products_unit_prices[$key],
                'sale_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'sale_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
                'sale_product_sub_total'     => $products_sub_totals[$key]
            );
            $sale_products_save = DB::table('sale_products')->insert($sale_product_adds[$key]);
        }

        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            $product_edits = array(
                // 'product_ref_no'                => $product_codes[$key],
                // 'product_name'                  => $product_names[$key],
                // 'product_barcode'               => $product_barcodes[$key],
                // 'warehouse_id'                  => $product_warehouses[$key],
                // 'product_piece_per_packet'      => $pieces_per_packet[$key],
                // 'product_piece_per_carton'      => $pieces_per_carton[$key],
                'product_pieces_total'          => $product[$key]->product_pieces_total-$products_pieces[$key],
                'product_pieces_available'      => $product[$key]->product_pieces_available-$products_pieces[$key],
                'product_packets_total'         => $product[$key]->product_packets_total-$products_packets[$key],
                'product_packets_available'     => $product[$key]->product_packets_available-$products_packets[$key],
                'product_cartons_total'         => $product[$key]->product_cartons_total-$products_cartons[$key],
                'product_cartons_available'     => $product[$key]->product_cartons_available-$products_cartons[$key],
                'product_quantity_total'        => $product[$key]->product_quantity_total-$products_quantity_total[$key],
                'product_quantity_available'    => $product[$key]->product_quantity_available-$products_quantity_available[$key],
                // 'product_trade_discount'        => $products_discounts[$key],
                // 'product_trade_price_piece'     => $products_unit_prices[$key],
                // 'product_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                // 'product_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            );
            $update = DB::table('products')->where('product_id','=', $single_id)->update($product_edits);
        }

		if($save){
			return response()->json(['data' => $sale_adds, 'sale_products' => $sale_products_save, 'message' => 'Sale Created Successfully'], 200);
		}else{
			return response()->json("Oops! Something Went Wrong", 400);
		}
    }

    public function storereturn(Request $request)
    {
        // dd($request->all());
        // $validate = Validator::make($request->all(), [ 
        //     'sale_id'                      => '',
        //     'sale_return_ref_no'           => '',
        //     'sale_return_customer_id'      => 'required',
        //     'sale_return_sale_pieces'   => '',
        //     'sale_return_sale_packets'  => '',
        //     'sale_return_sale_cartons'  => '',
        //     'sale_return_unit_price'       => '',
        //     'sale_return_sale_quantity' => '',
        //     'sale_return_status'           => '',
        //     'sale_return_date'             => '',
        //     'sale_return_total_price'      => '',
        //     'sale_return_grandtotal_price' => '',
        //     'sale_return_amount_paid'      => '',
        //     'sale_return_amount_dues'      => '',
        //     'sale_return_payment_method'   => '',
        //     'sale_return_payment_status'   => '',
        //     'sale_return_invoice_id'       => '',
        //     'sale_return_invoice_date'     => '',
        //     'sale_return_document'         => '',
        //     'sale_return_note'             => '',
        //     'sale_return_returned_by'      => '',
        // ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $sale_return_ref_no = $random = Str::random(8); //str_random
        //$sale_return_adds = $request->except('document');
        //$sale_return_adds['ref_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $sale_return_grandtotal_price = $request->sale_grandtotal_price;
        $sale_return_amount_return = $request->sale_amount_returned;
        $customer_amount_paid = $request->customer_amount_paid;
        $customer_amount_dues = $request->customer_amount_dues;
        $sale_return_amount_dues = $sale_return_grandtotal_price;

        if($sale_return_amount_return > $sale_return_grandtotal_price){
            $customer_amount_paid = $customer_amount_paid - $sale_return_grandtotal_price;
            $customer_amount_dues = $customer_amount_dues + ($sale_return_amount_return - $sale_return_grandtotal_price);
            $sale_return_amount_dues = $sale_return_amount_return - $sale_return_grandtotal_price;
        }
        else{
            $customer_amount_paid = $customer_amount_paid - $sale_return_amount_return;
            $customer_amount_dues = $customer_amount_dues - ($sale_return_grandtotal_price - $sale_return_amount_return);
            $sale_return_amount_dues = $sale_return_grandtotal_price - $sale_return_amount_return;
        }

        $customer_id = $request->sale_customer_id;
        $customer_name = $request->sale_customer_name;
        $customer_edits = array(
            'customer_balance_paid' 	=> $customer_amount_paid,
            'customer_balance_dues' 	=> $customer_amount_dues,
            // 'customer_total_balance'    => $request->customer_total_balance,
        );

        $update = DB::table('customers')->where('customer_id','=', $customer_id)->update($customer_edits);

        $salereturn_adds = array(
            'sale_return_ref_no'           => $sale_return_ref_no,
            'sale_return_customer_id'      => $request->sale_customer_id,
            'sale_return_total_items'      => $request->sale_total_items,//'sale_product_items'
            'sale_return_total_quantity'   => $request->sale_total_qty,//'sale_product_quantity'
            'sale_return_free_piece'       => $request->sale_free_piece,
            'sale_return_free_amount'      => $request->sale_free_amount,
            'sale_return_status'           => $request->sale_status,
            'sale_return_date'             => $request->sale_invoice_date,
            'sale_return_total_price'      => $request->sale_total_price,
            'sale_return_add_amount'       => $request->sale_add_amount,
            'sale_return_discount'         => $request->sale_discount,
            'sale_return_grandtotal_price' => $sale_return_grandtotal_price,
            'sale_return_amount_return'    => $sale_return_amount_return,
            'sale_return_amount_dues'      => $sale_return_amount_dues,
            'sale_return_payment_method'   => $request->sale_payment_method,
            'sale_return_payment_status'   => $request->sale_payment_status,
            'sale_return_invoice_id'       => $request->sale_invoice_id,
            'sale_return_invoice_date'     => $request->sale_invoice_date,
            'sale_return_document'         => $request->sale_document,
            'sale_return_note'             => $request->sale_note,
            'sale_return_returned_by' 	   => Auth::user()->id,
            'created_at'	 			   => date('Y-m-d h:i:s'),
        );
        $document = $request->sale_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->sale_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/sale', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $sale_adds['sale_document'] = $documentName;
        }

        $product_barcodes = $request->sale_products_barcode;
        // $product_warehouses = $request->sale_products_warehouse;
        $product_names = $request->sale_name;
        $product_codes = $request->sale_code;
        $product_ids = $request->sale_id;
        $products_pieces = $request->sale_products_pieces;
        $pieces_per_packet = $request->sale_pieces_per_packet;
        $products_packets = $request->sale_products_packets;
        $packets_per_carton = $request->sale_packets_per_carton;
        $products_cartons = $request->sale_products_cartons;
        $pieces_per_carton = $request->sale_pieces_per_carton;
        $products_unit_prices = $request->sale_products_unit_price;
        $products_discounts = $request->sale_products_discount;
        $products_sub_totals = $request->sale_products_sub_total;

        $save = DB::table('sale_returns')->insert($salereturn_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('salereturns')->insertGetId($sale_adds)
        
        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            $salereturn_product_adds[$key] = array(
                'sale_return_id'                   => $id,
                'product_id'                       => $single_id,
                'salereturn_product_ref_no'        => $product_codes[$key],
                'salereturn_product_name'          => $product_names[$key],
                'salereturn_product_barcode'       => $product_barcodes[$key],
                'warehouse_id'                     => $product[$key]->warehouse_id,
                'salereturn_piece_per_packet'      => $pieces_per_packet[$key],
                'salereturn_packet_per_carton'     => $packets_per_carton[$key],
                'salereturn_piece_per_carton'      => $pieces_per_carton[$key],
                'salereturn_pieces_total'          => $products_pieces[$key],
                'salereturn_packets_total'         => $products_packets[$key],
                'salereturn_cartons_total'         => $products_cartons[$key],
                'salereturn_quantity_total'        => $products_quantity_total[$key],
                'salereturn_trade_discount'        => $products_discounts[$key],
                'salereturn_trade_price_piece'     => $products_unit_prices[$key],
                'salereturn_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'salereturn_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
                'salereturn_product_sub_total'     => $products_sub_totals[$key]
            );
            $salereturn_products_save = DB::table('salereturn_products')->insert($salereturn_product_adds[$key]);
        }

        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            $product_edits = array(
                // 'product_id'                    => $single_id,
                // 'product_ref_no'                => $product_codes[$key],
                // 'product_name'                  => $product_names[$key],
                // 'product_barcode'               => $product_barcodes[$key],
                // 'warehouse_id'                  => $product_warehouses[$key],
                // 'product_piece_per_packet'      => $pieces_per_packet[$key],
                // 'product_piece_per_carton'      => $pieces_per_carton[$key],
                'product_pieces_total'          => $product[$key]->product_pieces_total+$products_pieces[$key],
                'product_pieces_available'      => $product[$key]->product_pieces_available+$products_pieces[$key],
                'product_packets_total'         => $product[$key]->product_packets_total+$products_packets[$key],
                'product_packets_available'     => $product[$key]->product_packets_available+$products_packets[$key],
                'product_cartons_total'         => $product[$key]->product_cartons_total+$products_cartons[$key],
                'product_cartons_available'     => $product[$key]->product_cartons_available+$products_cartons[$key],
                'product_quantity_total'        => $product[$key]->product_quantity_total+$products_quantity_total[$key],
                'product_quantity_available'    => $product[$key]->product_quantity_available+$products_quantity_available[$key],
                // 'product_trade_discount'        => $products_discounts[$key],
                // 'product_trade_price_piece'     => $products_unit_prices[$key],
                // 'product_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                // 'product_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            );
            $update = DB::table('products')->where('product_id','=', $single_id)->update($product_edits);
        }

		if($save){
			return response()->json(['data' => $salereturn_adds, 'salereturn_sales' => $salereturn_sales_save, 'message' => 'Sale Returned Successfully'], 200);
		}else{
			return response()->json("Oops! Something Went Wrong", 400);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $model, $id)
    {
        $j = 1;
        $total_quantity = 0;
        $total_discount = 0;
        $subtotal_amount = 0;
        $grandtotal_amount = 0;
        // $s_name = $model->paginate(15)->items()[$id-1]->customer_name;
        $s_id = $model->paginate(15)->items()[$id-1]->sale_customer_id;
        $customer = DB::table('customers')->where('customer_id','=', $s_id)->first();
        // $sale = $model->paginate(15)->items()[$id-1];
        $sale = Sale::where('sale_id', $id)->get();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();
        $saleproducts = SaleProducts::where('sale_id', $id)->get();    

        return view('sales.edit', compact('sale', 'customers', 'products', 'saleproducts', 'customer') );//'selectedsales'
        // return view('sales.edit', ['sales' => $model->paginate(15)->items()[$id-1], 'customers' => $model2->paginate(15)->items(), 'products' => $model3->paginate(15)->items()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sale_id)
    {
        // $sale_id = (int)$id; //OR $request->sale_id;

        $get_sale = DB::table('sales')->where('sale_id', $sale_id)->first();
        $get_customer = DB::table('customers')->where('customer_id', $request->sale_customer_id)->first();


        // $validate = Validator::make($request->all(), [ 
        //     'sale_customer_id'         => 'required',
        //     'sale_customer_name'       => '',
        //     'sale_total_items'         => '',//'sale_product_items'
        //     'sale_total_qty'           => '',//'sale_product_quantity'
        //     'sale_free_piece'          => '',
        //     'sale_free_amount'         => '',
        //     'sale_status'              => '',
        //     'sale_note'                => '',
        //     // 'sale_date'                => '',
        //     'sale_total_price'         => '',
        //     'sale_add_amount'          => '',
        //     'sale_discount'            => '',
        //     'sale_grandtotal_price'    => '',
        //     'sale_total_amount_paid'   => '',
        //     'sale_total_amount_dues'   => '',
        //     'sale_payment_method'      => '',
        //     'sale_payment_status'      => '',
        //     'sale_document'            => '',
        //     'sale_invoice_id'          => '',
        //     'sale_invoice_date'        => '',
        //     'sale_added_by'            => '',
        //     // 'sale_payment_id'          => '',
        //     'warehouse_id'                 => '',
        // ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }

        $sale_grandtotal_price = $request->sale_grandtotal_price;
        $sale_amount_recieved = $request->sale_amount_recieved;
        $sale_amount_paid = $request->customer_amount_paid;
        $sale_amount_dues = $request->customer_amount_dues;
        $net_sale_price = $sale_grandtotal_price - $sale_amount_paid;
        $customer_amount_paid = $request->customer_balance_paid;
        $customer_amount_dues = $request->customer_balance_dues;

        // if($sale_amount_recieved > $net_sale_price){
        $sale_amount_paid_new = $get_sale->sale_amount_paid + $sale_amount_recieved;
        $sale_amount_dues_new = $get_sale->sale_amount_dues - $sale_amount_recieved;
        $customer_amount_paid_new = $customer_amount_paid + $sale_amount_recieved;
        // if($sale_amount_recieved > $sale_grandtotal_price){
        if($sale_amount_recieved > $get_sale->sale_amount_dues){
            $customer_amount_dues_new = $get_customer->customer_balance_dues - ($sale_amount_recieved - $get_sale->sale_amount_dues);
        }
        else{
            $customer_amount_dues_new = $get_customer->customer_balance_dues;
        }

        $customer_id = $request->sale_customer_id;
        // dd($customer_id);
        $customer_name = $request->sale_customer_name;

        $customer_edits = array(
            'customer_balance_paid' 	=> $customer_amount_paid_new,
            'customer_balance_dues' 	=> $customer_amount_dues_new,
            // 'customer_total_balance'    => $request->customer_total_balance,
        );

        $update = DB::table('customers')->where('customer_id','=', $customer_id)->update($customer_edits);

        $sale_edits = array(
            'sale_customer_id'      => $request->sale_customer_id,
            'sale_total_items'      => $request->sale_total_items,//'sale_product_items'
            'sale_total_quantity'   => $request->sale_total_qty,//'sale_product_quantity'
            'sale_free_piece'       => $request->sale_free_piece,
            'sale_free_amount'      => $request->sale_free_amount,
            'sale_status'           => $request->sale_status,
            'sale_note'             => $request->sale_note,
            // 'sale_date'          => $request->sale_date,
            'sale_total_price'      => $request->sale_total_price,
            'sale_add_amount'       => $request->sale_add_amount,
            'sale_discount'         => $request->sale_discount,
            'sale_grandtotal_price' => $sale_grandtotal_price,
            'sale_amount_paid'      => $sale_amount_paid_new,
            'sale_amount_dues'      => $sale_amount_dues_new,
            'sale_payment_method'   => $request->sale_payment_method,
            'sale_payment_status'   => $request->sale_payment_status,
            // 'sale_document'      => $request->sale_document,
            'sale_invoice_id'       => $request->sale_invoice_id,
            'sale_invoice_date'     => $request->sale_invoice_date,
            // 'sale_payment_id'       => $request->sale_payment_id,
            // 'warehouse_id'              => $request->warehouse_id,

        );

        $document = $request->sale_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->sale_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/sale', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $sale_edits['sale_document'] = $documentName;
        }

        $product_barcodes = $request->sale_products_barcode;
        // $product_warehouses = $request->sale_products_warehouse;
        $product_names = $request->product_name;
        $product_codes = $request->product_code;
        $product_ids = $request->product_id;
        $products_pieces = $request->sale_products_pieces;
        $pieces_per_packet = $request->sale_pieces_per_packet;
        $products_packets = $request->sale_products_packets;
        $packets_per_carton = $request->sale_packets_per_carton;
        $products_cartons = $request->sale_products_cartons;
        $pieces_per_carton = $request->sale_pieces_per_carton;
        $products_unit_prices = $request->sale_products_unit_price;
        $products_discounts = $request->sale_products_discount;
        $products_sub_totals = $request->sale_products_sub_total;

        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();
            
            $product_products_get[$key] = DB::table('sale_products')->where('sale_id', $sale_id)->where('sale_id','=', $single_id)->first();

            // if($key == 0){
            //     $sale_products_delete = DB::table('sale_products')->where('sale_id','=', $sale_id)->delete();
            // }

            $sale_product_adds[$key] = array(
                // 'sale_id'                    => $sale_id,
                // 'product_id'                 => $single_id,
                // 'sale_product_ref_no'        => $product_codes[$key],
                // 'sale_product_name'          => $product_names[$key],
                // 'sale_product_barcode'       => $product_barcodes[$key],
                // 'warehouse_id'               => $product[$key]->warehouse_id,
                // 'sale_piece_per_packet'      => $pieces_per_packet[$key],
                // 'sale_packet_per_carton'     => $packets_per_carton[$key],
                // 'sale_piece_per_carton'      => $pieces_per_carton[$key],
                // 'sale_pieces_total'          => $sales_pieces[$key],
                // 'sale_packets_total'         => $sales_packets[$key],
                // 'sale_cartons_total'         => $sales_cartons[$key],
                // 'sale_quantity_total'        => $sales_quantity_total[$key],
                // 'sale_trade_discount'        => $sales_discounts[$key],
                // 'sale_trade_price_piece'     => $sales_unit_prices[$key],
                // 'sale_trade_price_packet'    => $sales_unit_prices[$key]*$pieces_per_packet[$key],
                // 'sale_trade_price_carton'    => $sales_unit_prices[$key]*$pieces_per_carton[$key],
                // 'sale_product_sub_total'     => $sales_sub_totals[$key]
            );

            // $sale_product_save[$key] = DB::table('sale_products')->insert($sale_product_adds[$key]);

            $sale_product_edits[$key] = array(
                'sale_product_name'          => $product_names[$key],
                'sale_piece_per_packet'      => $pieces_per_packet[$key],
                'sale_packet_per_carton'     => $packets_per_carton[$key],
                'sale_piece_per_carton'      => $pieces_per_carton[$key],
                'sale_pieces_total'          => $products_pieces[$key],
                'sale_packets_total'         => $products_packets[$key],
                'sale_cartons_total'         => $products_cartons[$key],
                'sale_quantity_total'        => $products_quantity_total[$key],
                'sale_trade_discount'        => $products_discounts[$key],
                'sale_trade_price_piece'     => $products_unit_prices[$key],
                'sale_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'sale_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
                'sale_product_sub_total'     => $products_sub_totals[$key]
            );

            $sale_products_update = DB::table('sale_products')->where('sale_id', $sale_id)->where('product_id','=', $single_id)->update($sale_product_edits[$key]);
        }
        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            if($sale_products_get[$key]->sale_pieces_total >= $sales_pieces[$key]){
                $diff_sale_pieces_total =  $sale_products_get[$key]->sale_pieces_total-$sales_pieces[$key];
                // dd($diff_sale_pieces_total);
            }
            else{
                $diff_sale_pieces_total =  $sale_products_get[$key]->sale_pieces_total-$sales_pieces[$key];
                // $diff_sale_pieces_total =  $sales_pieces[$key]-$sale_products_get[$key]->sale_pieces_total;
            }
            if($sale_products_get[$key]->sale_pieces_total >= $sales_pieces[$key]){
                $diff_sale_pieces_available = $sale_products_get[$key]->sale_pieces_total-$sales_pieces[$key];
            }
            else{
                $diff_sale_pieces_available = $sale_products_get[$key]->sale_pieces_total-$sales_pieces[$key];
                // $diff_sale_pieces_available = $sales_pieces[$key]-$sale_products_get[$key]->sale_pieces_total;
            }
            if($sale_products_get[$key]->sale_packets_total >= $sales_packets[$key]){
                $diff_sale_packets_total = $sale_products_get[$key]->sale_packets_total-$sales_packets[$key];
            }
            else{
                $diff_sale_packets_total = $sale_products_get[$key]->sale_packets_total-$sales_packets[$key];
                // $diff_sale_packets_total = $sales_packets[$key]-$sale_products_get[$key]->sale_packets_total;
            }
            if($sale_products_get[$key]->sale_packets_total >= $sales_packets[$key]){
                $diff_sale_packets_available   = $sale_products_get[$key]->sale_packets_total-$sales_packets[$key];
            }
            else{
                $diff_sale_packets_available   = $sale_products_get[$key]->sale_packets_total-$sales_packets[$key];
                // $diff_sale_packets_available   = $sales_packets[$key]-$sale_products_get[$key]->sale_packets_total;
            }
            if($sale_products_get[$key]->sale_cartons_total >= $sales_cartons[$key]){
                $diff_sale_cartons_total       = $sale_products_get[$key]->sale_cartons_total-$sales_cartons[$key];
            }
            else{
                $diff_sale_cartons_total       = $sale_products_get[$key]->sale_cartons_total-$sales_cartons[$key];
                // $diff_sale_cartons_total       = $sales_cartons[$key]-$sale_products_get[$key]->sale_cartons_total;
            }
            if($sale_products_get[$key]->sale_cartons_total >= $sales_cartons[$key]){
                $diff_sale_cartons_available   = $sale_products_get[$key]->sale_cartons_total-$sales_cartons[$key];
            }
            else{
                $diff_sale_cartons_available   = $sale_products_get[$key]->sale_cartons_total-$sales_cartons[$key];
                // $diff_sale_cartons_available   = $sales_cartons[$key]-$sale_products_get[$key]->sale_cartons_total;
            }
            if($sale_products_get[$key]->sale_quantity_total >= $sales_quantity_total[$key]){
                $diff_sale_quantity_total      = $sale_products_get[$key]->sale_quantity_total-$sales_quantity_total[$key];
            }
            else{
                $diff_sale_quantity_total      = $sale_products_get[$key]->sale_quantity_total-$sales_quantity_total[$key];
                // $diff_sale_quantity_total      = $sales_quantity_total[$key]-$sale_products_get[$key]->sale_quantity_total;
            }
            if($sale_products_get[$key]->sale_quantity_total >= $sales_quantity_available[$key]){
                $diff_sale_quantity_available  = $sale_products_get[$key]->sale_quantity_total-$sales_quantity_available[$key];
            }
            else{
                $diff_sale_quantity_available  = $sale_products_get[$key]->sale_quantity_total-$sales_quantity_available[$key];
                // $diff_sale_quantity_available  = $sales_quantity_available[$key]-$sale_products_get[$key]->sale_quantity_total;
            }

            // dd($sale[$key]->sale_pieces_total);
            $product_edits[$key] = array(
                // 'product_ref_no'                => $product_codes[$key],
                // 'product_name'                  => $product_names[$key],
                // 'product_barcode'               => $product_barcodes[$key],
                // 'warehouse_id'                  => $product_warehouses[$key],
                // 'product_piece_per_packet'      => $pieces_per_packet[$key],
                // 'product_piece_per_carton'      => $pieces_per_carton[$key],
                'product_pieces_total'          => $product[$key]->product_pieces_total+$diff_sale_pieces_total,
                'product_pieces_available'      => $product[$key]->product_pieces_available+$diff_sale_pieces_available,
                'product_packets_total'         => $product[$key]->product_packets_total+$diff_sale_packets_total,
                'product_packets_available'     => $product[$key]->product_packets_available+$diff_sale_packets_available,
                'product_cartons_total'         => $product[$key]->product_cartons_total+$diff_sale_cartons_total,
                'product_cartons_available'     => $product[$key]->product_cartons_available+$diff_sale_cartons_available,
                'product_quantity_total'        => $product[$key]->product_quantity_total+$diff_sale_quantity_total,
                'product_quantity_available'    => $product[$key]->product_quantity_available+$diff_sale_quantity_available,
                // 'product_trade_discount'        => $products_discounts[$key],
                // 'product_trade_price_piece'     => $products_unit_prices[$key],
                // 'product_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                // 'product_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            );
            $update = DB::table('products')->where('product_id', $single_id)->update($product_edits[$key]);
        }

        $update = DB::table('sales')->where('sale_id', $sale_id)->update($sale_edits);

        // return redirect()->back();
        // return redirect('/sale')->with(['message' => 'Sale Edited Successfully'], 200);
        if($update){
			return response()->json(['data' => $sale_edits, /*'sale_products' => $sale_products_update,*/ 'message' => 'Sale Edited Successfully'], 200);
		}else{
			return response()->json("Oops! Something Went Wrong", 400);
		}
        // return redirect('sales/'.$sale_id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = url()->previous();
        $sale_data = Sale::where('sale_id', $id)->first();
        $sale_products_data = SaleProducts::where('sale_id', $id)->get();
        if(!empty($sale_products_data)){
            foreach ($sale_products_data as $sale_product) {
                // if($sale_product->sale_payment_method == "cash")
                // if($sale_product->sale_payment_method == "credit")
                $product_data = Product::where('sale_id', $sale_product->sale_id)->get();
                //adjust sale quantity
                foreach ($product_data as $child_product) {
                    // $child_data = sale::find($child_id);
                    $child_data = Product::where('sale_id', $child_product->product_id)->first();
                    $update_data = array(
                        'product_quantity_total'  =>  $child_data->product_quantity_total - $sale_product->sale_quantity_total,
                        'product_quantity_available'  =>  $child_data->product_quantity_available - $sale_product->sale_quantity_total,
                        'product_pieces_total'  =>  $child_data->product_pieces_total - $sale_product->sale_pieces_total,
                        'product_packets_total'  =>  $child_data->product_packets_total - $sale_product->sale_packets_total,
                        'product_cartons_total'  =>  $child_data->product_cartons_total - $sale_product->sale_cartons_total,
                        'product_pieces_available'  =>  $child_data->product_pieces_available - $sale_product->sale_pieces_total,
                        'product_packets_available'  =>  $child_data->product_packets_available - $sale_product->sale_packets_total,
                        'product_cartons_available'  =>  $child_data->product_cartons_available - $sale_product->sale_cartons_total,
                    );
                    Product::where('product_id', $child_product->product_id)->update($update_data);
                }
                SaleProducts::where('product_id', $sale_product->product_id)->delete();
            }
        }
        $payment_data = Payment::where('sale_id', $id)->get();
        if(!empty($payment_data)){
            foreach ($payment_data as $payment) {
                if($payment->payment_method == 'cheque'){
                    // $customer = Customer::where('sale_customer_id', $sale_data->sale_customer_id)->get();
                    // $customer_data = array(
                    //     'customer_balance_paid' => $customer->customer_balance_paid - $payment->payment_amount_paid
                    // );
                    // Customer::where('customer_id', $sale_data->sale_customer_id)->update($customer_data);
                    $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
                    Payment::where('payment_id', $thispayment->payment_id)->delete();
                }
                elseif($payment->payment_method == 'cash'){
                    $customer = Customer::where('customer_id', $sale_data->sale_customer_id)->first();
                    $customer_data = array(
                        'customer_balance_paid' => $customer->customer_balance_paid - $payment->payment_amount_paid
                    );
                    Customer::where('customer_id', $sale_data->sale_customer_id)->update($customer_data);
                    $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
                    Payment::where('payment_id', $thispayment->payment_id)->delete();
                }
                elseif($payment->payment_method == 'credit'){
                    $customer = Customer::where('customer_id', $sale_data->sale_customer_id)->first();
                    $customer_data = array(
                        'customer_balance_dues' => $customer->customer_balance_dues - $payment->payment_amount_paid
                    );
                    Customer::where('customer_id', $sale_data->sale_customer_id)->update($customer_data);
                    $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
                    Payment::where('payment_id', $thispayment->payment_id)->delete();
                }
                // $payment->delete();
            }
        }
        Sale::where('sale_id', $sale_data->sale_id)->delete();
        return Redirect::to('sale')->with('Sale deleted successfully');
    }

    public function genInvoice($id)
    {
        $sale_data = Sale::where('sale_id', $id)->first();
        $sale_products_data = SaleProducts::where('sale_id', $id)->get();
        $user_data = User::where('id', $sale_data->sale_added_by)->first();
        $warehouse_data = Warehouse::where('warehouse_id', $sale_data->warehouse_id)->first();
        $customer_data = Customer::where('customer_id', $sale_data->sale_customer_id)->first();
        $payment_data = Payment::where('sale_id', $id)->get();
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $numberInWords = $numberTransformer->toWords($sale_data->sale_grandtotal_price);

        return view('sales.invoice', compact('sale_data', 'sale_products_data', 'user_data', 'warehouse_data', 'customer_data', 'payment_data', 'numberInWords'));
    }
}
