<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Payment;
use App\Models\PurchaseProducts;
use App\Models\PurchaseReturn;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Auth;
use DB;
use Input;
use Session;
use Response;
use Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the purchases
     *
     * @param  \App\Purchase  $model
     * @return \Illuminate\View\View
     */
    public function index(Purchase $model, Supplier $model2)
    {
        // $purchases = $model->paginate(15)->items();
        $purchases = Purchase::join('suppliers', 'purchases.purchase_supplier_id', '=', 'suppliers.supplier_id')->get();
        $suppliers = Supplier::where('status_id', 1)->get();

        return view('purchases.index', compact('purchases', 'suppliers') );
        // return view('purchases.index', ['purchases' => $purchases]);
    }

    public function getRowDetailsData()
    {
        // $purchases = Purchase::all();
        $purchases = Purchase::join('suppliers', 'purchases.purchase_supplier_id', '=', 'suppliers.supplier_id')->join('users', 'purchases.purchase_created_by', '=', 'users.id')->select('purchases.*', 'suppliers.supplier_name', 'users.name')->get();
        $suppliers = Supplier::where('status_id', 1)->get();
        // dd($purchases);
        return Datatables::of($purchases)
        ->addColumn('action', function ($purchases) {
            return '<a type="button" href="purchase/'. $purchases->purchase_id.'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
        })
        // ->editColumn('purchase_id', '{{$purchase_id}}')
        ->make(true);
    }

    public function return(PurchaseReturn $model, Supplier $model2)
    {
        // $purchasereturns = PurchaseReturn::join('purchases', 'purchase_returns.purchase_id', '=', 'purchases.purchase_id')->get();
        $purchasereturns = PurchaseReturn::join('suppliers', 'purchase_returns.purchase_return_supplier_id', '=', 'suppliers.supplier_id')->get();
        $suppliers = Supplier::where('status_id', 1)->get();

        return view('purchases.return', compact('purchasereturns', 'suppliers') );
    }

    public function returnadd(PurchaseReturn $model, Supplier $model2, Product $model3)
    {
        $purchasereturns = PurchaseReturn::get();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();

        return view('purchases.returnadd', compact('purchasereturns', 'suppliers', 'products') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Purchase $model, Supplier $model2, Product $model3)
    {
        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();
        return view('purchases.add', compact('purchases', 'suppliers', 'products') );
        // return view('purchases.add', ['purchases' => $model->paginate(15)->items(), 'suppliers' => $model2->paginate(15)->items(), 'products' => $model3->paginate(15)->items()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ledger(Purchase $model)
    {
        // $purchases = $model->paginate(15)->items();
        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::all();
        // $payments = Payment::get();

        return view('purchases.ledger', compact('purchases', 'suppliers', 'products') );
        // return view('purchases.ledger', ['purchases' => $purchases, 'suppliers' => $suppliers, 'payments' => $payments]);
    }

    public function available(Purchase $model)
    {
        // $purchases = $model->paginate(15)->items();
        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::all();
        // $payments = Payment::get();

        return view('purchases.available', compact('purchases', 'suppliers', 'products') );
        // return view('purchases.available', ['purchases' => $purchases, 'suppliers' => $suppliers, 'payments' => $payments]);
    }

    public function minimum(Purchase $model)
    {
        // $purchases = $model->paginate(15)->items();
        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::all();
        // $payments = Payment::get();

        return view('purchases.minimum', compact('purchases', 'suppliers', 'products') );
        // return view('purchases.minimum', ['purchases' => $purchases, 'suppliers' => $suppliers, 'payments' => $payments]);
    }

    public function damage(Purchase $model)
    {
        // $purchases = $model->paginate(15)->items();
        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::all();
        // $payments = Payment::get();

        return view('purchases.damage', compact('purchases', 'suppliers', 'products') );
        // return view('purchases.damage', ['purchases' => $purchases, 'suppliers' => $suppliers, 'payments' => $payments]);
    }

    public function amountwise(Purchase $model)
    {
        // $purchases = $model->paginate(15)->items();
        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::all();
        // $payments = Payment::get();

        return view('purchases.amountwise', compact('purchases', 'suppliers', 'products') );
        // return view('purchases.amountwise', ['purchases' => $purchases, 'suppliers' => $suppliers, 'payments' => $payments]);
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
        $validate = Validator::make($request->all(), [ 
            'purchase_supplier_id'         => 'required',
            'purchase_supplier_name'       => '',
            'purchase_total_items'         => '',//'purchase_product_items'
            'purchase_total_qty'           => '',//'purchase_product_quantity'
            'purchase_free_piece'          => '',
            'purchase_free_amount'         => '',
            'purchase_status'              => '',
            'purchase_note'                => '',
            // 'purchase_date'                => '',
            'purchase_total_price'         => '',
            'purchase_add_amount'          => '',
            'purchase_discount'            => '',
            'purchase_grandtotal_price'    => '',
            'purchase_total_amount_paid'   => '',
            'purchase_total_amount_dues'   => '',
            'purchase_payment_method'      => '',
            'purchase_payment_status'      => '',
            'purchase_document'            => '',
            'purchase_invoice_id'          => '',
            'purchase_invoice_date'        => '',
            'purchase_added_by'            => '',
            // 'purchase_payment_id'          => '',
            'warehouse_id'                 => '',
        ]);
        if ($validate->fails()) {    
           return response()->json("Fields Required", 400);
        }
        $purchase_ref_no = $random = Str::random(8); //str_random
        //$purchase_adds = $request->except('document');
        //$purchase_adds['ref_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $purchase_grandtotal_price = $request->purchase_grandtotal_price;
        $purchase_amount_recieved = $request->purchase_amount_recieved;
        $supplier_amount_paid = $request->purchase_amount_paid;
        $supplier_amount_dues = $request->purchase_amount_dues;
        $purchase_amount_dues = $purchase_grandtotal_price;

        if($purchase_amount_recieved > $purchase_grandtotal_price){
            $supplier_amount_paid = $supplier_amount_paid + $purchase_amount_recieved;
            $supplier_amount_dues = $supplier_amount_dues - ($purchase_amount_recieved - $purchase_grandtotal_price);
            $purchase_amount_dues = $purchase_grandtotal_price - $purchase_amount_recieved;
        }else{
            $supplier_amount_paid = $supplier_amount_paid + $purchase_amount_recieved;
            $supplier_amount_dues = $supplier_amount_dues + ($purchase_grandtotal_price - $purchase_amount_recieved);
            $purchase_amount_dues = $purchase_grandtotal_price - $purchase_amount_recieved;
        }

        $supplier_id = $request->purchase_supplier_id;
        $supplier_name = $request->purchase_supplier_name;
        $supplier_edits = array(
            'supplier_balance_paid' 	=> $supplier_amount_paid,
            'supplier_balance_dues' 	=> $supplier_amount_dues,
            // 'supplier_total_balance'    => $request->supplier_total_balance,
        );

        $update = DB::table('suppliers')->where('supplier_id','=', $supplier_id)->update($supplier_edits);


        $purchase_adds = array(
            'purchase_ref_no'           => $purchase_ref_no,
            'purchase_supplier_id'      => $request->purchase_supplier_id,
            'purchase_total_items'      => $request->purchase_total_items,//'purchase_product_items'
            'purchase_total_quantity'   => $request->purchase_total_qty,//'purchase_product_quantity'
            'purchase_free_piece'       => $request->purchase_free_piece,
            'purchase_free_amount'      => $request->purchase_free_amount,
            'purchase_status'           => $request->purchase_status,
            'purchase_note'             => $request->purchase_note,
            // 'purchase_date'             => $request->purchase_date,
            'purchase_total_price'      => $request->purchase_total_price,
            'purchase_add_amount'       => $request->purchase_add_amount,
            'purchase_discount'         => $request->purchase_discount,
            'purchase_grandtotal_price' => $purchase_grandtotal_price,
            'purchase_amount_paid'      => $purchase_amount_recieved,
            'purchase_amount_dues'      => $purchase_amount_dues,
            'purchase_payment_method'   => $request->purchase_payment_method,
            'purchase_payment_status'   => $request->purchase_payment_status,
            'purchase_document'         => $request->purchase_document,
            'purchase_invoice_id'       => $request->purchase_invoice_id,
            'purchase_invoice_date'     => $request->purchase_invoice_date,
            // 'purchase_payment_id'       => $request->purchase_payment_id,
            // 'warehouse_id'              => $request->warehouse_id,
            'purchase_created_by' 	    => Auth::user()->id,
            'created_at'	 			=> date('Y-m-d h:i:s'),
        );
        $document = $request->purchase_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->purchase_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/purchase', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $purchase_adds['purchase_document'] = $documentName;
        }

        $product_barcodes = $request->purchase_products_barcode;
        // $product_warehouses = $request->purchase_products_warehouse;
        $product_names = $request->product_name;
        $product_codes = $request->product_code;
        $product_ids = $request->product_id;
        $products_pieces = $request->purchase_products_pieces;
        $pieces_per_packet = $request->purchase_pieces_per_packet;
        $products_packets = $request->purchase_products_packets;
        $packets_per_carton = $request->purchase_packets_per_carton;
        $products_cartons = $request->purchase_products_cartons;
        $pieces_per_carton = $request->purchase_pieces_per_carton;
        $products_unit_prices = $request->purchase_products_unit_price;
        $products_discounts = $request->purchase_products_discount;
        $products_sub_totals = $request->purchase_products_sub_total;

        $save = DB::table('purchases')->insert($purchase_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('purchases')->insertGetId($purchase_adds)
        
        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            $purchase_product_adds[$key] = array(
                'purchase_id'                    => $id,
                'product_id'                     => $single_id,
                'purchase_product_ref_no'        => $product_codes[$key],
                'purchase_product_name'          => $product_names[$key],
                'purchase_product_barcode'       => $product_barcodes[$key],
                'warehouse_id'                   => $product[$key]->warehouse_id,
                'purchase_piece_per_packet'      => $pieces_per_packet[$key],
                // 'purchase_packet_per_carton'     => $packets_per_carton[$key],
                'purchase_packet_per_carton'     => 4,
                'purchase_piece_per_carton'      => $pieces_per_carton[$key],
                'purchase_pieces_total'          => $products_pieces[$key],
                'purchase_packets_total'         => $products_packets[$key],
                'purchase_cartons_total'         => $products_cartons[$key],
                'purchase_quantity_total'        => $products_quantity_total[$key],
                'purchase_trade_discount'        => $products_discounts[$key],
                'purchase_trade_price_piece'     => $products_unit_prices[$key],
                'purchase_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'purchase_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
                'purchase_product_sub_total'     => $products_sub_totals[$key]
            );
            $purchase_products_save = DB::table('purchase_products')->insert($purchase_product_adds[$key]);
        }

        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            // dd($products_quantity_available[$key]);
            $product_edits = array(
                // 'product_id'                 => $single_id,
                'product_ref_no'                => $product_codes[$key],
                'product_name'                  => $product_names[$key],
                'product_barcode'               => $product_barcodes[$key],
                // 'warehouse_id'                  => $product_warehouses[$key],
                'product_piece_per_packet'      => $pieces_per_packet[$key],
                'product_piece_per_carton'      => $pieces_per_carton[$key],
                'product_pieces_total'          => $product[$key]->product_pieces_total+$products_pieces[$key],
                'product_pieces_available'      => $product[$key]->product_pieces_available+$products_pieces[$key],
                'product_packets_total'         => $product[$key]->product_packets_total+$products_packets[$key],
                'product_packets_available'     => $product[$key]->product_packets_available+$products_packets[$key],
                'product_cartons_total'         => $product[$key]->product_cartons_total+$products_cartons[$key],
                'product_cartons_available'     => $product[$key]->product_cartons_available+$products_cartons[$key],
                'product_quantity_total'        => $product[$key]->product_quantity_total+$products_quantity_total[$key],
                'product_quantity_available'    => $product[$key]->product_quantity_available+$products_quantity_available[$key],
                'product_trade_discount'        => $products_discounts[$key],
                'product_trade_price_piece'     => $products_unit_prices[$key],
                'product_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'product_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            );
            $update = DB::table('products')->where('product_id','=', $single_id)->update($product_edits);
        }

		if($save){
			return response()->json(['data' => $purchase_adds, 'purchase_products' => $purchase_products_save, 'message' => 'Purchase Created Successfully'], 200);
		}else{
			return response()->json("Oops! Something Went Wrong", 400);
		}
    }

    public function storereturn(Request $request)
    {
        // dd($request->all());
        // $validate = Validator::make($request->all(), [ 
        //     'purchase_id'                       => '',
        //     'purchase_return_ref_no'            => '',
        //     'purchase_return_supplier_id'       => 'required',
        //     'purchase_return_product_pieces'    => '',
        //     'purchase_return_product_packets'   => '',
        //     'purchase_return_product_cartons'   => '',
        //     'purchase_return_unit_price'        => '',
        //     'purchase_return_product_quantity'  => '',
        //     'purchase_return_status'            => '',
        //     'purchase_return_date'              => '',
        //     'purchase_return_total_price'       => '',
        //     'purchase_return_grandtotal_price'  => '',
        //     'purchase_return_amount_paid'       => '',
        //     'purchase_return_amount_dues'       => '',
        //     'purchase_return_payment_method'    => '',
        //     'purchase_return_payment_status'    => '',
        //     'purchase_return_invoice_id'        => '',
        //     'purchase_return_invoice_date'      => '',
        //     'purchase_return_document'          => '',
        //     'purchase_return_note'              => '',
        //     'purchase_return_returned_by'       => '',
        // ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $purchase_return_ref_no = $random = Str::random(8); //str_random
        //$purchase_adds = $request->except('document');
        //$purchase_adds['ref_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $purchase_return_grandtotal_price = $request->purchase_grandtotal_price;
        $purchase_return_amount_recieved = $request->purchase_amount_recieved;
        $supplier_return_amount_paid = $request->purchase_amount_paid;
        $supplier_return_amount_dues = $request->purchase_amount_dues;
        $purchase_return_amount_dues = $purchase_return_grandtotal_price;

        if($purchase_return_amount_recieved > $purchase_return_grandtotal_price){
            $supplier_return_amount_paid = $supplier_return_amount_paid - $purchase_return_grandtotal_price;
            $supplier_return_amount_dues = $supplier_return_amount_dues + ($purchase_return_amount_recieved - $purchase_return_grandtotal_price);
            $purchase_return_amount_dues = $purchase_return_amount_recieved - $purchase_return_grandtotal_price;
        }else{
            $supplier_return_amount_paid = $supplier_return_amount_paid - $purchase_return_amount_recieved;
            $supplier_return_amount_dues = $supplier_return_amount_dues - ($purchase_return_grandtotal_price - $purchase_return_amount_recieved);
            $purchase_return_amount_dues = $purchase_return_grandtotal_price - $purchase_return_amount_recieved;
        }

        $supplier_id = $request->purchase_supplier_id;
        $supplier_name = $request->purchase_supplier_name;
        $supplier_edits = array(
            'supplier_balance_paid' 	=> $supplier_return_amount_paid,
            'supplier_balance_dues' 	=> $supplier_return_amount_dues,
            // 'supplier_total_balance'    => $request->supplier_total_balance,
        );

        $update = DB::table('suppliers')->where('supplier_id','=', $supplier_id)->update($supplier_edits);

        $purchasereturn_adds = array(
            'purchase_return_ref_no'           => $purchase_return_ref_no,
            'purchase_return_supplier_id'      => $request->purchase_supplier_id,
            'purchase_return_total_items'      => $request->purchase_total_items,//'purchase_product_items'
            'purchase_return_total_quantity'   => $request->purchase_total_qty,//'purchase_product_quantity'
            'purchase_return_free_piece'       => $request->purchase_free_piece,
            'purchase_return_free_amount'      => $request->purchase_free_amount,
            'purchase_return_status'           => $request->purchase_status,
            'purchase_return_date'             => $request->purchase_invoice_date,
            'purchase_return_total_price'      => $request->purchase_total_price,
            'purchase_return_add_amount'       => $request->purchase_add_amount,
            'purchase_return_discount'         => $request->purchase_discount,
            'purchase_return_grandtotal_price' => $purchase_return_grandtotal_price,
            'purchase_return_amount_paid'      => $purchase_return_amount_recieved,
            'purchase_return_amount_dues'      => $purchase_return_amount_dues,
            'purchase_return_payment_method'   => $request->purchase_payment_method,
            'purchase_return_payment_status'   => $request->purchase_payment_status,
            'purchase_return_invoice_id'       => $request->purchase_invoice_id,
            'purchase_return_invoice_date'     => $request->purchase_invoice_date,
            'purchase_return_document'         => $request->purchase_document,
            'purchase_return_note'             => $request->purchase_note,
            'purchase_return_returned_by' 	   => Auth::user()->id,
            'created_at'	 			       => date('Y-m-d h:i:s'),
        );
        $document = $request->purchase_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->purchase_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/purchase', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $purchase_adds['purchase_document'] = $documentName;
        }

        $product_barcodes = $request->purchase_products_barcode;
        // $product_warehouses = $request->purchase_products_warehouse;
        $product_names = $request->product_name;
        $product_codes = $request->product_code;
        $product_ids = $request->product_id;
        $products_pieces = $request->purchase_products_pieces;
        $pieces_per_packet = $request->purchase_pieces_per_packet;
        $products_packets = $request->purchase_products_packets;
        $packets_per_carton = $request->purchase_packets_per_carton;
        $products_cartons = $request->purchase_products_cartons;
        $pieces_per_carton = $request->purchase_pieces_per_carton;
        $products_unit_prices = $request->purchase_products_unit_price;
        $products_discounts = $request->purchase_products_discount;
        $products_sub_totals = $request->purchase_products_sub_total;

        $save = DB::table('purchase_returns')->insert($purchasereturn_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('purchases')->insertGetId($purchase_adds)
        
        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            $purchasereturn_product_adds[$key] = array(
                'purchase_return_id'                   => $id,
                'product_id'                           => $single_id,
                'purchasereturn_product_ref_no'        => $product_codes[$key],
                'purchasereturn_product_name'          => $product_names[$key],
                'purchasereturn_product_barcode'       => $product_barcodes[$key],
                'warehouse_id'                         => $product[$key]->warehouse_id,
                'purchasereturn_piece_per_packet'      => $pieces_per_packet[$key],
                // 'purchase_packet_per_carton'            => $packets_per_carton[$key],
                'purchasereturn_packet_per_carton'     => 4,
                'purchasereturn_piece_per_carton'      => $pieces_per_carton[$key],
                'purchasereturn_pieces_total'          => $products_pieces[$key],
                'purchasereturn_packets_total'         => $products_packets[$key],
                'purchasereturn_cartons_total'         => $products_cartons[$key],
                'purchasereturn_quantity_total'        => $products_quantity_total[$key],
                'purchasereturn_trade_discount'        => $products_discounts[$key],
                'purchasereturn_trade_price_piece'     => $products_unit_prices[$key],
                'purchasereturn_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'purchasereturn_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
                'purchasereturn_product_sub_total'     => $products_sub_totals[$key]
            );
            $purchasereturn_products_save = DB::table('purchasereturn_products')->insert($purchasereturn_product_adds[$key]);
        }

        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            // dd($products_quantity_available[$key]);
            $product_edits = array(
                // 'product_id'                 => $single_id,
                'product_ref_no'                => $product_codes[$key],
                'product_name'                  => $product_names[$key],
                'product_barcode'               => $product_barcodes[$key],
                // 'warehouse_id'                  => $product_warehouses[$key],
                'product_piece_per_packet'      => $pieces_per_packet[$key],
                'product_piece_per_carton'      => $pieces_per_carton[$key],
                'product_pieces_total'          => $product[$key]->product_pieces_total-$products_pieces[$key],
                'product_pieces_available'      => $product[$key]->product_pieces_available-$products_pieces[$key],
                'product_packets_total'         => $product[$key]->product_packets_total-$products_packets[$key],
                'product_packets_available'     => $product[$key]->product_packets_available-$products_packets[$key],
                'product_cartons_total'         => $product[$key]->product_cartons_total-$products_cartons[$key],
                'product_cartons_available'     => $product[$key]->product_cartons_available-$products_cartons[$key],
                'product_quantity_total'        => $product[$key]->product_quantity_total-$products_quantity_total[$key],
                'product_quantity_available'    => $product[$key]->product_quantity_available-$products_quantity_available[$key],
                'product_trade_discount'        => $products_discounts[$key],
                'product_trade_price_piece'     => $products_unit_prices[$key],
                'product_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'product_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            );
            $update = DB::table('products')->where('product_id','=', $single_id)->update($product_edits);
        }

		if($save){
			return response()->json(['data' => $purchasereturn_adds, 'purchasereturn_products' => $purchasereturn_products_save, 'message' => 'Purchase Returned Successfully'], 200);
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
    public function edit(Purchase $model, $id, Supplier $model2, Product $model3, PurchaseProducts $model4)
    {
        $j = 1;
        $total_quantity = 0;
        $total_discount = 0;
        $subtotal_amount = 0;
        $grandtotal_amount = 0;
        // $s_name = $model->paginate(15)->items()[$id-1]->supplier_name;
        $s_id = $model->paginate(15)->items()[$id-1]->purchase_supplier_id;
        $supplier = DB::table('suppliers')->where('supplier_id','=', $s_id)->first();
        // $purchase = $model->paginate(15)->items()[$id-1];
        $purchase = Purchase::where('purchase_id', $id)->get();
        $suppliers = Supplier::where('status_id', 1)->get();
        $products = Product::where('status_id', 1)->get();
        $purchaseproducts = PurchaseProducts::where('purchase_id', $id)->get();    

        return view('purchases.edit', compact('purchase', 'suppliers', 'products', 'purchaseproducts', 'supplier') );//'selectedproducts'
        // return view('purchases.edit', ['purchases' => $model->paginate(15)->items()[$id-1], 'suppliers' => $model2->paginate(15)->items(), 'products' => $model3->paginate(15)->items()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $purchase_id = $id; //OR $request->purchase_id;

        $validate = Validator::make($request->all(), [ 
            'purchase_supplier_id'         => 'required',
            'purchase_supplier_name'       => '',
            'purchase_total_items'         => '',//'purchase_product_items'
            'purchase_total_qty'           => '',//'purchase_product_quantity'
            'purchase_free_piece'          => '',
            'purchase_free_amount'         => '',
            'purchase_status'              => '',
            'purchase_note'                => '',
            // 'purchase_date'                => '',
            'purchase_total_price'         => '',
            'purchase_add_amount'          => '',
            'purchase_discount'            => '',
            'purchase_grandtotal_price'    => '',
            'purchase_total_amount_paid'   => '',
            'purchase_total_amount_dues'   => '',
            'purchase_payment_method'      => '',
            'purchase_payment_status'      => '',
            'purchase_document'            => '',
            'purchase_invoice_id'          => '',
            'purchase_invoice_date'        => '',
            'purchase_added_by'            => '',
            // 'purchase_payment_id'          => '',
            'warehouse_id'                 => '',
        ]);
        if ($validate->fails()) {    
           return response()->json("Fields Required", 400);
        }

        $purchase_grandtotal_price = $request->purchase_grandtotal_price;
        $purchase_amount_recieved = $request->purchase_amount_recieved;
        $purchase_amount_paid = $request->purchase_amount_paid;
        $purchase_amount_dues = $request->purchase_amount_dues;
        $net_purchase_price = $purchase_grandtotal_price - $purchase_amount_paid;
        $supplier_amount_paid = $request->supplier_balance_paid;
        $supplier_amount_dues = $request->supplier_balance_dues;
        // dd($supplier_amount_paid);

        // if($purchase_amount_recieved > $net_purchase_price){
        $purchase_amount_paid_new = $purchase_amount_paid + $purchase_amount_recieved;
        $purchase_amount_dues_new = $purchase_amount_dues - $purchase_amount_recieved;
        $supplier_amount_paid_new = $supplier_amount_paid + $purchase_amount_recieved;
        $supplier_amount_dues_new = $supplier_amount_dues - $purchase_amount_recieved;

        $supplier_id = $request->purchase_supplier_id;
        $supplier_name = $request->purchase_supplier_name;

        $supplier_edits = array(
            'supplier_balance_paid' 	=> $supplier_amount_paid_new,
            'supplier_balance_dues' 	=> $supplier_amount_dues_new,
            // 'supplier_total_balance'    => $request->supplier_total_balance,
        );

        $update = DB::table('suppliers')->where('supplier_id','=', $supplier_id)->update($supplier_edits);

        $purchase_edits = array(
            'purchase_supplier_id'      => $request->purchase_supplier_id,
            'purchase_total_items'      => $request->purchase_total_items,//'purchase_product_items'
            'purchase_total_quantity'   => $request->purchase_total_qty,//'purchase_product_quantity'
            'purchase_free_piece'       => $request->purchase_free_piece,
            'purchase_free_amount'      => $request->purchase_free_amount,
            'purchase_status'           => $request->purchase_status,
            'purchase_note'             => $request->purchase_note,
            // 'purchase_date'          => $request->purchase_date,
            'purchase_total_price'      => $request->purchase_total_price,
            'purchase_add_amount'       => $request->purchase_add_amount,
            'purchase_discount'         => $request->purchase_discount,
            'purchase_grandtotal_price' => $purchase_grandtotal_price,
            'purchase_amount_paid'      => $purchase_amount_paid_new,
            'purchase_amount_dues'      => $purchase_amount_dues_new,
            'purchase_payment_method'   => $request->purchase_payment_method,
            'purchase_payment_status'   => $request->purchase_payment_status,
            // 'purchase_document'      => $request->purchase_document,
            'purchase_invoice_id'       => $request->purchase_invoice_id,
            'purchase_invoice_date'     => $request->purchase_invoice_date,
            // 'purchase_payment_id'       => $request->purchase_payment_id,
            // 'warehouse_id'              => $request->warehouse_id,

        );

        $document = $request->purchase_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->purchase_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/purchase', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $purchase_edits['purchase_document'] = $documentName;
        }

        $product_barcodes = $request->purchase_products_barcode;
        // $product_warehouses = $request->purchase_products_warehouse;
        $product_names = $request->product_name;
        $product_codes = $request->product_code;
        $product_ids = $request->product_id;
        $products_pieces = $request->purchase_products_pieces;
        $pieces_per_packet = $request->purchase_pieces_per_packet;
        $products_packets = $request->purchase_products_packets;
        $packets_per_carton = $request->purchase_packets_per_carton;
        // dd($request->purchase_packets_per_carton);
        $products_cartons = $request->purchase_products_cartons;
        $pieces_per_carton = $request->purchase_pieces_per_carton;
        $products_unit_prices = $request->purchase_products_unit_price;
        $products_discounts = $request->purchase_products_discount;
        $products_sub_totals = $request->purchase_products_sub_total;

        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            // $purchase_products_delete = DB::table('purchase_products')->where('purchase_id','=', $purchase_id)->delete();

            $purchase_product_adds[$key] = array(
                'purchase_id'                    => $id,
                'product_id'                     => $single_id,
                'purchase_product_ref_no'        => $product_codes[$key],
                'purchase_product_name'          => $product_names[$key],
                'purchase_product_barcode'       => $product_barcodes[$key],
                'warehouse_id'                   => $product[$key]->warehouse_id,
                'purchase_piece_per_packet'      => $pieces_per_packet[$key],
                // 'purchase_packet_per_carton'     => $packets_per_carton[$key],
                'purchase_packet_per_carton'     => 4,
                'purchase_piece_per_carton'      => $pieces_per_carton[$key],
                'purchase_pieces_total'          => $products_pieces[$key],
                'purchase_packets_total'         => $products_packets[$key],
                'purchase_cartons_total'         => $products_cartons[$key],
                'purchase_quantity_total'        => $products_quantity_total[$key],
                'purchase_trade_discount'        => $products_discounts[$key],
                'purchase_trade_price_piece'     => $products_unit_prices[$key],
                'purchase_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'purchase_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
                'purchase_product_sub_total'     => $products_sub_totals[$key]
            );

            $purchase_product_save[$key] = DB::table('purchase_products')->insert($purchase_product_adds[$key]);

            // $purchase_product_edits[$key] = array(
            //     'purchase_id'                    => $id,
            //     'product_id'                     => $single_id,
            //     'purchase_product_ref_no'        => $product_codes[$key],
            //     'purchase_product_name'          => $product_names[$key],
            //     'purchase_product_barcode'       => $product_barcodes[$key],
            //     'warehouse_id'                   => $product[$key]->warehouse_id,
            //     'purchase_piece_per_packet'      => $pieces_per_packet[$key],
            //     // 'purchase_packet_per_carton'     => $packets_per_carton[$key],
            //     'purchase_packet_per_carton'     => 4,
            //     'purchase_piece_per_carton'      => $pieces_per_carton[$key],
            //     'purchase_pieces_total'          => $products_pieces[$key],
            //     // 'purchase_pieces_available'      => $products_pieces[$key],
            //     'purchase_packets_total'         => $products_packets[$key],
            //     // 'purchase_packets_available'     => $products_packets[$key],
            //     'purchase_cartons_total'         => $products_cartons[$key],
            //     // 'purchase_cartons_available'     => $products_cartons[$key],
            //     'purchase_quantity_total'        => $products_quantity_total[$key],
            //     // 'purchase_quantity_available'    => $products_quantity_available[$key],
            //     'purchase_trade_discount'        => $products_discounts[$key],
            //     'purchase_trade_price_piece'     => $products_unit_prices[$key],
            //     'purchase_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
            //     'purchase_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            //     'purchase_product_sub_total'     => $products_sub_totals[$key]
            // );

            // $purchase_products_update = DB::table('purchase_products')->where('product_id','=', $single_id)->update($purchase_product_edits[$key]);
        }
        // dd($purchase_product_edits);
        foreach($product_ids as $key => $single_id){

            $products_quantity_total[$key] = $products_pieces[$key]+($products_packets[$key]*($pieces_per_packet[$key]))+($products_cartons[$key]*($pieces_per_carton[$key]));
            $products_quantity_available[$key] = $products_quantity_total[$key];

            $product[$key] = DB::table('products')->where('product_id','=', $single_id)->first();

            // dd($products_quantity_available[$key]);
            $product_edits = array(
                'product_ref_no'                => $product_codes[$key],
                'product_name'                  => $product_names[$key],
                'product_barcode'               => $product_barcodes[$key],
                // 'warehouse_id'                  => $product_warehouses[$key],
                'product_piece_per_packet'      => $pieces_per_packet[$key],
                'product_piece_per_carton'      => $pieces_per_carton[$key],
                'product_pieces_total'          => $product[$key]->product_pieces_total+$products_pieces[$key],
                'product_pieces_available'      => $product[$key]->product_pieces_available+$products_pieces[$key],
                'product_packets_total'         => $product[$key]->product_packets_total+$products_packets[$key],
                'product_packets_available'     => $product[$key]->product_packets_available+$products_packets[$key],
                'product_cartons_total'         => $product[$key]->product_cartons_total+$products_cartons[$key],
                'product_cartons_available'     => $product[$key]->product_cartons_available+$products_cartons[$key],
                'product_quantity_total'        => $product[$key]->product_quantity_total+$products_quantity_total[$key],
                'product_quantity_available'    => $product[$key]->product_quantity_available+$products_quantity_available[$key],
                'product_trade_discount'        => $products_discounts[$key],
                'product_trade_price_piece'     => $products_unit_prices[$key],
                'product_trade_price_packet'    => $products_unit_prices[$key]*$pieces_per_packet[$key],
                'product_trade_price_carton'    => $products_unit_prices[$key]*$pieces_per_carton[$key],
            );
            $update = DB::table('products')->where('product_id','=', $single_id)->update($product_edits);
        }

        $update = DB::table('purchases')->where('purchase_id','=', $purchase_id)->update($purchase_edits);

        // return redirect()->back();
        // return redirect('/purchase')->with(['message' => 'Purchase Edited Successfully'], 200);
        if($update){
			return response()->json(['data' => $purchase_edits, /*'purchase_products' => $purchase_products_update,*/ 'message' => 'Purchase Edited Successfully'], 200);
		}else{
			return response()->json("Oops! Something Went Wrong", 400);
		}
        // return redirect('purchases/'.$purchase_id.'/edit');
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
        $purchase_data = Purchase::where('purchase_id', $id)->first();
        $purchase_products_data = PurchaseProducts::where('purchase_id', $id)->get();
        // dd($purchase_products_data);
        if(!empty($purchase_products_data)){
            foreach ($purchase_products_data as $product_purchase) {
                // if($product_purchase->purchase_payment_method == "cash")
                // if($product_purchase->purchase_payment_method == "credit")
                $product_data = Product::where('product_id', $product_purchase->product_id)->get();
                //adjust product quantity
                foreach ($product_data as $child_product) {
                    // $child_data = Product::find($child_id);
                    $child_data = Product::where('product_id', $child_product->product_id)->first();
                    $update_data = array(
                        'product_quantity_total'  =>  $child_data->product_quantity_total + $product_purchase->purchase_quantity_total,
                        'product_quantity_available'  =>  $child_data->product_quantity_available + $product_purchase->purchase_quantity_total,
                        'product_pieces_total'  =>  $child_data->product_pieces_total + $product_purchase->purchase_pieces_total,
                        'product_packets_total'  =>  $child_data->product_packets_total + $product_purchase->purchase_packets_total,
                        'product_cartons_total'  =>  $child_data->product_cartons_total + $product_purchase->purchase_cartons_total,
                        'product_pieces_available'  =>  $child_data->product_pieces_available + $product_purchase->purchase_pieces_total,
                        'product_packets_available'  =>  $child_data->product_packets_available + $product_purchase->purchase_packets_total,
                        'product_cartons_available'  =>  $child_data->product_cartons_available + $product_purchase->purchase_cartons_total,
                    );
                    Product::where('product_id', $child_product->product_id)->update($update_data);
                }
                PurchaseProducts::where('product_id', $product_purchase->product_id)->delete();
            }
        }
        $payment_data = Payment::where('purchase_id', $id)->get();
        if(!empty($payment_data)){
            foreach ($payment_data as $payment) {
                if($payment->payment_method == 'cheque'){
                    // $supplier = Supplier::where('purchase_supplier_id', $purchase_data->purchase_supplier_id)->get();
                    // $supplier_data = array(
                    //     'supplier_balance_paid' => $supplier->supplier_balance_paid - $payment->payment_amount_paid
                    // );
                    // Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->update($supplier_data);
                    $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
                    Payment::where('payment_id', $thispayment->payment_id)->delete();
                }
                elseif($payment->payment_method == 'cash'){
                    $supplier = Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->first();
                    $supplier_data = array(
                        'supplier_balance_paid' => $supplier->supplier_balance_paid - $payment->payment_amount_paid
                    );
                    Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->update($supplier_data);
                    $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
                    Payment::where('payment_id', $thispayment->payment_id)->delete();
                }
                elseif($payment->payment_method == 'credit'){
                    $supplier = Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->first();
                    $supplier_data = array(
                        'supplier_balance_dues' => $supplier->supplier_balance_dues - $payment->payment_amount_paid
                    );
                    Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->update($supplier_data);
                    $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
                    Payment::where('payment_id', $thispayment->payment_id)->delete();
                }
                // $payment->delete();
            }
        }
        Purchase::where('purchase_id', $purchase_data->purchase_id)->delete();
        return Redirect::to('purchase')->with('Purchase deleted successfully');
    }

    public  function generateRandomString($length = 20){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
	}
}
