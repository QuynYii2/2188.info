<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, NodeTrait;

    // Category.php
    protected $fillable = [
        'id',
        'name',
        'thumbnail',
        'stt',
        'description',
        'slug',
        'icon',
    ];


    // Category.php
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
