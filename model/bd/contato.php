<?php
/* Arquivo responsável por manipular os dados do Data Base
        (insert, update, select e delete).*/

        require_once('conexaoMysql.php');

    function insertContato($dadosDeContato){
        
        /*Declaração da variável de resposta, iniciada como false, para poder eliminar os elses de return false. */
        $resposta = (boolean) false;

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
        o script que será executado) e verificando se o script está correto através do if.*/            
        if(mysqli_query($conexao, $sql)){
            
            /*Verificação de uma atualização no banco de dados (se uma linha foi acrescentada),
            ou seja, se o Data Base aceitou a inserção. */
            if(mysqli_affected_rows($conexao)){
                $resposta = true;
            
            }
        }

        fecharConexaoMysql($conexao);

        return $resposta;
    }    

    function updateContato(){
        
    }

    function selectAllContatos(){
        
        $conexao = conectarMysql();
        $sql = "select * from tblcontatos order by idcontato desc;";

        /*Quando o mysqli_query é executado, com um script de select, o seu retorno passa a ser 
        de informações que retornarão do Data Base.*/
        $result = mysqli_query($conexao, $sql);

        /*Verificando se houve retorno do Data Base.*/
        if($result){

            $contador = 0;

            /* O método mysqli_fetch_assoc() converte o retorno do Data Base em um Array. E mantém
            a repetição do while enquanto ainda houver dados.*/
            while($resultArray = mysqli_fetch_assoc($result)){

                /*Seapara os dados desnecessários que retornam do Data Base.*/
                $dados [$contador] = array(
                    "id"         => $resultArray['idcontato'],
                    "nome"       => $resultArray['nome'],
                    "telefone"   => $resultArray['telefone'],
                    "celular"    => $resultArray['celular'],
                    "email"      => $resultArray['email'],
                    "observacao" => $resultArray['observacao']
                );

                $contador++;
            }

            fecharConexaoMysql($conexao);

            return $dados;
        }

    }

    function selectByIdContato($id){

        $conexao = conectarMysql();
        $sql = "select * from tblcontatos where idcontato = ". $id .";";

        /*Quando o mysqli_query é executado, com um script de select, o seu retorno passa a ser 
        de informações que retornarão do Data Base.*/
        $result = mysqli_query($conexao, $sql);

        /*Verificando se houve retorno do Data Base.*/
        if($result){

            /* O método mysqli_fetch_assoc() converte o retorno do Data Base em um Array.*/
            if($resultArray = mysqli_fetch_assoc($result)){

                /*Seapara os dados desnecessários que retornam do Data Base.*/
                $dados = array(
                    "id"         => $resultArray['idcontato'],
                    "nome"       => $resultArray['nome'],
                    "telefone"   => $resultArray['telefone'],
                    "celular"    => $resultArray['celular'],
                    "email"      => $resultArray['email'],
                    "observacao" => $resultArray['observacao']
                );
            }
        }    

            fecharConexaoMysql($conexao);

            return $dados;
    }

    function deleteContato($id){
        
        $conexao = conectarMysql();
        $sql = "delete from tblcontatos where idcontato = ". $id .";";

        $resposta = (boolean) false;

        /* Executando o script no Data Base (passando como parâmetros, o próprio Data Base e
        o script que será executado) e verificando se o script está correto através do if.*/ 
        if(mysqli_query($conexao, $sql)){

            /*Verificação de uma atualização no banco de dados (se uma linha foi acrescentada),
            ou seja, se o Data Base aceitou a inserção. */
            if(mysqli_affected_rows($conexao)){
                $resposta = true;
            }
        }

       fecharConexaoMysql($conexao);

        return $resposta;
    }


?>
