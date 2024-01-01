<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        $peliculas = $peliculaModel->select('peliculas.*, categorias.nombre as categoria')
        ->join('categorias', 'categorias.id = peliculas.categoria_id')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', "left")
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id',"left");

        if($buscar = $this->request->getGet("buscar")){
            $peliculas = $peliculas->orLike("peliculas.titulo",$buscar,"both");
            $peliculas = $peliculas->orLike("peliculas.descripcion",$buscar,"both");
        }

        if($categoria_id = $this->request->getGet("categoria_id")){
            $peliculas = $peliculas->where("peliculas.categoria_id",$categoria_id);
        }

        if($etiqueta_id = $this->request->getGet("etiqueta_id")){
            $peliculas = $peliculas->where("etiquetas.id",$etiqueta_id);
        }

        $peliculas = $peliculas->groupBy("peliculas.id")->paginate();

        $data = [
            "titulo" => "Peliculas",
            "peliculas" => $peliculas,
            "pager" => $peliculaModel->pager
        ];
        return  view("blog/pelicula/index", $data);
    }

    public function show($id)
    {

        $peliculaModel = new PeliculaModel();
        $pelicula = $peliculaModel
            ->select("peliculas.*, categorias.*")
            ->join("categorias", "categorias.id = peliculas.categoria_id")
            ->where("peliculas.id", $id)
            ->asObject()
            ->first();

        $data = [
            "titulo" => $pelicula->titulo,
            "pelicula" => $pelicula,
        ];


        return  view("blog/pelicula/show", $data);
    }
}
