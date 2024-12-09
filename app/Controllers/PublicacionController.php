<?php  
namespace App\Controllers;

use App\Models\PublicacionModel;
use CodeIgniter\Controller;

class PublicacionController extends Controller
{
    public function index()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/signin');
        }

        $publicacionModel = new PublicacionModel();
        $publicaciones = $publicacionModel->paginate(10);
        $pager = $publicacionModel->pager;
    
        
        $data = [
            'publicaciones' => $publicaciones,
            'pager' => $pager,
            'rol' => $session->get('rol'),
            'nombre_usuario' => $session->get('nombre_usuario'),
        ];

        return view('/dashboard', $data);
    }

    public function agregar()
    {
        $session = session();

        if (!in_array($session->get('rol'), ['admin', 'superadmin'])) {
            return redirect()->to('/dashboard')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        helper(['form']);

        $rules = [
            'titulo' => 'required|min_length[3]|max_length[100]',
            'tipo' => 'required|in_list[imagen,video]',
            'archivo' => 'permit_empty|uploaded[archivo]|max_size[archivo,10240]|ext_in[archivo,jpg,jpeg,png,mp4]',
        ];

        if (!$this->validate($rules)) {
            return view('agregar_publicacion', [
                'validation' => $this->validator
            ]);
        }

        $publicacionModel = new PublicacionModel();
        $archivo = $this->request->getFile('archivo');
        $rutaArchivo = null;

        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $rutaArchivo = $archivo->store('uploads');
        }

        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'tipo' => $this->request->getPost('tipo'),
            'archivo' => $rutaArchivo,
            'estado' => 'habilitado',
        ];

        $publicacionModel->insert($data);
        return redirect()->to('/dashboard')->with('msg', 'Publicación agregada exitosamente.');
    }

    public function habilitar($id)
    {
        return $this->modificarEstado($id, 'habilitado', 'Publicación habilitada.');
    }

    public function deshabilitar($id)
    {
        return $this->modificarEstado($id, 'deshabilitado', 'Publicación deshabilitada.');
    }

    public function eliminar($id)
    {
        $session = session();
        if ($session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $publicacionModel = new PublicacionModel();
        $publicacionModel->delete($id); // Cambiar a soft delete si es necesario
        return redirect()->to('/dashboard')->with('msg', 'Publicación eliminada.');
    }

    private function modificarEstado($id, $estado, $mensaje)
    {
        $session = session();

        if ($estado === 'deshabilitado' && $session->get('rol') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'No tienes permiso para deshabilitar publicaciones.');
        }

        $publicacionModel = new PublicacionModel();
        $publicacionModel->update($id, ['estado' => $estado]);
        return redirect()->to('/dashboard')->with('msg', $mensaje);
    }
}
