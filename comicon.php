
<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    try{
    
        if ($_SERVER['REQUEST_METHOD']==='POST'){


            $nombre=$_POST['nombre']??"";
            $edad=$_POST['edad']??"";
            $tipo=$_POST['tipoEntrada']??"";
            $talleres=$_POST['talleres']??[];  
            $total=0;

            foreach ($talleres as $taller => $precio){
                $total += $precio;
            }
            

            if (is_numeric($nombre)) {
                throw new Exception ("Error: solo se permiten caracteres");
            }
            if (!is_numeric($edad) || $edad < 0 || $edad > 120) {
                throw new Exception ("Error: la edad esta fuera de rango");
            }

            if ($total===0){
                throw new Exception("Error: no a marcado ningun taller");
            }


           $nombre = htmlspecialchars(
            trim($nombre),
            ENT_QUOTES, 'UTF-8'
            );
            
            echo "<p>".$tipo."</p>";   // General, VIP o Infantil
            

    
        }
    
    
    }catch (Exception $e){
        echo "Error capturado: ". htmlspecialchars($e->getMessage()). "<br>";
    }finally{

    }
    

?>
