<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class Area extends Eloquent
{
    // The MongoDB collection name
    protected $collection = 'areas';

    // Define the fields that need to be casted
    protected $casts = [
        '_id' => 'string',
        'name'=>'string',
        'city' => 'string', // If the city field is an ObjectId, this casting will convert it to a string
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];
    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }
    public function setCityIdAttribute($value)
    {
        $this->attributes['city'] = new ObjectId($value);
    }
}
