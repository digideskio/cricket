<?php

use LaravelBook\Ardent\Ardent;

class Base extends Ardent
{
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
