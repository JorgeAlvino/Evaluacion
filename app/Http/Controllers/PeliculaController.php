<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelicula = Pelicula::all();



        return response()->json([
            'peliculas' => $pelicula
        ], 200);
    }

    public function store(Request $request)
    {
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->fecha_publicacion = $request->fecha_publicacion;

        if ($request->imagen == null) {
            $pelicula->imagen = "no imagen";
        } else {
            $files = $request->file('imagen');
            $pelicula->imagen = $files->store('public');
        }

        $pelicula->save();

        return;
    }



    public function show(Request $request, $id)
    {

  
        $pelicula = Pelicula::find($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->fecha_publicacion = $request->fecha_publicacion;

        if ($request->imagen == null) {
            $pelicula->imagen = "no imagen";
        } else {
            $files = $request->file('imagen');
            $pelicula->imagen = $files->store('public');
        }

        $pelicula->save();

        return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelicula = Pelicula::find($id);

        return response()->json([
            'pelicula' => $pelicula
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $pelicula = Pelicula::find($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->fecha_publicacion = $request->fecha_publicacion;

        if ($request->imagen == null) {
            $pelicula->imagen = "no imagen";
        } else {
            $files = $request->file('imagen');
            $pelicula->imagen = $files->store('public');
        }

        $pelicula->save();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->delete();
    }


}
