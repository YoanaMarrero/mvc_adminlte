<?php
/*
require_once("config/dbcon.php");
require_once("models/roles.model.php");
*/
class roles_controller extends roles_model 
{
    public function get_roles() {   
        $response = parent::get_roles();
        return $response;
    }
    public function get_rol_by_id($rol_id) {   
        $response = parent::get_rol_by_id($rol_id);
        return $response;
    }
    
    public function edit_rol() {
        if (isset($_POST['rol_edit']) && ($_POST['rol_edit'] != '')) {

         
            $datos = array(
                'rol'=>$_POST['nombre_edit'],
                'rol_id'=> $_POST['rol_edit']
            );
            $response = parent::update_rol($datos);
            if($response == "ok") {
                echo'<script>
                    swal({
                        type:"success",
                        title: "¡CORRECTO!",
                        text: "El rol ha sido actualizado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"                        
                    }).then(function(result){
                        if(result.value){   
                            history.back();
                        } 
                    });
                </script>';
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Registro fallido</div>";
            }            
        }
    }

    public function save_rol() {
        if (isset($_POST['nombre'])) {
            $datos = array(
                'nombre'=>$_POST['nombre'],
                'rol_id'=> $_POST['rol_id']
            );
            $response = parent::create_rol($datos);
            if($response == "ok") {
                echo'<script>
                    swal({
                        type:"success",
                        title: "¡CORRECTO!",
                        text: "El rol ha sido creado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"                        
                    }).then(function(result){
                        if(result.value){   
                            history.back();
                        } 
                    });
                </script>';
            } else {
                echo "<div class='alert alert-danger mt-3 small'>registro fallido</div>";
            }            
        }
    }

    public function delete_rol($rol_id) {
        $response = parent::delete_rol_by_id($rol_id);
        return $response;
    }
}