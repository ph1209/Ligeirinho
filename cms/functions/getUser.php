<?php
    $result = mysql_query("SELECT * FROM tbl_users WHERE usuario = '$login'");
    if(mysql_num_rows ($result) > 0 ){
        $result_array = mysql_fetch_array($result);
        $nome =$result_array['nome'];
        $id_funcao_user=$result_array['id_nivel'];
    }else{$nome = $login;}
?>