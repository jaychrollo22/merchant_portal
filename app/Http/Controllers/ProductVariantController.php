<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductVariant;

use RealRashid\SweetAlert\Facades\Alert;

class ProductVariantController extends Controller
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

        $merchant_id = '';
        if(auth()->user()->role == 'Merchant'){
            $merchant_id = auth()->user()->merchant_id;
        }

        $product_variants = ProductVariant::where('status','Active')
                                ->where('name','LIKE','%'.$search.'%')
                                ->when($merchant_id,function($q) use($merchant_id){
                                    $q->where('merchant_id',$merchant_id);
                                })
                                ->paginate($limit);
            
        return view('product_variants.index',
        array(
            'header' => 'Product Categories',
            'product_variants'=>$product_variants,
            'search'=>$search,
            'limit'=>$limit,
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_variants.add_product_variant',
        array(
            'header' => 'Add Variant',
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
        $merchant_id = auth()->user()->merchant_id;

        $new = new ProductVariant;
        $new->name = $request->name;
        $new->merchant_id = $merchant_id;
        $new->status = 'Active';
        $new->save();

        Alert::success('Successfully Stored')->persistent('Dismiss');
        return redirect('/product-variants');

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
        $product_variant = ProductVariant::where('id',$id)->first();

        return view('product_variants.edit_product_variant',
        array(
            'header' => 'Edit Variant',
            'product_variant' => $product_variant,
        ));
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
        $updated = ProductVariant::findOrFail($id);
        $updated->name = $request->name;
        $updated->save();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return redirect('/product-variants');
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
