<?php

//Campo obrigatorio
function required($field)
{

    if ($_POST[$field] == '') {
        setFlash($field, 'Campo obrigatório');
        return false;
    }

    $value = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);

    $valueFormat = trim(strip_tags($value));

    return $valueFormat;
}

//Verificao de e-mail valido e campos iguais
function email($field)
{
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    $emailConfirm = filter_input(INPUT_POST, 'emailconfirm', FILTER_VALIDATE_EMAIL);

    if (!$emailIsValid) {
        setFlash($field, 'E-mail inválido.');
        return false;
    }

    if ($emailConfirm === '' || $emailIsValid !== $emailConfirm) {
        setFlash('emailconfirm', 'Digite o mesmo e-mail.');
        return false;
    }

    return trim(strip_tags($emailIsValid));
}

//Verifica dados cadastrados
function unique($field, $param)
{
    $value = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);

    $valueFormat = trim(strip_tags(str_replace("-", "", str_replace(".", "", $value))));

    $user = findBy($param, $field, $valueFormat);

    if ($user) {
        setFlash($field, "{$field} já cadastrado");
        return false;
    }

    return trim(strip_tags($valueFormat));
}


function validaCpf($field)
{
    $cpf = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);

    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    //Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        setFlash($field, "Informe os dígitos necessários do Cpf");
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        setFlash($field, "Sequência!");
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            setFlash($field, "CPF inválido!!");
            return false;
        }
    }

    return substr($cpf, 0, 11);
}

function formatarDados($field)
{
    $value = filter_input(INPUT_POST, $field);

    $valueFormat = trim(strip_tags(str_replace("-", "", str_replace(".", "", str_replace(")", "", str_replace("(", "", $value))))));

    return $valueFormat;
}

//ARQUIVO

function getExtension($name)
{
    return pathinfo($name, PATHINFO_EXTENSION);
}


function uploadArquivo($field)
{

    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $valueFormat = trim(strip_tags(str_replace("-", "", str_replace(".", "", $cpf))));

    if (!isset($_FILES[$field], $_FILES[$field]['name']) || $_FILES[$field]['name'] === '') {
        setFlash($field, "Campo obrigátorio");
        return false;
    }

    $arquivo = $_FILES[$field];

    $nomeArquivo = $arquivo['name'];

    $extension = getExtension($nomeArquivo);

    if (!in_array($extension, ['png', 'jpg', 'pdf'])) {
        setFlash($field, "Tipo de arquivo inválido.");
        return false;
    }

    $pasta = '../public/assets/arquivos/';

    $novoNomeArquivo = $valueFormat . "_" . $field;

    $path = $pasta . $novoNomeArquivo . '.' . $extension;

    $upload = move_uploaded_file($arquivo['tmp_name'], $path);

    if (!$upload) {
        setFlash($field, "Erro ao cadastrar. Por favor tente novamente.");
        return false;
    } else {
        return $path;
    }
}

function optionalArquivo($field)
{
    $escola = filter_input(INPUT_POST, 'escolapublica');

    $value = $_FILES[$field];

    if ($escola === 'sim') {
        return $value;
    } else {
        return null;
    }
}

function optionalString($field)
{
    $trabalhando = filter_input(INPUT_POST, 'trabalhando');

    $value = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);

    if ($trabalhando === 'sim') {
        return $value;
    } else {
        if (strlen($value) === '') {
            return null;
        }
    }
}

// function calcularIdade($field)
// {

//     $idade = 0;
//     $data = filter_input(INPUT_POST, $field);
//     //converte para o formato data
//     $data_nascimento = date('Y-m-d', strtotime($data));
//     //separa a string transformando em array
//     $data = explode("-", $data_nascimento);
//     $anoNasc    = $data[0];
//     $mesNasc    = $data[1];
//     $diaNasc    = $data[2];

//     $anoAtual   = date("Y");
//     $mesAtual   = date("m");
//     $diaAtual   = date("d");

//     $idade      = $anoAtual - $anoNasc;
//     if ($mesAtual < $mesNasc) {
//         $idade -= 1;
//     } elseif (($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc)) {
//         $idade -= 1;
//     }


//     if ($idade < 18) {
//         setFlash($field, "Cadastro apenas para maiores de 18 anos");
//         return false;
//     }

//     return $data_nascimento;
// }


function calcularIdade($field)
{
    $idade = 0;

    $data = filter_input(INPUT_POST, $field);

    $data_nascimento = date('Y-m-d', strtotime($data));

    list($anoNasc, $mesNasc, $diaNasc) = explode('-', $data_nascimento);

    $idade      = date("Y") - $anoNasc;
    if (date("m") < $mesNasc) {
        $idade -= 1;
    } elseif ((date("m") == $mesNasc) && (date("d") <= $diaNasc)) {
        $idade -= 1;
    }

    if ($idade < 18) {
        setFlash($field, "Cadastro apenas para maiores de 18 anos");
        return false;
    }

    return $data_nascimento;
}
