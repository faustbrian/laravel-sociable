<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Sociable\Listeners;

use DraperStudio\Sociable\Events\UserHasSocialized;
use DraperStudio\Sociable\Models\Provider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Class UserHasSocializedListener.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class UserHasSocializedListener
{
    /**
     * @param UserHasSocialized $event
     *
     * @return Collection
     */
    public function handle(UserHasSocialized $event)
    {
        $profile = $event->profile;

        // build data for the "$event->model" model
        $modelFields = $event->fields->map(function ($item) use ($profile) {
            return $profile[$item];
        })->merge($event->additionalFields)->toArray();

        // create or update an eloquent model
        $model = $event->model;

        if ($model instanceof Model) {
            $model->update($modelFields);
        } else {
            $model = $model::firstOrCreate($modelFields);
        }

        // check if the given model is already authenticated with the provider,
        // if not we will save the received profile data
        try {
            $provider = $model->sociables()
                              ->where('provider', '=', $event->provider)
                              ->where('uid', '=', $profile->get('id'))
                              ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $provider = new Provider(
                $profile->merge([
                    'uid' => $profile->get('id'),
                    'provider' => $event->provider,
                ])->toArray()
            );

            $model->sociables()->save($provider);
        }

        return new Collection(compact('model', 'provider'));
    }
}
