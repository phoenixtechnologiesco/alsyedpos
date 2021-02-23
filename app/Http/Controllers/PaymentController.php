<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
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

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sale $model, Customer $model2, Payment $model3)
    {
        $sales = $model->paginate(15)->items();
        // $sales = sale::get();
        $customers = Customer::where('status_id', 1)->get();
        $payments = Payment::get();

        return view('sales.payment', compact('sales', 'customers', 'payments') );
        // return view('sales.payment', ['sales' => $sales, 'customers' => $customers, 'payments' => $payments]);
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
        //     'payment_id'                 => '',
        //     'payment_ref_no'             => '',
        //     'payment_type'               => '',//'initial/opening_balance', 'opening_stock', 'credit', 'debit', 'deposit', 'transfer', 'refund', 'sale_return', 'purchase_return'
        //     'customer_id'                => '',
        //     'supplier_id'                => '',
        //     'payment_method'             => 'required',//'cash', 'credit', 'deposit', 'card', 'cheque', 'other'
        //     'payment_amount_paid'        => 'required',
        //     'payment_amount_balance'     => '',
        //     'payment_cheque_no'          => '',
        //     'account_id'                 => '',
        //     'payment_note'               => '',
        //     'payment_status'             => '',//'paid', 'due', 'partial', 'overdue'
        //     'payment_invoice_no'         => '',
        //     'payment_invoice_date'       => '',
        //     'payment_document'           => '',
        //     'created_by'                 => '',
        // ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $payment_ref_no = $random = Str::random(8); //str_random
        $payment_type = 'credit';
        //$payment_adds = $request->except('document');
        //$payment_adds['ref_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $payment_amount_recieved = $request->payment_amount_recieved;
        // $payment_amount_balance = $request->payment_amount_paid;
        $customer_amount_paid = $request->customer_amount_paid;
        $customer_amount_dues = $request->customer_amount_dues;

        if($payment_amount_recieved > $customer_amount_dues){
            $customer_amount_paid = $customer_amount_paid + $payment_amount_recieved;
            $customer_amount_dues = $customer_amount_dues - $payment_amount_recieved;
            // $payment_amount_balance = $payment_amount_balance - $payment_amount_recieved;
        }
        else{
            $customer_amount_paid = $customer_amount_paid + $payment_amount_recieved;
            $customer_amount_dues = $customer_amount_dues - $payment_amount_recieved;
            // // $payment_amount_balance = $payment_amount_balance - $payment_amount_recieved;
        }

        $customer_id = $request->payment_customer_id;
        // $customer_name = $request->payment_customer_name;
        $customer_edits = array(
            'customer_balance_paid' 	=> $customer_amount_paid,
            'customer_balance_dues' 	=> $customer_amount_dues,
            // 'customer_total_balance'    => $request->customer_total_balance,
        );

        $update = DB::table('customers')->where('customer_id','=', $customer_id)->update($customer_edits);

        $payment_adds = array(
            'payment_ref_no'           => $payment_ref_no,
            'payment_type'             => $request->payment_type,
            'payment_customer_id'      => $request->payment_customer_id,
            // 'payment_supplier_id'      => $request->payment_supplier_id,
            // 'payment_status'           => $request->payment_status,
            'payment_status'           => 'done',
            'payment_note'             => $request->payment_note,
            'payment_amount_paid'      => $payment_amount_recieved,
            // 'payment_amount_balance'   => $payment_amount_balance,
            'customer_amount_paid'     => $customer_amount_paid,
            'customer_amount_dues'     => $customer_amount_dues,
            'payment_method'           => $request->payment_method,
            'payment_cheque_no'        => $request->payment_cheque_no,
            // 'payment_document'         => $request->payment_document,
            // 'account_id'               => $request->account_id,
            'payment_invoice_id'       => $request->payment_invoice_id,
            'payment_invoice_date'     => $request->payment_invoice_date,
            // 'payment_date'             => $request->payment_date,
            'payment_created_by' 	   => Auth::user()->id,
            'created_at'	 		   => date('Y-m-d h:i:s'),
        );
        $document = $request->payment_document;
        if($document){
            $v = Validator::make([
                    'extension' => strtolower($request->payment_document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:pdf,csv,docx,pptx,xlsx,txt',
            ]);
            if($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $documentName = $document->getClientOriginalName();
            // dd($documentName);
            // $document->move('public/documents/payment', $documentName);
            Storage::disk('documents')->put('/', $document);
            // Storage::putFile('documents', $document, $documentName);
            $payment_adds['payment_document'] = $documentName;
        }

        $save = DB::table('payments')->insert($payment_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('payments')->insertGetId($payment_adds)
        
		if($save){
			return response()->json(['data' => $payment_adds, 'message' => 'payment Created Successfully'], 200);
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
    public function edit($id)
    {
        //
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
        //
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
}
