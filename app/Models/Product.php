<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // If you want to specify which columns are mass assignable
    protected $fillable = [
        'name', 'description', 'price', 'quantity','status'
    ];
}

