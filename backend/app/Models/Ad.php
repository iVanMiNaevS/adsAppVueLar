<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'user_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
