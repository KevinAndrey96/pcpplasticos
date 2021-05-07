<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $table = 'price_lists';
    protected $fillable = [
        'name',
        'role',
        'currency',
        'country',

        
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users(){

        return $this->hasMany(User::class);
    }


}
