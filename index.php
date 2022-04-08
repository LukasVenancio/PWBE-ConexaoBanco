<?php

/*Variável criada para diferenciar o action do form. 
É iniciada com o inserir.*/
    $form = "router.php?component=contatos&action=inserir";

    // $id = (String) null;

    /*Valida se a utilização de variável de sessão está ativa no servidor.*/
    if(session_status()){

        /*Valida se a variável de sessão possui conteúdo */
        if(!empty($_SESSION['dadosContato'])){

            $id         = $_SESSION['dadosContato']['id'];
            $nome       = $_SESSION['dadosContato']['nome'];
            $telefone   = $_SESSION['dadosContato']['telefone'];
            $celular    = $_SESSION['dadosContato']['celular'];
            $email      = $_SESSION['dadosContato']['email'];
            $observacao = $_SESSION['dadosContato']['observacao'];

            /*Já que a variável de sessão esta ativa (sabemos através do if), sabemos que a intenção é de editar
            o registro, então o action passa a receber o 'editar'. */
            $form = "router.php?component=contatos&action=editar&id=". $id;

            /*Destrói a variável de sessão da memória do servidor. */
            unset($_SESSION['dadosContato']);
        }
    }
    
?>
<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
       
        <div id="cadastro">
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
                
            </div>
            <div id="cadastroInformacoes">
                <form  action="<?=$form?>" name="frmCadastro" method="post" >
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <!-- if ternário para evitar o erro de variável indefinida. -->
                            <input type="text" name="txtNome" value="<?=isset($nome)?$nome:null?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                                     
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=isset($telefone)?$telefone:null?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=isset($celular)?$celular:null?>">
                        </div>
                    </div>
                   
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=isset($email)?$email:null?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=isset($observacao)?$observacao:null?></textarea>
                        </div>
                    </div>
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
               <?php
               
                    require_once('controller/controllerContatos.php');

                    /*Função que retorna os dados do DB. */
                    $listaDeContatos = listarContatos();

                    /*Retira os dados do array e os joga dentro das <td>. */
                    foreach($listaDeContatos as $contato){

               ?>
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$contato['nome']?></td>
                    <td class="tblColunas registros"><?=$contato['celular']?></td>
                    <td class="tblColunas registros"><?=$contato['email']?></td>
                   
                    <td class="tblColunas registros">
                            
                            <a href="router.php?component=contatos&action=buscar&id=<?=$contato['id']?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>


                            <a onclick ="return confirm('Deseja realmente excluir o registro?')" href="router.php?component=contatos&action=deletar&id=<?=$contato['id']?>">
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir" >
                            </a>

                            <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                    </td>
                </tr>

                <?php
                    }

                ?>        

            </table>
        </div>
    </body>
</html>