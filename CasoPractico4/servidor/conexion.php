<?php
class Conexion extends PDO{
    private $tipo_de_base='mysql';
    private $host='localhost';
    private $nombre_de_base='reloj';
    private $usuario='root';
    private $contrasena='';
    public function __construct(){
        try {
        parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};
        host={$this->host};charset=utf8",$this->usuario,$this->contrasena);
        }catch(PDOException $e){
            echo $e->getMessage( );
        }
    }
}
?>

