
<?php
    
    try{
    
    if ($_SERVER['REQUEST_METHOD']==='POST'){


        $nombre=$_POST['nombre']??"";
        $edad=$_POST['edad']??"";
        $tipo=$_POST['tipoEntrada']??"";
        $talleres=$_POST['talleres']??[];  
        $total=0;
        
        if (!is_numeric($edad) || $edad < 0 || $edad >120 ){
            
        }
    }
    
    
       
    
    
    }catch (Exception $e){

    }finally{

    }

?>
