<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\Supplier;
use App\Models\Payment;
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

class SupplierController extends Controller
{
    public function __construct(Supplier $supplier /*, User $user*/)
    {
        $this->Supplier = $supplier;
        // $this->myuser = new UserController($user);
        // $this->User = $user;
    }

    /**
     * Display a listing of the suppliers
     *
     * @param  \App\Supplier  $model
     * @return \Illuminate\View\View
     */
    public function index(Supplier $model)
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers') );
    }
    public function getSuppliersData()
    {
        $suppliers = Supplier::all();

        return Datatables::of($suppliers)
        ->addColumn('action', function ($suppliers) {
            return '<a type="button" href="supplier/'. $suppliers->supplier_id.'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Supplier $model)
    {
        $suppliers = Supplier::all();
        return view('suppliers.add', compact('suppliers') );
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
            'supplier_ref_no' 			=> 'required',
            'supplier_type'             => 'required',//General, Booker
            'supplier_name' 			=> 'required',
            'supplier_shop_name' 		=> '',
            'supplier_shop_info' 		=> '',
            'supplier_email' 			=> '',
            'supplier_alternate_email' 	=> '',
            'supplier_cnic_number' 		=> '',
            'supplier_town' 			=> '',
            'supplier_area' 			=> '',
            'supplier_shop_address' 	=> '',
            'supplier_resident_address' => '',
            'supplier_zipcode' 			=> '',
            'supplier_phone_number' 	=> '',
            'supplier_office_number' 	=> '',
            'supplier_alternate_number' => '',
            'supplier_total_balance' 	=> '',
            'supplier_balance_paid' 	=> 'required',
            'supplier_balance_dues' 	=> 'required',
            'status_id' 	            => 'required',
        ]);
        if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
           return redirect()->back()->withErrors($validate);
        }
        $supplier_adds = array(
            'supplier_ref_no' 			=> $request->supplier_ref_no,
            'supplier_type'             => $request->supplier_type,
            'supplier_name' 			=> $request->supplier_name,
            'supplier_shop_name' 		=> $request->supplier_shop_name,
            'supplier_shop_info' 		=> $request->supplier_shop_info,
            'supplier_email' 			=> $request->supplier_email,
            'supplier_alternate_email' 	=> $request->supplier_alternate_email,
            'supplier_cnic_number' 		=> $request->supplier_cnic_number,
            'supplier_town' 			=> $request->supplier_town,
            'supplier_area' 			=> $request->supplier_area,
            'supplier_shop_address' 	=> $request->supplier_shop_address,
            'supplier_resident_address' => $request->supplier_resident_address,
            'supplier_zipcode' 			=> $request->supplier_zipcode,
            'supplier_phone_number' 	=> $request->supplier_phone_number,
            'supplier_office_number' 	=> $request->supplier_office_number,
            'supplier_alternate_number' => $request->supplier_alternate_number,
            'supplier_total_balance' 	=> $request->supplier_total_balance,
            'supplier_balance_paid' 	=> $request->supplier_balance_paid,
            'supplier_balance_dues' 	=> $request->supplier_balance_dues,
            'status_id' 	            => $request->status_id,
            'supplier_created_by' 	            => Auth::user()->id,
            // 'created_at'	 			=> date('Y-m-d h:i:s'),
        );
        $save = DB::table('suppliers')->insert($supplier_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('suppliers')->insertGetId($supplier_adds);
        Session::flash('message' , 'Supplier Added Successfully');
        return redirect('supplier');
        // return redirect()->back();
        // if($save){
		// 	return response()->json(['data' => $supplier_adds, 'message' => 'Supplier Created Successfully'], 200);
		// }else{
		// 	return response()->json("Oops! Something Went Wrong", 400);
		// }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $model, $id)
    {
        $supplier = Supplier::where('supplier_id', $id)->get();

        return view('suppliers.edit', compact('supplier') );
        // return view('suppliers.edit', ['supplier' => $model->paginate(15)->items()[$id-1]]);
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
        $supplier_id = $id; //OR $request->suppliers_id;

        $validate = Validator::make($request->all(), [ 
            'supplier_ref_no' 			=> 'required',
            'supplier_type'             => 'required',//General, Booker
            'supplier_name' 			=> 'required',
            'supplier_shop_name' 		=> '',
            'supplier_shop_info' 		=> '',
            'supplier_email' 			=> '',
            'supplier_alternate_email' 	=> '',
            'supplier_cnic_number' 		=> '',
            'supplier_town' 			=> '',
            'supplier_area' 			=> '',
            'supplier_shop_address' 	=> '',
            'supplier_resident_address' => '',
            'supplier_zipcode' 			=> '',
            'supplier_phone_number' 	=> '',
            'supplier_office_number' 	=> '',
            'supplier_alternate_number' => '',
            'supplier_total_balance' 	=> '',
            'supplier_balance_paid' 	=> 'required',
            'supplier_balance_dues' 	=> 'required',
            'status_id' 	            => 'required',
        ]);
        if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
           return redirect()->back()->withErrors($validate);
        }
        $supplier_edits = array(
            'supplier_ref_no' 			=> $request->supplier_ref_no,
            'supplier_type'             => $request->supplier_type,
            'supplier_name' 			=> $request->supplier_name,
            'supplier_shop_name' 		=> $request->supplier_shop_name,
            'supplier_shop_info' 		=> $request->supplier_shop_info,
            'supplier_email' 			=> $request->supplier_email,
            'supplier_alternate_email' 	=> $request->supplier_alternate_email,
            'supplier_cnic_number' 		=> $request->supplier_cnic_number,
            'supplier_town' 			=> $request->supplier_town,
            'supplier_area' 			=> $request->supplier_area,
            'supplier_shop_address' 	=> $request->supplier_shop_address,
            'supplier_resident_address' => $request->supplier_resident_address,
            'supplier_zipcode' 			=> $request->supplier_zipcode,
            'supplier_phone_number' 	=> $request->supplier_phone_number,
            'supplier_office_number' 	=> $request->supplier_office_number,
            'supplier_alternate_number' => $request->supplier_alternate_number,
            'supplier_balance_paid' 	=> $request->supplier_balance_paid,
            'supplier_balance_dues' 	=> $request->supplier_balance_dues,
            'supplier_total_balance' 	=> $request->supplier_total_balance,
            'status_id' 	            => $request->status_id,
            // 'updated_by' 	        => Auth::user()->id,
            // 'updated_at'	 			=> date('Y-m-d h:i:s'),
        );

        $update = DB::table('suppliers')->where('supplier_id', '=', $supplier_id)->update($supplier_edits);
        // return redirect()->back();
        Session::flash('message' , 'Supplier Edited Successfully');
        return redirect('/supplier');
        // ->with(['message' => 'Supplier Edited Successfully'], 200);
        // return redirect('suppliers/'.$supplier_id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('suppliers')->where('supplier_id', $id)->delete();

        return redirect('/supplier')->with(['message' => 'Supplier Deleted Successfully'], 200);

    }

    public function searchsupplier(Request $request)
    {
        $getRecords = null;
        // $input = trim(filter_var($request['search_data'], FILTER_SANITIZE_STRING));
        $input = trim(filter_var($request['data'], FILTER_SANITIZE_STRING));
        //return response()->json(['input' => $request['input'],], 200);
        $records = Supplier::where(function($query)use($input){
            // $query->orWhere('supplier_ref_no', 'LIKE', "%{$input}%");
            $query->orWhere('supplier_name', '=', $input);
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

    public function searchsupplierpayments(Request $request)
    {
        $getRecords = NULL;
        $myvar = NULL;
        // $input = trim(filter_var($request['search_data'], FILTER_SANITIZE_STRING));
        $input = trim(filter_var($request['data'], FILTER_SANITIZE_STRING));
        //return response()->json(['input' => $request['input'],], 200);
        $records = Supplier::where(function($query)use($input){
            // $query->orWhere('supplier_ref_no', 'LIKE', "%{$input}%");
            $query->orWhere('supplier_name', '=', $input);
        })
        ->get()->toArray();

        $supplier_id = $records[0]['supplier_id'];

        $records2 = Payment::where(function($query)use($supplier_id){
            $query->where('payment_supplier_id', '=', $supplier_id);
        })
        ->get()->toArray();

        foreach($records2 as $one_payment){
            $myvar .= '<tr class="row table-info"><td class="col-1 firstcol text-center">'.$one_payment['payment_invoice_id'].'</td><td class="col-1 mycol text-center">'.$one_payment['payment_invoice_date'].'</td><td class="col-2 mycol text-center"   >'.$one_payment['payment_id'].'</td><td class="col-2 mycol text-center"   >'.$one_payment['payment_amount_paid'].'</td><td class="col-2 mycol text-center"   >'.$one_payment['payment_id'].'</td><td class="col-1 mycol text-center"   >'.$one_payment['payment_method'].'</td><td class="col-1 mycol text-center"   >'.$one_payment['payment_type'].'</td><td class="col-1 mycol text-center"   >'.$one_payment['payment_id'].'</td> <td class="col-1 lastcol text-center" >'.$one_payment['supplier_amount_dues'].'</td></tr>';
        }

        $records3 = array(
            'supplier' => $records,
            'payments' => $myvar
        );
        
        return $records3;
    }
}
