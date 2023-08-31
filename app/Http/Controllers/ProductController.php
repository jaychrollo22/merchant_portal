<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

use Image;
use Storage;

class ProductController extends Controller
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

        $products = Product::where('status','Active')
                                ->where('name','LIKE','%'.$search.'%')
                                ->when($merchant_id,function($q) use($merchant_id){
                                    $q->where('merchant_id',$merchant_id);
                                })
                                ->paginate($limit);
            
        return view('products.index',
        array(
            'header' => 'Product',
            'products'=>$products,
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
        return view('products.add_product',
        array(
            'header' => 'Product',
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
            'catalog' => 'required',
            'price' => 'required',
            'images' => 'required',
        ]);

        $new_product = new Product;
        $new_product->name = $request->name;
        $new_product->catalog = $request->catalog;
        $new_product->price = $request->price;
        $new_product->remarks = $request->remarks;
        $new_product->merchant_id = auth()->user()->merchant_id;
        $new_product->status = 'Active';
        $new_product->save();

        if($request->images){
            $images = json_decode($request->images);

            if(count($images)){
                foreach($images as $k=> $image){

                    $base64_str = substr($image, strpos($image, ",")+1);
                    $image = base64_decode($base64_str);
                    
                    $path = $new_product->id . '_'. $k . '.png';
                    Storage::disk('public')->put('product_images/'.$path,  $image);

                    $new_product_image = new ProductImage;
                    $new_product_image->product_id = $new_product->id;
                    $new_product_image->image_file = $path;
                    $new_product_image->save();

                }
            }
        }

        return $response = [
            'status'=> 'saved'
        ];
    }

    public function removeImage($id){
        $product_image = ProductImage::where('id',$id)->first();
        if($product_image){
            $product_image->delete();
            return $response = [
                'status'=> 'saved'
            ];
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
        return view('products.edit_product',
        array(
            'header' => 'Product',
            'id' => $id
        ));
    }
    public function info($id)
    {
       return Product::with('images')->where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->all();
        $validator = $request->validate([
            'name' => 'required',
            'catalog' => 'required',
            'price' => 'required',
        ]);

        $product = Product::where('id',$request->id)->first();
        if($product){

            $product->name = $request->name;
            $product->catalog = $request->catalog;
            $product->price = $request->price;
            $product->remarks = $request->remarks;
            $product->save();

            if($request->images){
                $images = json_decode($request->images);

                if(count($images)){
                    foreach($images as $k=> $image){

                        $base64_str = substr($image, strpos($image, ",")+1);
                        $image = base64_decode($base64_str);
                        
                        $path = $product->id . '_'. $k . '.png';
                        Storage::disk('public')->put('product_images/'.$path,  $image);

                        $new_product_image = new ProductImage;
                        $new_product_image->product_id = $product->id;
                        $new_product_image->image_file = $path;
                        $new_product_image->save();

                    }
                }
            }
            return $response = [
                'status'=> 'saved'
            ];
        }else{
            return $response = [
                'status'=> 'error'
            ];
        }

        
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
