<?php

    namespace Models;

    Class HomeModel
    {
        public function logarAluno($email,$senha){
            $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_admin.alunos` WHERE email = ? AND senha = ?");
            $sql->execute(array($email,$senha));
            $info = $sql->fetch();
            if($sql->rowCount() > 0){
                $_SESSION['login_aluno'] = $email;
                $_SESSION['nome_aluno'] = $info[1];
                $_SESSION['id'] = $info[0];
                \Views\mainViews::render('area-aluno.php');
            }else{
                echo '<script>alert("Email ou Senha Incorreto!!!")</script>';
            }
        }
        public static function VerificarLoginAluno(){
            $verifica = isset($_SESSION['login_aluno']) ? true : false;
            if($verifica == false){
                \Painel::redirect(INCLUDE_PATH);
                die();
            }    
        }
        public static function VerificarCompraCurso($aluno_id){
            if(SELF::hasByIdAluno($aluno_id) == false){
                \Painel::redirect(INCLUDE_PATH);
                die();
            }
        }

        public static function hasByIdAluno($aluno_id){
            $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_admin.curso_controle` WHERE aluno_id =?");
            $sql->execute(array($aluno_id));
            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function compraCurso($aluno_id){
            \Mysql::conectar()->exec("INSERT INTO `tb_admin.curso_controle` VALUES (null,$aluno_id)");
        }
        public static function listaModulos(){
            $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_admin.modulos`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function listarAulas($modulo_id){
            $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_admin.aulas` WHERE modulo_id=?");
            $sql->execute(array($modulo_id));
            return $sql->fetchAll();
        }
    }


?>