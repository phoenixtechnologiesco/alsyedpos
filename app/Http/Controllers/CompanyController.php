<?php

namespace App\Http\Controllers;

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

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies
     *
     * @param  \App\Company  $model
     * @return \Illuminate\View\View
     */
    public function index(Company $model)
    {
        return view('companies.index', ['companies' => $model->paginate(15)->items()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $model)
    {
        return view('companies.add', ['companies' => $model->paginate(15)->items(), 'allcompanies' => $model->paginate(15)->items()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validate = Validator::make($request->all(), [ 
        //     'company_ref_no'            => 'required',
        //     'company_parent'            => '',
        //     'company_name'              => 'required',
        //     'company_description'              => '',
        //     // 'status_id'                 => 'required',
        // ]);
        // if ($validate->fails()) {    
        //    return response()->json("Fields Required", 400);
        // }
        $company_adds = array(
            'company_ref_no'            => $request->company_ref_no,
            'company_parent'            => $request->company_parent,
            'company_name'              => $request->company_name,
            'company_description'       => $request->company_description,
            'status_id'                 => 1,
            // 'status_id'              => $request->status_id,
            // 'created_at'	 			=> date('Y-m-d h:i:s'),
        );
        $save = DB::table('companies')->insert($company_adds);
        $id = DB::getPdo()->lastInsertId();
        // $add_id = DB::table('companies')->insertGetId($company_adds);
		if($save){
			return response()->json(['data' => $company_adds, 'message' => 'Company Created Successfully'], 200);
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
    public function edit(Company $model, $id)
    {
        return view('companies.edit', ['companies' => $model->paginate(15)->items()[$id-1], 'allcompanies' => $model->paginate(15)->items()]);
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
        $company_id = $id; //OR $request->company_id;

        $validate = Validator::make($request->all(), [ 
            'company_ref_no'            => 'required',
            'company_parent'            => '',
            'company_name'              => 'required',
            'company_description'       => '',
            // 'status_id'                 => 'required',
        ]);
        if ($validate->fails()) {    
           return response()->json("Fields Required", 400);
        }
        $company_edits = array(
            'company_ref_no'            => $request->company_ref_no,
            'company_parent'            => $request->company_parent,
            'company_name'              => $request->company_name,
            'company_description'       => $request->company_description,
            'status_id'                 => 1,
            // 'status_id'                 => $request->status_id,
            // 'updated_at'	 			=> date('Y-m-d h:i:s'),
        );

        $update = DB::table('companies')->where('company_id','=', $company_id)->update($company_edits);
        // return redirect()->back();
        return redirect('/company')->with(['message' => 'Company Edited Successfully'], 200);
        // return redirect('companies/'.$company_id.'/edit');
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
