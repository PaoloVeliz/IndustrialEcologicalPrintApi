<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travels extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'team',
        'date',
        'amount',
        'emission_type',
    ];
}
