<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-envelope-open-text"></i>  Cadastar Aulas</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
        
            if(isset($_POST['acao'])){
                //Enviei o meu formulário
                $modulo_id = $_POST['modulo_id'];
                $aula_link = $_POST['aula-link'];
                $nome = $_POST['nome'];

                if($modulo_id == '' || $aula_link == ''){
                    Painel::alert('erro','Você precisa preencher todos os campos!!');
                }else{
                    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_admin.aulas` VALUES (null,?,?,?)");
                    $sql->execute(array($modulo_id,$nome,$aula_link));
                    Painel::alert('sucesso','Aula cadastrada com sucesso');
                }
            }

            $modulos = \Mysql::conectar()->prepare("SELECT * FROM `tb_admin.modulos`");
            $modulos->execute();
            $modulos = $modulos->fetchAll();
        ?>

        <div class="form-group">
            <label for=""><i class="fa-solid fa-rectangle-list"></i> Selecione Módulo da Aula:</label>
            <select name="modulo_id" id="">
                <?php foreach($modulos as $key => $value){ ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div><!--form-group-->

        
        <div class="form-group">
            <label><i class="fa-solid fa-chalkboard-user"></i> Nome da Aula</label>
            <input type="text" name="nome"  placeholder="nome..."/>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-link"></i> Link da Aula</label>
            <input type="text" name="aula-link"  placeholder="link..."/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->