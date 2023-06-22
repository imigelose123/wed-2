<?php
 include "../modelo/Login.php";
 $per = new Login();
$data = json_decode(file_get_contents("php://input"), true);
$nick="";
$pass="";
if ($data) {
    if (isset($data['nick']) && $data['nick']) {
        $nick = htmlspecialchars($data['nick']);
    } else{
        echo json_encode(array('exito' => 0, 'msg' => 'No se envio el nick'));
        die();
    }
    if (isset($data['pass']) && $data['pass']) {
        $pass = htmlspecialchars($data['pass']);
    } else{
        echo json_encode(array('exito' => 0, 'msg' => 'No se envio el pass'));
        die();
    }
   
    $per->asignar("nick", $nick);
    $per->asignar("pass", $pass);
    $per->validar();
} else {
    echo json_encode(array('exito' => 0, 'msg' => 'No se realizo la peticion correctamente'));
}
