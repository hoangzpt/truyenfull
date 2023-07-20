<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'describe',
        'status',
        'slug_category',
    ];

    protected $table = 'category';

    public function novel() {
        return $this->hasMany('App\Models\Novel', 'category_id', 'id');
    }
}
