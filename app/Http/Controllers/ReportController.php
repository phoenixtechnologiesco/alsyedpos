<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Company;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\PurchaseProducts;
use App\Models\SaleProducts;
use App\Models\PurchaseReturn;
use App\Models\SaleReturn;

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

class ReportController extends Controller
{
    public function balancecustomer()
    {
        // $purchases = Purchase::all();
        // $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        // $products = Product::all();
        // $payments = Payment::get();

        return view('balance.customer', compact('customers') );
        // return view('balance.customer', ['sales', 'purchases' => $purchases, 'customers' => $customers, 'payments' => $payments]);
    }

    public function getBalanceCustomerData()
    {
        $customers = Customer::where('status_id', 1)->get();
        
        return Datatables::of($customers)
        // ->editColumn('customer_id', '{{$customer_id}}')
        ->make(true);
    }

    public function balancesale()
    {
        $sale_customer_amount=0;
        $sale_total_amount_paid=0;
        $sale_total_amount_dues=0;
        $sale_total_amount=[];
        $saleledgers=[];

        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();

        $saleledgers_raw = Customer::join('sales', 'customers.customer_id', '=', 'sales.sale_customer_id')->get()->toArray();
        foreach ($customers as $key => $value) {
            $customersales = Sale::where('sale_customer_id', $value['customer_id'])->get();
            foreach ($customersales as $onesale) {
                $sale_customer_amount += $onesale->sale_grandtotal_price;
                $sale_total_amount_paid += $onesale->sale_amount_paid;
                $sale_total_amount_dues += $onesale->sale_amount_dues;
            }
            $sale_total_amount[$key] = $sale_customer_amount;
            $sale_amount_paid[$key] = $sale_total_amount_paid;
            $sale_amount_dues[$key] = $sale_total_amount_dues;

            $saleledgers[$key] = array(
                'customer_id' => $value->customer_id,
                'customer_ref_no' => $value->customer_ref_no,
                'customer_name' => $value->customer_name,
                'customer_balance_paid' => $value->customer_balance_paid,
                'customer_balance_dues' => $value->customer_balance_dues,
                'sale_amount_paid' => $sale_amount_paid[$key],
                'sale_amount_dues' => $sale_amount_dues[$key],
                'sale_total_balance' => $sale_total_amount[$key],
                // 'sale_invoice_date' => $sale_invoice_date,
            );
        }

        return view('balance.sale', compact('saleledgers', 'sales', 'customers') );
        // return view('balance.sale, ['sales' => $sales, 'customers' => $customers,]);
    }

    public function getBalanceSaleData()
    {
        $sale_customer_amount=0;
        $sale_total_amount_paid=0;
        $sale_total_amount_dues=0;
        $sale_total_amount=[];
        $saleledgers=[];

        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();

        foreach ($customers as $key => $value) {
            $customersales = Sale::where('sale_customer_id', $value['customer_id'])->get();
            foreach ($customersales as $onesale) {
                $sale_customer_amount += $onesale->sale_grandtotal_price;
                $sale_total_amount_paid += $onesale->sale_amount_paid;
                $sale_total_amount_dues += $onesale->sale_amount_dues;
            }
            $sale_total_amount[$key] = $sale_customer_amount;
            $sale_amount_paid[$key] = $sale_total_amount_paid;
            $sale_amount_dues[$key] = $sale_total_amount_dues;

            $saleledgers[$key] = array(
                'customer_id' => $value->customer_id,
                'customer_ref_no' => $value->customer_ref_no,
                'customer_name' => $value->customer_name,
                'customer_balance_paid' => $value->customer_balance_paid,
                'customer_balance_dues' => $value->customer_balance_dues,
                'sale_amount_paid' => $sale_amount_paid[$key],
                'sale_amount_dues' => $sale_amount_dues[$key],
                'sale_total_balance' => $sale_total_amount[$key],
                // 'sale_invoice_date' => $sale_invoice_date,
            );
        }
        
        return Datatables::of($saleledgers)
        // ->editColumn('customer_id', '{{$customer_id}}')
        ->make(true);
    }

