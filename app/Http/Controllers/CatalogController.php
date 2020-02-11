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

    public function postCreate(Request $request){
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return redirect('/catalog');
    }

    public function putEdit(Request $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return redirect('/catalog/show/'.$id);
    }

}
