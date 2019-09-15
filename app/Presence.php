<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session_id', 'user_id'
    ];

    protected $table = 'presence';

    public function presenceToUser(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function orderproductsToOrders(){
        return $this->belongsTo('App\Session', 'session_id');
    }

}
