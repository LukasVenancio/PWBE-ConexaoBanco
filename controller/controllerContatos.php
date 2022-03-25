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

                /*Função da model que de fato faz a inserção no Data Base. */
                if(insertContato($arrayDados)){
                    return true;
                
                }else{
                    return array('idErro' => 1,
                                'message' => 'Não foi possível inserir os dados no Data Base.');
                }

            }else{
                return array('idErro' => 2,
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.');
            }
        }

    }

    function atualizarContato(){

    }

    function excluirContato($id){

        /*Validação do id que foi informado. */
        if($id != 0 && !empty($id) && is_numeric($id)){
            
            /*Verifica se foi possível deletar o contato. */
            if(deleteContato($id)){
                return true;
            
            }else{  
                return array('idErro'   => 3,
                             'message'  => 'O Data Base não pode excluir o registro.');
            }
        
        }else{
            return array('idErro'   => 4,
                         'message'  => 'ID inválido.');
        }
    }

    function listarContatos(){

        /*Recuparando os dados do Data Base através da função da model. */
        $dados = selectAllContatos();

        if(!empty($dados)){
            return $dados;

        }else{
            return false;
        }
    }





?>