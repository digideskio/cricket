<?php

use LaravelBook\Ardent\Ardent;

class Base extends Ardent
{
    public static function create(array $attributes)
    {
        $model = parent::create($attributes);
        if ($model->id > 0) {
            return $model;
        } else {
            throw new DataFailureException();
        }
    }
}
