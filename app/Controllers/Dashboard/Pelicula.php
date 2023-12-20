<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
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

        //$peliculas = $this->peliculaModel->findAll();

        /* $this->generarImagen();
        $this->asignarImagen(); */

        $peliculas = $this->peliculaModel->asObject()
            ->select("peliculas.id,titulo,descripcion,categorias.nombre as categoria")
            ->join("categorias", "categorias.id = peliculas.categoria_id")
            ->findAll();

        $data = [
            "titulo" => "Listado de Películas",
            "peliculas" => $peliculas,
        ];
        return view("dashboard/peliculas/index", $data);
    }

    public function show($id = null)
    {

        $imagenes = $this->peliculaModel->getImagesById($id);
        $etiquetas = $this->peliculaModel->getEtiquetasById($id);

        $pelicula = $this->peliculaModel->find($id);
        $data = [
            "titulo" => $pelicula->titulo,
            "pelicula" => $pelicula,
            "imagenes" => $imagenes,
            "etiquetas" => $etiquetas,
        ];

        return view("dashboard/peliculas/show", $data);
    }

    public function new()
    {
        $pelicula = new PeliculaModel();
        $categorias = new CategoriaModel();

        $data = [
            "titulo" => "Crear Película",
            "pelicula" => $pelicula,
            "categorias" => $categorias->findAll()
        ];
        return view("dashboard/peliculas/new", $data);
    }

    public function create()
    {
        if ($this->validate("peliculas")) {
            $insertar = $this->peliculaModel->insert([
                "titulo" => $this->request->getPost("titulo"),
                "descripcion" => $this->request->getPost("descripcion"),
                "categoria_id" => $this->request->getPost("categoria_id"),
            ]);
            return redirect()->to('/dashboard/pelicula')->with("mensaje", "Registro añadido exitosamente");
        } else {
            session()->setFlashdata([
                "validation" => $this->validator,
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id = null)
    {
        $pelicula = $this->peliculaModel->find($id);
        $categorias = new CategoriaModel();
        $data = [
            "titulo" => "Editar Película",
            "pelicula" => $pelicula,
            "categorias" => $categorias->find()
        ];
        return view("dashboard/peliculas/edit", $data);
    }

    public function update($id = null)
    {

        if ($this->validate("peliculas")) {
            $editar = $this->peliculaModel->update($id, [
                "titulo" => $this->request->getPost("titulo"),
                "descripcion" => $this->request->getPost("descripcion"),
                "categoria_id" => $this->request->getPost("categoria_id"),
            ]);

            return redirect()->to('/dashboard/pelicula')->with("mensaje", "Registro editado exitosamente");
        } else {
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


    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if ($this->request->getGet("categoria_id")) {
            $etiquetas = $etiquetaModel
                ->where("categoria_id", $this->request->getGet("categoria_id"))
                ->find();
        }

        $data = [
            "titulo" => "Etiquetas",
            "pelicula" => $peliculaModel->find($id),
            "categorias" => $categoriaModel->findAll(),
            "categoria_id" => $this->request->getGet("categoria_id"),
            "etiquetas" => $etiquetas,
        ];

        return view("dashboard/peliculas/etiquetas", $data);
    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost("etiqueta_id");
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel
            ->where("etiqueta_id", $etiquetaId)
            ->where("pelicula_id", $peliculaId)->first();

        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                "pelicula_id" => $peliculaId,
                "etiqueta_id" => $etiquetaId,
            ]);
        }

        return redirect()->back();
    }

    public function etiqueta_delete($peliculaId, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta
        ->where("etiqueta_id", $etiquetaId)
        ->where("pelicula_id", $peliculaId)
        ->delete();

        echo '{"mensaje":"Eliminado"}';

      /*   return redirect()->back()->with("mensaje", "Etiqueta eliminada"); */

    }


    private function generarImagen()
    {
        $imagenModel = new ImagenModel();
        $imagenModel->insert([
            "imagen" => date("Y-m-d H:m:s"),
            "extension" => "Pendiente",
            "data" => "Pendiente",
        ]);
    }

    private function asignarImagen()
    {
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert([
            "imagen_id" => 2,
            "pelicula_id" => 3,
        ]);
    }
}
