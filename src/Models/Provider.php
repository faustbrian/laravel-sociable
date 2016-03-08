<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Sociable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class Provider extends Model
{
    /**
     * @var string
     */
    public $table = 'sociables';

    /**
     * @var array
     */
    protected $fillable = [
        'provider', 'token', 'uid', 'nickname', 'name', 'email', 'avatar', 'user',
    ];

    /**
     * @var array
     */
    protected $casts = ['user' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
