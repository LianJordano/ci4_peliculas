<?php

namespace App\Controllers;

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
        return view("peliculas/index",$data);
    }

    public function show($id = null)
    {
       
        $pelicula = $this->peliculaModel->find($id);
        $data = [
            "titulo" => $pelicula->titulo,
            "pelicula" => $pelicula,
        ];

        return view("peliculas/show",$data);

    }

    public function new()
    {
        $pelicula = new PeliculaModel();

        $data = [
            "titulo" => "Crear Película",
            "pelicula" =>$pelicula,
        ];
        return view("peliculas/new",$data);
    }

    public function create()
    {
        
        $insertar = $this->peliculaModel->insert([
            "titulo" => $this->request->getPost("titulo"),
            "descripcion" => $this->request->getPost("descripcion"),
        ]);

        return redirect()->to('/pelicula');

    }

    public function edit($id = null)
    {
        $pelicula = $this->peliculaModel->find($id);
        $data = [
            "titulo" => "Editar Película",
            "pelicula" => $pelicula,
        ];
        return view("peliculas/edit",$data);
    }

    public function update($id = null)
    {

        $editar = $this->peliculaModel->update($id,[
            "titulo" => $this->request->getPost("titulo"),
            "descripcion" => $this->request->getPost("descripcion"),
        ]);

        return redirect()->to('/pelicula');
    }

    public function delete($id = null)
    {

        $this->peliculaModel->delete($id);
        return redirect()->to('/pelicula');

    }
}
