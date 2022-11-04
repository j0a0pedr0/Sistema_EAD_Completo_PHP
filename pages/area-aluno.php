<div class="area-aluno">
    <div class="center">
        <div class="h2-aluno w100"><h2>Seja Bem-vindo <?php echo $_SESSION['nome_aluno']; ?>, O que Vamos estudar hoje?</h2></div>
        
        <?php if(\Models\HomeModel::hasByIdAluno($_SESSION['id'])){ ?>
                <div class="apresentacao-wrap w100">
                    <div class="w100 modulos-h2"><h3>Escolhas Quais Aulas irá estudar hoje!!</h3></div>
                    <div class="modulos">
                        <?php foreach(\Models\HomeModel::listaModulos() as $key => $value){ ?>
                            <div class="modulo-single w100">
                                <h2><?php echo $value['nome']; ?></h2>
                                <?php foreach(\Models\HomeModel::listarAulas($value['id']) as $key => $valueAula){ ?>
                                    <p><a href="<?php echo INCLUDE_PATH; ?>aula_single/<?php echo $valueAula['id']; ?>"><i class="fa-solid fa-play"></i> <?php echo $valueAula['nome'] ?></a></p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="apresentacao-wrap w100">
                    <h3 class="w100 h2-apresentacao">Você ainda não é aluno, conheça o curso no video abaixo:</h3>
                    <div class="apresentacao w100">
                        <iframe allow="fullscreen;" src="https://player.vimeo.com/video/582284688" frameborder="0"></iframe>
                    </div><!--apresentacao-->
                    <div class="w100 comprar-btn"><a href="<?php echo INCLUDE_PATH; ?>?addCurso">Adquerir Agora</a></div>
                </div>
            <?php }?>

    
    </div><!--center-->
</div><!--box-login-->