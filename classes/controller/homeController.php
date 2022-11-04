<?php

    namespace Controller;
    use \views\mainViews;
    Class HomeController
    {
        private $homeModel,$homeView;

        public function __construct(){
           $this->homeModel = new \Models\HomeModel;
            $this->homeView = new \Views\mainViews;
        }
        
        public function index($data){

            if(!isset($_SESSION['login_aluno'])){
                if(isset($_POST['acao_login_aluno'])){
                    $this->homeModel->logarAluno($_POST['email'],$_POST['senha']);
                }
                mainViews::render('home.php',$data);
            }else{
                if(isset($_GET['addCurso'])){
                    $this->homeModel->compraCurso($_SESSION['id']);
                    \Painel::redirect(INCLUDE_PATH);
                }
                if(isset($_GET['deslogar'])){
                    unset($_SESSION['login_aluno']);
                    \Painel::redirect(INCLUDE_PATH);
                }
                $this->homeView->render('area-aluno.php');

    
            }
            
        }
    }


?>