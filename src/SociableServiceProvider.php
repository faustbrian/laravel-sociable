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

use BrianFaust\ServiceProvider\ServiceProvider;
use BrianFaust\Sociable\Events\UserHasSocialized;
use BrianFaust\Sociable\Listeners\UserHasSocializedListener;
use Laravel\Socialite\SocialiteServiceProvider;

class SociableServiceProvider extends ServiceProvider
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
            UserHasSocialized::class,
            UserHasSocializedListener::class
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
