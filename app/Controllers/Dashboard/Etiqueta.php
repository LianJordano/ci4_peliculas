<?php

namespace App\Controllers\Dashboard;

use App\Models\EtiquetaModel;
use App\Models\CategoriaModel;
use App\Controllers\BaseController;

class Etiqueta extends BaseController
{

    private $etiquetaModel;

    public function __construct()
    {
        $this->etiquetaModel = new EtiquetaModel();
    }

    public function index()
    {

        $etiquetas = $this->etiquetaModel->asObject()
            ->select("etiquetas.id,titulo,categorias.nombre as categoria")
            ->join("categorias", "categorias.id = etiquetas.categoria_id")
            ->findAll();
        $data = [
            "titulo" => "Listado de etiquetas",
            "etiquetas" => $etiquetas,
        ];
        return view("dashboard/etiquetas/index", $data);
    }

    public function show($id = null)
    {


        $etiqueta = $this->etiquetaModel->find($id);
        $data = [
            "titulo" => $etiqueta->titulo,
            "etiqueta" => $etiqueta,
        ];

        return view("dashboard/etiquetas/show", $data);
    }

    public function new()
    {
        $categorias = new CategoriaModel();
        $etiqueta = new EtiquetaModel();

        $data = [
            "titulo" => "Crear Etiqueta",
            "etiqueta" => $etiqueta,
            "categorias" => $categorias->findAll()
        ];
        return view("dashboard/etiquetas/new", $data);
    }

    public function create()
    {
        if ($this->validate("etiquetas")) {
            $insertar = $this->etiquetaModel->insert([
                "titulo" => $this->request->getPost("titulo"),
                "categoria_id" => $this->request->getPost("categoria_id"),
            ]);
            return redirect()->to('/dashboard/etiqueta')->with("mensaje", "Registro añadido exitosamente");
        } else {
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id = null)
    {
        $etiqueta = $this->etiquetaModel->find($id);
        $categorias = new CategoriaModel();
        $data = [
            "titulo" => "Editar Etiqueta",
            "etiqueta" => $etiqueta,
            "categorias" => $categorias->find()
        ];
        return view("dashboard/etiquetas/edit", $data);
    }

    public function update($id = null)
    {

        if ($this->validate("etiquetas")) {
            $editar = $this->etiquetaModel->update($id, [
                "titulo" => $this->request->getPost("titulo"),
                "categoria_id" => $this->request->getPost("categoria_id"),
            ]);

            return redirect()->to('/dashboard/etiqueta')->with("mensaje", "Registro editado exitosamente");
        } else {
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);

            return redirect()->back()->withInput();
        }
    }

    public function delete($id = null)
    {

        $this->etiquetaModel->delete($id);
        return redirect()->to('/dashboard/etiqueta')->with("mensaje", "Registro eliminado exitosamente");;
    }
}
