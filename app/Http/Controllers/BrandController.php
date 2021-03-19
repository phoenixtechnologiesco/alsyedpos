<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Company;
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

class BrandController extends Controller
{
    /**
     * Display a listing of the brands
     *
     * @param  \App\Brand  $model
     * @return \Illuminate\View\View
     */
    public function index(Brand $model, Company $model2)
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $model, Company $model2)
    {
        $brands = Brand::all();
        $companies = Company::all();

        return view('brands.add', compact('brands', 'companies') );
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
            'brand_ref_no'            => 'required',
            'parent_company'            => '',
            'brand_name'              => 'required',
            'brand_description'              => '',
            // 'status_id'                 => 'required',
        ]);
        if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
           return redirect()->back()->withErrors($validate);
        }
        $brand_adds = array(
            'brand_ref_no'            => $request->brand_ref_no,
            'parent_company'          => $request->parent_company,
            'brand_name'              => $request->brand_name,
            'brand_description'       => $request->brand_description,
            'status_id'                 => 1,
            // 'status_id'              => $request->status_id,
            // 'created_at'	 			=> date('Y-m-d h:i:s'),
        );
        $save = DB::table('brands')->insert($brand_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('brands')->insertGetId($brand_adds);
        return redirect('/brand')->with(['message' => 'Brand Created Successfully'], 200);

        // if($save){
		// 	return response()->json(['data' => $brand_adds, 'message' => 'Brand Created Successfully'], 200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $model, $id, Company $model2)
    {
        $brand = Brand::where('brand_id', $id)->get();
        $companies = Company::all();
        // dd($brand[0]->brand_id);
        return view('brands.edit', compact('brand', 'companies'));
        // return view('brands.edit', ['brand' => $model->paginate(15)->items()[$id-1], 'companies' => $model2->paginate(15)->items()]);
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
        $brand_id = $id; //OR $request->brand_id;

        $validate = Validator::make($request->all(), [ 
            'brand_ref_no'            => '',
            'parent_company'            => '',
            'brand_name'              => '',
            'brand_description'       => '',
            // 'status_id'                 => 'required',
        ]);
        if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
           return redirect()->back()->withErrors($validate);
        }
        $brand_edits = array(
            'brand_ref_no'            => $request->brand_ref_no,
            'parent_company'          => $request->parent_company,
            'brand_name'              => $request->brand_name,
            'brand_description'       => $request->brand_description,
            'status_id'                 => 1,
            // 'status_id'                 => $request->status_id,
            // 'updated_at'	 			=> date('Y-m-d h:i:s'),
        );

        $update = DB::table('brands')->where('brand_id','=', $brand_id)->update($brand_edits);
        // return redirect()->back();
        return redirect('/brand')->with(['message' => 'Brand Edited Successfully'], 200);
        // return redirect('brands/'.$brand_id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('brands')->where('brand_id', $id)->delete();

        return redirect('/brand')->with(['message' => 'Brand Deleted Successfully'], 200);

    }
}
