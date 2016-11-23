<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Sociable;

trait Sociable
{
    public function sociables()
    {
        return $this->morphMany(Provider::class, 'model');
    }

    public function getSociable($provider)
    {
        return $this->sociables()->whereProvider($provider)->firstOrFail();
    }
}
