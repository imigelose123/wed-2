<?php
 include "../modelo/Persona.php";
 $per = new Persona();

$data = json_decode(file_get_contents("php://input"), true);
$nombre="";
$papellido="";
$sapellido="";
$celular=0;
$direccion="";
$fechanac="";
if ($data) {
    if (isset($data['nombre']) && $data['nombre']) {
        $nombre = htmlspecialchars($data['nombre']);
    } else{
        echo json_encode(array('exito' => 0, 'msg' => 'No se envio el nombre'));
        die();
    }
    if (isset($data['papellido']) && $data['papellido']) {
        $papellido=$data['papellido'];
    }else{
        echo json_encode(array('exito' => 0, 'msg' => 'No se envio el primer apellido'));
        die();
    }
    if (isset($data['sapellido']) && $data['sapellido']) {
        $sapellido=$data['sapellido'];
    }
    if (isset($data['celular']) && $data['celular']) {
        $celular=$data['celular'];
    }
    if (isset($data['direccion']) && $data['direccion']) {
        $direccion=$data['direccion'];
    }
    if (isset($data['fechanac']) && $data['fechanac']) {
        $fechanac=$data['fechanac'];
    }
   
    $per->asignar("nombre", $nombre);
    $per->asignar("papellido", $papellido);
    $per->asignar("sapellido", $sapellido);
    $per->asignar("celular", $celular);
    $per->asignar("direccion", $direccion);
    $per->asignar("fechanac", $fechanac);
    $per->validar();
} else {
    echo json_encode(array('exito' => 0, 'msg' => 'No se realizo la peticion correctamente'));
}
