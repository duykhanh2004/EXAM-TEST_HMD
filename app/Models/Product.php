<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Cho phép gán giá trị cho các trường cần thiết
    protected $fillable = ['name', 'price', 'image'];
}
