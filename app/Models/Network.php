<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Eloquent
{
    protected $collection = 'networks'; // Set the name of the MongoDB collection.

    protected $fillable = [
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

}
