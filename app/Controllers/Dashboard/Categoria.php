<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController
{

    private $categoriasModelo;

    public function __construct()
    {
        $this->categoriasModelo = new CategoriaModel();
    }

    public function index()
    {

        $categorias = $this->categoriasModelo->paginate(7);
        $data = [
            "titulo" => "Listado de categorías",
            "categorias" => $categorias,
            "pager" => $this->categoriasModelo->pager,

        ];
        return view("dashboard/categorias/index", $data);
    }

    public function show($id = null)
    {
       
        $categoria = $this->categoriasModelo->find($id);
        $data = [
            "titulo" => $categoria->nombre,
            "categoria" => $categoria,
        ];

        return view("dashboard/categorias/show",$data);

    }

    public function new()
    {
        $categoria = new CategoriaModel();

        $data = [
            "titulo" => "Crear Categoría",
            "categoria" =>$categoria,
        ];
        return view("dashboard/categorias/new",$data);
    }

    public function create()
    {

        if($this->validate("categorias")){
            $insertar = $this->categoriasModelo->insert([
                "nombre" => $this->request->getPost("nombre"),
            ]);
    
            return redirect()->to('/dashboard/categoria')->with("mensaje", "Registro añadido exitosamente");
        }else{
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);
            return redirect()->back()->withInput();
        }
        
  

    }

    public function edit($id = null)
    {
        $categoria = $this->categoriasModelo->find($id);
        $data = [
            "titulo" => "Editar Categorías",
            "categoria" => $categoria,
        ];
        return view("dashboard/categorias/edit",$data);
    }

    public function update($id = null)
    {

        if($this->validate("categorias")){
            $editar = $this->categoriasModelo->update($id,[
                "nombre" => $this->request->getPost("nombre"),
            ]);
    
            return redirect()->to('/dashboard/categoria')->with("mensaje", "Registro editado exitosamente");
        }else{
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);
            return redirect()->back()->withInput();
        }


    }

    public function delete($id = null)
    {

        $this->categoriasModelo->delete($id);
        return redirect()->to('/dashboard/categoria')->with("mensaje", "Registro eliminado exitosamente");

    }
}
