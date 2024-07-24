<?php
/*
require_once("config/dbcon.php");
require_once("models/users.model.php");
*/
class users_controller extends users_model
{
    public function login_user() {
        
		if(isset($_POST["user_name"])){
			$encriptarPass=crypt($_POST["user_pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			$respuesta=parent::get_user_by_username($_POST["user_name"]);
            if (!is_null($respuesta)) {
			    if($respuesta["username"] == $_POST["user_name"]  && $respuesta["password"] == $encriptarPass){
                    $_SESSION["validarSession"] = "ok";
                    $_SESSION["lg_userid"] = $respuesta["userid"];
                    $_SESSION["lg_user_fullname"] = trim($respuesta["nombre"] .' '. $respuesta['apellido1']);
                    $_SESSION['lg_user_img'] = $respuesta["foto"];

                    echo '<script>window.location = "users";</script>';
                } else {  
                    $_SESSION["validarSession"] = "";
                    echo "<div class='alert alert-danger mt-3 small'>ERROR: Usuario y/o contraseña incorrectos</div>";
                }
            } else {
                $_SESSION["validarSession"] = "";
                echo "<div class='alert alert-danger mt-3 small'>ERROR: Usuario y/o contraseña incorrectos</div>";
            }
    	}
	}

    public function get_users() {   
        $response = parent::get_users();
        return $response;
    }

    public function get_user_by_id($userid) { 
        $response = parent::get_user_by_id($userid);
        return $response;
    }

    public function edit_user() {
        if (isset($_POST['user_edit']) && ($_POST['user_edit'] != '')) {

            $ruta = $nombreFichero = '';
            if ((isset($_FILES['avatar_edit']['tmp_name'])) && 
                (!empty($_FILES['avatar_edit']['tmp_name']))) {
                
                // Obtenemos las dimensiones de la imagen
                list($ancho, $alto) = getimagesize($_FILES['avatar_edit']['tmp_name']);
                $nuevoAncho = 480;
                $nuevoAlto = 380;

                $directorio ="view/img/users";

                // Antes de nada, comprobamos si el usuario ya tenía una imagen seleccionada
                // para eliminarla. 
                if (isset($_POST['avatar_edit_ant'])) {
                    unlink($directorio .'/'.$_POST['avatar_edit_ant']);
                }

                $aleatorio = mt_rand(100,999);
                $ruta = $directorio .'/'.$aleatorio;

                // Tratamos la imagen según su tipo
                if ($_FILES['avatar_edit']['type'] == 'image/jpeg') {
                    $nombreFichero = $aleatorio;
                    $ruta .= '.jpg';
                    $nombreFichero .= '.jpg';

                    $origen = imagecreatefromjpeg($_FILES['avatar_edit']['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);
                }
                elseif ($_FILES['avatar_edit']['type'] == 'image/png') {
                    $nombreFichero = $aleatorio;
                    $ruta .= '.png';
                    $nombreFichero .= '.png';

                    $origen = imagecreatefrompng($_FILES['avatar_edit']['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagealphablending($destino, false);
                    imagesavealpha($destino, true);
                    imagecopyresized($destino, $origen, 0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
                }
                else { ?>
                    <script>
                        swal({
                            type:'error',
                            title: 'CORREGIR',
                            text: 'No se permiten formatos diferentes a JPG y/o PNG',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'
                            
                        }).then(function(result){
                            if (result.value) {
                                history.back();
                            }
                        });
                    </script>
                <?php                 
                }

            }

            if($nombreFichero != ''){
                $avatar= $nombreFichero;
            } else {
                $avatar = $_POST["avatar_edit_ant"];
            }

            // Tras subir la imagen del usuario procedemos a registrar el mismo en la base de datos
            if ($_POST["clave_edit"] == '') {
                $encriptarPassword = $_POST["clave_edit_ant"];
            } else  {
                $encriptarPassword = crypt($_POST["clave_edit"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            }
            $datos = array(
                'nombre'=>$_POST['nombre_edit'],
                'apellido1'=>$_POST['apellido1_edit'],
                'apellido2'=>$_POST['apellido2_edit'],
                'email'=>$_POST['email_edit'], 
                'usuario'=>$_POST['usuario_edit'], 
                'clave'=> $encriptarPassword,
                'rol'=> $_POST['rol_edit'],
                'avatar'=> $avatar, 
                'userid' => $_POST['user_edit']
            );
            $response = parent::update_user($datos);
            if($response == "ok") {
                echo'<script>
                    swal({
                        type:"success",
                        title: "¡CORRECTO!",
                        text: "El usuario ha sido actualizado correctamente",
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

    public function save_user() {
        if (isset($_POST['nombre'])) {
            $ruta = $nombreFichero = '';
            if ((isset($_FILES['avatar']['tmp_name'])) && 
                (!empty($_FILES['avatar']['tmp_name']))) {
                
                // Obtenemos las dimensiones de la imagen
                list($ancho, $alto) = getimagesize($_FILES['avatar']['tmp_name']);
                $nuevoAncho = 480;
                $nuevoAlto = 380;

                $directorio ="view/img/users";

                $aleatorio = mt_rand(100,999);
                $ruta = $directorio .'/'.$aleatorio;
                $nombreFichero = $aleatorio;

                // Tratamos la imagen según su tipo
                if ($_FILES['avatar']['type'] == 'image/jpeg') {
                    $ruta .= '.jpg';
                    $nombreFichero .= '.jpg';

                    $origen = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);
                }
                elseif ($_FILES['avatar']['type'] == 'image/png') {
                    $ruta .= '.png';
                    $nombreFichero .= '.png';

                    $origen = imagecreatefrompng($_FILES['avatar']['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagealphablending($destino, false);
                    imagesavealpha($destino, true);
                    imagecopyresized($destino, $origen, 0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
                }
                else { ?>
                    <script>
                        swal({
                            type:'error',
                            title: 'CORREGIR',
                            text: 'No se permiten formatos diferentes a JPG y/o PNG',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'
                            
                        }).then(function(result){
                            if (result.value) {
                                history.back();
                            }
                        });
                    </script>
                <?php                 
                }

            }

            // Tras subir la imagen del usuario procedemos a registrar el mismo en la base de datos
            $encriptarPassword = crypt($_POST["clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $datos = array(
                'nombre'=>$_POST['nombre'],
                'apellido1'=>$_POST['apellido1'],
                'apellido2'=>$_POST['apellido2'],
                'email'=>$_POST['email'], 
                'usuario'=>$_POST['usuario'], 
                'clave'=> $encriptarPassword,
                'rol'=> $_POST['rol'],
                'avatar'=>$nombreFichero
            );
            $response = parent::create_user($datos);
            if($response == "ok") {
                echo'<script>
                    swal({
                        type:"success",
                        title: "¡CORRECTO!",
                        text: "El usuario ha sido creado correctamente",
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

    public function delete_user($userid, $user_img) {
        $directorio ="view/img/users/";
        unlink('../' .$directorio .$user_img);
        $response = parent::delete_user_by_id($userid);
        return $response;
    }
}

