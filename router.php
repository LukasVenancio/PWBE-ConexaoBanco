<?php
/*  Arquivo para segmentar as ações encaminhadas
pela view. Será responsável por encaminhas as solicitações
para a controller. */

    $action = (string) null;
    $component = (string) null;

    /*Verificação da requisição do formulário.*/
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $component = strtolower($_GET['component']);
        $action = $_GET['action'];

        if($component == 'contatos'){
            echo('kbalbi');
        }
    }


?>