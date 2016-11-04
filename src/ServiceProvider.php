<?php

namespace BrianFaust\Sociable;

use BrianFaust\Sociable\Events\UserHasSocialized;
use BrianFaust\Sociable\Listeners\UserHasSocializedListener;
use Laravel\Socialite\SocialiteServiceProvider;

class ServiceProvider extends \BrianFaust\ServiceProvider\ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();
    }

    public function register()
    {
        parent::register();

        $this->app->register(SocialiteServiceProvider::class);

        $this->app['events']->listen(
            UserHasSocialized::class, UserHasSocializedListener::class
        );
    }

    public function provides()
    {
        return array_merge(parent::provides(), [
            SocialiteServiceProvider::class,
        ]);
    }

    public function getPackageName()
    {
        return 'sociable';
    }
}
