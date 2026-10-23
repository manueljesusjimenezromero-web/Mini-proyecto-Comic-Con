
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
            $i=0;
            foreach ($talleres as $taller => $precio){
                
                if (!is_numeric($precio)) {
                throw new Exception ("Error: tiene que haver valores numericos");
                }else{
                $total += $precio;}

                $i+=1;

            }
            

           $nombre = htmlspecialchars(
            trim($nombre),
            ENT_QUOTES, 'UTF-8'
            );
            
            if (!is_numeric($edad) || $edad < 0 || $edad > 120) {
                throw new Exception ("Error: la edad esta fuera de rango");
            }

            if ($i === 0){
                throw new Exception("Error: no a marcado ningun taller");
            }

            if ($edad >= 18 && $tipo === "VIP"){
                throw new Exception("Error: La entrada VIP está restringida a mayores de edad");
            }
        
            

    
        }
    
    
    }catch (Exception $e){
        echo "Error capturado: ". htmlspecialchars($e->getMessage()). "<br>";
    }finally{
        echo "Finalizando el script... (Guardando traza en el servidor)<br>";
        error_log("[" . date('Y-m-d H:i:s') . "] Operación
        finalizada. Divisor usado: " . $divisor);
    }
    

?>
