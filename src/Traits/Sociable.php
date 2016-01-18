<?php

namespace DraperStudio\Sociable\Traits;

use DraperStudio\Sociable\Models\Provider;

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
