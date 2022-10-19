<?php
require_once("lib/lib/nusoap.php");
$urlServicio=new nusoap_client('http://localhost/CasoPractico4/servidor/RelojesServer.php');
$resultado=$urlServicio->call('InsertarRelojes',
array('codigo'=>'1234','marcas'=>'rolex','genero'=>'unisex','tipo'=>'digital','material'=>'titanio','color'=>'negro','precio'=>'10000'));
echo $resultado;
?>