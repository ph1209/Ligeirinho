<?php 
     session_start();
    $login = $_SESSION['login'];
    include('functions/conMysql.php');
    include('functions/getUser.php');
    if($id_funcao_user == 2){
        header('location:cms.php?id_func='.$id_funcao_user);
    }
    /*=======================================*/
    
    
    $opt=null;
    $id=null;

    $nome = null;
    $senha = null;
    $func = null;
    
    $new=1;
    if(isset($_GET['new'])){                       
        $new = $_GET['new'];
    }
        
    /*ADICIONAR USUÁRIO*/
    if(isset($_POST['btnEnviar'])){
        $nome= $_POST['txtNome'];
        $usuario= $_POST['txtUser'];
        $senha= $_POST['txtSenha'];
        $func = $_POST['slcFuncao'];
        //INSERT
        $sql = "INSERT INTO tbl_users(nome, usuario, senha, id_nivel)
        VALUES('".$nome."','".$usuario."','".$senha."',".$func.")";
        mysql_query($sql);
        header('location:admUsers.php');
    }

    /*EXCLUIR USUARIO*/
    if(isset($_POST['btnExcluir'])){
        $id = $_POST['txtId'];
        $sql_delete="delete from tbl_users where id_usuario =".$id;
        mysql_query($sql_delete);
        header('location:admUsers.php');
    }
    
    /*EDITAR USUÁRIO*/

    //condição para permissão de edição se falsa
    if(isset($_GET['opt'])){
        $opt = $_GET['opt'];
        $id = $_GET['id'];
        $opcoes_btn = 1;
        $condicao="disabled";
        
        $sql_user="select u.id_usuario, u.nome , u.usuario, u.senha, n.nome as nivel 
        from tbl_users as u 
        INNER JOIN tbl_nivel as n 
        ON u.id_nivel = n.id_nivel 
        Where id_usuario=".$id;
        
        $select_user = mysql_query($sql_user);
        $rs_user=mysql_fetch_array($select_user);
    }
    
    //condição para permissão de edição se verdadeira
    if(isset($_POST['btnAlterar'])){
        $id = $_POST['txtId'];
        $opt=1;
        $condicao=" ";
        $opcoes_btn = 2;
        
        //ID DA FUNCAO PARA O SELECT-OPTION
        $sql_id = "select * from tbl_users where id_usuario=".$id;
        $select_id = mysql_query($sql_id);
        $rs_id = mysql_fetch_array($select_id);
        $id_func = $rs_id['id_nivel'];
        
        //SELECT DO ALTERAR
        $sql_user="select u.id_usuario, u.nome , u.usuario, u.senha, n.nome as nivel 
        from tbl_users as u 
        INNER JOIN tbl_nivel as n 
        ON u.id_nivel = n.id_nivel 
        Where id_usuario=".$id;
        
        $select_user = mysql_query($sql_user);
        $rs_user=mysql_fetch_array($select_user);
    }
    
    //aplicando alteração ao usuário
    if(isset($_POST['btnSalvarAlteracao'])){
        $id = $_POST['txtId'];
        $nome = $_POST['txtNome_user'];
        $usuario = $_POST['txtUsuario_user'];
        $senha = $_POST['txtSenha_user'];
        $func = $_POST['slcFuncao_alterar'];

        $sql="update tbl_users SET nome='".$nome."', usuario='".$usuario."', senha='".$senha."', id_nivel=".$func." where id_usuario =".$id;
        mysql_query($sql);
        header('location:admUsers.php');
    }

    /*ADICIONAR NÍVEL*/
    if(isset($_POST['btnEnviarNivel'])){
        $nome= $_POST['txtNomeNivel'];
        //INSERT
        $sql = "INSERT INTO tbl_nivel(nome)
        VALUES('".$nome."')";
        mysql_query($sql);
        header('location:admUsers.php');
    }
?>

