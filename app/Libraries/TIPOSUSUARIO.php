<?php
namespace App\Libraries;
/**

 * Enum CAQUITA

 */



final class TIPOSUSUARIO
{

    public static $tipos = [
        'Admin'=> 1 ,
        'Usuario' => 2
    ];

    public const USUARIO_NORMAL = 2;

    public const USUARIO_ADMIN  = 1;

    public const USUARIO_GUEST  = 0;

}

?>