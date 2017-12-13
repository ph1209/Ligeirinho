<?php 
    /*Conexão com o banco MySql*/
    $conexao=mysql_connect('localhost', 'root', 'bcd127');
    mysql_select_db('db_phligeirinho');

    /*----*/
    
    //SALVAR NO BANCO
    if(isset($_POST['btnEnviar'])){
        $nome=$_POST['txtNome'];
		$email=$_POST['txtEmail'];
		$celular=$_POST['txtCel'];
		$profissao=$_POST['txtProfissao'];
		$sexo=$_POST['rdsex'];
		$obs=$_POST['txtDescricao'];
		
		//COMANDO INSERT
		$sql="INSERT INTO tbl_fale(nome, email, celular, profissao, sexo, obs)";
		$sql = $sql." VALUES('".$nome."','".$email."','".$celular."','".$profissao."','".$sexo."','".$obs."')";
		
		mysql_query($sql);//Executa a string no banco
	}
	
?>

<html>
    <head>
        <title>Fale Conosco</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href = "css/styleFaleCon.css">
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
            <h1>FALE CONOSCO</h1>
            
            <div id="content">
                <form name="frmFale" method="post" action="faleconosco.php">
                    <input class="input_text" type="text" placeholder="Nome" name="txtNome"><br>
                    <input class="input_text" type="text" placeholder="Email" name="txtEmail"><br>
                    <input class="input_text" type="text" placeholder="Celular" name="txtCel"><br>
                    <input class="input_text" type="text" placeholder="Profissão" name="txtProfissao"><br>
                    
                    <div id="rdSexo"> Sexo:
                        <input type="radio" name="rdsex" value="m">Masculino
                        <input type="radio" name="rdsex" value="f">Feminino
                    </div>
                         
                    <textarea name="txtDescricao" placeholder="Sugestão ou crítica" id="textArea"></textarea>
                    
                    <input id="btn_enviar" type="submit" name="btnEnviar" value="Enviar">
                </form>
            </div>
        
        </section>
        
        
        <footer>
            ₢ Ligeirinho - 2017
		</footer>
    </body>
</html>