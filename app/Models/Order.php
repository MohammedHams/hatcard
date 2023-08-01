<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;

class Order extends Eloquent
{

    protected $collection = 'orders';

    protected $primaryKey = '_id';

    protected $fillable = [
        'order_number',
        'user',
        'cards',
        'refund',
        'isPaid',
        'canceled',
        'isDelivered',
        'network',
        'category',
        'totalPrice',
        'createdAt',
        'updatedAt',
    ];


    public function set_idAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }


    public function setUserAttribute($value)
    {
        $this->attributes['user'] = new ObjectId($value);
    }
    public function setNetworkAttribute($value)
    {
        $this->attributes['network'] = new ObjectId($value);
    }
    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = new ObjectId($value);
    }
    public function setTotalPriceAttribute($value)
    {
        $this->attributes['totalPrice'] = (int) $value;
    }


}
