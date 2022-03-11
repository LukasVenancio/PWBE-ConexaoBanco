<?php
/*  Responsável pela manipulação de dados de contatos.
Todos os tramatamentos e validações precisam ser feitos no arquivo controller.*/

    require_once('./model/bd/contato.php');

    function inserirContato($dadosDoContato){

        /*Validação para verificar se o objeto não está vazio.*/
        if(!empty($dadosDoContato)){

            /*Validação dos campos obrigatórios do Data Base. */
            if(!empty($dadosDoContato['txtNome']) && !empty($dadosDoContato['txtCelular']) && !empty($dadosDoContato['txtEmail']) ){
                
                /*  Criação do array que será passado para o arquivo model,
                conforme os atributos do Data Base.*/
                $arrayDados = array(
                    "nome"     => $dadosDoContato['txtNome'],
                    "telefone" => $dadosDoContato['txtTelefone'],
                    "celular"  => $dadosDoContato['txtCelular'],
                    "email"    => $dadosDoContato['txtEmail'],
                    "obs"      => $dadosDoContato['txtObs']
                );

                insertContato($arrayDados);

            }else{
                echo('Tô bem não man');
            }
        }

    }

    function atualizarContato(){

    }

    function excluirContato(){

    }

    function listarContatos(){
        
    }





?>