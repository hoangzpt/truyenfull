<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'describe',
        'status',
        'slug_novel',
        'image',
        'category_id',
    ];
    protected $primaryKey = 'id';

    protected $table = 'novel';

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function chapter() {
        return $this->hasMany('App\Models\Chapter', 'novel_id', 'id');
    }
}
