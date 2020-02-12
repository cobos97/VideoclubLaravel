<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use PDOException;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Movie::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->input('title') && $request->input('year') &&
                $request->input('director') && $request->input('poster') &&
                $request->input('synopsis')) {
                $movie = new Movie();
                $movie->title = $request->input('title');
                $movie->year = $request->input('year');
                $movie->director = $request->input('director');
                $movie->poster = $request->input('poster');
                $movie->synopsis = $request->input('synopsis');
                $movie->save();
                return response()->json(['error' => false, 'msg' => 'La película se ha guardado correctamente']);
            } else {
                return response()->json(['error' => true, 'msg' => 'Faltan parametros']);
            }
        } catch (PDOException $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Movie::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $movie = Movie::findOrFail($id);
            if ($request->input('title')) $movie->title = $request->input('title');
            if ($request->input('year')) $movie->year = $request->input('year');
            if ($request->input('director')) $movie->director = $request->input('director');
            if ($request->input('poster')) $movie->poster = $request->input('poster');
            if ($request->input('synopsis')) $movie->synopsis = $request->input('synopsis');
            $movie->save();
            return response()->json(['error' => false, 'msg' => 'La película se ha actualizado correctamente']);
        } catch (PDOException $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json(['error' => false, 'msg' => 'La película se ha borrado correctamente']);
    }

    public function putRent($id)
    {
        $m = Movie::findOrFail($id);
        $m->rented = true;
        $m->save();
        return response()->json(['error' => false, 'msg' => 'La película se ha marcado como alquilada']);
    }

    public function putReturn($id)
    {
        $m = Movie::findOrFail($id);
        $m->rented = false;
        $m->save();
        return response()->json(['error' => false, 'msg' => 'La película se ha marcado como libre']);
    }

}
