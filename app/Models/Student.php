<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory,
        SoftDeletes;

    protected $cast = [
        'birthday' => 'date',
        'signed_up_the' => 'date',
    ];

    protected $fillable = [
        "firstname",
        "lastname",
        'phone',
        'email' ,
        'birthday'
    ];
        
}
