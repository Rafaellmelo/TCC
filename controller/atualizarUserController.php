<?php
include_once('../includes/db.php');
include('../model/membro.php');
class atualizarUserController{
    public function atualizarUser(){
        $db = new DataBase();
        $db->conectar();
        $membro = new Membros("","","","","","","");
        if(isset($_POST['novo_usuario'])){
            if($membro->atualizarUser($_POST['novo_usuario'])){
                header("Location: ../view/welcome.php?msg=Nome de usuário alterado com sucesso!");
            }else{
                echo "Erro ao atualizar o nome de usuário: " . $db->getConexao()->error;
            }
        }else {
            echo "Por favor, insira um novo nome de usuário!";
        }
         
        
    }
}
$atualizar = new atualizarUserController();
$atualizar->atualizarUser();