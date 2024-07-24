<?php 

/*
$lista_controladores['noticias/'] = 'noticias';
include('config.php');

$pantallaSeleccionada = $_GET['pantalla'];
if ($pantallaSeleccionada == ''){
    $controlador = 'inicio';
} else {
    foreach($lista_controladores as $pantalla => $controlador_actual){
        if (strpos($pantallaSeleccionada, $pantalla) === 0) {
            $controlador = $controlador_actual;
            $url_adicional = substr($pantallaSeleccionada, strlen($pantalla));
        }
    }
}
if ($controlador == '') {
    $controlador = 'error404';
}
include "controller/$controlador.php";
*/

include "controllers/template.controller.php";

$plantilla = new template_controller();
$plantilla->ctrTemplate();

?>
