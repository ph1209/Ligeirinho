<?php 
    session_start();
    $login = $_SESSION['login'];
    include('functions/conMysql.php');
    include('functions/getUser.php');
    if($id_funcao_user == 3){
        header('location:cms.php?id_func='.$id_funcao_user);
    }
    
    if(isset($_POST['btn_cond'])){
        if($_POST['btn_cond']=="Ativar"){
            $id=$_GET['id'];
            $sql="update tbl_corridas set ativado=1 where id_corrida=".$id;
            mysql_query($sql);
            header('location:admCorridas.php');
        }else{
            $id=$_GET['id'];
            $sql="update tbl_corridas set ativado=0 where id_corrida=".$id;
            mysql_query($sql);
            header('location:admCorridas.php');
        }
        
    }
?>
<html>
    <head>
        <title> Title </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href = "css/styleAdmProdutos.css"> 
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
                        <div id="adicionar">
                            <a href="#">
                                <a href="admCorridasAdd.php">
                                    <img id="img_add" src="img/icn/add.png" title="Adicionar">
                                </a>
                            </a>
                            <div id="txt_add">Adicionar</div>
                        </div>
                        <div class="ref_1">Nome</div>
                        <div class="border_ref"></div>
                        <div class="ref_2">Descrição</div>
                        <div class="border_ref"></div>
                        <div class="ref_2">Imagem</div>
                        <div class="border_ref"></div>
                        <div class="ref_3">Preço</div>
                        <div class="border_ref"></div>
                        <div class="ref_1">Categoria</div>
                        <div class="border_ref"></div>
                        <div class="ref_1">Subcategoria</div>
                    </div>
                    <div id="conteudo">
                        <?php 
                            $sql="select * from view_corridas";
                            $select=mysql_query($sql);
                            while($rs=mysql_fetch_array($select)){
                                if($rs['ativado']==0){
                                    $txt_cond_class="txt_desativ";
                                    $txt_cond="Desativado";
                                    $btn_cond_class="btn_ativ";
                                    $btn_cond="Ativar";
                                }elseif($rs['ativado']==1){
                                    $txt_cond_class="txt_ativ";
                                    $txt_cond="Ativado";
                                    $btn_cond_class="btn_desativ";
                                    $btn_cond="Desativar";
                                }
                        ?>
                        <div class="linha">
                            <div class="ativ">
                                <div class="<?php echo($txt_cond_class)?>"><?php echo($txt_cond)?></div>
                                <form method="post" name="frm_cond" class="<?php echo($btn_cond_class)?>" action="admCorridas.php?id=<?php echo($rs['id_corrida'])?>">
                                    <input name="btn_cond" type="submit" class="<?php echo($btn_cond_class)?>" value="<?php echo($btn_cond)?>">
                                </form>
                            </div>
                            <div class="box_1">
                                <textarea readonly="true" class="txt_1"><?php echo($rs['nome'])?>
                                </textarea>
                            </div>
                            <div class="border"></div>
                            <div class="box_2">
                                <textarea readonly="true" class="txt_2"><?php echo($rs['descricao'])?>
                                </textarea>
                            </div>
                            <div class="border"></div>
                            <div class="box_2">
                                <img class="img" src="<?php echo($rs['img'])?>">
                            </div>
                            <div class="border"></div>
                            <div class="box_3">
                                <textarea readonly="true" class="txt_3"><?php echo("R$".$rs['preco'])?>
                                </textarea>
                            </div>
                            <div class="border"></div>
                            <div class="box_1">
                                <textarea readonly="true" class="txt_1"><?php echo($rs['categoria'])?>
                                </textarea>
                            </div>
                            <div class="border"></div>
                            <div class="box_1">
                                <textarea readonly="true" class="txt_1"><?php echo($rs['subcategoria'])?></textarea>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </section>

            <footer>
                Desenvolvido por: Paulo Henrique Lima Ferreira
            </footer>
        </div>
    </body>
</html>