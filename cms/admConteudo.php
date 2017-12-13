<?php 
    session_start();
    $login = $_SESSION['login'];
    include('functions/conMysql.php');
    include('functions/getUser.php');
    if($id_funcao_user == 2){
        header('location:cms.php?id_func='.$id_funcao_user);
    }

$tipo_conteudo = 0;
    if(isset($_GET['conteudo'])){
        $tipo_conteudo = $_GET['conteudo'];
    }
/* ## ** CONTEÚDO ** EVENTO DESTAQUE ** ## */
    $idItem_destaque = null;
    $sobre_destaque_mostrar= null;
    $btn_destaque="Salvar";
    $div_titulo_destaque_mostrar = "Novo Evento Destaque";
    $id_evento=null;
    $opt_ref_destaque="<option value=' ' selected>Selecione um evento</option>";

    if(isset($_GET['editarDestaque'])){
        $idItem_destaque = $_GET['idItem'];
        $sql="select * from tbl_destaque where id_destaque=".$idItem_destaque;
        $select=mysql_query($sql);
        $rs=mysql_fetch_array($select);
        $id_evento = $rs['id_corrida'];
        $sobre_destaque_mostrar = $rs['sobre'];
        $btn_destaque="Editar";
        $div_titulo_kit_mostrar = "Editar Kit";
        $div_titulo_destaque_mostrar = "Editar Evento Destaque";
        $opt_ref_destaque=null;
    }
    
    if(isset($_POST['btn_destaque'])){
        if($_POST['btn_destaque']=="Salvar"){
            $id_corrida = $_POST['slcEvento'];
            $sobre = $_POST['txt_destaque'];
            $upload_dir="img/upload/destaque";
            $upload_file = $upload_dir.basename($_FILES['ft_destaque']['name']);
            $arq= basename($_FILES['ft_destaque']['name']);
            $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
            if($extensao=='jpg' || $extensao=='png'){
                if(move_uploaded_file($_FILES['ft_destaque']['tmp_name'],$upload_file)){
                    $sql="insert into tbl_destaque (id_corrida, sobre, img, ativado) values(".$id_corrida.", '".$sobre."', '".$upload_file."', 0)";
                    mysql_query($sql);
                    header('location:admConteudo.php?conteudo=1');
                }
            }
        }elseif($_POST['btn_destaque']=="Editar"){
            if(isset($_GET['idItem_destaque'])){
                $idItem_destaque=$_GET['idItem_destaque'];
            }
            $id_corrida = $_POST['slcEvento'];
            $sobre = $_POST['txt_destaque'];
            if(empty($_FILES['ft_destaque']['name'])){
                $sql="update tbl_destaque set id_corrida=".$id_corrida.", sobre='".$sobre."' where id_destaque=".$idItem_destaque;
                mysql_query($sql);
                header('location:admConteudo.php?conteudo=1');
            }else{
                $upload_dir="img/upload/destaque";
                $upload_file = $upload_dir.basename($_FILES['ft_destaque']['name']);
                $arq= basename($_FILES['ft_destaque']['name']);
                $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
                if($extensao=='jpg' || $extensao=='png'){
                if(move_uploaded_file($_FILES['ft_destaque']['tmp_name'],$upload_file)){
                    $sql="update tbl_destaque set id_corrida=".$id_corrida.", sobre='".$sobre."', img='".$upload_file."' where id_destaque=".$idItem_destaque;
                    mysql_query($sql);
                    header('location:admConteudo.php?conteudo=1');
                }
            }
            }
        }
        
    }
    if(isset($_POST['btn_cond_destaque'])){
        //Ativar e desativar noticia
        $id_destaque = $_GET['destaque_id'];
        if($_POST['btn_cond_destaque']=="Ativar"){
            $desativar="update tbl_destaque set ativado = 0";
            mysql_query($desativar);
            $sql="update tbl_destaque set ativado = 1 where id_destaque=".$id_destaque;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=1');

        }elseif($_POST['btn_cond_destaque']=="Desativar"){
            $sql="update tbl_destaque set ativado = 0 where id_destaque=".$id_destaque;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=1');
        }
    }

