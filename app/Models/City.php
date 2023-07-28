<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class City extends Eloquent
{
    // The MongoDB collection name
    protected $collection = 'cities';

    // Define the fields that need to be casted
    protected $casts = [
        '_id' => 'string',
        'name'=>'string',// If your _id field is an ObjectId, this casting will convert it to a string
        // Add other fields that need casting here if necessary
    ];
    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }


    // Define the fillable fields if necessary
    // protected $fillable = ['name', 'population', 'country', ...];

    // If the primary key is not '_id', you can define it like this:
    // protected $primaryKey = 'custom_id';
}
