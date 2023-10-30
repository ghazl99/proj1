<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
            protected $primaryKey = 'id';

    protected $table="offers";
        protected $fillable = [
        'name',
        'status',
        'price',
        'details',
        'photo',
    ];
      protected $hidden = [
      ];
    //   public $timestamps=false;
}
