 <?php
    
    session_start(); // session_start inicia a sessão
   
//  conectar com o bando de dados.
    $con = mysql_connect("127.0.0.1", "root", "bcd127") or die ("Sem conexão com o servidor");
    $select = mysql_select_db("db_phligeirinho") or die("Sem acesso ao DB");

// as variáveis login e senha recebem os dados digitados na página anterior
    if(isset($_POST['btnlog'])){
        $login = $_POST['txtlogin'];
        $senha = $_POST['txtsenha'];
        
        // A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
        $result = mysql_query("SELECT * FROM `tbl_users` WHERE `usuario` = '$login' AND `senha`= '$senha'");

        /* verificando se a variável $result foi bem sucedida, ou seja, se encontrar algum registro idêntico o seu valor será igual a 1, se não o seu valor será 0. Redirecionará para a pagina cms.php ou retornara  para a pagina do formulário inicial*/
        if(mysql_num_rows ($result) > 0 ){
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            $_SESSION['senha'] = $senha;
            header('location:cms/cms.php');
        }
        else{
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
            echo("<script>alert('Usuário ou senha incorretos!');</script>");
        }
    }    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> Index </title>
		<link rel="stylesheet" type="text/css" href = "css/style.css">
		<meta charset="utf-8"/>
        <script type="text/javascript" src="js/slider.js"></script>
	</head>
	
	<body>
		<header>
			<div id="cabecalho">
                <div id="logo"><img class="logo_img" src="img/logo.png"></div>
                <nav>
                    <img id="img_menu" src="img/menu.png">
					<ul id = "lista_menu">
						<li> <a href="Index.php"> Home </a> </li>
                        <li><a href="eventodomes.php">Evento do mês</a></li>
                        <li> <a href="loja.php"> Loja  </a> </li>
                        <li><a href="promocoes.php">Promoções</a></li>
                        <li> <a href="noticias.php"> Notícias </a></li>
                        <li><a href="historia.php">História</a></li>
                        <li> <a href="faleconosco.php"> Fale Conosco </a></li>
					</ul>
				</nav> 
                <div id="login">
                    <form name="frmlogin" method="post" action="Index.php">
                        <div id="caixa_inputs">
                            <input class="input_login" placeholder="Usuário" type="text"  name="txtlogin"> 
                        
                            <input  class="input_login" placeholder="Senha" type="password"  name="txtsenha">
                        </div>
                        
                        <input id="btn_login" type="submit" name="btnlog" value="Entrar">
                    </form>
                </div>
			</div>
		</header>
		
		
		<section>
            <div id = "content">
                <div id="slider"> 
                    <figure>
                        
                        <span class="trs next">   </span> <!-- Botão 'próximo' do slider-->
                        
                        <span class="trs prev">  </span> <!-- Botão 'anterior' do slider-->

                        <div id="imagem_slider">
                            <a href="#" class="trs"><img class="img_slider" src="img/slider/slider1.jpg" alt="Inscrição Franca!!"/></a>
                            <a href="#" class="trs"><img class="img_slider" src="img/slider/slider2.jpg" alt="Participe do movimento #CorrerFazBem "/></a>
                            <a href="#" class="trs"><img class="img_slider" src="img/slider/slider3.jpg" alt="A maratona Pão de Açucar, inscrições abertas"/></a>
                            <a href="#" class="trs"><img class="img_slider" src="img/slider/slider4.jpg" alt="Confira as nossas promoções!!"/></a>
                        </div>

                        <!--Pega o alt da imagem e aplica como legenda-->
                        <figcaption> </figcaption>
                    </figure>
                </div>

                <!-- MENU LATERAL-->
                <div id="conteudo_under_slider">
                    <div id="menu_lateral"> 
                        <ul id = "lista_menu_lateral">
                            <?php
                                $sql="select * from tbl_categoria";
                                $select=mysql_query($sql);
                                while($rs=mysql_fetch_array($select)){
                            ?>
                            <li>
                                <a href="#"><?php echo($rs['nome'])?></a>
                                <ul class="lst_submenu_lateral">
                                    <?php
                                        $sql_sub="select * from tbl_sub_categoria where id_categoria=".$rs['id_categoria'];
                                        $select_sub=mysql_query($sql_sub);
                                        while($rs_sub=mysql_fetch_array($select_sub)){
                                    ?>
                                        <li> <a href="Index.php?id_sub=<?php echo($rs_sub['id_sub_categoria'])?>"><?php echo($rs_sub['nome'])?></a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            <?php }?>
                        </ul>
                    </div>


                    <div id="conteudo">
                        <?php
                            if(isset($_GET['id_sub'])){
                                $id_cat=$_GET['id_sub'];
                                $sql="select * from tbl_corridas where ativado = 1 and id_categoria=".$id_cat;
                            }else{
                                $sql="select * from tbl_corridas where ativado = 1";
                            }
                            $select = mysql_query($sql);
                            while($rs = mysql_fetch_array($select)){
                        ?>
                        <!-- EVENTO -->
                        <div class ="evento"> 
                            <div class = "bloco_imagem_evento">
                                <img class="img_evento" src="<?php echo("cms/".$rs['img'])?>" alt="Evento1">
                            </div>
                            <div class = "bloco_info_evento">
                                <p> <?php echo($rs['nome'])?></p>
                                <a class="detalhes_evento" href="#"><?php echo($rs['descricao'])?></a>
                                <p style="color: #64ff94;"><?php echo("R$".$rs['preco'])?></p>
                            </div>
                        </div>
                        <?php }?>

                    </div>
                </div>
            </div>
            
            <!-- REDES SOCIAIS -->
            <div id="social">
                <div id="facebook"> <img class="img_social" src="img/social/fb.jpg" alt="Facebook"></div>
                <div id="instagram"> <img class="img_social" src="img/social/instagram.jpg" alt="Intagram"> </div>
                <div id="twitter"> <img class="img_social" src="img/social/twitter.jpg" alt="Twitter"> </div>
            </div>
            
        </section>
        
        <footer>
            Ligeirinho₢
        </footer>
        

	</body>
</html>