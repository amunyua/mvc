<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
//    protected $fillable = array(
//        'school_id', 'postal_address', 'physical_address', 'website', 'masterfile_id', 'telephone_No', 'email', 'mobile_no'
//    );

    public function masterfile(){
        return $this->belongsTo('App\Masterfile');
    }
}
