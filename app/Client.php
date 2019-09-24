<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = true;

    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    public $incrementing = true;

    protected $fillable = ['name','phone', 'address', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