/* ## ** CONTEÚDO ** LOJA ** ## */
    $nome_kit_mostrar = null;
    $preco_kit_mostrar=null;
    $desc_kit_mostrar=null;
    $div_titulo_kit_mostrar = "Novo Kit";
    $btn_kit="Salvar";
    $idItem_kit = null;
    //editarNoticia
    if(isset($_GET['editarKit'])){
        $idItem_kit = $_GET['idItem'];
        $sql="select * from tbl_produtos where id_produto=".$idItem_kit;
        $select=mysql_query($sql);
        $rs=mysql_fetch_array($select);
        $nome_kit_mostrar = $rs['nome'];
        $preco_kit_mostrar=$rs['preco'];
        $desc_kit_mostrar=$rs['descricao'];
        $btn_kit="Editar";
        $div_titulo_kit_mostrar = "Editar Kit";
    }
    if(isset($_POST['btn_kit'])){
        if($_POST['btn_kit']=="Salvar"){
            $nome=$_POST['txt_titulo_kit'];
            $preco=$_POST['txt_preco_kit'];
            $desc=$_POST['txt_desc_kit'];
            $upload_dir="img/upload/loja/";
            $upload_file = $upload_dir.basename($_FILES['ft_kit']['name']);
            $arq= basename($_FILES['ft_kit']['name']);
            $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
            if($extensao=='jpg' || $extensao=='png'){
                if(move_uploaded_file($_FILES['ft_kit']['tmp_name'],$upload_file)){
                    $sql="insert into tbl_produtos (nome, preco, img, descricao, ativado) values('".$nome."', ".$preco.", '".$upload_file."', '".$desc."', 0)";
                    mysql_query($sql);
                    header('location:admConteudo.php?conteudo=2');
                }
            }
        }elseif($_POST['btn_kit']=="Editar"){
            if(isset($_GET['idItem_kit'])){ $idItem = $_GET['idItem_kit']; }
            $nome=$_POST['txt_titulo_kit'];
            $preco=$_POST['txt_preco_kit'];
            $desc=$_POST['txt_desc_kit'];
            if(empty($_FILES['ft_kit']['name'])){
                $sql="update tbl_produtos set nome='".$nome."', preco=".$preco.", descricao='".$desc."' where id_produto=".$idItem;
                mysql_query($sql);
                header('location:admConteudo.php?conteudo=2');
            }else{
                $upload_dir="img/upload/loja/";
                $upload_file = $upload_dir.basename($_FILES['ft_kit']['name']);
                $arq= basename($_FILES['ft_kit']['name']);
                $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
                if($extensao=='jpg' || $extensao=='png'){
                if(move_uploaded_file($_FILES['ft_kit']['tmp_name'],$upload_file)){
                    $sql="update tbl_produtos set nome='".$nome."', preco=".$preco.", descricao='".$desc."', img='".$upload_file."' where id_produto=".$idItem;
                    mysql_query($sql);
                    header('location:admConteudo.php?conteudo=2');
                }
            }
            }
        }
        
    }
    if(isset($_POST['btn_cond_kit'])){
        //Ativar e desativar noticia
        $id_kit = $_GET['kit_id'];
        if($_POST['btn_cond_kit']=="Ativar"){
            $sql="update tbl_produtos set ativado = 1 where id_produto=".$id_kit;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=2');

        }elseif($_POST['btn_cond_kit']=="Desativar"){
            $sql="update tbl_produtos set ativado = 0 where id_produto=".$id_kit;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=2');
        }
    }

/* ## ** CONTEÚDO ** PROMOÇÃO ** ## */
    $porcentagem_promo = null;
    $div_titulo_promo_mostrar = "Nova Promoção";
    $btn_promo="Salvar";
    $idItem_promo = null;
    $id_prod = null;
    $opt_ref_promo="<option value=' ' selected>Selecione um produto</option>";
    if(isset($_GET['editarPromo'])){
        $div_titulo_promo_mostrar = "Editar Promoção";
        $btn_promo="Editar";
        $idItem_promo = $_GET['idItem'];
        $sql="select * from tbl_promocao where id_promocao=".$idItem_promo;
        $select = mysql_query($sql);
        $rs=mysql_fetch_array($select);
        $id_prod=$rs['id_produto'];
        $preco_promo=$rs['preco_promo'];
        
        $sql_prod="select * from tbl_produtos where id_produto=".$rs['id_produto'];
        $select_prod=mysql_query($sql_prod);
        $rs_prod=mysql_fetch_array($select_prod);
        $preco_prod=$rs_prod['preco'];
        
        $porcentagem_promo = (($preco_prod - $preco_promo) / $preco_prod)*100;    
        
        $opt_ref_promo=null;
        
    }
    if(isset($_POST['btn_promo'])){
        if($_POST['btn_promo']=="Salvar"){
            $id_produto=$_POST['slc_produtos'];
            $sql_valor="select * from tbl_produtos where id_produto=".$id_produto;
            $select_valor=mysql_query($sql_valor);
            $rs_valor=mysql_fetch_array($select_valor);
            $valor=$rs_valor['preco'];
            $desconto_porcentagem=$_POST['txt_desconto'];
            $desconto = $valor-(($desconto_porcentagem/100)*$valor);

            $sql_promo="insert into tbl_promocao (preco_promo, ativado, id_produto) values(".$desconto.", 0, ".$id_produto.")";
            mysql_query($sql_promo);
            header('location:admConteudo.php?conteudo=3');
        }elseif($_POST['btn_promo']=="Editar"){
            $idItem_promo = $_GET['idItem_promo'];
            $id_produto=$_POST['slc_produtos'];
            $sql_valor="select * from tbl_produtos where id_produto=".$id_produto;
            $select_valor=mysql_query($sql_valor);
            $rs_valor=mysql_fetch_array($select_valor);
            $valor=$rs_valor['preco'];
            $desconto_porcentagem=$_POST['txt_desconto'];
            $desconto = $valor-(($desconto_porcentagem/100)*$valor);

            $sql_promo="update tbl_promocao set preco_promo=".$desconto.", id_produto=".$id_produto." where id_promocao=".$idItem_promo;
            mysql_query($sql_promo);
            header('location:admConteudo.php?conteudo=3');
            
        }
    }

