<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Sociable\Traits;

use DraperStudio\Sociable\Models\Provider;

/**
 * Class Sociable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
trait Sociable
{
    /**
     * @return mixed
     */
    public function sociables()
    {
        return $this->morphMany(Provider::class, 'model');
    }

    /**
     * @param $provider
     *
     * @return mixed
     */
    public function getSociable($provider)
    {
        return $this->sociables()->whereProvider($provider)->firstOrFail();
    }
}
