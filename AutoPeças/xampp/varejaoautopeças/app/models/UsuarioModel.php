<?php

namespace app\models;

use app\core\Model;
use PDO;

class UsuarioModel extends Model {

    
    public function create($nome, $email, $senha) {
        
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR); 

            return $stmt->execute(); 

        } catch (\PDOException $e) {
            
            error_log("Erro ao criar usuário: " . $e->getMessage());
            return false; 
        }
    }

    
    public function findByEmail($email) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            return $usuario; 

        } catch (\PDOException $e) {
            error_log("Erro ao buscar usuário por email: " . $e->getMessage());
            return false;
        }
    }

     
     public function findById($id) {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            return $usuario;
        } catch (\PDOException $e) {
             error_log("Erro ao buscar usuário por ID: " . $e->getMessage());
            return false;
        }
    }
}