/* ## ** CONTEÚDO ** NOTÍCIAS ** ## */
    $titulo_news_mostrar = null;
    $texto_news_mostrar=null;
    $div_titulo_news_mostrar = "Nova Notícia";
    $btn_news="Salvar";
    $idItem_news = null;
    //editarNoticia
    if(isset($_GET['editarNews'])){
        $idItem_news = $_GET['idItem'];
        $sql="select * from tbl_noticias where id_noticia=".$idItem_news;
        $select=mysql_query($sql);
        $rs=mysql_fetch_array($select);
        $titulo_news_mostrar = $rs['titulo'];
        $texto_news_mostrar=$rs['texto'];
        $btn_news="Editar";
        $div_titulo_news_mostrar = "Editar Notícia";
    }
    if(isset($_POST['btn_news'])){
        //Nova noticia
        if($_POST['btn_news']=="Salvar"){
            $titulo=$_POST['txt_titulo_news'];
            $texto=$_POST['txt_news'];   
            $upload_dir="img/upload/noticias/";
            $upload_file = $upload_dir.basename($_FILES['ft_news']['name']);
            $arq= basename($_FILES['ft_news']['name']);
            $extensao=strtolower(substr($arq, strlen($arq)-3, 3));

            if($extensao=='jpg' || $extensao=='png'){
                if(move_uploaded_file($_FILES['ft_news']['tmp_name'],$upload_file)){
                    $sql="insert into tbl_noticias (titulo, img, texto, condicao) values('".$titulo."', '".$upload_file."', '".$texto."', 0)";
                    mysql_query($sql);
                    header('location:admConteudo.php?conteudo=4');
                    
                }
            }
        }
        if($_POST['btn_news']=="Editar"){
            //editar noticia
            if(isset($_GET['idItem'])){ $idItem = $_GET['idItem']; }
            $titulo=$_POST['txt_titulo_news'];
            $texto=$_POST['txt_news'];
            if(empty($_FILES['ft_news']['name'])){
                $sql="update tbl_noticias set titulo='".$titulo."', texto='".$texto."' where id_noticia=".$idItem;
                mysql_query($sql);
            }else{
                $upload_dir="img/upload/noticias/";
                $upload_file = $upload_dir.basename($_FILES['ft_news']['name']);
                $arq= basename($_FILES['ft_news']['name']);
                $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
                if($extensao=='jpg' || $extensao=='png'){
                if(move_uploaded_file($_FILES['ft_news']['tmp_name'],$upload_file)){
                    $sql="update tbl_noticias set titulo='".$titulo."',img='".$upload_file."', texto='".$texto."' where id_noticia=".$idItem;
                    mysql_query($sql);
                    header('location:admConteudo.php?conteudo=4');
                }
            }
            }
        }
    }
    //ativar e desativar noticia
    if(isset($_POST['btn_cond_news'])){
        //Ativar e desativar noticia
        $id_noticia = $_GET['news_id'];
        if($_POST['btn_cond_news']=="Ativar"){
            $sql="update tbl_noticias set condicao = 1 where id_noticia=".$id_noticia;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=4');

        }elseif($_POST['btn_cond_news']=="Desativar"){
            $sql="update tbl_noticias set condicao = 0 where id_noticia=".$id_noticia;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=4');
        }
    }

