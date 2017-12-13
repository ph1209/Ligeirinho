<?php
    include('cms/functions/conMysql.php');
    $sql="select pr.nome, pr.preco, pr.img, p.preco_promo from tbl_produtos as pr
    inner join tbl_promocao as p on pr.id_produto = p.id_produto
    where pr.ativado=1;";
    $select=mysql_query($sql);
?>
<html>
    <head>
		<title> Index </title>
		<link rel="stylesheet" type="text/css" href = "css/stylePromo.css">
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
                <div id="destaque">
                    <img id="img_destaque" src="img/promo/destaque.jpg">
                </div>
                
                <div id="conteudo">
                    <div class="linha_conteudo">
                        <?php
                            while($rs=mysql_fetch_array($select)){
                        ?>
                        <div class="evento">
                            <div class="cima_evento">
                                <img class="img_evento" src="<?php echo('cms/'.$rs['img'])?>"> 
                            </div>
                            
                            <div class="baixo_evento">
                                <div class="info_evento">
                                    <p><?php echo($rs['nome']) ?></p>
                                </div>
                                <div class="preco_evento">
                                    <p style="text-decoration: line-through; font-size:15px; color:#ff4141"><?php echo('R$'.$rs['preco']) ?></p>
                                    <p><?php echo('R$'.$rs['preco_promo']) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    
                    </div>
                </div>
            </div>
        </section>
        
        <footer>
            ₢ Ligeirinho - 2017
		</footer>
    </body>
</html>