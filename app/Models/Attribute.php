<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'attribute_variation');
    }
}
