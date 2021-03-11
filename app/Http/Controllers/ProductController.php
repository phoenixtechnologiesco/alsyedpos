<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\ProductBarcodes;
use App\Models\Company;
use App\Models\Brand;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Auth;
use DB;
use Input;
use Session;
use Response;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the products
     *
     * @param  \App\Product  $model
     * @return \Illuminate\View\View
     */
    public function index(Product $model1, ProductBarcodes $model2)
    {
        $products = Product::all();
        $attached_barcodes = ProductBarcodes::all();
        return view('products.index', compact('products', 'attached_barcodes') );
        // 'products' => $model1->paginate(15)->items(),
    }

    public function getRowDetailsData()
    {
        $products = Product::with('barcodes');
        // where('product_id', 13)->with('barcodes');
        // join('product_barcodes', 'products.product_id', '=', 'product_barcodes.product_id')->select(['products.product_id', 'products.product_name', 'products.product_barcode', 'products.product_company', 'products.product_brand', 'products.product_pieces_total',  'products.product_packets_total', 'products.product_cartons_total', 'products.product_pieces_available', 'products.product_packets_available', 'products.product_cartons_available', 'products.product_trade_price_piece', 'products.product_trade_price_packet', 'products.product_trade_price_carton', 'products.product_cash_price_piece', 'products.product_cash_price_packet', 'products.product_credit_price_carton', 'products.product_credit_price_piece', 'products.product_credit_price_packet', 'products.product_credit_price_carton', 'product_barcodes.product_id', 'product_barcodes.product_barcodes']);
        // leftJoin('product_barcodes', 'products.product_id', '=', 'product_barcodes.product_id')
        // ->select(['products.product_id', 'products.product_name', 'products.product_barcode', 'products.product_company', 'products.product_brand', 'products.product_pieces_total',  'products.product_packets_total', 'products.product_cartons_total', 'products.product_pieces_available', 'products.product_packets_available', 'products.product_cartons_available', 'products.product_trade_price_piece', 'products.product_trade_price_packet', 'products.product_trade_price_carton', 'products.product_cash_price_piece', 'products.product_cash_price_packet', 'products.product_credit_price_carton', 'products.product_credit_price_piece', 'products.product_credit_price_packet', 'products.product_credit_price_carton',])
        // dd($products);
        // $product_barcodes = ProductBarcodes::select(['product_barcode_id', 'product_id', 'product_barcodes']);

        return Datatables::of($products)
        // ->addColumn('action', function ($products) {
        //     return '<a href="product/'. $products->product_id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        // })
        // ->editColumn('product_id', '{{$product_id}}')
        ->make(true);
    }

    public function getRowAttributesData()
    {
        $products = Product::select(['product_id', 'product_name', 'product_barcode', 'product_company', 'product_brand', 'product_pieces_total',  'product_packets_total', 'product_cartons_total', 'product_pieces_available', 'product_packets_available', 'product_cartons_available', 'product_trade_price_piece', 'product_trade_price_packet', 'product_trade_price_carton', 'product_cash_price_piece', 'product_cash_price_packet', 'product_credit_price_carton', 'product_credit_price_piece', 'product_credit_price_packet', 'product_credit_price_carton' ]);
        
        return Datatables::of($products)
            ->addColumn('action', function ($products) {
                return '<a href="#edit-'. $products->product_id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('product_id', '{{$product_id}}')
            ->removeColumn('updated_at')
            ->setRowId('product_id')
            ->setRowClass(function ($user) {
                return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })
            ->setRowData([
                'product_id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $model, Company $model2, Brand $model3, Warehouse $model4)
    {
        $products = Product::get();
        $companies = Company::get();
        $brands = Brand::get();
        $warehouses = Warehouse::get();
        return view('products.add', ['products' => $products, 'companies' => $companies, 'brands' => $brands, 'warehouses' => $warehouses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [ 
            'product_ref_no'                => '',
            'warehouse_id'                  => 'required',
            'product_name'                  => 'required',
            'product_barcode'               => 'required',
            'product_company'               => 'required',
            'product_brand'                 => '',
            'product_piece_per_packet'      => '',
            'product_packet_per_carton'     => '',
            'product_piece_per_carton'      => '',
            'product_pieces_total'          => '',
            'product_packets_total'         => '',
            'product_cartons_total'         => '',
            'product_pieces_available'      => '',
            'product_packets_available'     => '',
            'product_cartons_available'     => '',
            'product_quantity_total'        => 'required',
            'product_quantity_available'    => 'required',
            'product_quantity_damage'       => '',
            'product_alert_quantity'        => 'required',
            'product_trade_price_piece'     => '',
            'product_trade_price_packet'    => '',
            'product_trade_price_carton'    => 'required',
            'product_credit_price_piece'    => 'required',
            'product_credit_price_packet'   => '',
            'product_credit_price_carton'   => '',
            'product_cash_price_piece'      => 'required',
            'product_cash_price_packet'     => '',
            'product_cash_price_carton'     => '',
            'product_nonbulk_price_piece'   => 'required',
            'product_nonbulk_price_packet'  => '',
            'product_nonbulk_price_carton'  => '',
            'product_state'                 => '',
            // 'product_expiry_date'           => '',
            'product_info'                  => '',
            // 'status_id'                     => 'required',
        ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $product_adds = array(
            'product_ref_no'                => $request->product_ref_no,
            'warehouse_id'                  => $request->warehouse_id,
            'product_name'                  => $request->product_name,
            'product_barcode'               => $request->product_barcode,
            'product_company'               => $request->product_company,
            'product_brand'                 => $request->product_brand,
            'product_piece_per_packet'      => $request->product_piece_per_packet,
            'product_packet_per_carton'     => $request->product_packet_per_carton,
            'product_piece_per_carton'      => $request->product_piece_per_carton,
            'product_pieces_total'          => $request->product_pieces_total,
            'product_packets_total'         => $request->product_packets_total,
            'product_cartons_total'         => $request->product_cartons_total,
            'product_pieces_available'      => $request->product_pieces_available,
            'product_packets_available'     => $request->product_packets_available,
            'product_cartons_available'     => $request->product_cartons_available,
            'product_quantity_total'        => $request->product_quantity_total,
            'product_quantity_available'    => $request->product_quantity_available,
            'product_quantity_damage'       => $request->product_quantity_damage,
            'product_alert_quantity'        => $request->product_alert_quantity,
            'product_trade_price_piece'     => $request->product_trade_price_piece,
            'product_trade_price_packet'    => $request->product_trade_price_packet,
            'product_trade_price_carton'    => $request->product_trade_price_carton,
            'product_credit_price_piece'    => $request->product_credit_price_piece,
            'product_credit_price_packet'   => $request->product_credit_price_packet,
            'product_credit_price_carton'   => $request->product_credit_price_carton,
            'product_cash_price_piece'      => $request->product_cash_price_piece,
            'product_cash_price_packet'     => $request->product_cash_price_packet,
            'product_cash_price_carton'     => $request->product_cash_price_carton,
            'product_nonbulk_price_piece'   => $request->product_nonbulk_price_piece,
            'product_nonbulk_price_packet'  => $request->product_nonbulk_price_packet,
            'product_nonbulk_price_carton'  => $request->product_nonbulk_price_carton,
            'product_state'                 => $request->product_state,
            'product_expiry_date'           => $request->product_expiry_date,
            'product_info'                  => $request->product_info,
            'status_id' 	                => $request->status_id,
            'created_at'	 			    => date('Y-m-d h:i:s'),
        );
        $product_barcodes = $request->attachedbarcodes;
        $save = DB::table('products')->insert($product_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('products')->insertGetId($product_adds);
        if( !empty($product_barcodes) ){
            foreach($product_barcodes as $key => $value){
                $barcodes_adds[$key] = array(
                    'product_id'        => $id,
                    'product_barcode'   => $value,
                );
                $barcodes_save[$key] = DB::table('product_barcodes')->insert($barcodes_adds[$key]);
            }
        }
		if($save){
			return response()->json(['data' => $product_adds, 'barcodes' => $barcodes_adds, 'message' => 'Product Created Successfully'], 200);
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
    public function edit(Product $model, $id, Company $model2, Brand $model3, Warehouse $model4, ProductBarcodes $model5)
    {
        $product = Product::where('product_id', $id)->get();
        $companies = Company::get();
        $brands = Brand::get();
        $warehouses = Warehouse::get();
        $product_barcodes = ProductBarcodes::where('product_id', $id)->get();

        return view('products.edit', ['product' => $product, 'companies' => $companies, 'brands' => $brands, 'warehouses' => $warehouses, 'attached_barcodes' => $product_barcodes]);
        // 'product' => $model->paginate(15)->items()[$id-1]
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
        $product_id = $id; //OR $request->products_id;
        $validate = Validator::make($request->all(), [ 
            'product_ref_no'                => '',
            'warehouse_id'                  => 'required',
            'product_name'                  => 'required',
            'product_barcode'               => 'required',
            'product_company'               => 'required',
            'product_brand'                 => '',
            'product_piece_per_packet'      => '',
            'product_packet_per_carton'     => '',
            'product_piece_per_carton'      => '',
            'product_pieces_total'          => '',
            'product_packets_total'         => '',
            'product_cartons_total'         => '',
            'product_pieces_available'      => '',
            'product_packets_available'     => '',
            'product_cartons_available'     => '',
            'product_quantity_total'        => 'required',
            'product_quantity_available'    => 'required',
            'product_quantity_damage'       => '',
            'product_alert_quantity'        => 'required',
            'product_trade_price_piece'     => '',
            'product_trade_price_packet'    => '',
            'product_trade_price_carton'    => 'required',
            'product_credit_price_piece'    => 'required',
            'product_credit_price_packet'   => '',
            'product_credit_price_carton'   => '',
            'product_cash_price_piece'      => 'required',
            'product_cash_price_packet'     => '',
            'product_cash_price_carton'     => '',
            'product_nonbulk_price_piece'   => 'required',
            'product_nonbulk_price_packet'  => '',
            'product_nonbulk_price_carton'  => '',
            'product_state'                 => '',
            // 'product_expiry_date'           => '',
            'product_info'                  => '',
            // 'status_id'                     => 'required',
        ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $product_edits = array(
            'product_ref_no'                => $request->product_ref_no,
            'warehouse_id'                  => $request->warehouse_id,
            'product_name'                  => $request->product_name,
            'product_barcode'               => $request->product_barcode,
            'product_company'               => $request->product_company,
            'product_brand'                 => $request->product_brand,
            'product_piece_per_packet'      => $request->product_piece_per_packet,
            'product_packet_per_carton'     => $request->product_packet_per_carton,
            'product_piece_per_carton'      => $request->product_piece_per_carton,
            'product_pieces_total'          => $request->product_pieces_total,
            'product_packets_total'         => $request->product_packets_total,
            'product_cartons_total'         => $request->product_cartons_total,
            'product_pieces_available'      => $request->product_pieces_available,
            'product_packets_available'     => $request->product_packets_available,
            'product_cartons_available'     => $request->product_cartons_available,
            'product_quantity_total'        => $request->product_quantity_total,
            'product_quantity_available'    => $request->product_quantity_available,
            'product_quantity_damage'       => $request->product_quantity_damage,
            'product_alert_quantity'        => $request->product_alert_quantity,
            'product_trade_price_piece'     => $request->product_trade_price_piece,
            'product_trade_price_packet'    => $request->product_trade_price_packet,
            'product_trade_price_carton'    => $request->product_trade_price_carton,
            'product_credit_price_piece'    => $request->product_credit_price_piece,
            'product_credit_price_packet'   => $request->product_credit_price_packet,
            'product_credit_price_carton'   => $request->product_credit_price_carton,
            'product_cash_price_piece'      => $request->product_cash_price_piece,
            'product_cash_price_packet'     => $request->product_cash_price_packet,
            'product_cash_price_carton'     => $request->product_cash_price_carton,
            'product_nonbulk_price_piece'   => $request->product_nonbulk_price_piece,
            'product_nonbulk_price_packet'  => $request->product_nonbulk_price_packet,
            'product_nonbulk_price_carton'  => $request->product_nonbulk_price_carton,
            'product_state'                 => $request->product_state,
            'product_expiry_date'           => $request->product_expiry_date,
            'product_info'                  => $request->product_info,
            'status_id' 	                => $request->status_id,
            // 'updated_at'	 			    => date('Y-m-d h:i:s'),
        );
        $product_barcodes = $request->attachedbarcodes;
        $update = DB::table('products')->where('product_id','=', $product_id)->update($product_edits);
        $saved_barcodes = DB::table('product_barcodes')->where('product_id','=', $product_id)->delete();
        // dd($product_barcodes);
        if( !empty($product_barcodes) ){
            foreach($product_barcodes as $key => $value){
                $barcodes_adds[$key] = array(
                    'product_id'        => $id,
                    'product_barcodes'   => $value,
                );
                $barcodes_save[$key] = DB::table('product_barcodes')->insert($barcodes_adds[$key]);
            }
        }

        // return redirect()->back();
        return redirect('/product')->with(['message' => 'Product Edited Successfully'], 200);
        // return redirect('products/'.$product_id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products')->where('product_id', $id)->delete();

        return redirect('/product')->with(['message' => 'Product Deleted Successfully'], 200);

        // $url = url()->previous();
        // $purchase_data = Purchase::where('purchase_id', $id)->first();
        // $purchase_products_data = PurchaseProducts::where('purchase_id', $id)->get();
        // // dd($purchase_products_data);
        // if(!empty($purchase_products_data)){
        //     foreach ($purchase_products_data as $product_purchase) {
        //         // if($product_purchase->purchase_payment_method == "cash")
        //         // if($product_purchase->purchase_payment_method == "credit")
        //         $product_data = Product::where('product_id', $product_purchase->product_id)->get();
        //         //adjust product quantity
        //         foreach ($product_data as $child_product) {
        //             // $child_data = Product::find($child_id);
        //             $child_data = Product::where('product_id', $child_product->product_id)->first();
        //             $update_data = array(
        //                 'product_quantity_total'  =>  $child_data->product_quantity_total + $product_purchase->purchase_quantity_total,
        //                 'product_quantity_available'  =>  $child_data->product_quantity_available + $product_purchase->purchase_quantity_total,
        //                 'product_pieces_total'  =>  $child_data->product_pieces_total + $product_purchase->purchase_pieces_total,
        //                 'product_packets_total'  =>  $child_data->product_packets_total + $product_purchase->purchase_packets_total,
        //                 'product_cartons_total'  =>  $child_data->product_cartons_total + $product_purchase->purchase_cartons_total,
        //                 'product_pieces_available'  =>  $child_data->product_pieces_available + $product_purchase->purchase_pieces_total,
        //                 'product_packets_available'  =>  $child_data->product_packets_available + $product_purchase->purchase_packets_total,
        //                 'product_cartons_available'  =>  $child_data->product_cartons_available + $product_purchase->purchase_cartons_total,
        //             );
        //             Product::where('product_id', $child_product->product_id)->update($update_data);
        //         }
        //         PurchaseProducts::where('product_id', $product_purchase->product_id)->delete();
        //     }
        // }
        // $payment_data = Payment::where('purchase_id', $id)->get();
        // if(!empty($payment_data)){
        //     foreach ($payment_data as $payment) {
        //         if($payment->payment_method == 'cheque'){
        //             // $supplier = Supplier::where('purchase_supplier_id', $purchase_data->purchase_supplier_id)->get();
        //             // $supplier_data = array(
        //             //     'supplier_balance_paid' => $supplier->supplier_balance_paid - $payment->payment_amount_paid
        //             // );
        //             // Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->update($supplier_data);
        //             $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
        //             Payment::where('payment_id', $thispayment->payment_id)->delete();
        //         }
        //         elseif($payment->payment_method == 'cash'){
        //             $supplier = Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->first();
        //             $supplier_data = array(
        //                 'supplier_balance_paid' => $supplier->supplier_balance_paid - $payment->payment_amount_paid
        //             );
        //             Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->update($supplier_data);
        //             $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
        //             Payment::where('payment_id', $thispayment->payment_id)->delete();
        //         }
        //         elseif($payment->payment_method == 'credit'){
        //             $supplier = Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->first();
        //             $supplier_data = array(
        //                 'supplier_balance_dues' => $supplier->supplier_balance_dues - $payment->payment_amount_paid
        //             );
        //             Supplier::where('supplier_id', $purchase_data->purchase_supplier_id)->update($supplier_data);
        //             $thispayment = Payment::where('payment_id', $payment->payment_id)->first();
        //             Payment::where('payment_id', $thispayment->payment_id)->delete();
        //         }
        //         // $payment->delete();
        //     }
        // }
        // Purchase::where('purchase_id', $purchase_data->purchase_id)->delete();
        // return Redirect::to($url)->with('Purchase deleted successfully');

    }

    public function searchproduct(Request $request)
    {
        $getRecords = null;
        // $input = trim(filter_var($request['search_data'], FILTER_SANITIZE_STRING));
        $input = trim(filter_var($request['data'], FILTER_SANITIZE_STRING));
        //return response()->json(['input' => $request['input'],], 200);
        $records = Product::where(function($query)use($input){
            $query->orWhere('product_id', "$input");
            $query->orWhere('product_name', 'LIKE', "%{$input}%");
            // $query->orWhere('product_barcode', 'LIKE', "%{$input}%");
            // $query->orWhere('product_ref_no', 'LIKE', "%{$input}%");
        })
        ->get()->toArray();
        
        // send the response
        //return Response::json([
        // return response()->json([
        //     'records' => $records->count() > 0
        //         ? $records//$getRecords
        //         : [],/*'Nothing to show.',*/
        // ], 200);

        return $records;
    }

    public function searchbarcode(Request $request)
    {
        $getRecords = null;
        // $input = trim(filter_var($request['search_data'], FILTER_SANITIZE_STRING));
        $input = trim(filter_var($request['data'], FILTER_SANITIZE_STRING));
        //return response()->json(['input' => $request['input'],], 200);
        $records = ProductBarcodes::where(function($query)use($input){
            $query->where('product_barcodes', 'LIKE', "%{$input}%");
            // $query->orWhere('product_ref_no', 'LIKE', "%{$input}%");
        })
        ->get()->toArray();
        
        // send the response
        //return Response::json([
        // return response()->json([
        //     'records' => $records->count() > 0
        //         ? $records//$getRecords
        //         : [],/*'Nothing to show.',*/
        // ], 200);

        return $records;
    }

    public function searchbarcode3(Request $request)
    {
        $getRecords = null;
        // $input = trim(filter_var($request['search_data'], FILTER_SANITIZE_STRING));
        $input = trim(filter_var($request['data'], FILTER_SANITIZE_STRING));
        //return response()->json(['input' => $request['input'],], 200);
        $records = ProductBarcodes::where(function($query)use($input){
            $query->where('product_id', $input);
        })
        ->get()->toArray();
        
        // send the response
        //return Response::json([
        // return response()->json([
        //     'records' => $records->count() > 0
        //         ? $records//$getRecords
        //         : [],/*'Nothing to show.',*/
        // ], 200);

        return $records;
    }

}
