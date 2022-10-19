<?php
require_once("lib/nusoap.php");
require_once("conexion.php");

//Metodos
function InsertarRelojes($codigo,$marcas,$genero,$tipo,$material,$color,$precio){
    try {
        $conectar=new Conexion();
$consulta=$conectar->prepare("INSERT INTO reloj(Codigo,Marcas,Genero,Tipo,Material,Color,Precio)
VALUES(:codigo,:marcas,:genero,:tipo,:material,:color,:precio)");
$consulta->bindParam(":codigo",$codigo,PDO::PARAM_INT);
$consulta->bindParam(":marcas",$marcas,PDO::PARAM_STR);
$consulta->bindParam(":genero",$genero,PDO::PARAM_STR);
$consulta->bindParam(":tipo",$tipo,PDO::PARAM_STR);
$consulta->bindParam(":material",$material,PDO::PARAM_STR);
$consulta->bindParam(":color",$color,PDO::PARAM_STR);
$consulta->bindParam(":precio",$precio,PDO::PARAM_STR);
$consulta->execute();
$ultimoId=$conectar->lastInsertId();
return join(",",array($ultimoId));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
//METODO READ
function ObtenerDato(){
    $consulta=$conectar->prepare("SELECT * FROM reloj");
    $consulta->execute();
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    return $consulta->fetchAll();
}
//METODO UPDATE
function ModificarDatos($codigo,$marcas,$genero,$tipo,$material,$color,$precio){
    $consulta=$conectar->prepare("UPDATE reloj SET Codigo=:codigo,Marcas=:marcas,Genero=:genero,Tipo=:tipo,Material=:material,Color=:color,Precio=:precio WHERE Codigo=codigo");
    $consulta->bindParam(":codigo",$codigo,PDO::PARAM_STR);
        $consulta->bindParam(":marcas",$marcas,PDO::PARAM_STR);
        $consulta->bindParam(":genero",$genero,PDO::PARAM_STR);
        $consulta->bindParam(":tipo",$tipo,PDO::PARAM_STR);
        $consulta->bindParam(":material",$material,PDO::PARAM_STR);
        $consulta->bindParam(":color",$color,PDO::PARAM_STR);
        $consulta->bindParam(":precio",$precio,PDO::PARAM_STR);
        $consulta->execute();
        return 1;
}
//METODO DELETE
function EliminarDatos($codigo){
    $conectar=new Conexion();
    $consulta=$conectar->prepare("DELETE FROM reloj WHERE Codigo=:codigo");
    $consulta->bindParam(":codigo",$codigo,PDO::PARAM_INT);
    $consulta->execute();
    $ultimoId=$conectar->lastInsertId();
    return join(",",array($ultimoId));
}
}
$server=new soap_server();
$server->configureWSDL('usuarioservice',"urn:usuarioservice");
$server->wsdl->schemaTargetNamespace="urn:usuarioservice";
$server->register(
'InsertarRelojes',
array('codigo'=>'xsd:integer','marcas'=>'xsd:string','genero'=>'xsd:string','tipo'=>'xsd:string','material'=>'xsd:string','color'=>'xsd:string','precio'=>'xsd:integer'),
array('return'=>'xsd:string'),
'urn:usuarioservice',
'urn:usuarioservice#InsertarRelojes',
'rpc',
'encoded',
'insertar relojes a reloj'
);
$server->register(
    'ObtenerDato',
    array('codigo'=>'xsd:integer','marcas'=>'xsd:string','genero'=>'xsd:string','tipo'=>'xsd:string','material'=>'xsd:string','color'=>'xsd:string','precio'=>'xsd:integer'),
    array('return'=>'xsd:string'),
    'urn:usuarioservice',
    'urn:usuarioservice#InsertarRelojes',
    'rpc',
    'encoded',
    'insertar relojes a reloj'
    );
$server->register(
    'ModificarDatos',
    array('codigo'=>'xsd:integer','marcas'=>'xsd:string','genero'=>'xsd:string','tipo'=>'xsd:string','material'=>'xsd:string','color'=>'xsd:string','precio'=>'xsd:integer'),
    array('return'=>'xsd:string'),
    'urn:usuarioservice',
    'urn:usuarioservice#EliminarDatos',
    'rpc',
    'encoded',
    'insertar relojes a reloj'
    );
    $server->register(
        'EliminarDatos',
        array('codigo'=>'xsd:integer'),
        array('return'=>'xsd:string'),
        'urn:usuarioservice',
        'urn:usuarioservice#InsertarRelojes',
        'rpc',
        'encoded',
        'insertar relojes a reloj'
        );
$post=file_get_contents('php://input');
$server->service($post);
?>