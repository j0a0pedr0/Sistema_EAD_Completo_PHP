<?php
    include("../../includeConstants.php");
    $data['sucesso'] = true;
    $data['mensagem'] = '';

    if(Painel::logado() == false){
        die("Ops, Não sei oq Ha");
    }


    if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_cliente'){
        sleep(2);
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo_cliente'];
        $cpf_cnpj = '';
        $imagem = '';

        if($nome == '' || $email == '' || $tipo == ''){
            $data['sucesso'] = false;
            $data['mensagem'] = 'Atenção! Campos vazios não são permitidos';
        }

        if($tipo == 'fisico'){
            $cpf_cnpj = $_POST['cpf'];
        }else{
            $cpf_cnpj = $_POST['cnpj'];
        }

        if(isset($_FILES['imagem'])){
            if(Painel::imagemValida($_FILES['imagem'])){             
                $imagem = $_FILES['imagem'];
            }else{
                $imagem = "";
                $data['sucesso'] = false;
                $data['mensagem'] = 'Você está tentando realizar um upload de uma imagem invalida';
            }
        }

        if($data['sucesso']){
            //tudo okay so cadastrar
            if(is_array($imagem))
                $imagem = Painel::uploadFile($imagem);

            $sql = Mysql::conectar()->prepare("INSERT INTO `tb_admin.clientes` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($nome,$email,$tipo,$cpf_cnpj,$imagem));
            $data['mensagem'] = 'Você cadastrou o cliente com sucesso!';
        }

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'editar_cliente'){
        sleep(2);
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo_cliente'];
        $cpf_cnpj = '';
        $imagem = $_POST['imagem_original'];
        $id = $_POST['id'];

        if($tipo == 'fisico'){
            $cpf_cnpj = $_POST['cpf'];
        }else{
            $cpf_cnpj = $_POST['cnpj'];
        }

        if($nome == '' || $email == '' || $cpf_cnpj == ''){
            $data['sucesso'] = false;
            $data['mensagem'] = 'Atenção! Campos vazios não são permitidos';
        }
        
        if(isset($_FILES['imagem'])){
            if(Painel::imagemValida($_FILES['imagem'])){       
                @unlink('../uploads/'.$imagem);      
                $imagem = $_FILES['imagem'];
            }else{
                $data['sucesso'] = false;
                $data['mensagem'] = 'Você está tentando realizar um upload de uma imagem invalida';
            }
        }

        if($data['sucesso']){
            if(is_array($imagem))
                $imagem = Painel::uploadFile($imagem);
            
            $sql = Mysql::conectar()->prepare("UPDATE `tb_admin.clientes` SET nome=?,email=?,tipo=?,cpf_cnpj=?,imagem=? WHERE id=$id");
            $sql->execute(array($nome,$email,$tipo,$cpf_cnpj,$imagem));
            $data['mensagem'] = 'O cliente foi editado com sucesso!';
        }
    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'deletar_cliente'){
            
        $id = $_POST['id'];
        $sql = Mysql::conectar()->prepare("SELECT imagem FROM `tb_admin.clientes` WHERE id = $id");
        $sql->execute();
        $imagem = $sql->fetch()['imagem'];
        @unlink('../uploads/'.$imagem);
        Mysql::conectar()->exec("DELETE FROM `tb_admin.clientes` WHERE id = $id");
        Mysql::Conectar()->exec("DELETE FROM `tb_admin.financeiro` WHERE `cliente_id` =$id");

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'deletar_produto'){
        $itemId = (int)$_POST['id'];
        $itemName = $_POST['nome'];
        $sql = MySql::Conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $itemId");
        $sql->execute();
        $imagensItem = $sql->fetchAll();
        foreach($imagensItem as $key => $value){
            @unlink(BASE_DIR_PAINEL.'/uploads/'.$value['imagem']);
        }
        Mysql::Conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE produto_id = $itemId");
        Mysql::Conectar()->exec("DELETE FROM `tb_admin.estoque` WHERE id = $itemId");
        Painel::alert('sucesso','Você Excluiu com sucesso o Produto do estoque!','margin-top:60px;');
    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'delete-imagem'){
        $itemId = $_POST['id'];
        $item_name = $_POST['imagem'];
        @unlink(BASE_DIR_PAINEL.'/uploads/'.$item_name);
        Mysql::Conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE id=$itemId");
    }

    die(json_encode($data));

?>