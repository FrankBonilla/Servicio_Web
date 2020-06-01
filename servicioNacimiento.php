<?php
//incluimos la libreria NuSoap
require_once "lib/nusoap.php";
//creamos el objeto.
$servicio = new nusoap_server();
//creamos el name space para hacer referencia a nuestro servicio web
$nameSpace = "http://localhost:8888/ServiciosWeb/servicioNacimineto.php";
//en el siguiente metodo nos solicita dos parametros
//el nombre de tu servicio W y el name sapce
$servicio->configureWSDL("MiPrimerServicioWeb",$nameSpace);
$servicio->wsdl->schemaTargetNamespace = $nameSpace;
$servicio->soap_defencoding = 'utf-8';//para caracteres latinos
//el metodo register nos pide 4 parametros, el primero es la funcion
//el segundo parametro indicamos que tipo de parametros va a recibir
//el tercer parametro es el tipo de valor que va a retornar
$servicio->register("consulta",array('nombre'=>'xsd:string',
'fecha'=>'xsd:string'),array('return'=>'xsd:string'),$nameSpace);
//definimos la funcion
function consulta($nombre,$fecha){
    list($ano,$mes,$dia) = explode("-",$fecha);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
      $ano_diferencia--;

    if($ano_diferencia > 18){
    $msj = $nombre." ya tienes ".$ano_diferencia." años, ya eres mayor de edad";
    }else{
        $msj = $nombre." tienes ".$ano_diferencia." años, aún no eres mayor de edad";
    }
    return $msj;

}
//desplegamos nuestro servicio web
$servicio->service(file_get_contents("php://input"));
?>