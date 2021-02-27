<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    protected $guarded = [];

    use SoftDeletes;

    protected $hidden = ['user', 'updated_at'];

    protected $append = ['creator'];

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getCreatorAttribute()
    {
        return $this->user->username;
    }
}
