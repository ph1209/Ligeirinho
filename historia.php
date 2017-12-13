<?php
    $con = mysql_connect("127.0.0.1", "root", "bcd127") or die ("Sem conexão com o servidor");
    $select = mysql_select_db("db_phligeirinho") or die("Sem acesso ao DB");
    
    $sql="select * from tbl_historia where condicao = 1";
    $select=mysql_query($sql);
    $rs=mysql_fetch_array($select);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> Index </title>
		<link rel="stylesheet" type="text/css" href = "css/styleHistoria.css">
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
            <h1>História da corrida de rua</h1>
            <div id="content">
                <div id="img_evento">
                    <img class="img" src="<?php echo("cms/".$rs['img_1'])?>" alt="Corrida 1">
                    <img class="img" src="<?php echo("cms/".$rs['img_2'])?>" alt="Corrida 2">
                </div>
                <div id="sobre_evento">
                    <?php echo($rs['texto']);?>
                </div>
            </div>
        </section>
        
        <footer>
            ₢ Ligeirinho - 2017
		</footer>
    
    </body>