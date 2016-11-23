<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Sociable\Services;

use BrianFaust\Sociable\Events\UserHasSocialized;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Interfaces\Factory as Socialite;

class Authenticator
{
    private $users;

    private $socialite;

    public $event = UserHasSocialized::class;

    public $provider;

    public $model;

    public $fields;

    public $additionalFields;

    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    public function execute($hasCode)
    {
        if (! $hasCode) {
            return $this->getAuthorizationFirst();
        }

        $event = new $this->event(
            $this->provider, $this->getUser(),
            $this->model, $this->fields, $this->additionalFields
        );

        return Event::fire($event);
    }

    public function provider($value)
    {
        $this->provider = $value;

        return $this;
    }

    public function model($value)
    {
        $this->model = $value;

        return $this;
    }

    public function mapField($key, $value, $additional = false)
    {
        if ($additional) {
            $this->additionalFields[$key] = $value;
        } else {
            $this->fields[$key] = $value;
        }

        return $this;
    }

    public function event($value)
    {
        $this->event = $value;

        return $this;
    }

    private function getAuthorizationFirst()
    {
        return $this->socialite->driver($this->provider)->redirect();
    }

    private function getUser()
    {
        return $this->socialite->driver($this->provider)->user();
    }
}
