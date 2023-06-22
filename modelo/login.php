<?php
require "conexion/conexionBase.php";

class Login
{
    private $nick;
    private $pass;
    private $con;

    function __construct()
    {
        $this->nick = "";
        $this->pass = "";
        $this->con = new conexionBase();
    }
    function asignar($nom, $valor)
    {
        $this->$nom = $valor;
    }
     //valida si la persona existe
     function validar()
     {
         $this->con->CreateConnection();
         $sql = "select * from usuario u join persona p on u.persona_idpersona=p.idpersona
         join rol r on r.idrol=u.rol_idrol where u.nick='$this->nick'";
         $resp = $this->con->ExecuteQuery($sql);
         $da=mysqli_fetch_assoc($resp);
         $re = $this->con->GetCountAffectedRows($resp);
         if ($re > 0) {
            $res=password_verify($this->pass,$da['pass']);
            if($res){
                echo json_encode(array('exito' => 1,'data'=>$da),JSON_UNESCAPED_UNICODE);
            }
            else {
                echo json_encode(array('exito' =>0,'msg'=>'Clave incorrecta'));
            }
         } else {
            echo json_encode(array('exito' => 0, 'msg' => "Usuario incorrecto"));
         }
     }

}