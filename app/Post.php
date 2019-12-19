<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
        'flatRange','address','contact','numberOfBed','numberOfBath',
        'category_id','user_id', 'image', 'landRange'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
