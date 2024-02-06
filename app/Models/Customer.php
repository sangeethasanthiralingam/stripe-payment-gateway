<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'stripe_customer_id',
    ];
    public static function getAllCustomers()
    {
        return self::all();
    }
    // You can define any relationships here if needed
}
