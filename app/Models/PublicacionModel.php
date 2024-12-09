<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicacionModel extends Model
{
    protected $table = 'publicaciones';
    protected $primaryKey = 'id_publicacion';
    protected $allowedFields = [
        'titulo', 
        'tipo', 
        'archivo', 
        'estado', 
        'creado', 
        'actualizado'
    ];

    // Configuración de timestamps
    protected $useTimestamps = true;
    protected $createdField = 'creado';
    protected $updatedField = 'actualizado';

    // Validaciones
    protected $validationRules = [
        'titulo' => 'required|min_length[3]|max_length[100]',
        'tipo' => 'required|in_list[imagen,video]',
        'archivo' => 'permit_empty|string',
        'estado' => 'required|in_list[habilitado,deshabilitado]',
    ];

    protected $validationMessages = [
        'titulo' => [
            'required' => 'El título es obligatorio.',
            'min_length' => 'El título debe tener al menos 3 caracteres.',
            'max_length' => 'El título no puede exceder los 100 caracteres.',
        ],
        'tipo' => [
            'required' => 'El tipo de publicación es obligatorio.',
            'in_list' => 'El tipo debe ser "imagen" o "video".',
        ],
        'estado' => [
            'required' => 'El estado es obligatorio.',
            'in_list' => 'El estado debe ser "habilitado" o "deshabilitado".',
        ],
    ];
}
