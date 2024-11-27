<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class SignupController extends Controller {
    public function index()
    {
        $session = session();

        // Verifica si el usuario tiene rol de superadmin
        if ($session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('msg', 'No tienes permiso para acceder a esta página.');
        }

        helper(['form']); // Cargar helper para formularios
        $data = [];
        echo view('signup', $data); // Renderizar la vista de registro
    }
  
    public function store()
    {
        $session = session();

        // Verifica si el usuario tiene rol de superadmin
        if ($session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('msg', 'No tienes permiso para registrar usuarios.');
        }

        helper(['form']); // Cargar helper para formularios

        // Reglas de validación ajustadas a los campos de tu base de datos
        $rules = [
            'nombre_usuario'    => 'required|min_length[2]|max_length[100]',
            'correo'            => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.correo]',
            'pswd'              => 'required|min_length[8]|max_length[50]',
            'confirmpassword'   => 'required|matches[pswd]',
            'rol'               => 'required|in_list[admin,superadmin]'
        ];
          
        if ($this->validate($rules)) {
            $usuarioModel = new UsuarioModel();

            // Datos a guardar en la base de datos
            $data = [
                'nombre_usuario' => $this->request->getVar('nombre_usuario'),
                'correo'         => $this->request->getVar('correo'),
                'pswd'           => password_hash($this->request->getVar('pswd'), PASSWORD_DEFAULT), // Hashear contraseña
                'rol'            => $this->request->getVar('rol') // Rol seleccionado por el superadmin
            ];

            $usuarioModel->save($data); // Guarda los datos en la tabla `usuarios`
            
            return redirect()->to('/dashboard')->with('msg', 'Usuario registrado exitosamente.');
        } else {
            // Devuelve los errores de validación a la vista
            $data['validation'] = $this->validator;
            echo view('signup', $data);
        }
    }
}
