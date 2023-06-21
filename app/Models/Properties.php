<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $fillable = ['name','attribute_id', 'status'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
