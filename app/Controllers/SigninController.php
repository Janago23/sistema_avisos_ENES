<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UsuarioModel;  

class SigninController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('signin');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UsuarioModel();  
        
        
        $correo = $this->request->getVar('correo');
        $pswd = $this->request->getVar('pswd');

        print_r([
            'correo' => $correo,
            'pswd' => $pswd
        ]);
    
        
        // Comprobamos si el correo existe
        $data = $userModel->where('correo', $correo)->first();
        
        if($data){
            $pass = $data['pswd']; 
            $authenticatePassword = password_verify($pswd, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre_usuario' => $data['nombre_usuario'],
                    'correo' => $data['correo'],
                    'rol' => $data['rol'], 
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard'); 
            }else{
                $session->setFlashdata('msg', 'Contraseña incorrecta.');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'el correo no existe.');
            return redirect()->to('/');
        }

        
    }

    public function logout()
{
    $session = session(); 
    $session->destroy(); 
    return redirect()->to('/');

}

}