<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fontawesome-free-6.1.1-web/css/all.css">
    <title>EAD JP</title>
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />
<header>
    <div class="center">
        <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>">EAD JP</a></div>

        <nav>
            <ul>
            <?php
                if(isset($_SESSION['login_aluno']))
                    echo '<li><a href="'.INCLUDE_PATH.'?deslogar"><i class="fa-solid fa-arrow-right-from-bracket"></i> Deslogar</a></li>';
                else{
                    echo '<li><a href="'.INCLUDE_PATH.'Conheca-curso"><i class="fa-solid fa-cart-shopping"></i>Conheça o Curso</a></li>';
                    echo '<li><a href="'.INCLUDE_PATH.'sobre">Sobre</a></li>';
                    echo '<li><a href="'.INCLUDE_PATH.'contato">Contato</a></li>';
                }
            ?>
            </ul>
        </nav>
    </div><!--center-->
</header>
    
