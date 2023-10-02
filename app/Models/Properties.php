<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'attribute_id', 'slug', 'description', 'status','name_vi', 'name_ja', 'name_ko', 'name_en', 'name_zh'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
