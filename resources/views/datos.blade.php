<?php
    
    function conexion(){
        $hostDB = '127.0.0.1';
        $nomDB = 'desayunosfeministas';
        $usuarioDB = 'root';
        $contraseñaDB = '';
        $hostPDO = "mysql:host=$hostDB; dbname=$nomDB;";
        try{
            $miPDO = new PDO( $hostPDO, $usuarioDB, $contraseñaDB);
            $miPDO->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
            $miPDO->exec("set names  utfrmb4");
            return $miPDO;
            
        }catch(PDOException $e){
            echo "Error de conexion";
        }
    }
    
    $conex = conexion();
    $consulta = $conex->prepare('SELECT nombre,foto FROM mujeres');
    $consulta->execute();
    $salida = $consulta->fetchAll();
    $nombres = [];
    $fotos = [];
   foreach($salida as $s => $datos){
     
     // $nombres = $datos['nombre'];
     // print_r($nombres);
        array_push($nombres,$datos['nombre']);
        array_push($fotos,$datos['foto']);  
   } 
    print_r($nombres); 
?>
