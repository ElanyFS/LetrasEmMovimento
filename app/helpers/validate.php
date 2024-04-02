<?php

function validate(array $validations, $persistInput = false)
{
    $result = [];
    $param = '';
    foreach ($validations as $field => $validate) {
        if (!str_contains($validate, '|')) {
            if (str_contains($validate, ':')) {
                [$validate, $param] = explode(':', $validate);
            }
            //Recebe falso ou o valor informado 
            $result[$field] = $validate($field, $param);
        } else {
            $result[$field] = multipleValidations($validate, $field, $param);
            // return $result[$field];
        }
    }

    if (in_array(false, $result, true)) {
        setFlash('message', '');
        if ($persistInput) {
            setOld();
        }
        return false;
    }

    return $result;
}

function multipleValidations($validate, $field, $param)
{
    $explodePipeValidate = explode('|', $validate);

    $result = [];
    foreach ($explodePipeValidate as $validate) {
        if (str_contains($validate, ':')) {
            [$validate, $param] = explode(':', $validate);
        }

        $result[$field] = $validate($field, $param);

        if ($result[$field] === false || $result[$field] === null) {
            break;
        }
    }

    return $result[$field];
}
