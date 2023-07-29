<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\BSON\ObjectId;

class Network extends Eloquent
{
    protected $collection = 'networks'; // Set the name of the MongoDB collection.

    protected $fillable = [
        '_id',
        'name',
        'owner',
        'phone',
        'cover',
        'url',
        'city',
        'area',
        'socialMediaLinks',
        'notes',
        'createdAt',
        'updatedAt',
        'slug',
        'owner_id',
    ];
    public $timestamps = true;

    // Specify the name of the "updated_at" field in the database
    const UPDATED_AT = 'updatedAt';
    const CREATED_AT  = 'createdAt';

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = new ObjectId($value);
    }

    public function setAreaAttribute($value)
    {
        $this->attributes['area'] = new ObjectId($value);
    }
    public function setOwnerIdAttribute($value)
    {
        $this->attributes['owner_id'] = new ObjectId($value);
    }
    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }

}
