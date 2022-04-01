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
                
                /*Chama a função de excluir da Controller. */
                $resposta = excluirContato($id);

                if(is_bool($resposta)){

                    if($resposta){
                        
                        echo("<script>
                                alert('Registro excluído com sucesso!')
                                window.location.href = 'index.php'
                            </script>");
                    }
                    
                }elseif(is_array($resposta)){
                    echo("<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>");
                }
            
            }elseif($action == 'buscar'){

                /*Recebe o id passado pelo href através do botão editar. */
                $id = $_GET['id'];

                /*Chama a função de editar da Controller. */
                $dados = buscarContato($id);

                /*Precisamos passar os dados que retornaram do db para a index, porém o arquivo router não
                possui retorno, então precisamos criar variáveis de sessão para transportar as
                variáveis entre os arquivos. Essa variável somente será destruída quando o navegador for
                fechado se não a destruirmos manualmente. */

                /*Ativa a utilização de variáveis de sessão no servidor.*/
                session_start();

                /*Cria uma variável de sessão com o nome de 'dadosContato' e essa recebe o 
                array que retornou do banco de dados. Essa variável de sessão será utilizada na index para
                preencher as inputs com os dados já registrados. */
                $_SESSION['dadosContato'] = $dados;

                /*Fazendo o require da index, para que a tela não pisque novamente.*/
                require_once('index.php');
                
                /*Caso quisermos diretamente mudar de página, devemos usar o comando header('location: index.php'), porém 
                isso causará uma ação de carregamento no navegador, o que fará que a tela pisque.*/

            }
            
        }
    }

?>