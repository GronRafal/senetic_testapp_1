<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'addresses';

    protected $fillable = ['street', 'city'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
