<?php

namespace BrianFaust\Sociable\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public $table = 'sociables';

    protected $fillable = [
        'provider', 'token', 'uid', 'nickname', 'name', 'email', 'avatar', 'user',
    ];

    protected $casts = ['user' => 'array'];

    public function model()
    {
        return $this->morphTo();
    }
}
