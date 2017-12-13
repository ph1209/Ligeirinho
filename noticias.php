<?php
    include('cms/functions/conMysql.php');
    
    $sql="select * from tbl_noticias where condicao = 1";
    $select = mysql_query($sql);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> Index </title>
		<link rel="stylesheet" type="text/css" href = "css/styleNoticias.css">
		<meta charset="utf-8"/>
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
            <h1> Notícias </h1>
            <div id="content">
                <?php while($rs = mysql_fetch_array($select)){?>
                <div id="noticia_destaque">
                    <div class="texto_destaque">
                        <div class="titulo_noticia"> <?php echo($rs['titulo'])?> </div>
                        <div class = "cont_noticia">
                            <textarea class="txt_noticia" readonly="true"><?php echo($rs['texto'])?></textarea>
                        </div>
                    </div>
                    <div class="imagem_destaque">
                        <img class="img_noticia" src="<?php echo('cms/'.$rs['img'])?>" alt="img1">
                    </div>
                </div>
                <?php }?>
                
            </div>
        </section>
        
        <footer>
            ₢ Ligeirinho - 2017
		</footer>
    
    </body>