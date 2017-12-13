<?php
    session_start();
    //ACESSANDO O BANCO
    include('conMysql.php');

    if(isset($_GET['tela'])){
        if($_GET['tela']=="fale"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_fale WHERE id_fale=".$idItem;
            mysql_query($sql);
            header('location:../admFale.php');
        }
        if($_GET['tela']=="contDestaque"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_destaque where id_destaque=".$idItem;
            mysql_query($sql);
            header('location:../admConteudo.php?conteudo=1');
        }
        if($_GET['tela']=="contLoja"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_produtos where id_produto=".$idItem;
            mysql_query($sql);
            header('location:../admConteudo.php?conteudo=2');
        }
        if($_GET['tela']=="contPromo"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_promocao where id_promocao=".$idItem;
            mysql_query($sql);
            header('location:../admConteudo.php?conteudo=3');
        }
        if($_GET['tela']=="contNews"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_noticias where id_noticia=".$idItem;
            mysql_query($sql);
            header('location:../admConteudo.php?conteudo=4');
        }
        if($_GET['tela']=="contHist"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_historia where id_historia=".$idItem;
            mysql_query($sql);
            header('location:../admConteudo.php?conteudo=5');
        }
    }
    
?>