/* ## ** CONTEÚDO ** HISTÓRIA ** ## */
    $texto_hist_mostrar = null;
    $titulo_hist_mostrar = "Nova Notícia";
    $btn_hist="Salvar";
    $idItem_hist = null;
    //editar historia
    if(isset($_GET['editarHist'])){
        $idItem_hist = $_GET['idItem'];
        $sql="select * from tbl_historia where id_historia=".$idItem_hist;
        $select=mysql_query($sql);
        $rs=mysql_fetch_array($select);
        $texto_hist_mostrar= $rs['texto'];
        $titulo_hist_mostrar = "Editar Notícia";
        $btn_hist="Editar";
    }
    if(isset($_POST['btn_hist'])){
        if($_POST['btn_hist']=="Salvar"){
            //inserir historia
            $texto = $_POST['txt_hist'];
            $upload_dir = "img/upload/historia/";
            $upload_file = $upload_dir.basename($_FILES['ft_hist1']['name']);
            $upload_file2 = $upload_dir.basename($_FILES['ft_hist2']['name']);
            $arq= basename($_FILES['ft_hist1']['name']);
            $arq2= basename($_FILES['ft_hist2']['name']);
            $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
            $extensao2=strtolower(substr($arq2, strlen($arq2)-3, 3));
            if($extensao =='jpg' || $extensao=='png' & $extensao2=='jpg' || $extensao2=='png' ){
                if(move_uploaded_file($_FILES['ft_hist1']['tmp_name'],$upload_file) & move_uploaded_file($_FILES['ft_hist2']['tmp_name'],$upload_file2) ){
                    $sql="insert into tbl_historia (img_1, img_2, texto, condicao)values('".$upload_file."', '".$upload_file2."', '".$texto."', 0)";
                    mysql_query($sql);
                }
            }
        }
        if($_POST['btn_hist']=="Editar"){   
            //editar historia
            $texto = $_POST['txt_hist'];
            $upload_dir = "img/upload/historia/";
            if(isset($_GET['idItem'])){
                $idItem=$_GET['idItem'];
            }
            if(empty($_FILES['ft_hist1']['name']) & empty($_FILES['ft_hist2']['name'])){
                $sql="update tbl_historia set texto='".$texto."' where id_historia=".$idItem;
                mysql_query($sql);
            }elseif(empty($_FILES['ft_hist2']['name']) & empty($_FILES['ft_hist1'])==false){
                $upload_file = $upload_dir.basename($_FILES['ft_hist1']['name']);
                $arq= basename($_FILES['ft_hist1']['name']);
                $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
                if($extensao =='jpg' || $extensao=='png'){
                    if(move_uploaded_file($_FILES['ft_hist1']['tmp_name'],$upload_file)){
                        $sql="update tbl_historia set img_1='".$upload_file."', texto='".$texto."' where id_historia=".$idItem;
                        mysql_query($sql);
                    }
                }
            }elseif(empty($_FILES['ft_hist1']['name']) & empty($_FILES['ft_hist2'])==false){
                $upload_file = $upload_dir.basename($_FILES['ft_hist2']['name']);
                $arq= basename($_FILES['ft_hist2']['name']);
                $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
                if($extensao =='jpg' || $extensao=='png'){
                    if(move_uploaded_file($_FILES['ft_hist2']['tmp_name'],$upload_file)){
                        $sql="update tbl_historia set img_2='".$upload_file."', texto='".$texto."' where id_historia=".$idItem;
                        mysql_query($sql);
                    }
                }
            }else{
                $upload_file = $upload_dir.basename($_FILES['ft_hist1']['name']);
                $upload_file2 = $upload_dir.basename($_FILES['ft_hist2']['name']);
                $arq= basename($_FILES['ft_hist1']['name']);
                $arq2= basename($_FILES['ft_hist2']['name']);
                $extensao=strtolower(substr($arq, strlen($arq)-3, 3));
                $extensao2=strtolower(substr($arq, strlen($arq)-3, 3));
                if($extensao =='jpg' || $extensao=='png' & $extensao2=='jpg' || $extensao2=='png' ){
                    if(move_uploaded_file($_FILES['ft_hist1']['tmp_name'],$upload_file) & move_uploaded_file($_FILES['ft_hist2']['tmp_name'],$upload_file2) ){
                        $sql="update tbl_historia set img_1='".$upload_file."', img_2='".$upload_file2."', texto='".$texto."')";
                        mysql_query($sql);
                    }
                }
            }
        }
    }
    //Ativar e desatvar historia
    if(isset($_POST['btn_opt_hist'])){
        $id_historia = $_GET['id_hist'];
        if($_POST['btn_opt_hist']=="Ativar"){
            $desativar="update tbl_historia set condicao = 0";
            mysql_query($desativar);
            $sql="update tbl_historia set condicao = 1 where id_historia=".$id_historia;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=5');

        }elseif($_POST['btn_opt_hist']=="Desativar"){
            $sql="update tbl_historia set condicao = 0 where id_historia=".$id_historia;
            mysql_query($sql);
            header('location:admConteudo.php?conteudo=5');
        }   
    }
?>

