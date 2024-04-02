<?php

namespace app\controllers;

class Home
{
    public function index()
    {
        $municipios =  all('municipios');

        return[
            'view' => 'home.php',
            'data' => ['title' => 'Home', 'municipios' => $municipios]
        ];
    }

    public function modal(){
        return[
            'view' => 'modal.php',
            'data' => ['title' => 'Verificacao']
        ];
    }

    public function createStore()
    {
        $validate = validate([
            'cpf' => 'required|unique:usuarios|validaCpf',
            'tipoinscricao' => 'required',
            'nome' => 'required',
            'registro' => 'required|unique:usuarios|formatarDados',
            'telefone' => 'required|formatarDados',
            'bairro' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'numero' => 'required',
            'cep' => 'required|formatarDados',
            'datanascimento' => 'required|calcularIdade',
            'escolapublica' => 'required',
            'trabalhando' => 'required',
            'comprovanteescolapublica' => 'optionalArquivo|uploadArquivo',
            'localtrabalho' => 'optionalString|required',
            'funcao' => 'optionalString|required',
            // 'trabalhourestaurante' => 'required',
            // 'autonomo' => 'required',
            // 'comercio' => 'required',
            'comprovanteescolaridade' => 'uploadArquivo',
            // 'comprovanteexperiencia' => 'uploadArquivo',
            'email' => 'required|email|unique:usuarios',
        ],persistInput:true);


        if (!$validate) {
            return redirect('/#formulario');
        }

        $create = create('usuarios', $validate);

        if ($create) {
            return redirect('/cadastro');
        }
    }
}
