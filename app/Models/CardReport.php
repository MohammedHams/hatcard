<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Network;
use MongoDB\BSON\ObjectId;

class CardReport extends Eloquent
{
    protected $collection = 'reports';
    protected $fillable = [
        '_id',
        'invoice_number',
        'network',
        'category',
        'quantity',
        'status',
        'user',
    ];
    public $timestamps = true;

    // Specify the name of the "updated_at" field in the database
    const UPDATED_AT = 'updatedAt';
    const CREATED_AT = 'createdAt';

    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }

    // Correct mutator method for the "network" attribute
    public function setNetworkAttribute($value)
    {
        $this->attributes['network'] = new ObjectId($value);
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = new ObjectId($value);
    }
    public function setUserAttribute($value)
    {
        $this->attributes['user'] = new ObjectId($value);
    }

    public function getNetworkIdAttribute($value)
    {
        return $this->attributes['network'];
    }
    // Correct mutator method for the "invoice_number" attribute
    public function setInvoiceNumberAttribute($value)
    {
        $this->attributes['invoice_number'] = (int) $value;
    }
    public function categoryCard()
    {
        return $this->belongsTo(CategoryCard::class, 'category', '_id');
    }
    public function Network()
    {
        return $this->belongsTo(Network::class, 'network_id', '_id');
    }


}
