<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function InvoiceDetail(){
      return $this->hasOne('App\InvoiceDetail');
    }
    public function InvoiceDescription(){
      return $this->hasMany('App\InvoiceDescription');
    }
}
