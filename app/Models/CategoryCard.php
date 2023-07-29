<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class CategoryCard extends Eloquent
{
    // Define the collection name in MongoDB
    protected $collection = 'categorycards';

    // Define the primary key field name
    protected $primaryKey = '_id';

    // Define the fillable fields (fields that can be mass-assigned)
    protected $fillable = ['_id', 'cname', 'photo', 'price', 'period', 'network', 'createdAt', 'slug'];

    // Enable timestamps for this model
    public $timestamps = true;

    // Specify the name of the "updated_at" field in the database
    const UPDATED_AT = 'updatedAt';
    const CREATED_AT  = 'createdAt';
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

    // Override the getDates method to customize timestamp fields


    // Override the default format for timestamps

}
