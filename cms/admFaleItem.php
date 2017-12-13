<?php 
    session_start();
    $login = $_SESSION['login'];
    include('functions/conMysql.php');
    include('functions/getUser.php');
    if($id_funcao_user == 2){
        header('location:cms.php?id_func='.$id_funcao_user);
    }
    
    //RECUPERANDO DADOS DO BANCO
    $idItem = $_GET['idItem'];
    $sql="select * from tbl_fale WHERE id_fale=".$idItem;
    $select = mysql_query($sql);
    $rs=mysql_fetch_array($select);
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
                <div id="item_principal">
                    <div id="item_voltar"> 
                        <a href="admFale.php">
                            <img id="item_voltar_icn" src="img/icn/back.png" alt=""> 
                        </a>
                        Voltar
                    </div>
                    
                    <div id="item_content">
                        <div class="item_info"> 
                            <span class = "item_info_title">
                                Nome:
                            </span>
                            <span class ="item_info_cont">
                                <?php echo($rs['nome']);?>
                            </span>
                        </div>
                        
                        <div class="item_info"> 
                            <span class = "item_info_title">
                                Email:
                            </span>
                            <span class ="item_info_cont">
                                <?php echo($rs['email']);?>
                            </span>
                        </div>
                        
                        <div class="item_info"> 
                            <span class = "item_info_title">
                                Celular:
                            </span>
                            <span class ="item_info_cont">
                                <?php echo($rs['celular']);?>
                            </span>
                        </div>
                        
                        <div class="item_info"> 
                            <span class = "item_info_title">
                                Profissão:
                            </span>
                            <span class ="item_info_cont">
                                <?php echo($rs['profissao']);?>
                            </span>
                        </div>
                        
                        <div class="item_info"> 
                            <span class = "item_info_title">
                                Sexo:
                            </span>
                            <span class ="item_info_cont">
                                <?php 
                                    if($rs['sexo'] == "m"){
                                        echo("Masculino");    
                                    }else{
                                        echo("Feminino");
                                    }
                                ?>
                            </span>
                        </div>
            
                        <div id="item_obs">
                            <div id = "item_obs_title">
                                Observação
                            </div>
                            <div id="item_obs_cont">
                                <?php echo($rs['obs']);?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                Desenvolvido por: Paulo Henrique Lima Ferreira
            </footer>
        </div>
    </body>
</html>