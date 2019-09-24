<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    //
    public $timestamps = true;

    protected $table = 'todolists';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = ['title','Description','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
