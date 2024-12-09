<?php  
namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        $session = session();

        if ($session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'No tienes permiso para gestionar usuarios.');
        }

        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();

        $data = [
            'usuarios' => $usuarios,
            'nombre_usuario' => $session->get('nombre_usuario'),
        ];

        return view('usuarios/index', $data);
    }

    public function agregar()
    {
        $session = session();

        if ($session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        helper(['form']);

        $rules = [
            'nombre' => 'required|min_length[3]|max_length[100]',
            'correo' => 'required|valid_email|is_unique[usuarios.correo]',
            'rol' => 'required|in_list[admin,superadmin]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $usuarioModel = new UsuarioModel();
        $usuarioModel->save([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'rol' => $this->request->getPost('rol'),
            'pswd' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/usuarios')->with('msg', 'Usuario agregado exitosamente.');
    }

    public function eliminar($id)
    {
        $session = session();

        if ($session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $usuarioModel = new UsuarioModel();
        $usuarioModel->delete($id);

        return redirect()->to('/usuarios')->with('msg', 'Usuario eliminado exitosamente.');
    }
}