<html>
    <head>
        <title> Title </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href = "css/styleAdmConteudo.css"> 
    </head>
    
    <body>
        <div id="co-ntent">
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
                <div id="conteudo">
                    <?php if($tipo_conteudo == 0){ ?>
                        <div id="linha">
                            <a href="admConteudo.php?conteudo=1">
                                <div class="opt_tela">
                                    <div class="titulo_tela"> Evento do mês </div>
                                    <div class="imagem_tela">
                                        <img class="icn_tela" src="img/icn/month.png">
                                    </div>
                                </div>
                            </a>
                            <a href="admConteudo.php?conteudo=2">
                                <div class="opt_tela">
                                    <div class="titulo_tela"> Loja </div>
                                    <div class="imagem_tela">
                                        <img class="icn_tela" src="img/icn/loja.png">
                                    </div>
                                </div>
                            </a>
                            <a href="admConteudo.php?conteudo=3">
                                <div class="opt_tela">
                                    <div class="titulo_tela"> Promoções </div>
                                    <div class="imagem_tela">
                                        <img class="icn_tela" src="img/icn/discount.png">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="linha">
                            <a href="admConteudo.php?conteudo=4">
                                <div class="opt_tela_baixo">
                                    <div class="titulo_tela"> Notícias </div>
                                    <div class="imagem_tela">
                                        <img class="icn_tela" src="img/icn/news.png">
                                    </div>
                                </div>
                            </a>

                            <a href="admConteudo.php?conteudo=5">
                                <div class="opt_tela_baixo">
                                    <div class="titulo_tela"> História da corrida </div>
                                    <div class="imagem_tela">
                                        <img class="icn_tela" src="img/icn/race.png">
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }elseif($tipo_conteudo == 1){?>
                        <div class="cima">
                            <div class="voltar">
                                <a href="admConteudo.php"><img id="icn_voltar" src="img/icn/back.png"></a>
                            </div>
                            <div class="even">
                                <img class="icn_reps" src="img/icn/month.png">
                                <div class="title_reps">Evento Do Mês</div>
                                <img class="icn_reps" src="img/icn/month.png">
                            </div>
                        </div>
                        <div class="baixo">
                            <div id="mostrar_destaque">
                                <div id="ref_destaque">
                                    <div id="titulo_destaque_ref">Nome da corrida</div>
                                    <div class="borda_destaque_ref"></div>
                                    <div id="sobre_destaque_ref">Sobre</div>
                                    <div class="borda_destaque_ref"></div>
                                    <div id="img_destaque_ref">Imagem</div>
                                    <div class="borda_destaque_ref"></div>
                                    <div id="opt_destaque_ref">Opções</div>
                                </div>
                                <div id="destaque_cont">
                                    <?php 
                                        $sql="select d.id_destaque, c.nome, d.img, d.sobre, d.ativado from tbl_corridas as c inner join tbl_destaque as d on c.id_corrida = d.id_corrida";
                                        $select=mysql_query($sql);
                                        while($rs=mysql_fetch_array($select)){
                                    ?>
                                    <div class="linha_destaque">
                                        <div class="titulo_destaque">
                                            <textarea class="titulo_destaque_area" readonly="true"><?php echo($rs['nome'])?></textarea>
                                        </div>
                                        <div class="borda_destaque"></div>
                                        <div class="sobre_destaque">
                                            <textarea class="sobre_destaque_area" readonly="true"><?php echo($rs['sobre'])?></textarea>
                                        </div>
                                        <div class="borda_destaque"></div>
                                        <div class="img_destaque_div">
                                            <img class="img_destque" src="<?php echo($rs['img'])?>">
                                        </div>
                                        <div class="borda_destaque"></div>
                                        <div class="opt_destaque">
                                            <?php 
                                                if($rs['ativado']==0){
                                                    $cond = "<div class='cond_destaque_desativ'>Desativado</div>";
                                                    $cond_class="ativ_destaque";
                                                    $cond_value="Ativar";
                                                }elseif($rs['ativado']==1){
                                                    $cond = "<div class='cond_destaque_ativ'>Ativado</div>";
                                                    $cond_class="desativ_destaque";
                                                    $cond_value="Desativar";
                                                }
                                            ?>
                                            <?php echo($cond)?>
                                            <form name="frm_opt_destaque" class="frm_opt_" method="post" action="admConteudo.php?conteudo=1&destaque_id=<?php echo($rs['id_destaque'])?>">
                                                <input name="btn_cond_destaque" type="submit" class="<?php echo($cond_class)?>" value="<?php echo($cond_value)?>">
                                            </form>
                                            <div class="actions_loja">
                                                <a href="admConteudo.php?conteudo=1&editarDestaque=1&idItem=<?php echo($rs['id_destaque'])?>">
                                                    <img class="icn_action_destaque" src="img/icn/edit.png" title="Editar">
                                                </a>
                                                <a href="functions/excluir_registro.php?tela=contDestaque&idItem=<?php echo($rs['id_destaque'])?>">
                                                    <img class="icn_action_destaque" src="img/icn/garbage.png" title="Excluir">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div id="abt_conteudo_destaque">
                                <div class="titulo_cont"><?php echo($div_titulo_destaque_mostrar)?></div>
                                <form id="frm_destaque" enctype="multipart/form-data" name="frmDestaque" method="post" action="admConteudo.php?conteudo=1&idItem_destaque=<?php echo($idItem_destaque)?>">
                                    Evento:<br/>
                                    <select id="slc_evento" name="slcEvento">
                                        <?php
                                            echo($opt_ref_destaque);
                                            $sql_func = "SELECT * FROM tbl_corridas";
                                            $select_func = mysql_query($sql_func);
                                            while($rs_func=mysql_fetch_array($select_func)){
                                                $opt_selected_destaque = "a";
                                                if($rs_func['id_corrida']==$id_evento){$opt_selected_destaque="selected";}
                                        ?>
                                            <option value="<?php echo($rs_func['id_corrida'])?>" <?php echo($opt_selected_destaque)?>><?php echo($rs_func['nome'])?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                    <p>Foto:
                                        <input id="file_destaque" type="file" name="ft_destaque">
                                    </p>
                                    <textarea name="txt_destaque" id="area_frm_destaque" placeholder="Sobre o evento destaque:"><?php echo($sobre_destaque_mostrar)?></textarea>
                                    <input name="btn_destaque"type="submit" id="btn_destaque" value="<?php echo($btn_destaque)?>">
                                </form>
                            </div>
                        </div>
                    
                    <?php }elseif($tipo_conteudo==2){?>
                        <div class="cima">
                            <div class="voltar">
                                <a href="admConteudo.php"><img id="icn_voltar" src="img/icn/back.png"></a>
                            </div>
                            <div class="even">
                                <img class="icn_reps" src="img/icn/loja.png">
                                <div class="title_reps">Loja</div>
                                <img class="icn_reps" src="img/icn/loja.png">
                            </div>
                        </div>
                        <div class="baixo">
                            <div id="mostrar_loja">
                                <div id="ref_loja">
                                    <div id="titulo_kit_ref">Titulo</div>
                                    <div class="borda_kit_ref"></div>
                                    <div id="preco_kit_ref">Preço</div>
                                    <div class="borda_kit_ref"></div>
                                    <div id="img_kit_ref">Imagem</div>
                                    <div class="borda_kit_ref"></div>
                                    <div id="opt_kit_ref">Opções</div>
                                </div>
                                <div id="loja_cont">
                                    <?php
                                        $sql="select * from tbl_produtos order by ativado desc";
                                        $select=mysql_query($sql);
                                        while($rs=mysql_fetch_array($select)){
                                    ?>
                                    <div class="linha_loja">
                                        <div class="titulo_kit">
                                            <textarea class="titulo_kit_area" readonly="true" ><?php echo($rs['nome'])?></textarea>
                                        </div>
                                        <div class="borda_kit"></div>
                                        <div class="preco_kit">
                                            <textarea class="preco_kit_area" readonly="true"><?php echo("R$".$rs['preco'])?></textarea>
                                        </div>
                                        <div class="borda_kit"></div>
                                        <div class="img_kit_div">
                                            <img class="img_kit" src="<?php echo($rs['img'])?>">
                                        </div>
                                        <div class="borda_kit"></div>
                                        <div class="opt_kit">
                                            <?php 
                                                if($rs['ativado']==0){
                                                    $cond = "<div class='cond_kit_desativ'>Desativado</div>";
                                                    $cond_class="ativ_kit";
                                                    $cond_value="Ativar";
                                                }elseif($rs['ativado']==1){
                                                    $cond = "<div class='cond_kit_ativ'>Ativado</div>";
                                                    $cond_class="desativ_kit";
                                                    $cond_value="Desativar";
                                                }
                                            ?>
                                            <div class="cond_kit_desativ"><?php echo($cond)?></div>
                                            <form name="frm_opt_kit" class="frm_opt_kit" method="post" action="admConteudo.php?conteudo=2&kit_id=<?php echo($rs['id_produto'])?>">
                                                <input name="btn_cond_kit" type="submit" class="<?php echo($cond_class)?>" value="<?php echo($cond_value)?>">
                                            </form>
                                            <div class="actions_loja">
                                                <a href="admConteudo.php?conteudo=2&editarKit=1&idItem=<?php echo($rs['id_produto'])?>">
                                                    <img class="icn_action_loja" src="img/icn/edit.png" title="Editar">
                                                </a>
                                                <a href="functions/excluir_registro.php?tela=contLoja&idItem=<?php echo($rs['id_produto'])?>">
                                                    <img class="icn_action_loja" src="img/icn/garbage.png" title="Excluir">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div id="abt_conteudo_loja">
                                <div class="titulo_cont"><?php echo($div_titulo_kit_mostrar)?></div>
                                <form id="frm_kit" enctype="multipart/form-data" name="frmNovaHistória" method="post" action="admConteudo.php?conteudo=2&idItem_kit=<?php echo($idItem_kit)?>">
                                    <input class="txt_frm_kit" name="txt_titulo_kit" type="text" placeholder="Nome" maxlength="45" value="<?php echo($nome_kit_mostrar)?>"><br/>
                                    <input class="txt_frm_kit" name="txt_preco_kit" type="number" placeholder="Preço" maxlength="45" value="<?php echo($preco_kit_mostrar)?>"><br/>
                                    <div id="item_frm_kit">Foto:<br/>
                                    <input id="file_kit" type="file" name="ft_kit"></div>
                                    <textarea name="txt_desc_kit" id="text_frm_kit" placeholder="Sobre o produto:"><?php echo($desc_kit_mostrar)?></textarea>
                                    <input id="btn_kit" type="submit" name="btn_kit" value="<?php echo($btn_kit)?>">
                                </form>
                            </div>
                            
                        </div>
                    
                    <?php }elseif($tipo_conteudo==3){?>
                        <div class="cima">
                            <div class="voltar">
                                <a href="admConteudo.php"><img id="icn_voltar" src="img/icn/back.png"></a>
                            </div>
                            <div class="even">
                                <img class="icn_reps" src="img/icn/discount.png">
                                <div class="title_reps">Promoções</div>
                                <img class="icn_reps" src="img/icn/discount.png">
                            </div>
                        </div>
                        <div class="baixo">
                            <div id="mostrar_promo">
                                <div id="ref_promo">
                                    <div id="nome_promo_ref">Nome</div>
                                    <div class="borda_promo_ref"></div>
                                    <div id="preco_promo_ref">Preço</div>
                                    <div class="borda_promo_ref"></div>
                                    <div id="off_promo_ref">Promoção</div>
                                    <div class="borda_promo_ref"></div>
                                    <div id="img_promo_ref">Imagem</div>
                                    <div class="borda_promo_ref"></div>
                                    <div id="opt_promo_ref">Opções</div>
                                </div>
                                <div id="promo_cont">
                                    <?php
                                        $sql="select pr.nome, pr.preco, pr.img, p.preco_promo, p.ativado, p.id_promocao from tbl_produtos as pr inner join tbl_promocao as p on pr.id_produto = p.id_produto";
                                        $select = mysql_query($sql);
                                        while($rs=mysql_fetch_array($select)){
                                    ?>
                                    <div class="linha_promo">
                                        <div class="nome_promo">
                                            <textarea class="nome_promo_area" readonly="true"><?php echo($rs['nome'])?></textarea>
                                        </div>
                                        <div class="borda_promo"></div>
                                        <div class="preco_promo">
                                            <div class="txt_promo_money"><?php echo("R$".$rs['preco'])?></div>
                                        </div>
                                        <div class="borda_promo"></div>
                                        <div class="off_promo">
                                            <div class="txt_promo_money"><?php echo("R$".$rs['preco_promo'])?></div>
                                        </div>
                                        <div class="borda_promo"></div>
                                        <div class="img_promo_div">
                                            <img class="img_promo" src="<?php echo($rs['img'])?>">
                                        </div>
                                        <div class="borda_promo"></div>
                                        <div class="opt_promo">
                                            <?php 
                                                if($rs['ativado']==0){
                                                    $cond = "<div class='cond_promo_desativ'>Desativado</div>";
                                                    $cond_class="ativ_promo";
                                                    $cond_value="Ativar";
                                                }elseif($rs['ativado']==1){
                                                    $cond = "<div class='cond_promo_ativ'>Ativado</div>";
                                                    $cond_class="desativ_promo";
                                                    $cond_value="Desativar";
                                                }
                                            ?>
                                            <div class="cond_news_desativ"><?php echo($cond)?></div>
                                            <form name="frm_opt_promo" class="frm_opt_promo" method="post" action="admConteudo.php?conteudo=3&promo_id=<?php echo($rs['id_promocao'])?>">
                                                <input name="btn_cond_promo" type="submit" class="<?php echo($cond_class)?>" value="<?php echo($cond_value)?>">
                                            </form>
                                            <div class="actions_news">
                                                <a href="admConteudo.php?conteudo=3&editarPromo=1&idItem=<?php echo($rs['id_promocao'])?>">
                                                    <img class="icn_action_promo" src="img/icn/edit.png" title="Editar">
                                                </a>
                                                <a href="functions/excluir_registro.php?tela=contPromo&idItem=<?php echo($rs['id_promocao'])?>">
                                                    <img class="icn_action_promo" src="img/icn/garbage.png" title="Excluir">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div id="abt_conteudo_promo">
                                <div class="titulo_cont"><?php echo($div_titulo_promo_mostrar);?></div>
                                <form id="frm_promo" name="frm_new_promo" method="post" action="admConteudo.php?conteudo=3&idItem_promo=<?php echo($idItem_promo)?>">
                                    Evento:<br/>
                                    <select id="slc_promo" name="slc_produtos">
                                        <?php
                                            echo($opt_ref_promo);
                                            $sql_func = "select * from tbl_produtos";
                                            $select_func = mysql_query($sql_func);
                                            while($rs_func=mysql_fetch_array($select_func)){
                                                $opt_selected_destaque = null;
                                                if($rs_func['id_produto']==$id_evento){$opt_selected_destaque="selected";}
                                        ?>
                                            <option value="<?php echo($rs_func['id_produto'])?>" <?php echo($opt_selected_destaque)?>><?php echo($rs_func['nome'])?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                    <input class="input_promo" type="number" name="txt_desconto" placeholder="Porcentagem de desconto:" value="<?php echo($porcentagem_promo)?>">
                                    <input id="btn_promo" type="submit" name="btn_promo" value="<?php echo($btn_promo)?>">
                                </form>
                            </div>
                        </div>
                    <?php }elseif($tipo_conteudo==4){?>
                        <div class="cima">
                            <div class="voltar">
                                <a href="admConteudo.php"><img id="icn_voltar" src="img/icn/back.png"></a>
                            </div>
                            <div class="even">
                                <img class="icn_reps" src="img/icn/news.png">
                                <div class="title_reps">Notícias</div>
                                <img class="icn_reps" src="img/icn/news.png">
                            </div>
                        </div>
                        <div class="baixo">
                            <div id="mostrar_news">
                                <div id="ref_news">
                                    <div class="texto_news_ref">Título</div>
                                    <div class="borda"></div>
                                    <div class="texto_news_ref">Texto</div>
                                    <div class="borda"></div>
                                    <div id="img_news_ref">Imagem</div>
                                    <div class="borda"></div>
                                    <div id="opt_news_ref">Opções</div>
                                </div>
                                <div id="news_cont">
                                    <?php
                                        $sql="select * from tbl_noticias order by condicao desc";
                                        $select = mysql_query($sql);
                                        while($rs=mysql_fetch_array($select)){
                                    ?>
                                    <div class="linha_news">
                                        <div class="texto_titulo_news">
                                            <textarea class="area_titulo_news" readonly="true"><?php echo($rs['titulo'])?></textarea>
                                        </div>
                                        <div class="borda_cont"></div>
                                        <div class="texto_cont_news">
                                            <textarea class="area_texto_news" readonly="true"><?php echo($rs['texto'])?></textarea>
                                        </div>
                                        <div class="borda_cont"></div>
                                        <div class="img_news_div">
                                            <img class="img_news" src="<?php echo($rs['img'])?>">
                                        </div>
                                        <div class="borda_cont"></div>
                                        <div class="opt_news">
                                            <?php 
                                                if($rs['condicao']==0){
                                                    $cond = "<div class='cond_news_desativ'>Desativado</div>";
                                                    $cond_class="ativ_news";
                                                    $cond_value="Ativar";
                                                }elseif($rs['condicao']==1){
                                                    $cond = "<div class='cond_news_ativ'>Ativado</div>";
                                                    $cond_class="desativ_news";
                                                    $cond_value="Desativar";
                                                }
                                            ?>
                                            <div class="cond_news_desativ"><?php echo($cond)?></div>
                                            <form name="frm_opt_news" class="frm_opt_news" method="post" action="admConteudo.php?conteudo=4&news_id=<?php echo($rs['id_noticia'])?>">
                                                <input name="btn_cond_news" type="submit" class="<?php echo($cond_class)?>" value="<?php echo($cond_value)?>">
                                            </form>
                                            <div class="actions_news">
                                                <a href="admConteudo.php?conteudo=4&editarNews=1&idItem=<?php echo($rs['id_noticia'])?>">
                                                    <img class="icn_action_news" src="img/icn/edit.png" title="Editar">
                                                </a>
                                                <a href="functions/excluir_registro.php?tela=contNews&idItem=<?php echo($rs['id_noticia'])?>">
                                                    <img class="icn_action_news" src="img/icn/garbage.png" title="Excluir">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div id="abt_conteudo_news">
                                <div class="titulo_cont"><?php echo($div_titulo_news_mostrar)?></div>
                                <form id="frm_news" enctype="multipart/form-data" name="frm_new_história" method="post" action="admConteudo.php?conteudo=4&idItem=<?php echo($idItem_news)?>">
                                    <input id="title_frm_news" name="txt_titulo_news" type="text" placeholder="Título" maxlength="45" value="<?php echo($titulo_news_mostrar)?>"><br/>
                                    <div id="item_frm_news">Foto:<br/>
                                    <input id="file_news" type="file" name="ft_news"></div>
                                    <textarea name="txt_news" id="text_frm_news" placeholder="Texto da notícica:"><?php echo($texto_news_mostrar)?></textarea>
                                    <input id="btn_news" type="submit" name="btn_news" value="<?php echo($btn_news)?>">
                                </form>
                            </div>
                        </div>
                    
                    <?php }elseif($tipo_conteudo == 5){?>
                        <div class="cima">
                            <div class="voltar">
                                <a href="admConteudo.php"><img id="icn_voltar" src="img/icn/back.png"></a>
                            </div>
                            <div class="even">
                                <img class="icn_reps" src="img/icn/race.png">
                                <div class="title_reps">História da Corrida</div>
                                <img class="icn_reps" src="img/icn/race.png">
                            </div>
                        </div>
                        <div class="baixo">
                            <div id ="mostrar_hist">
                                <div id="ref_hist">
                                    <div class="img_hist_ref">Imagem 1</div>
                                    <div class="borda"></div>
                                    <div class="img_hist_ref">Imagem 2</div>
                                    <div class="borda"></div>
                                    <div id="texto_hist_ref">Texto</div>
                                    <div class="borda"></div>
                                    <div id="opt_hist">Condição</div>
                                </div>
                                <div id="hist_cont">
                                    <?php 
                                        $sql="select * from tbl_historia order by condicao desc";
                                        $select = mysql_query($sql);
                                        while($rs = mysql_fetch_array($select)){
                                    ?>
                                    <div class = "linha_cont">
                                        <div class="img_hist_div"> 
                                            <img class="img_hist" src="<?php echo($rs['img_1'])?>">
                                        </div>
                                        <div class="borda_cont"></div>
                                        <div class="img_hist_div">
                                            <img class="img_hist" src="<?php echo($rs['img_2'])?>">
                                        </div>
                                        <div class="borda_cont"></div>
                                        <div class="texto_hist_div">
                                            <textarea readonly="readonly" name="texto" class="texto_hist"><?php echo($rs['texto'])?></textarea>
                                        </div>
                                        <div class="borda_cont"></div>
                                        <div class="cond_hist">
                                            <?php 
                                                if($rs['condicao']==0){
                                                    $cond = "<div class='cond_desativado'>Desativado</div>";
                                                    $cond_class="btn_ativ";
                                                    $cond_value="Ativar";
                                                }elseif($rs['condicao']==1){
                                                    $cond = "<div class='cond_ativado'>Ativado</div>";
                                                    $cond_class="btn_desativ";
                                                    $cond_value="Desativar";
                                                }
                                            ?>
                                                <?php echo($cond) ?>
                                                <form name="frm_opt" class="frm_opt" method="post" action="admConteudo.php?conteudo=5&id_hist=<?php echo($rs['id_historia'])?>">
                                                    <input class="<?php echo($cond_class)?>" type="submit" name="btn_opt_hist" value="<?php echo($cond_value)?>">
                                                </form>
                                                <div class="opt_edit">
                                                    <div class="opt_hist">
                                                        <a href="admConteudo.php?conteudo=5&editarHist=1&idItem=<?php echo($rs['id_historia'])?>">
                                                            <img class="icn_opt_hist" src="img/icn/edit.png" title="Editar">
                                                        </a>
                                                    </div>
                                                    <div class="opt_hist">
                                                        <a href="functions/excluir_registro.php?tela=contHist&idItem=<?php echo($rs['id_historia'])?>">
                                                            <img class="icn_opt_hist" src="img/icn/garbage.png" title="Excluir">
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div id="abt_conteudo_hist">
                                <div class="titulo_cont"><?php echo($titulo_hist_mostrar)?></div>
                                <form id="frm_hist" enctype="multipart/form-data" name="frmNoaHistória" method="post" action="admConteudo.php?conteudo=5&idItem=<?php echo($idItem_hist)?>">
                                    <div class="item_frm_hist">
                                        Foto 1: <br>
                                        <input class="file_hist" type="file" name="ft_hist1">
                                    </div>
                                    <div class="item_frm_hist">
                                        Foto 2: <br>
                                        <input class="file_hist" type="file" name="ft_hist2">
                                    </div>
                                    <div id="txt_hist_div">
                                        Texto:
                                        <textarea name="txt_hist" id="txt_hist"><?php echo($texto_hist_mostrar)?></textarea>
                                    </div>
                                    <input id="btn_hist" name="btn_hist" type="submit" value="<?php echo($btn_hist)?>">
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <footer>
                Desenvolvido por: Paulo Henrique Lima Ferreira
            </footer>
        </div>
    </body>
</html>