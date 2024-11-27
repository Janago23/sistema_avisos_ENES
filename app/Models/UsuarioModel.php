<?php 
namespace App\Models;  
use CodeIgniter\Model;

class UsuarioModel extends Model {
    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos
    
    protected $primaryKey = 'id_usuario'; // Clave primaria de la tabla
    
    protected $allowedFields = [
        'nombre_usuario', // Campo para el nombre del usuario
        'correo',         // Correo del usuario
        'pswd',           // Contraseña del usuario
        'rol',            // Rol del usuario (admin o superadmin)
    ]; 

    protected $useTimestamps = true; // Activar manejo automático de timestamps
    protected $createdField = 'creado'; // Campo para la fecha de creación
    protected $updatedField = 'actualizado'; // Campo para la última modificación
    
}
