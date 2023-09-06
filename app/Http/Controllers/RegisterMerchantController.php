<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\MerchantDocument;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Storage;
class RegisterMerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $url = "https://restcountries.com/v3.1/all";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        // return json_decode($response);
        return view('merchants.register',array('countries'=>json_decode($response)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
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
        $new_merchant->status = 'For Approval';
        $new_merchant->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $dateFolder = Carbon::now()->format('Ymd'); // Generate a folder path based on the current date
                $original_filename = $file->getClientOriginalName();
                $fileSizeInBytes = $file->getSize();
                $fileSizeInMB = round($fileSizeInBytes / 1024 / 1024, 2);

                if (!Storage::exists("public/merchant_documents/{$new_merchant->id}")) {
                    Storage::makeDirectory("public/merchant_documents/{$new_merchant->id}");
                }

                $file->storeAs('public/merchant_documents/' . $new_merchant->id, $original_filename);

                $new_merchant_doc = new MerchantDocument;
                $new_merchant_doc->original_filename = $original_filename;
                $new_merchant_doc->size = $fileSizeInMB;
                $new_merchant_doc->merchant_id = $new_merchant->id;
                $new_merchant_doc->save();

            }
        }

        return redirect('/login?registered=true');
    }
}
