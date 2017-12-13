<?php
    $optCont="admConteudo.php";
    $optFale="admFale.php";
    $optProd="admCorridas.php";
    $optUser="admUsers.php";
    
    if($id_funcao_user == 2){
        //CATALOGUISTA
        $optCont="#";
        $optFale="#";
        $optUser="#";
    }elseif($id_funcao_user == 3){
        //OPERADOR BÁSICO
        $optProd="#";
    }
?>
<nav>
    <div class="opt">
        <a href="<?php echo($optCont)?>">
            <div class="img_opt">
                <img class="icn" src="img/icn/content.png" alt="">
            </div>
            <div class="nome_opt">
                Adm. Conteúdo
            </div>
        </a>
    </div>

    <div class="opt">
        <a href="<?php echo($optFale)?>">
            <div class="img_opt">
                <img class="icn" src="img/icn/dialogue.png" alt="">
            </div>
            <div class="nome_opt">
                Adm. Fale Conosco
            </div>
        </a>
    </div>

    <div id="opt_slct">
        <a href="<?php echo($optProd)?>">
            <div class="img_opt">
                <img class="icn" src="img/icn/shirt.png" alt="">
            </div>
            <div class="nome_opt">
                Adm. Produtos
            </div>
        </a>
    </div>

    <div class="opt">
        <a href="<?php echo($optUser)?>">
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