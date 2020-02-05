<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{

    function getIndex()
    {
        //return view('catalog.index', array('arrayPeliculas' => $this->arrayPeliculas));
        $arrayPeliculas = Movie::all();

        return view('catalog.index')
            ->with('arrayPeliculas', $arrayPeliculas);
    }

    public function getShow($id)
    {
        //return view('catalog.show', array('id' => $id, 'pelicula' => $this->arrayPeliculas[$id]));
        $pelicula = Movie::findOrFail($id);

        return view('catalog.show')
            ->with('id', $id)
            ->with('pelicula', $pelicula);
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        //return view('catalog.edit', array('id' => $id));
        $pelicula = Movie::findOrFail($id);

        return view('catalog.edit')
            ->with('pelicula', $pelicula);
    }
}
