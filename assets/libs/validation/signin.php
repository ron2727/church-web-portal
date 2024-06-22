<?php

function validate($data): array{
    $errors = array();
    
    foreach ($data as $field => $value) {
        if($field === 'email'){
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $errors[$field] = 'Your email is invalid';
            }
        }
        if(empty($value)){
            $errors[$field] = 'Please enter your '.$field.'';
        }
    }
    return $errors;
}

?>