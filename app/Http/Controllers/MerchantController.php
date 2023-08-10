<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;

use RealRashid\SweetAlert\Facades\Alert;

class MerchantController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $limit = isset($request->limit) ? $request->limit : 10;
        $search = isset($request->search) ? $request->search : '';

        $merchants = Merchant::where('status','Active')->where('name','LIKE','%'.$search.'%')->orWhere('contact_person','LIKE','%'.$search.'%')->paginate($limit);

        return view('merchants.index',
        array(
            'header' => 'Merchants',
            'merchants' => $merchants,
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
        return view('merchants.add_merchant',
        array(
            'header' => 'Merchants',
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
        $new_merchant = new Merchant;
        $new_merchant->name = $request->name;
        $new_merchant->address = $request->address;
        $new_merchant->city = $request->city;
        $new_merchant->region = $request->region;
        $new_merchant->website = $request->website;
        $new_merchant->phone = $request->phone;
        $new_merchant->zip_code = $request->zip_code;
        $new_merchant->country = $request->country;
        $new_merchant->notes = $request->notes;
        $new_merchant->contact_person = $request->contact_person;
        $new_merchant->contact_phone = $request->contact_phone;
        $new_merchant->contact_email = $request->contact_email;
        $new_merchant->status = 'Active';
        $new_merchant->save();

        Alert::success('Successfully Stored')->persistent('Dismiss');
        return redirect('/merchants');
    }

    public function storeRegister(Request $request)
    {
        //
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
        $merchant = Merchant::where('id',$id)->first();

        return view('merchants.edit_merchant',
        array(
            'header' => 'Merchants',
            'merchant' => $merchant,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $merchant = Merchant::findOrFail($merchant->id);
        $merchant->name = $request->name;
        $merchant->address = $request->address;
        $merchant->city = $request->city;
        $merchant->region = $request->region;
        $merchant->website = $request->website;
        $merchant->phone = $request->phone;
        $merchant->zip_code = $request->zip_code;
        $merchant->country = $request->country;
        $merchant->notes = $request->notes;
        $merchant->contact_person = $request->contact_person;
        $merchant->contact_phone = $request->contact_phone;
        $merchant->contact_email = $request->contact_email;
        $merchant->status = $request->status;
        $merchant->save();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return redirect('/merchants');
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
