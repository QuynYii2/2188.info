<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLevelTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'level_old',
        'new_level',
        'activation_date',
        'duration',
        'expiration_date',
        'total_price',
        'type_account',
        //
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
