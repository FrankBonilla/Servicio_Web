<!DOCTYPE Html>
<html>
    <head>
        <meta/>
    </head>
    <body>
        <h3>Comprobacion de edad</h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" required/>
            <label>Fecha de Nacimiento</label>
            <input type="text" name="fecha" id="fecha" placeholder="YYYY-MM-DD"/>
            <input type="submit" name="comprobar" id="comprobar" value="Comprobar Edad" size="3" required/>
        </form>

<?php
//hacemos la inclusion de la herramienta
require_once "lib/nusoap.php";
//creamos el cliente
$cliente = new nusoap_client("http://localhost:8888/ServiciosWeb/servicioNacimiento.php?wsdl",true);
//TAMBIEN -->   $cliente = new nusoap_client("http://localhost:8888/MVC4/servicioWeb.php",false);
if(isset($_POST['comprobar'])){

    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];

    $parametros = array("nombre"=>$nombre,"fecha"=>$fecha);
    $msj = $cliente->call("consulta",$parametros);

    print_r($msj);
}
?>
    </body>
</html>