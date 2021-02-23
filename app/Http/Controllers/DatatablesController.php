<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\ProductBarcodes;

class DatatablesController extends Controller
{
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
        ->addColumn('action', function ($products) {
            return '<a href="product/'. $products->product_id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        // ->editColumn('product_id', '{{$product_id}}')
        ->make(true);
    }

    public function getMasterDetailsData()
    {
        $products = Product::select();

        return Datatables::of($products)
            ->addColumn('details_url', function($product) {
                return route('api.master_single_details', $product->product_id);
            })->make(true);
    }

    public function getMasterDetailsSingleData($id)
    {
        $purchases = Product::findOrFail($id)->purchases;

        return Datatables::of($purchases)->make(true);
    }

    public function getColumnSearchData()
    {
        $products = Product::select();

        return Datatables::of($products)->make(true);
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

    public function getCarbonData()
    {
        $products = select(['product_id', 'product_name', 'product_barcode', 'product_company', 'product_brand', 'product_pieces_total',  'product_packets_total', 'product_cartons_total', 'product_pieces_available', 'product_packets_available', 'product_cartons_available', 'product_trade_price_piece', 'product_trade_price_packet', 'product_trade_price_carton', 'product_cash_price_piece', 'product_cash_price_packet', 'product_credit_price_carton', 'product_credit_price_piece', 'product_credit_price_packet', 'product_credit_price_carton' ]);

        return Datatables::of($products)
            ->editColumn('created_at', '{!! $created_at !!}')
            ->editColumn('updated_at', function ($product) {
                return $product->updated_at->format('Y/m/d');
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->make(true);
    }
}

