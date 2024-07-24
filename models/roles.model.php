<?php

class roles_model {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    
    public function get_roles() {
        $sql = 'SELECT rol_id, rol
            FROM roles ';
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
        $stmt->close();
        $stmt = null;

        return $result;
    }

    public function get_rol_by_id($rol_id) {
        $sql = 'SELECT rol
            FROM roles where rol_id=?';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $rol_id);
        
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);				
        $stmt->close();
        $stmt = null;

        return $result;
    }

    public function create_rol ($datos) {

        $sql = 'INSERT INTO roles (rol) 
            VALUES (?)';
        
        $params = array();        
        $params[] = 's';
        $params[] = &$datos['nombre'];
        $stmt = $this->db->executeStatement($sql, $params);

        if ($stmt->execute())
            $result = 'ok';
        else
            $result = 'error';

        $stmt->close();
		$stmt = null;

        return $result;
    }

    public function update_rol ($datos) {

        $sql = 'UPDATE roles set rol=?
            WHERE rol_id=?';
        $params = array();        
        $params[] = 'si';
        $params[] = &$datos['rol'];
        $params[] = &$datos['rol_id'];
        
        $stmt = $this->db->executeStatement($sql, $params);
     
        if ($stmt->execute())
            $result = 'ok';
        else
            $result = 'error';
        $stmt->close();
		$stmt = null;
        
        return $result;
    }

    public function delete_rol_by_id ($rol_id) {
        $sql = 'DELETE from roles where rol_id=?';
        $params = array();
        $params[] = 'i';
        $params[] = &$rol_id;
        
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