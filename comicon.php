
<?php
    
    try{
    
    if ($_SERVER['REQUEST_METHOD']==='POST'){


        $nombre=$_POST['nombre']??"";
        $edad=$_POST['edad']??"";
        $tipo=$_POST['tipoEntrada']??"";
        $talleres=$_POST['talleres']??[];  
        $total=0;
        
        echo $nombre;
        echo $edad;
    }
    
    
       
    
    
    }catch (Exception $e){

    }finally{

    }

?>
