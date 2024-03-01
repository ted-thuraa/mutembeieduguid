<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'firstname',
        'text',
        'rating',
        'resource_id',
        'userid',
       
        
    ];
}
