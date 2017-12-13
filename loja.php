<?php
    include('cms/functions/conMysql.php');
    $sql="select * from tbl_produtos where ativado=1";
    $select=mysql_query($sql);
    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> Index </title>
		<link rel="stylesheet" type="text/css" href = "css/styleLoja.css">
		<meta charset="utf-8"/>
        <script type="text/javascript" src="js/slider.js"></script>
	</head>
    
    <body>
        <header>
            <div id="cabecalho">
                <div id="logo"></div>
                <nav>
					<ul id = "lista_menu">
						<li> <a href="Index.php"> Home </a> </li>
						<li> <a href="loja.php"> Loja  </a> </li>
                        <li> <a href="noticias.php"> Notícias </a></li>
                        <li> <a href="faleconosco.php"> Fale Conosco </a></li>
					</ul>
				</nav> 
                <div id="login">
                    <form name="frmlogin" method="post" action="">
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
            <div id="content">
                <div id="conteudo">
                    <div class="linha_cont">
                        <?php while($rs=mysql_fetch_array($select)){?>
                            <div class="produto"> 
                                <div class="titulo_produto">
                                    <?php echo($rs['nome'])?>
                                </div>
                                <div class="img_produto">
                                    <img src="<?php echo('cms/'.$rs['img'])?>" class="imagem" alt="produto1">
                                </div>
                                <div class="info_produto">
                                <p><?php echo($rs['descricao'])?></p>
                                <p style="color:#63ff81;"><?php echo('R$'.$rs['preco'])?></p>
                                <p><a style="color:#007ae5; text-decoration:underline;" href="#">Comprar</a></p>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </section>
        
        <footer>
            ₢ Ligeirinho - 2017
		</footer>
    
    </body>