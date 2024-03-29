<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'url', 'views', 'size'];

    protected $dates = ['created_at', 'updated_at'];
}
