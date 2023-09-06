<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    public function merchant_documents(){
        return $this->hasMany(MerchantDocument::class);
    }
}
