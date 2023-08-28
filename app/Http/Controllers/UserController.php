<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Merchant;

use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = isset($request->limit) ? $request->limit : 10;
        $search = isset($request->search) ? $request->search : '';

        $users = User::where('status','Active')->where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->paginate($limit);

        return view('users.index',
        array(
            'header' => 'Users',
            'users'=>$users,
            'search'=>$search,
            'limit'=>$limit
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $merchants = Merchant::where('status','Active')
                                ->orderBy('name','ASC')
                                ->get();

        return view('users.add_user',
        array(
            'header' => 'Users',
            'merchants' => $merchants
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'merchant_id' => 'required'
        ]);

        $new_user = new User;
        $new_user->name = $request->input('name');
        $new_user->email = $request->input('email');
        $new_user->password = bcrypt($request->input('password'));
        $new_user->merchant_id = $request->input('merchant_id');
        $new_user->role = $request->input('role');
        $new_user->save();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword($id)
    {
        $user = User::where('id',$id)->first();

        return view('users.change_password',
        array(
            'header' => 'Users',
            'user'=>$user
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();

        $merchants = Merchant::where('status','Active')
                                ->orderBy('name','ASC')
                                ->get();

        return view('users.edit_user',
        array(
            'header' => 'Users',
            'merchants' => $merchants,
            'user'=>$user
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePasswordUser(Request $request, $id)
    {

        $validator = $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::where('id',$id)->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return redirect('/users');
    }


    public function update(Request $request, $id)
    {


        $user = User::where('id',$id)->first();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->merchant_id = $request->input('merchant_id');
        $user->role = $request->input('role');
        $user->save();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return redirect('/users');
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
