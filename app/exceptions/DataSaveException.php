<?php

class DataSaveException extends Exception {

    public function __construct(array $errors = array())
    {
        $message = 'Could not save for the following reasons: ';
        foreach ($errors as $error) {
            $message .= "<br />" . $error;
        }
        parent::__construct($message);
    }
}
