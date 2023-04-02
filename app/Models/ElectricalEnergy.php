<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricalEnergy extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'responsable_team',
        'date',
        'emission_type',
    ];
}
