<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMedicines extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cateogory',
        'price',
        'quantity'
    ];
}
