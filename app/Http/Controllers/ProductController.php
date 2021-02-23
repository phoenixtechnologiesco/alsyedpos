<?php

namespace App\Http\Controllers;

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
        return view('products.index', ['products' => $model1->paginate(15)->items(), 'attached_barcodes' => $model2->paginate(15)->items()]);
        // 'products' => $model1->paginate(15)->items(),
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $model, Company $model2, Brand $model3, Warehouse $model4)
    {
        return view('products.add', ['products' => $model->paginate(15)->items(), 'companies' => $model2->paginate(15)->items(), 'brands' => $model3->paginate(15)->items(), 'warehouses' => $model4->paginate(15)->items()]);
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
            'product_warehouse'             => 'required',
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
            'product_warehouse'             => $request->product_warehouse,
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
        foreach($product_barcodes as $key => $value){
            $barcodes_adds[$key] = array(
                'product_id'        => $id,
                'product_barcode'   => $value,
            );
            $barcodes_save[$key] = DB::table('product_barcodes')->insert($barcodes_adds[$key]);
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
        
        return view('products.edit', ['products' => $model->paginate(15)->items()[$id-1], 'companies' => $model2->paginate(15)->items(), 'brands' => $model3->paginate(15)->items(), 'warehouses' => $model4->paginate(15)->items(), 'attached_barcodes' => $model5->where('product_id', $id)->paginate(15)->items()]);
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
            'product_warehouse'             => 'required',
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
            'product_warehouse'             => $request->product_warehouse,
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
        foreach($product_barcodes as $key => $value){
            $barcodes_adds[$key] = array(
                'product_id'        => $id,
                'product_barcodes'   => $value,
            );
            $barcodes_save[$key] = DB::table('product_barcodes')->insert($barcodes_adds[$key]);
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
        //
    }

    public function searchproduct(Request $request)
    {

        $getRecords = null;
        // $input = trim(filter_var($request['search_data'], FILTER_SANITIZE_STRING));
        $input = trim(filter_var($request['data'], FILTER_SANITIZE_STRING));
        //return response()->json(['input' => $request['input'],], 200);
        $records = Product::where(function($query)use($input){
            $query->orWhere('product_name', 'LIKE', "%{$input}%");
            $query->orWhere('product_barcode', 'LIKE', "%{$input}%");
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

    public function addMore()
    {
        return view("products.add");
    }


    public function addMoreBarcode(Request $request)
    {
        // $rules = [];


        // foreach($request->input('attachedbarcodes') as $key => $value) {
        //     $rules["attachedbarcodes.{$key}"] = 'required';
        // }


        // $validator = Validator::make($request->all(), $rules);


        // if ($validator->passes()) {


            foreach($request->input('attachedbarcodes') as $key => $value) {
                ProductBarcodes::create(['product_barcode'=>$value]);
            }


            return response()->json(['success'=>'done']);
        // }


        // return response()->json(['error'=>$validator->errors()->all()]);
    }
}
