<?php 
    session_start();
    $login = $_SESSION['login'];
    include('functions/conMysql.php');
    include('functions/getUser.php');
    if($id_funcao_user == 2){
        header('location:cms.php?id_func='.$id_funcao_user);
    }

    //Mostar Registros
?>
<html>
    <head>
        <title> Title </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href = "css/styleAdmFale.css"> 
    </head>
    
    <body>
        <div id="content">
            <header>
                <div id="cms">
                    <span style="font-size:35px;">CMS</span> - Sistema de gerenciamento do Site
                </div>
                <div id="logo">
                    <img id="img_logo" src="img/logo.png" alt="">
                </div>
            </header>
            
            <nav>
                <div class="opt">
                    <a href="admConteudo.php">
                        <div class="img_opt">
                            <img class="icn" src="img/icn/content.png" alt="">
                        </div>
                        <div class="nome_opt">
                            Adm. Conteúdo
                        </div>
                    </a>
                </div>
                
                <div class="opt">
                    <a href="admFale.php">
                        <div class="img_opt">
                            <img class="icn" src="img/icn/dialogue.png" alt="">
                        </div>
                        <div class="nome_opt">
                            Adm. Fale Conosco
                        </div>
                    </a>
                </div>
                
                <div class="opt">
                    <a href="admCorridas.php">
                        <div class="img_opt">
                            <img class="icn" src="img/icn/shirt.png" alt="">
                        </div>
                        <div class="nome_opt">
                            Adm. Produtos
                        </div>
                    </a>
                </div>
                
                <div class="opt">
                    <a href="admUsers.php">
                        <div class="img_opt">
                            <img class="icn" src="img/icn/users.png" alt="">
                        </div>
                        
                        <div class="nome_opt">
                            Adm. Usuários
                        </div>
                    </a>
                </div>
                
                <div id ="usuario">
                    <div id="mensagem">
                        Bem vindo, <?php echo($nome);?>.
                    </div>
                    <div id="logout">
                        <a href="functions/session_end.php">Logout</a>
                    </div>
                </div>
            </nav>
            
            <section>
                <div id="principal">
                    
                    <div id="linha_ref">
                        <div class="coluna_ref">Nome</div>
                        <div class="coluna_ref">E-mail</div>
                        <div class="coluna_ref">Celular</div>
                        <div class="coluna_ref">Profissão</div>
                        <div class="coluna_ref">Opções</div>
                    </div>
                    <?php
                        $sql="select * from tbl_fale";
						$select = mysql_query($sql);
						while($rs=mysql_fetch_array($select)){
                    ?>
                    <div class="linha">
                        <div class="coluna"><?php echo($rs['nome']) ?></div>
                        <div class="coluna"><?php echo($rs['email']) ?></div>
                        <div class="coluna"><?php echo($rs['celular']) ?></div>
                        <div class="coluna"><?php echo($rs['profissao']) ?></div>
                        <div class="coluna_opt">
                            <a href="admFaleItem.php?idItem=<?php echo($rs['id_fale'])?>">
                                <img class="img_opt_fale" src="img/icn/eye.png"/>
                            </a>
                            <a href="functions/excluir_registro.php?tela=fale&idItem=<?php echo($rs['id_fale'])?>">
                                <img class="img_opt_fale" src="img/icn/garbage.png"/>
                            </a>
                            
                        </div>
                    </div>
                    <?php
                        }
                    ?>
            
                </div>
            </section>

            <footer>
                Desenvolvido por: Paulo Henrique Lima Ferreira
            </footer>
        </div>
    </body>
</html>