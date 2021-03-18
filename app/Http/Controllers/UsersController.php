<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use DB;
use Input;
use Session;
use Response;
use Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('superadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $you = auth()->user();
        $users = User::all();
        return view('dashboard.admin.usersList', compact('users', 'you'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $model)
    {
        $users = User::all();
        return view('dashboard.admin.userAddForm', compact('users'));
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
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|min:1|max:256|unique:users',
            'password'   => 'required_with:password_confirmation|same:password_confirmation|min:1|max:256|',
            'password_confirmation' => 'required_with:password|same:password|min:1|max:256'
        ]);
        if ($validate->fails()) {    
           return response()->json("Fields Requireds", 400);
        }

        // $user_add = array(
        //     'name'          => $request->input('name'),
        //     'email'         => $request->input('email'),
        //     'password'      => Hash::make($request->password),
        //     // 'created_at'    => date('Y-m-d h:i:s'),
        // );
        // $user_save = DB::table('users')->insert($user_add);
        $user =  User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->assignRole('user');

        $request->session()->flash('message', 'Successfully Created User');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.userShow', compact( 'user' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.userEditForm', compact('user'));
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
        $validate = Validator::make($request->all(), [
            'name'       => 'required|min:2|max:256',
            'email'      => 'required','min:2','max:256','unique:users,email,'.$id.',id',
            // 'email'      => ['required|min:1|max:256|unique:users,email', Rule::unique('users')->ignore($id),],
            // 'password'   => 'sometimes|string|min:6|same:password_confirmation',
            
            // 'password'   => 'required_with:password_confirmation|same:password_confirmation|min:6|max:256|',
            // 'password_confirmation' => 'required_with:password|same:password|min:6|max:256'
        ]);
        if ($validate->fails()) {    
            return response()->json("Fields Requireds", 400);
        }
        // dd($validate);

        $user_name = $request->input('name');
        $user_email = $request->input('email');
        // $user = User::find($id);
        // $user->name       = $user_name;
        // $user->email      = $user_email;
        // if(!empty($request->input('password'))){
        //     $user->password   = Hash::make($request->input('password'));
        // }
        // $user->save();
        $user_edits = array(
            'name'       => $user_name,
            'email'      => $user_email,
        );
        if(!empty($request->input('password'))){
            $user_edits['password']   = Hash::make($request->input('password'));
        }

        $update = DB::table('users')->where('id', $id)->update($user_edits);

        // $request->session()->flash('message', 'Successfully Updated User');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return redirect()->route('users.index');
    }
}
