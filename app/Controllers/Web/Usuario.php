<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{

    private $usuarioModelo;


    public function __construct()
    {
        $this->usuarioModelo = new UsuarioModel();
    }

    public function traficarUsuario()
    {
        $traficado = $this->usuarioModelo;
        echo $traficado->insert([
            "usuario" => "adminx",
            "email" => "adminx@correo.com",
            "contrasena" => $traficado->contrasenaHash("12345"),
        ]) . " Usuario traficado correctamente ";
    }

    public function login()
    {

        $data = [
            "titulo" => "Login",
        ];

        return view("web/usuarios/login", $data);
    }


    public function login_post()
    {
        $email =  $this->request->getPost("email");
        $contrasena =  $this->request->getPost("contrasena");

        $x = new UsuarioModel();

        $usuario = $this->usuarioModelo->select("id,usuario,email,contrasena,tipo")
            ->where("email", $email)
            ->Orwhere("usuario", $email)
            ->first();

        if (!$usuario) {
            return redirect()->to('/login')->with("mensaje", "Usuario y/o contraseña invalido");
        }

        if ($x->contrasenaVerificar($contrasena, $usuario->contrasena)) {
            $session = session();
            unset($usuario->contrasena);
            $session->set("usuario", $usuario);
            return redirect()->to('/dashboard/categoria')->with("mensaje", "Bienvenid@  $usuario->usuario");
        }

        return redirect()->to('/login')->with("mensaje", "Usuario y/o contraseña invalido");
    }


    public function register()
    {
        $data = [
            "titulo" => "Registrar",
        ];

        return view("web/usuarios/register", $data);
    }


    public function register_post()
    {

        if ($this->validate("usuarios")) {
            $this->usuarioModelo->insert([
                "usuario" => $this->request->getPost("usuario"),
                "email" => $this->request->getPost("email"),
                "contrasena" => $this->usuarioModelo->contrasenaHash($this->request->getPost("contrasena")),

            ]);
            return redirect()->to('/login')->with("mensaje", "Se ha registrado correctamente, puedes iniciar sesión");

        }

        session()->setFlashdata([
            "validation" => $this->validator
        ]);

        return redirect()->to('/register')->withInput();

    }

    public function logout(){
        session()->destroy();
        return redirect()->to("/login");
    }
}
