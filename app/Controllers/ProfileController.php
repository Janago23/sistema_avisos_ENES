<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está autenticado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/'); // Redirige a iniciar sesión si no hay sesión activa
        }

        // Pasa los datos de sesión a la vista
        $data = [
            'nombre_usuario' => $session->get('nombre_usuario'),
            'rol' => $session->get('rol'),
        ];

        // Carga la vista 'dashboard' con los datos
        echo view('dashboard', $data);
    }
}