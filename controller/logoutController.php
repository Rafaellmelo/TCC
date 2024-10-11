<?php
include_once('../includes/db.php');
include_once('../model/login.php');
class LogoutController {
    public function logout() {
        $db = new DataBase();
        $db->conectar();
        $login = new Login("", "");
        $login->logout();
        
    }
}

$logout = new LogoutController();
$logout->logout();