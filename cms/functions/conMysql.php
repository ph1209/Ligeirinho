<?php
    $con = mysql_connect("127.0.0.1", "root", "bcd127") or die ("Sem conexão com o servidor");
    $banco = mysql_select_db("db_phligeirinho") or die("Sem acesso ao DB");
?>