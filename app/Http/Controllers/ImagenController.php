<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    //
    public function store(Request $request) {
    $manager = new ImageManager(new Driver());
        
        // Imagen en memoria
        $imagen = $request->file('file');

        // Setear nombre
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        
        // Guardar la imagen al servidor
        $imagenServidor = $manager->read($imagen);
        $imagenServidor->cover(1000, 1000);

        // Mover al servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}