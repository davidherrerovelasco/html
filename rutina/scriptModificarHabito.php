<?php 
    $servername = "localhost";
    $username = "root";
    $password = "tomate";
    $dbname = "tfg";

    //Creamos la conexion con el servidor mysql:
    $conn = mysqli_connect($servername, $username, $password,$dbname);
            
    //Comprobamos la conexion:
    if (!$conn) {
        mysqli_close($conn);
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql1="select * from habitos where idPaciente='".$_COOKIE["id"]."' and id='".$_GET["id"]."'";
    $result1=mysqli_query($conn, $sql1);

    if($result1 == FALSE) {
        mysqli_close($conn);
        die(header("location:viewGestionarRutina.php?failed=true"));
    }

    $row = mysqli_fetch_assoc($result1);

    $nombre=$row["nombre"];
    $dia=$row["dia"];
    $hora=$row["hora"];
    $descripcion=$row["descripcion"];
    $id =$row["id"];

    if(isset($_POST['nombreModificado']) && $_POST['nombreModificado']!=""){
        $nombre = $_POST['nombreModificado'];
    }
    if(isset($_POST['diaModificado']) && $_POST['diaModificado']!=""){
        if(strcmp($_POST['diaModificado'],"Lunes")==0){
            $dia=0;
        }else if(strcmp($_POST['diaModificado'],"Martes")==0){
            $dia=1;
        }else if(strcmp($_POST['diaModificado'],"Miercoles")==0){
            $dia=2;
        }else if(strcmp($_POST['diaModificado'],"Jueves")==0){
            $dia=3;
        }else if(strcmp($_POST['diaModificado'],"Viernes")==0){
            $dia=4;
        }else if(strcmp($_POST['diaModificado'],"Sabado")==0){
            $dia=5;
        }else if(strcmp($_POST['diaModificado'],"Domingo")==0){
            $dia=6;
        }
    }
    if(isset($_POST['horaModificado']) && $_POST['horaModificado']!=""){
        $hora = $_POST['horaModificado'];
    }
    if(isset($_POST['descripcionModificado']) && $_POST['descripcionModificado']!=""){
        $descripcion = $_POST['descripcionModificado'];
    }   

    
    $sql="UPDATE habitos SET nombre ='".$nombre."', dia ='".$dia."', hora ='".$hora."', descripcion ='".$descripcion."' where id='".$id."'";
    $result=mysqli_query($conn, $sql);
    

    if($result == FALSE) {  
        mysqli_close($conn);
        echo $sql;
    }else{
        mysqli_close($conn);
        die(header("location:viewGestionarRutina.php?done=true"));
    }
?>