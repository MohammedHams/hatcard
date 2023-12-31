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
    protected $fillable = ['_id', 'cname', 'photo', 'price', 'period','periodType', 'network', 'slug'];

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

    public function setNetworkAttribute($value)
    {
        $this->attributes['network'] = new ObjectId($value);
    }
    public function setPriceAttribute($value)
    {
        // Ensure that the value is converted to a numeric representation
        $this->attributes['price'] = (float) $value;
    }

    public function setPeriodAttribute($value)
    {
        // Ensure that the value is converted to an integer representation
        $this->attributes['period'] = (int) $value;
    }
}
