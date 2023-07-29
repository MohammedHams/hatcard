<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class CategoryCard extends Eloquent
{
    // Define the collection name in MongoDB
    protected $collection = 'categorycards';

    // Define the primary key field name
    protected $primaryKey = '_id';

    // Define the fillable fields (fields that can be mass-assigned)
    protected $fillable = ['cname', 'photo', 'price', 'period', 'network', 'createdAt', 'updatedAt', 'slug'];

    // Disable timestamps for this model if not needed
    public $timestamps = false;
}

