<?php

/*
 * This file is part of Laravel Sociable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Sociable\Events;

use Illuminate\Support\Collection;

/**
 * Class UserHasSocialized.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class UserHasSocialized
{
    /**
     * @var
     */
    public $provider;

    /**
     * @var Collection
     */
    public $profile;

    /**
     * @var
     */
    public $model;

    /**
     * @var Collection
     */
    public $fields;

    /**
     * @var Collection
     */
    public $additionalFields;

    /**
     * UserHasSocialized constructor.
     *
     * @param $provider
     * @param $profile
     * @param $model
     * @param $fields
     * @param $additionalFields
     */
    public function __construct($provider, $profile, $model, $fields, $additionalFields)
    {
        $this->provider = $provider;
        $this->profile = new Collection($profile);
        $this->model = $model;
        $this->fields = new Collection($fields);
        $this->additionalFields = new Collection($additionalFields);
    }
}
