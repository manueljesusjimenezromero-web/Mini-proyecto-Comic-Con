
<?php
    error_reporting(E_ALL);
    ini_set('display_errors','1');
    ini_set('display_startup_errors', '1');
    if ($_SERVER['REQUEST_METHOD']==='POST'){


        $nombre=$_POST['nombre']??"";
        $edad=$_POST['edad']??"";
        $tipo=$_POST['tipoEntrada']??"";
        $talleres=$_POST['talleres']??[];
        $total=0;
        foreach ($talleres as $taller){
            $total+=$taller;
        }
    }
    echo "<p>Nombre: " . htmlspecialchars($nombre) . "</p>";
    echo "<p>Edad: " . htmlspecialchars($edad) . "</p>";
    echo "<p>Tipo de entrada: " . htmlspecialchars($tipo) . "</p>";
    echo "<p>Total talleres: $total €</p>";
    
    try{
    
    
    
       
    
    
    }catch (Exception $e){

    }finally{

    }

?>
