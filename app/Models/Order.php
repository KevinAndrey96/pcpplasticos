<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory; 

    protected $table = 'orders';

    protected $fillable = [
        'seller_role',
        'status',
        'buyer_role',
        'currency',
        'total',
        'coment',
        'delivery_address',
        'seller_id',
        'buyer_id',        
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id'); 
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id'); 
    }

    public function products()
    {
        return $this->hasMany(Product::class); 
    }
}
