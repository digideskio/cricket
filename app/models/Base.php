<?php

use LaravelBook\Ardent\Ardent;

class Base extends Ardent
{
    public static function all($colums = array('*'))
    {
        $data = parent::all($colums);
        if ($data->count() === 0) {
            throw new NoDataException();
        }
        return $data;
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

    public static function findOrFail($id, $columns = array('*'))
    {
        try {
            return parent::findOrFail($id, $columns);
        } catch (ModelNotFoundException $e){
            throw new NoDataException();
        }
    }

    public function whereNotIn($something, $somethingelse)
    {
        $data = parent::whereNotIn($something, $somethingelse);
        if ($data->count() === 0) {
            throw new NoDataException();
        }
        return $data;
    }
}
