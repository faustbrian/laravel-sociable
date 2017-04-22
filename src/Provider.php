<?php



declare(strict_types=1);

namespace BrianFaust\Sociable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Provider extends Model
{
    public $table = 'sociables';

    protected $fillable = [
        'provider', 'token', 'uid', 'nickname', 'name', 'email', 'avatar', 'user',
    ];

    protected $casts = ['user' => 'array'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
