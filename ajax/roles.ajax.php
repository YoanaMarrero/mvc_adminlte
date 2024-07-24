<?php 
require_once "../config/dbcon.php";
require_once "../models/roles.model.php";
require_once "../controllers/roles.controller.php";

class roles_ajax extends roles_controller {
    public $rol_id;

    public function ajax_edit_rol($rol_id) {
        $respuesta = parent::get_rol_by_id($rol_id);
        echo json_encode($respuesta);
    }

    public function ajax_delete_rol(){
        $respuesta = parent::delete_rol($this->rol_id);
        echo $respuesta;
    }
}

$action = isset($_POST['action']) ? $_POST['action'] : '';
switch ($action) {
    case 'delete':
        // Obtener rol segun su id
        if(isset($_POST["rol_id"])) {            
            $eliminar = new roles_ajax();
            $eliminar->rol_id = $_POST["rol_id"];
            $eliminar->ajax_delete_rol();
        }
        break;
    default:
        // Obtener usuario segun su id
        if(isset($_POST["rol_id"])) {
            header('Content-Type: application/json');
            $editar = new roles_ajax();
            $editar->ajax_edit_rol($_POST["rol_id"]);
        }
        break;
}
