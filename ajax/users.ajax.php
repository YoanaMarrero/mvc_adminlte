<?php 
require_once "../config/dbcon.php";
require_once "../models/users.model.php";
require_once "../controllers/users.controller.php";

class users_ajax extends users_controller {
    public $user_id;
    public $user_img;

    public function ajax_edit_user($userid) {
        $respuesta = parent::get_user_by_id($userid);
        echo json_encode($respuesta);
    }

    public function ajax_delete_user(){
        $respuesta = parent::delete_user($this->user_id, $this->user_img);
        echo $respuesta;

    }
}

$action = isset($_POST['action']) ? $_POST['action'] : '';
switch ($action) {
    case 'delete':
        // Obtener usuario segun su id
        if(isset($_POST["userid"])) {            
            $eliminar = new users_ajax();
            $eliminar->user_id = $_POST["userid"];
            $eliminar->user_img = ($_POST["userimg"]) ? $_POST["userimg"] : '';
            $eliminar->ajax_delete_user();
        }
        break;
    default:
        // Obtener usuario segun su id
        if(isset($_POST["userid"])) {
            header('Content-Type: application/json');
            $editar = new users_ajax();
            $editar->ajax_edit_user($_POST["userid"]);
        }
        break;
}
