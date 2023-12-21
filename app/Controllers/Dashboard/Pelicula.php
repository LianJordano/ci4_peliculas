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

            $this->asignarImagen($id);

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

    private function asignarImagen($peliculaId)
    {

        $imageFile = $this->request->getFile("imagen");

        if ($imageFile) {
            if ($imageFile->isValid()) {

                $validated = $this->validate([
                    "uploaded[imagen]",
                    "mime_in[imagen,image/jpg,image/gif,image/png,image/jpeg]",
                    "max_size[imagen,4096]"
                ]);

                if ($validated) {
                    $imageNombre = $imageFile->getRandomName();
                    //$imageNombre = $imageFile->getName();
                    $ext = $imageFile->guessExtension();

                    //$imageFile->move(WRITEPATH . "uploads/peliculas", $imageNombre);
                    $imageFile->move("../public/uploads/peliculas", $imageNombre);

                    $imagenModel = new ImagenModel();
                    $imagenId = $imagenModel->insert([
                        "imagen" => $imageNombre,
                        "extension" => $ext,
                        "data" => "Pendiente",
                    ]);

                    $peliculaImagenModel = new PeliculaImagenModel();
                    $peliculaImagenModel->insert([
                        "imagen_id" => $imagenId,
                        "pelicula_id" => $peliculaId,
                    ]);
                }

                return $this->validator->listErrors();
            }
        }
    }

    public function borrarImagen($imagenId)
    {
        // Asegúrate de importar los modelos si no se han importado previamente
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();
        
        // Buscar la imagen en la base de datos
        $imagen = $imagenModel->find($imagenId);
    
        if (!$imagen) {
            return "No existe la imagen";
        }
    
        // Obtener la ruta completa del archivo
        $imagenRuta = FCPATH . "uploads/peliculas/" . $imagen->imagen;
    
        // Verificar si el archivo existe antes de intentar eliminarlo
        if (file_exists($imagenRuta)) {
            // Intentar eliminar el archivo
            if (unlink($imagenRuta)) {
                // Eliminar el registro asociado en la tabla de relación
                $peliculaImagenModel->where("imagen_id", $imagenId)->delete();
    
                // Eliminar la imagen de la tabla de imágenes
                $imagenModel->delete($imagenId);
    
                return redirect()->back()->with("mensaje", "Imagen eliminada correctamente");
            } else {
                return "Hubo un problema al eliminar el archivo";
            }
        } else {
            return "El archivo no existe en la ruta especificada";
        }
    }


    public function descargarImagen($imagenId){
        $imagenModel = new ImagenModel();
        $imagen = $imagenModel->find($imagenId);

        if (!$imagen) {
            return "No existe la imagen";
        }
        $imagenRuta = FCPATH . "uploads/peliculas/" . $imagen->imagen;

        return $this->response->download($imagenRuta, null);

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

    /* private function asignarImagen()
    {
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert([
            "imagen_id" => 2,
            "pelicula_id" => 3,
        ]);
    } */
}
