<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    private $peliculaModel;

    public function __construct()
    {
        $this->peliculaModel = new PeliculaModel();  
    }

    public function index()
    {   

        $peliculas = $this->peliculaModel->findAll();

        $data = [
            "titulo" => "Listado de Películas",
            "peliculas" => $peliculas,
        ];
        return view("dashboard/peliculas/index",$data);
    }

    public function show($id = null)
    {
       
        $pelicula = $this->peliculaModel->find($id);
        $data = [
            "titulo" => $pelicula->titulo,
            "pelicula" => $pelicula,
        ];

        return view("dashboard/peliculas/show",$data);

    }

    public function new()
    {
        $pelicula = new PeliculaModel();

        $data = [
            "titulo" => "Crear Película",
            "pelicula" =>$pelicula,
        ];
        return view("dashboard/peliculas/new",$data);
    }

    public function create()
    {
        if($this->validate("peliculas")){
            $insertar = $this->peliculaModel->insert([
                "titulo" => $this->request->getPost("titulo"),
                "descripcion" => $this->request->getPost("descripcion"),
            ]);
            return redirect()->to('/dashboard/pelicula')->with("mensaje", "Registro añadido exitosamente");
        }else{
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);
            return redirect()->back()->withInput();
        }
        
     
    }

    public function edit($id = null)
    {
        $pelicula = $this->peliculaModel->find($id);
        $data = [
            "titulo" => "Editar Película",
            "pelicula" => $pelicula,
        ];
        return view("dashboard/peliculas/edit",$data);
    }

    public function update($id = null)
    {

        if($this->validate("peliculas")){
            $editar = $this->peliculaModel->update($id,[
                "titulo" => $this->request->getPost("titulo"),
                "descripcion" => $this->request->getPost("descripcion"),
            ]);

            return redirect()->to('/dashboard/pelicula')->with("mensaje", "Registro editado exitosamente");

        }else{
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);

            return redirect()->back()->withInput();
        }
    }

    public function delete($id = null)
    {

        $this->peliculaModel->delete($id);
        return redirect()->to('/dashboard/pelicula')->with("mensaje", "Registro eliminado exitosamente");;

    }

   
}
