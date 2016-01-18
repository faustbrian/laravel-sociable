<?php

namespace DraperStudio\Sociable;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;
use DraperStudio\Sociable\Events\UserHasSocialized;
use DraperStudio\Sociable\Listeners\UserHasSocializedListener;
use Laravel\Socialite\SocialiteServiceProvider;

class ServiceProvider extends BaseProvider
{
    public function boot()
    {
        $this->setup(__DIR__)
             ->publishMigrations();
    }

    public function register()
    {
        $this->app->register(SocialiteServiceProvider::class);

        $this->app['events']->listen(
            UserHasSocialized::class, UserHasSocializedListener::class
        );
    }
}
