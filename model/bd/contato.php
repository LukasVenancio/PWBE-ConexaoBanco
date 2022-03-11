<?php
/* Arquivo responsável por manipular os dados do Data Base
        (insert, update, select e delete).*/

        require_once('conexaoMysql.php');

    function insertContato($dadosDeContato){
        
        /*  Abrindo a conexão com o Data Base. */
        $conexao = conectarMysql();

        /*Montagem do script SQL para inserção dos dados.*/
        $sql = "insert into tblcontatos
                    (nome, 
                    telefone, 
                    celular, 
                    email, 
                    observacao)
                values
                    ('".$dadosDeContato['nome']."',
                    '".$dadosDeContato['telefone']."', 
                    '".$dadosDeContato['celular']."', 
                    '".$dadosDeContato['email']."',
                    '".$dadosDeContato['obs']."');";

        /* Executando o script no Data Base (passando como parâmetros, o próprio Data Base e
        o script que será executado) */            
        mysqli_query($conexao, $sql);            
    }    

    function updateContato(){
        
    }

    function selectAllContatos(){
        
    }

    function deleteContato(){
        
    }


?>
