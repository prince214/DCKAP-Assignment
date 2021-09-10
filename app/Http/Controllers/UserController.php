<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $view['countries'] = Countries::all();
        $view['users'] = User::all();

        if ($request->ajax()) {

            $postQuery = DB::table('users');
            if($request->get('s_status') && $request->get('s_status')  != '0'){
                $postQuery = $postQuery->where('status',$request->s_status);
            }
            if($request->get('s_name') && $request->get('s_name')  != '0'){
                $postQuery = $postQuery->where('name', 'LIKE', '%'.$request->s_name.'%');
            }
            if($request->get('s_email') && $request->get('s_email')  != '0'){
                $postQuery = $postQuery->where('email', 'LIKE', '%'.$request->s_email.'%');
            }
            if($request->get('s_age')){
                $age = '-'.$request->s_age.' years';
                $age = date('Y-m-d', strtotime($age));
                $postQuery = $postQuery->where('dob','<=',$age);
            }
            $postQuery = $postQuery->orderBy('created_at', 'DESC');

            return Datatables::of($postQuery)
                ->addColumn('profile_pic', function ($data){
                    $image = empty($data->profile_pic) ? asset('images/default-profile.jpg') : asset($data->profile_pic);
                    return '<img width="40px" src="'. $image .'"/>';
                })
                ->addColumn('dob', function ($data){
                    return $data->dob ? Carbon::parse($data->dob)->diff(Carbon::now())->y.' Years' : '--';
                })
                ->addColumn('status', function ($data){
                    if($data->status == 'active') {
                        $class = 'success';
                    }else{
                        $class = 'danger';
                    }
                    return '<span class="badge badge-'.$class.'">'.ucwords($data->status).'</span>';
                })
                ->addColumn('action', 'users.partial.action')
                ->rawColumns(['profile_pic','status','action'])
                ->addIndexColumn()
                ->make(true);


        }

        return view('users.index', $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'dob' => 'required',
            'status' => 'required',
            'education' => 'required',
            'profile_pic' => 'image'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'status' => $request->status,
            'education' => $request->education,
            'dob' => date('Y-m-d',strtotime($request->dob)),
            'pin_code' => $request->pincode,
            'country_id' => $request->country,
            'city_id' => $request->city,
        ];

        if($request->file('profile_pic')){
            $image = $request->file('profile_pic');
            $imageName = rand(0,10000).time() . '.' . $image->extension();
            $image->move(public_path('upload/user-images'), $imageName);
            $data['profile_pic'] = 'upload/user-images/'.$imageName;
        }
        $user = User::create($data);
        if($user){
            $request->session()->flash('alert-success', "User Created.");
        }else{
            $request->session()->flash('alert-danger', "Something went wrong.");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userid = Crypt::decrypt($id);
        $user = User::where('users.id',$userid)
                ->leftJoin('countries','users.country_id','countries.id')
                ->leftJoin('cities','users.city_id','cities.id')
                ->first();
        if($user){
            return response()->json(['status' => true, 'data' => $user]);
        }else{
            return response()->json(['status' => false, 'data' => 'User not found.']);
        }
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
        $userId = Crypt::decrypt($id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'dob' => $request->dob ? date('Y-m-d',strtotime($request->dob)): null,
            'status' => $request->status,
            'pin_code' => $request->pincode,
            'education' => $request->education,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ];

        if($request->file('profile_pic')){
            $image = $request->file('profile_pic');
            $imageName = rand(0,10000).time() . '.' . $image->extension();
            $image->move(public_path('upload/user-images'), $imageName);
            $data['profile_pic'] = 'upload/user-images/'.$imageName;
        }

        $user = User::where('id',$userId)->update($data);
        if($user){
            $request->session()->flash('alert-success', "User Delete.");
        }else{
            $request->session()->flash('alert-danger', "Something went wrong.");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('id',$id)->delete();
        if($user){
            $request->session()->flash('alert-success', "User Delete.");
        }else{
            $request->session()->flash('alert-danger', "Something went wrong.");
        }
        return redirect()->back();
    }
}
