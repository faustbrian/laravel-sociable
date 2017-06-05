<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Sociable\Events;

use Illuminate\Support\Collection;

class UserHasSocialized
{
    public $provider;

    public $profile;

    public $model;

    public $fields;

    public $additionalFields;

    public function __construct($provider, $profile, $model, $fields, $additionalFields)
    {
        $this->provider = $provider;
        $this->profile = new Collection($profile);
        $this->model = $model;
        $this->fields = new Collection($fields);
        $this->additionalFields = new Collection($additionalFields);
    }
}
