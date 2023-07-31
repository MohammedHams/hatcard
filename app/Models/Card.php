<?php

// app/Models/Card.php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class Card extends Eloquent
{
    protected $connection = 'mongodb'; // Set the MongoDB connection

    protected $collection = 'cards'; // Set the MongoDB collection name

    protected $primaryKey = '_id'; // Set the primary key field

    protected $fillable = [
        '_id',
        'code',
        'password',
        'category',
        'network',
        'isUsed',
    ];

    public $timestamps = true;

    // Specify the name of the "updated_at" field in the database
    const UPDATED_AT = 'updatedAt';
    const CREATED_AT = 'createdAt';

    // Automatically convert the "_id" attribute to MongoDB ObjectId
    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }

    // Automatically convert the "network" attribute to MongoDB ObjectId
    public function setNetworkAttribute($value)
    {
        $this->attributes['network'] = new ObjectId($value);
    }

    // Automatically convert the "category" attribute to MongoDB ObjectId
    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = new ObjectId($value);
    }

    // Define any additional properties, casts, or relationships here
}
