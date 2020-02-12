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

        flash('La película se ha guardado correctamente')->success();

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

        flash('La película se ha modificado correctamente')->success();

        return redirect('/catalog/show/'.$id);
    }

    public function putRent($id){
        $movie = Movie::findOrFail($id);
        $movie->rented = true;
        $movie->save();

        flash('La película se ha alquilado correctamente')->success();

        return redirect('/catalog/show/'.$id);
    }

    public function putReturn($id){
        $movie = Movie::findOrFail($id);
        $movie->rented = false;
        $movie->save();

        flash('La película se ha devuelto correctamente')->success();

        return redirect('/catalog/show/'.$id);
    }

    public function deleteMovie($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        flash('La película se ha borrado correctamente')->success();

        return redirect('/catalog');
    }

}
