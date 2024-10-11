<?php
include_once('../includes/db.php');
include('../model/membro.php');

class trocarSenhaController {
    public function trocarSenha(){
        $db = new DataBase();
        $db->conectar();
        $membros = new Membros("","","","","","","");
        if(isset($_POST['nova_senha'])){
            if($membros->trocarSenha($_POST['nova_senha'])){
                header("Location: ../view/welcome.php?msg=Senha alterada com sucesso");
            }else{
                echo "Erro ao atualizar a senha: " . $db->getConexao()->error;
            }
        }else{
            echo "Por favor, preencha todos os campos!";
        }
       
    }
    }
$trocarSenha = new trocarSenhaController();
$trocarSenha->trocarSenha();        
