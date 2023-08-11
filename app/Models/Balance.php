<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectId;
class Balance extends Eloquent
{
    protected $collection = 'balances'; // Collection name in MongoDB

    protected $primaryKey = '_id'; // Set the primary key field

    protected $fillable = [
        '_id',
        'operationNumber',
        'receiver',
        'balance',
        'operationType',
        'sender',
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
    public function setReceiverAttribute($value)
    {
        $this->attributes['receiver'] = new ObjectId($value);
    }
    public function setSenderAttribute($value)
    {
        $this->attributes['sender'] = new ObjectId($value);
    }

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender','_id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver','_id');
    }

}
