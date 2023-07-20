<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'novel_id',
        'describe',
        'status',
        'title',
        'content',
        'slug_chapter',
    ];
    protected $primaryKey = 'id';

    protected $table = 'chapter';

    public function novel() {
        return $this->belongsTo('App\Models\Novel');
    }
}
