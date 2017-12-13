<?php
    include('conMysql.php');
    $id_hist = $_GET['idItem'];
    $sql="select * from tbl_historia where id_historia=".$id_hist;
    $select=mysql_query($sql);
    $rs=mysql_fetch_array($select);

    $img1= explode("/", $rs['img_1']);
    $img2= explode("/", $rs['img_2']);
    echo($img1[3]);
    echo($img2[3]);
    
?>