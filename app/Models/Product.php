<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class Product extends Eloquent
{
    protected $collection = 'products'; // Specify the MongoDB collection name
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id',
        'title',
        'description',
        'availability',
        'ratingsQuantity',
        'brand',
        'stockQuantity',
        'imageCover',
        'ratingsAverage',
        'price',
        'category',
        'slug',
        'discount',
        'images',
    ];
    public $timestamps = true;

    const UPDATED_AT = 'updatedAt';
    const CREATED_AT = 'createdAt';

    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }


}

