<?php

function setFlash($index, $message)
{
    if (!isset($_SESSION['flash'][$index])) {
        $_SESSION['flash'][$index] = $message;
    }
}

function getFlash($index, $style = "color:red")
{
    if (isset($_SESSION['flash'][$index])) {
        $flash = $_SESSION['flash'][$index];
        unset($_SESSION['flash'][$index]);
        return "<span style = '$style'>$flash</span>";
    }
}

function getMessage($index, $style = "color:#fff")
{
    if (isset($_SESSION['flash'][$index])) {
        $flash = $_SESSION['flash'][$index];
        unset($_SESSION['flash'][$index]);
        return "
        <div class='alert alert-danger text-white' role='alert'>
            Erros detectados ao processar formulário. Preencha todos os campos!
        </div>
        ";
    }
}
