<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-envelope-open-text"></i>  Cadastar Módulo</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário

                $nome = $_POST['nome'];

                if($nome == ''){
                    Painel::alert('erro','Você precisa preencher todos os campos!!');
                }else{
                    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_admin.modulos` VALUES (null,?)");
                    $sql->execute(array($nome));
                    Painel::alert('sucesso','Módulo cadastrado com sucesso');
                }
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome do Módulo:</label>
            <input type="text" name="nome" placeholder="Nome..." />
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->