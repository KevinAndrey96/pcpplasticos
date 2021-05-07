<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'price',
        'list_id',
        'code',
        'url',
    ];

    public function list()
    {
        return $this->belongsTo(PriceList::class); 
    }
}
