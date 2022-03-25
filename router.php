<?php
/*  Arquivo para segmentar as ações encaminhadas
pela view. Será responsável por encaminhas as solicitações
para a controller. */

require_once('./controller/controllerContatos.php');

    $action = (string) null;
    $component = (string) null;

    /*Verificação da requisição do formulário.*/
    if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){

        $component = strtolower($_GET['component']);
        $action = strtolower($_GET['action']);

        /*Verificação da página que fez a requisição.*/
        if($component == 'contatos'){
            
            /*Verificaçãao da ação requirida pela página.*/
            if($action == 'inserir'){

                /*Função de inserir da controller. */
                $resposta = inserirContato($_POST);

                /*Valida se o retorno da controller foi um booleano.*/
                if(is_bool($resposta)){
                    
                    /*Verifica se o retorno foi verdadeiro. */
                    if($resposta){
                        echo("<script>
                            alert('Registro inserido com sucesso!')
                            window.location.href = 'index.php'
                        </script>");
                    }
                  
                  /*Verifica se o retorno foi um array, porque esse retorno
                  (segundo a construção da nossa controller) significa que algo deu errado. */  
                }elseif(is_array($resposta)){
                    echo("<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>");
                }
            
            }elseif($action == 'deletar'){
                
                /*Recebe o id passado pelo href através do botão excluir. */
                $id = $_GET['id'];
                
                $resposta = excluirContato($id);

                if(is_bool($resposta)){

                    if($resposta){
                        
                        echo("<script>
                                alert('Registro inserido com sucesso!')
                                window.location.href = 'index.php'
                            </script>");
                    }
                    
                }elseif(is_array($resposta)){
                    echo("<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>");
                }
            }
            
        }
    }

?>