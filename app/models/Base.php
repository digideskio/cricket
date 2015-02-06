<?php

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public static function all($colums = array('*'))
    {
        $data = parent::all($colums);
        if ($data->count() === 0) {
            throw new NoDataException();
        }
    }

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
