<?php
/*  Arquivo para segmentar as ações encaminhadas
pela view. Será responsável por encaminhas as solicitações
para a controller. */


require_once('./controller/controllerContatos.php');

    $action = (string) null;
    $component = (string) null;

    /*Verificação da requisição do formulário.*/
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $component = strtolower($_GET['component']);
        $action = strtolower($_GET['action']);

        /*Verificação da página que fez a requisição.*/
        if($component == 'contatos'){
            
            /*Verificaçãao da ação requirida pela página.*/
            if($action == 'inserir'){
                inserirContato($_POST);
            }
            
        }
    }

?>