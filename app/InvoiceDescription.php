<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDescription extends Model
{
  public function Invoice(){
    return $this->belongsTo('App\Invoice');
  }
}
