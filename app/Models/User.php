<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\BSON\ObjectId;

class User extends Eloquent implements Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $primaryKey = '_id';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mongodb'; // Set the MongoDB connection for the model

    /**
     * The name of the collection associated with the model.
     *
     * @var string
     */
    protected $collection = 'users'; // Set the MongoDB collection name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        '_id',
        'name',
        'email',
        'password',
        'phone',
        'balance',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Add the following methods for authentication

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->primaryKey};
    }

    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }
    public function setIdAttribute($value)
    {
        $this->attributes['_id'] = new ObjectId($value);
    }
    public function isAgent()
    {
        return $this->role === 'agent';
    }

    public function isDistributor()
    {
        return $this->role === 'distributor';
    }

}
