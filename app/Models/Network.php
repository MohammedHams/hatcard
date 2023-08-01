<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\BSON\ObjectId;
use App\Models\City; // Import the City model at the top of the file
use App\Models\Area; // Import the Area model at the top of the file

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
        'status',
        'rejected_Details',
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
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Set the default value for "status" if not already set
        if (!isset($this->attributes['status'])) {
            $this->attributes['status'] = 'pending';
        }
    }

}
