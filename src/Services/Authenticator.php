<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Sociable\Services;

use DraperStudio\Sociable\Events\UserHasSocialized;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Contracts\Factory as Socialite;

/**
 * Class Authenticator.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class Authenticator
{
    /**
     * @var
     */
    private $users;

    /**
     * @var Socialite
     */
    private $socialite;

    /**
     * @var
     */
    public $event = UserHasSocialized::class;

    /**
     * @var
     */
    public $provider;

    /**
     * @var
     */
    public $model;

    /**
     * @var
     */
    public $fields;

    /**
     * @var
     */
    public $additionalFields;

    /**
     * Authenticator constructor.
     *
     * @param Socialite $socialite
     */
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    /**
     * @param $hasCode
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function execute($hasCode)
    {
        if (!$hasCode) {
            return $this->getAuthorizationFirst();
        }

        $event = new $this->event(
            $this->provider, $this->getUser(),
            $this->model, $this->fields, $this->additionalFields
        );

        return Event::fire($event);
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function provider($value)
    {
        $this->provider = $value;

        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function model($value)
    {
        $this->model = $value;

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @param bool $additional
     *
     * @return $this
     */
    public function mapField($key, $value, $additional = false)
    {
        if ($additional) {
            $this->additionalFields[$key] = $value;
        } else {
            $this->fields[$key] = $value;
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function event($value)
    {
        $this->event = $value;

        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getAuthorizationFirst()
    {
        return $this->socialite->driver($this->provider)->redirect();
    }

    /**
     * @return \Laravel\Socialite\Contracts\User
     */
    private function getUser()
    {
        return $this->socialite->driver($this->provider)->user();
    }
}
