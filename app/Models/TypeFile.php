<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = ['deleted_at' => 'datetime'];
   
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
}
