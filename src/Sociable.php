<?php



declare(strict_types=1);

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
