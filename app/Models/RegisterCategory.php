<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterCategory extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'storage_id',
        'category_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
