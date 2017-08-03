<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Sociable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Sociable\Models;

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
