<?php

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
