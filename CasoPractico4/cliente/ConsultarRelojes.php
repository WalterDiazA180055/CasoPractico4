<?php
require_once("lib/lib/nusoap.php");
$urlServicio=new nusoap_client('http://localhost/CasoPractico4/servidor/RelojesServer.php');
$resultado=$urlServicio->call('ObtenerDato',[]);
echo $resultado;
?>