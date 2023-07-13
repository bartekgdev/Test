<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The products that belong to the tag.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
