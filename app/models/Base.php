<?php

use LaravelBook\Ardent\Ardent;

class Base extends Ardent
{
    public function save(array $rules = array(),
        array $customMessages = array(),
        array $options = array(),
        Closure $beforeSave = null,
        Closure $afterSave = null)
    {
        $data = Input::all();
        $fillable = $this->getFillable();
        foreach ($fillable as $column) {
            if (array_key_exists($column, $data) === true) {
                $this->$column = $data[$column];
            }
        }
        return parent::save();
    }

    public function errorString()
    {
        $details = $this->errors()->getMessages();
        $err_string = 'Cannot be saved because of the following reasons: ';
        foreach ($details as $column => $errors) {
            foreach ($errors as $error) {
                $err_string .= '<br>' . $error;
            }
        }
        return $err_string;
    }
}
