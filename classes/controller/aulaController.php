<?php

    namespace Controller;

    Class AulaController
    {
        public function index($arg){
            \Models\HomeModel::VerificarLoginAluno();
            \Models\HomeModel::VerificarCompraCurso($_SESSION['id']);
            $aula_id = $arg[2];
            $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_admin.aulas` WHERE id=?");
            $sql->execute(array($aula_id));
            
            $aula_info = $sql->fetch();
            if($sql->rowCount() < 1){
                echo '<script>alert("Não existe essa Aula não existe!!");</script>';
                \Painel::redirect(INCLUDE_PATH);
                die();
            }else{
                \Views\AulaViews::render('aula-single.php',$aula_info);
            }
        }
    }
?>