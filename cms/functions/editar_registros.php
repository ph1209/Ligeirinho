<?php
    session_start();
    //ACESSANDO O BANCO
    $con = mysql_connect("127.0.0.1", "root", "bcd127") or die ("Sem conexão com o servidor");
    $banco = mysql_select_db("db_phligeirinho") or die("Sem acesso ao DB");
    //RECUPERANDO DADOS DO BANCO
    if(isset($_GET['tela'])){
        if($_GET['tela']=="fale"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_fale WHERE id_fale=".$idItem;
            mysql_query($sql);
            header('location:../admFale.php');
        }
        if($_GET['tela']=="contHist"){
            $idItem = $_GET['idItem'];
            $sql="delete from tbl_historia where id_historia=".$idItem;
            mysql_query($sql);
            header('location:../admConteudo.php?conteudo=5');
        }
    }
    
?>