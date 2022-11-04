<div class="box-content editarUsuario w100">
    <h2 class="w100" ><i class="fa-solid fa-envelope-open-text"></i>  Cadastar Aluno</h2>

    <form method="POST" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                //Enviei o meu formulário

                $nome = $_POST['nome'];
                $senha = $_POST['senha'];
                $email = $_POST['email'];

                if($nome == '' || $senha == '' || $email == ''){
                    Painel::alert('erro','Você precisa preencher todos os campos!!');
                }else{
                    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_admin.alunos` VALUES (null,?,?,?)");
                    $sql->execute(array($nome,$email,$senha));
                    Painel::alert('sucesso','Aluno cadastrado com sucesso');
                }
            }
        ?>

        <div class="form-group">
            <label><i class="fa-solid fa-user"></i> Nome do Aluno:</label>
            <input type="text" name="nome" placeholder="Nome..." />
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-key"></i> Senha</label>
            <input type="password" name="senha" placeholder="Senha..."></input>
        </div><!--form-group-->

        <div class="form-group">
            <label><i class="fa-solid fa-at"></i> E-Mail</label>
            <input type="email" name="email"  placeholder="Email..."/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div><!--form-group-->
    </form>
</div><!--box-content-->