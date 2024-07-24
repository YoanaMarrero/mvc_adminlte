<?php

class users_model {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    
    public function get_users() {
        $sql = 'SELECT usuarios.*, roles.rol as rol_nb 
            FROM usuarios 
            INNER JOIN roles on usuarios.rol = roles.rol_id';
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
        $stmt->close();
        $stmt = null;

        return $result;
    }

    public function get_user_by_username($user_name) {
        $sql = 'SELECT userid, nombre, apellido1, apellido2, username, password, email, foto, rol
            FROM usuarios where username=?';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $user_name);
        
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);				
        $stmt->close();
        $stmt = null;

        return $result;
    }

    public function get_user_by_id($userid) {
        $sql = 'SELECT userid, nombre, apellido1, apellido2, username, password, email, foto, rol
            FROM usuarios where userid=?';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userid);
        
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);				
        $stmt->close();
        $stmt = null;

        return $result;
    }
    /*
    public function create_user2($datos) {

        $sql = 'INSERT INTO usuarios (nombre, apellido1, apellido2, username, password, email, foto, rol) 
            VALUES (?,?,?,?,?,?,?,?)';
        $mysqli = $this->connect();
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sssssssi', $datos['nombre'], $datos['apellido1'], $datos['apellido2'], 
            $datos['usuario'], $datos['clave'], $datos['email'], $datos['avatar'], $datos['rol']);

        if ($stmt->execute())
            $result = 'ok';
        else
            $result = 'error';

        $stmt->close();
		$stmt = null;

        return $result;
    }
    */
    public function create_user ($datos) {

        $sql = 'INSERT INTO usuarios (nombre, apellido1, apellido2, username, password, email, foto, rol) 
            VALUES (?,?,?,?,?,?,?,?)';
        
        $params = array();        
        $params[] = 'sssssssi';
        $params[] = &$datos['nombre'];
        $params[] = &$datos['apellido1'];
        $params[] = &$datos['apellido2'];
        $params[] = &$datos['usuario'];
        $params[] = &$datos['clave'];
        $params[] = &$datos['email'];
        $params[] = &$datos['avatar'];
        $params[] = &$datos['rol'];
        $stmt = $this->db->executeStatement($sql, $params);

        if ($stmt->execute())
            $result = 'ok';
        else
            $result = 'error';

        $stmt->close();
		$stmt = null;

        return $result;
    }

    public function update_user ($datos) {

        $sql = 'UPDATE usuarios set nombre=?, apellido1=?, apellido2=?, username=?, password=?, email=?, foto=?, rol=?
            WHERE userid=?';
        
        $params = array();        
        $params[] = 'sssssssii';
        $params[] = &$datos['nombre'];
        $params[] = &$datos['apellido1'];
        $params[] = &$datos['apellido2'];
        $params[] = &$datos['usuario'];
        $params[] = &$datos['clave'];
        $params[] = &$datos['email'];
        $params[] = &$datos['avatar'];
        $params[] = &$datos['rol'];
        $params[] = &$datos['userid'];
        
        $stmt = $this->db->executeStatement($sql, $params);
     
        if ($stmt->execute())
            $result = 'ok';
        else
            $result = 'error';
        $stmt->close();
		$stmt = null;
        
        return $result;
    }

    public function delete_user_by_id ($userid) {
        $sql = 'DELETE from usuarios where userid=?';
        $params = array();
        $params[] = 'i';
        $params[] = &$userid;
        
        $stmt = $this->db->executeStatement($sql, $params);
     
        if ($stmt->execute())
            $result = 'ok';
        else
            $result = 'error';
        $stmt->close();
		$stmt = null;
        
        return $result;
    }
    
    public function __destruct() {
        $this->db->close();
    }
}