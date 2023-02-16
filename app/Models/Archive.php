<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archives';

   public function categories(){
    return $this->belongsTo('App\Models\Category','category_id');
   }
   public function users(){
    return $this->belongsTo('App\Models\User','user_id');
   }
}
