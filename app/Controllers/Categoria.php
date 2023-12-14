<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\RESTful\ResourceController;

class Categoria extends ResourceController
{

    private $categoriasModelo;

    public function __construct()
    {
        $this->categoriasModelo = new CategoriaModel();
    }

    public function index()
    {

        $categorias = $this->categoriasModelo->findAll();
        $data = [
            "titulo" => "Listado de categorías",
            "categorias" => $categorias,
        ];
        return view("categorias/index", $data);
    }

    public function show($id = null)
    {
       
        $categoria = $this->categoriasModelo->find($id);
        $data = [
            "titulo" => $categoria->nombre,
            "categoria" => $categoria,
        ];

        return view("categorias/show",$data);

    }

    public function new()
    {
        $categoria = new CategoriaModel();

        $data = [
            "titulo" => "Crear Categoría",
            "categoria" =>$categoria,
        ];
        return view("categorias/new",$data);
    }

    public function create()
    {
        
        $insertar = $this->categoriasModelo->insert([
            "nombre" => $this->request->getPost("nombre"),
        ]);

        return redirect()->to('/categoria');

    }

    public function edit($id = null)
    {
        $categoria = $this->categoriasModelo->find($id);
        $data = [
            "titulo" => "Editar Categorías",
            "categoria" => $categoria,
        ];
        return view("categorias/edit",$data);
    }

    public function update($id = null)
    {

        $editar = $this->categoriasModelo->update($id,[
            "nombre" => $this->request->getPost("nombre"),
        ]);

        return redirect()->to('/categoria');
    }

    public function delete($id = null)
    {

        $this->categoriasModelo->delete($id);
        return redirect()->to('/categoria');

    }
}