    public function balancepurchase()
    {
        $purchase_supplier_amount=0;
        $purchase_total_amount_paid=0;
        $purchase_total_amount_dues=0;
        $purchase_total_amount=[];
        $purchaseledgers=[];

        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();

        // $purchaseledgers = Purchase::join('suppliers', 'purchases.purchase_supplier_id', '=', 'suppliers.supplier_id')->get();
        $purchaseledgers_raw = Supplier::join('purchases', 'suppliers.supplier_id', '=', 'purchases.purchase_supplier_id')->get()->toArray();
        foreach ($suppliers as $key => $value) {
            $supplierpurchases = Purchase::where('purchase_supplier_id', $value['supplier_id'])->get();
            foreach ($supplierpurchases as $onepurchase) {
                $purchase_supplier_amount += $onepurchase->purchase_grandtotal_price;
                $purchase_total_amount_paid += $onepurchase->purchase_amount_paid;
                $purchase_total_amount_dues += $onepurchase->purchase_amount_dues;
            }
            $purchase_total_amount[$key] = $purchase_supplier_amount;
            $purchase_amount_paid[$key] = $purchase_total_amount_paid;
            $purchase_amount_dues[$key] = $purchase_total_amount_dues;

            $purchaseledgers[$key] = array(
                'supplier_id' => $value->supplier_id,
                'supplier_ref_no' => $value->supplier_ref_no,
                'supplier_name' => $value->supplier_name,
                'supplier_balance_paid' => $value->supplier_balance_paid,
                'supplier_balance_dues' => $value->supplier_balance_dues,
                'purchase_amount_paid' => $purchase_amount_paid[$key],
                'purchase_amount_dues' => $purchase_amount_dues[$key],
                'purchase_total_balance' => $purchase_total_amount[$key],
                // 'purchase_invoice_date' => $purchase_invoice_date,
            );
        }
        // dd($purchaseledgers);

        return view('balance.purchase', compact('purchaseledgers', 'purchases', 'suppliers',) );
        // return view('balance.purchase, ['purchases' => $purchases,  'payments' => $payments]);
    }

    public function getBalancePurchaseData()
    {
        $purchase_supplier_amount=0;
        $purchase_total_amount_paid=0;
        $purchase_total_amount_dues=0;
        $purchase_total_amount=[];
        $purchaseledgers=[];

        $purchases = Purchase::all();
        $suppliers = Supplier::where('status_id', 1)->get();

        foreach ($suppliers as $key => $value) {
            $supplierpurchases = Purchase::where('purchase_supplier_id', $value['supplier_id'])->get();
            foreach ($supplierpurchases as $onepurchase) {
                $purchase_supplier_amount += $onepurchase->purchase_grandtotal_price;
                $purchase_total_amount_paid += $onepurchase->purchase_amount_paid;
                $purchase_total_amount_dues += $onepurchase->purchase_amount_dues;
            }
            $purchase_total_amount[$key] = $purchase_supplier_amount;
            $purchase_amount_paid[$key] = $purchase_total_amount_paid;
            $purchase_amount_dues[$key] = $purchase_total_amount_dues;

            $purchaseledgers[$key] = array(
                'supplier_id' => $value->supplier_id,
                'supplier_ref_no' => $value->supplier_ref_no,
                'supplier_name' => $value->supplier_name,
                'supplier_balance_paid' => $value->supplier_balance_paid,
                'supplier_balance_dues' => $value->supplier_balance_dues,
                'purchase_amount_paid' => $purchase_amount_paid[$key],
                'purchase_amount_dues' => $purchase_amount_dues[$key],
                'purchase_total_balance' => $purchase_total_amount[$key],
                // 'purchase_invoice_date' => $purchase_invoice_date,
            );
        }
        
        return Datatables::of($purchaseledgers)
        // ->editColumn('customer_id', '{{$customer_id}}')
        ->make(true);
    }

    public function balancecreditduration()
    {
        $purchases = Purchase::all();
        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();

        return view('balance.creditduration', compact('sales', 'purchases', 'customers',) );
        // return view('balance.creditduration, ['sales', 'purchases' => $purchases, 'customers' => $customers, 'payments' => $payments]);
    }

    public function getBalanceCreditDurationData()
    {
        $customers = Customer::where('status_id', 1)->get();
        
        return Datatables::of($customers)
        // ->editColumn('customer_id', '{{$customer_id}}')
        ->make(true);
    }

    public function reportdate()
    {
        // $purchases = Purchase::all();
        // $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        // $products = Product::all();
        // $payments = Payment::get();
        return view('report.datewise', compact('customers') );
    }

    public function reportcashcredit()
    {
        // $purchases = Purchase::all();
        // $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        // $products = Product::all();
        // $payments = Payment::get();
        return view('report.cashcreditwise', compact('customers') );
    }

    public function reportcustomer()
    {
        // $purchases = Purchase::all();
        // $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        // $products = Product::all();
        // $payments = Payment::get();
        return view('report.customerwise', compact('customers') );
    }

    public function reportbrand()
    {
        $purchases = Purchase::all();
        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::all();
        $payments = Payment::get();
        $brands = Brand::all();

        return view('report.brandwise', compact('customers', 'brands') );
    }

    public function reportcompany()
    {
        $purchases = Purchase::all();
        $sales = Sale::all();
        $customers = Customer::where('status_id', 1)->get();
        $products = Product::all();
        $payments = Payment::get();
        $companies = Company::all();

        return view('report.companywise', compact('customers', 'companies') );
    }


}
