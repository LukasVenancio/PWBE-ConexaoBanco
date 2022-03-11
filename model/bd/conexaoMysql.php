<?php
/*  Arquivo para criar a conexão com o bando de dados.*/

const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbcontatos';

 function conectarMysql(){
    $conexao = array();

    // Retorna um array de dados sobre a conexão, caso a mesma dê certo
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if($conexao){
        return $conexao;
   
    }else{
        return false;
    }
 }
 /*
    Existem três formas de realizar a conexão com o DB MySQL no PHP:

        mysql_connect() - versão antiga do PHP de fazer a conexão com o DB (não oferece performace e segurança)

        mysqli_connect() - versão mais atualizada no PHP de fazer a conexão com o DB (pode ser utilizada para Programação Estruturada e POO)

        PDO() - versão mais completa e eficiente para conexão com DB (é indicada pela segurança e para POO)
  */
?>