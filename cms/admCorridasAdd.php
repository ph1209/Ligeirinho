<?php 
    session_start();
    $login = $_SESSION['login'];
    include('functions/conMysql.php');
    include('functions/getUser.php');
    if($id_funcao_user == 3){
        header('location:cms.php?id_func='.$id_funcao_user);
    }

    $cond_slc="disabled";
    //JUMP MENU DAS CORRIDAS
    if(isset($_GET['jump_id'])){
        $cond_slc= " ";
        $id_cat=$_GET['jump_id'];
        $sql_cat="select * from tbl_categoria where id_categoria=".$id_cat;
        $select_cat=mysql_query($sql_cat);
        $sql="select * from tbl_sub_categoria where id_categoria=".$id_cat;
        $select_jump=mysql_query($sql);   
    }
    //ADICIONAR CORRIDA
    if(isset($_POST['btnSalvar_corrida'])){
        echo("echo 1");
        $nome = $_POST['txtNome'];
        $preco = $_POST['txtPreco'];
        $cat = $_POST['slc_cat'];
        $desc = $_POST['txt_desc'];
        $upload_dir="img/upload/corridas/";
        $upload_file = $upload_dir.basename($_FILES['ft_corrida']['name']);
        $arq= basename($_FILES['ft_corrida']['name']);
        $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
        if($extensao=='jpg' || $extensao=='png'){
                echo("entrou2");
                if(move_uploaded_file($_FILES['ft_corrida']['tmp_name'],$upload_file)){
                    $sql="insert into tbl_corridas(nome, descricao, img, preco, id_categoria, ativado)";
                    $sql=$sql." values('".$nome."', '".$desc."', '".$upload_file."', ".$preco.", ".$cat.", 0)";
                    mysql_query($sql);
                    header('location:admCorridas.php');
                }
        }
    }

    //ADICIONAR CATEGORIA
    if(isset($_POST['btnSalvar_categoria'])){
        $nome=$_POST['txtNome'];
        $sql="insert into tbl_categoria(nome) values('".$nome."')";
        mysql_query($sql);
        header('location:admCorridasAdd.php');
    }
    if(isset($_POST['btnSalvar_subcategoria'])){
        $nome=$_POST['txtNome'];
        $id_cat=$_POST['slc_cat'];
        $sql="insert into tbl_sub_categoria(nome, id_categoria) values('".$nome."',".$id_cat.")";
        mysql_query($sql);
        header('location:admCorridasAdd.php');
    }

?>
<html>
    <head>
        <title> Title </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href = "css/styleAdmProdutosAdd.css">
        <script type="text/javascript">
            <!--
            function MM_jumpMenu(targ,selObj,restore){ //v3.0
              eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
              if (restore) selObj.selectedIndex=0;
            }
            //-->
        </script>
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
                    <!--ADICIONAR CORRIDA-->
                    <div class="add_div">
                        <div class="add_title"> Adicionar Produto</div>
                        <form id="frm_add_corrida" enctype="multipart/form-data"method="post" action="admCorridasAdd.php">
                            <select name="jumpMenu" class = "input" onchange="MM_jumpMenu('parent',this,0)">
                                <?php
                                    if(isset($_GET['jump_id'])){
                                        $rs_cat=mysql_fetch_array($select_cat);
                                ?>
                                    <option value="admCorridasAdd.php?jump_id=<?php echo($rs_cat['id_categoria'])?>" selected><?php echo($rs_cat['nome'])?></option>
                                <?php }else{?>
                                    <option value="" selected>Selecione uma categoria</option>
                                <?php
                                }
                                    $sql="select * from tbl_categoria";
                                    $select=mysql_query($sql);
                                    while($rs=mysql_fetch_array($select)){
                                ?>
                                    <option value="admCorridasAdd.php?jump_id=<?php echo($rs['id_categoria'])?>"><?php echo($rs['nome'])?></option>
                                <?php }?>
                            </select>
                            <select name="slc_cat" class="input" <?php echo($cond_slc)?>>
                                <option value="" selected>Selecione uma subcategoria</option>
                                <?php
                                    if(isset($_GET['jump_id'])){
                                       while($rs = mysql_fetch_array($select_jump)){ 
                                ?>
                                    <option value="<?php echo($rs['id_sub_categoria'])?>"><?php echo($rs['nome'])?></option>
                                <?php } 
                                    }?>
                            </select>
                            <input type="text" class="input" placeholder="Nome" name="txtNome" maxlength="45">
                            <input type="number" class="input" placeholder="Preço" name="txtPreco">
                            <input type="file" class="input" name="ft_corrida">
                            <textarea maxlength="100" name="txt_desc" id="txtDesc" placeholder="Descrição"></textarea>
                            <input type="submit" class="input" name="btnSalvar_corrida" value="Salvar">
                        </form>
                    </div>
                    <!--ADICIONAR CATEGORIA-->
                    <div class="add_div">
                        <div class="add_title"> Adicionar Categoria</div>
                        <form class="frm_add_cat" method="post" action="admCorridasAdd.php" >
                            <input type="text" class="input" placeholder="Nome" name="txtNome" maxlength="45">
                            <input type="submit" class="input" name="btnSalvar_categoria" value="Salvar">
                        </form>
                        <div class="view_title"> Categorias </div>
                        <div class="view_itens_div">
                            <?php
                                $sql="select * from tbl_categoria";
                                $select=mysql_query($sql);
                                while($rs=mysql_fetch_array($select)){
                            ?>
                            <div class="view_item">
                                <?php echo($rs['nome'])?>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <!--ADICIONAR SUBCATEGORIA-->
                    <div class="add_div">
                        <div class="add_title"> Adicionar Sub Categoria</div>
                        <form class="frm_add_cat" method="post" action="admCorridasAdd.php">
                            <input type="text" class="input" placeholder="Nome" name="txtNome" maxlength="45">
                            <select name="slc_cat" class = "input" onchange="MM_jumpMenu('parent',this,0)">
                                <option value="" selected>Selecione uma categoria</option>
                                <?php
                                    $sql="select * from tbl_categoria";
                                    $select=mysql_query($sql);
                                    while($rs=mysql_fetch_array($select)){
                                ?>
                                    <option value="<?php echo($rs['id_categoria'])?>"><?php echo($rs['nome'])?></option>
                                <?php }?>
                            </select>
                            <input type="submit" class="input" name="btnSalvar_subcategoria" value="Salvar">
                        </form>
                        <div class="view_title"> Sub Categorias </div>
                        <div class="view_itens_div">
                            <?php
                                $sql="select * from tbl_sub_categoria";
                                $select=mysql_query($sql);
                                while($rs=mysql_fetch_array($select)){
                            ?>
                            <div class="view_item">
                                <?php echo($rs['nome'])?>
                            </div>
                            <?php }?>
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