<html>
    <head>
        <title> Title </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href = "css/styleUsers.css"> 
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
                    <div class="img_opt">
                        <img class="icn" src="img/icn/content.png" alt="">
                    </div>
                    <div class="nome_opt">
                        Adm. Conteúdo
                    </div>
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
                    <div class="img_opt">
                        <img class="icn" src="img/icn/shirt.png" alt="">
                    </div>
                    <div class="nome_opt">
                        Adm. Produtos
                    </div>
                </div>
                
                <div id="opt_slct">
                    <div class="img_opt">
                        <img class="icn" src="img/icn/users.png" alt="">
                    </div>
                    <div class="nome_opt">
                        Adm. Usuários
                    </div>
                </div>

                <div id ="usuario">
                    <div id="mensagem">
                        Bem vindo, <?php echo($nome);?>.
                    </div>
                    <div id="logout">
                        <a href="../Index.php">Logout</a>
                    </div>
                </div>
            </nav>
            
            <section>
                <div id="cont">
                    <!-- MOSTRAR UsUÁRIOS -->
                    <div id="campo_users">
                        <div class="user_ref">
                            <div class="info_user_ref">Nome</div>
                            <div class="info_user_ref">Usuario</div>
                            <div class="info_user_ref">Função</div>
                        </div>
                        <?php
                            $sql ="select u.id_usuario, u.nome , u.usuario, n.nome as nivel 
                            from tbl_users as u 
                            INNER JOIN tbl_nivel as n 
                            ON u.id_nivel = n.id_nivel
                            ORDER BY n.id_nivel";
                        
                            $select = mysql_query($sql);
                            while($rs=mysql_fetch_array($select)){
                        ?>
                        <a href="admUsers.php?opt=1&id=<?php echo($rs['id_usuario'])?>">
                            <div class="user">
                                <div class="info_user"><?php echo($rs['nome'])?></div>
                                <div class="info_user"><?php echo($rs['usuario'])?></div>
                                <div class="info_user"><?php echo($rs['nivel'])?></div>
                            </div>
                        </a>
                        <?php }?>
                    </div>
                    <div id="options">
                        
                        <!-- CAMPO DE CADASTRO -->
                        <?php 
                            if($new == 1){
                        ?>
                        <!-- CADASTRO DE USUÁRIOS -->
                        <div id="cadastro">
                            <div class="opt_titulo">Novo Usuário</div>

                            <form id="form" name="frmNovoUsuario" method="post" action="admUsers.php">
                                <input class="input_text" type="text" placeholder="Nome" name="txtNome" maxlength="45"><br>
                                <input class="input_text" type="text" placeholder="Nome de usuário" name="txtUser" maxlength="20"><br>
                                <input class="input_text" type="password" placeholder="Senha" name="txtSenha" maxlength="16"><br>

                                <select id="select" name="slcFuncao">
                                    <option value="" selected>Selecione uma opção</option>
                                    <?php
                                        $sql_func = "SELECT * FROM tbl_nivel";
                                        $select_func = mysql_query($sql_func);
                                        while($rs_func=mysql_fetch_array($select_func)){
                                    ?>
                                    <option value="<?php echo( $rs_func['id_nivel']);?>"> <?php echo($rs_func['nome']);?></option>    
                                    <?php
                                        }
                                    ?>
                                </select>
                                <input id="btn_enviar" type="submit" name="btnEnviar" value="Enviar">
                            </form>
                        </div>
                        <div id="next_opt">
                            <a href="admUsers.php?new=2">
                                <img id="icn_next" src="img/icn/right-arrow.png" alt="">
                            </a>
                        </div>
                        <?php }elseif($new==2){?>
                        <!-- CAMPO DE NÍVEIS -->
                        <div id="cadastro_n">
                            <div class="opt_titulo">Novo nível</div>
                            <form  id="form" name="frmNovoNivel" method="post" action="admUsers.php">
                                <input class="input_text" type="text" placeholder="Nome" name="txtNomeNivel" maxlength="45"><br>
                                
                                <input id="btn_enviar" type="submit" name="btnEnviarNivel" value="Cadastrar">
                            </form>
                        </div>
                        <div id="prev_opt">
                            <a href="admUsers.php?new=1">
                                <img id="icn_prev" src="img/icn/left-arrow.png" alt="">
                            </a>
                        </div>
                        <?php }?>
                        
                        <!-- CAMPOS DE EXCULIR E EDITAR -->
                        <?php if($opt==1){?>
                            <div id="sobre_user">
                                <div class="opt_titulo">Informações do Usuário</div>
                                <form id="form" name="frmUsuario" method="post" action="admUsers.php">
                                    <div class="campo_sobre_user">
                                        <div class="abt_campo">ID:</div>
                                        <input id="input_id" type="text" value="<?php echo($rs_user['id_usuario'])?>" name="txtId" readonly="true" >
                                    </div>

                                    <div class="campo_sobre_user">
                                        <div class="abt_campo">Nome:</div>
                                        <input class="input_user" type="text" value="<?php echo($rs_user['nome'])?>" name="txtNome_user" <?php echo($condicao)?> >
                                    </div>

                                    <div class="campo_sobre_user">
                                        <div class="abt_campo">Usuário:</div>
                                        <input class="input_user" type="text" value="<?php echo($rs_user['usuario'])?>" name="txtUsuario_user" <?php echo($condicao)?> >
                                    </div>

                                    <div class="campo_sobre_user">
                                        <div class="abt_campo">Senha:</div>
                                        <input class="input_user" type="password" value="<?php echo($rs_user['senha'])?>" name="txtSenha_user" <?php echo($condicao)?> >
                                    </div>
                                    
                                    <!-- DECISÃO DE CASO DE DESBLOQUIEO DE EDIÇÃO -->
                                    
                                    <?php if($opcoes_btn == 1){ ?>
                                        <!-- CAMPOS CASO NÃO SEJA EDITÁVEL -->
                                        <div class="campo_sobre_user">
                                            <div class="abt_campo">Nível:</div>
                                            <input class="input_user" type="text" value="<?php echo($rs_user['nivel'])?>" name="txtNivel_user" disabled>
                                        </div>
                                    
                                        <div class="campo_sobre_user">
                                            <input id="btn_alterar" type="submit" name="btnAlterar" value="Alterar">
                                            <input id="btn_excluir" type="submit" name="btnExcluir" value="Excluir">
                                        </div>
                                    
                                    <?php } else{ ?>
                                        <!-- CAMPOS CASO SEJA EDITAVEL -->
                                        <div class="campo_sobre_user">
                                            <div class="abt_campo">Nível:</div>
                                            <select id="select_alterar" name="slcFuncao_alterar">
                                                <?php
                                                    $sql_func = "SELECT * FROM tbl_nivel";
                                                    $select_func = mysql_query($sql_func);
                                                    while($rs_func=mysql_fetch_array($select_func)){
                                                        $slc = " ";
                                                        if($rs_func['id_nivel'] == $id_func){$slc = "selected";}
                                                ?>
                                                     <option value="<?php echo($rs_func['id_nivel'])?>" <?php echo($slc)?>> <?php echo($rs_func['nome'])?></option>    
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="campo_sobre_user">
                                            <input id="btn_salvar_alteracao" type="submit" name="btnSalvarAlteracao" value="Salvar">
                                        </div>
                                     <?php }?>
                                </form>
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