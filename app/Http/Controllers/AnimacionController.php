<?php

namespace App\Http\Controllers;

use App\Models\Animacion;
use App\Models\Estudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimacionController extends Controller
{
    // Mostrar todas las animaciones
    public function index()
    {
        $animaciones = Animacion::with('estudio')->get();
        return view('animaciones.index', compact('animaciones'));
    }

    // Mostrar formulario para crear nueva animación
    public function create()
    {
        $estudios = Estudio::all();
        return view('animaciones.create', compact('estudios'));
    }

    // Guardar una nueva animación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'duracion' => 'required|string|max:50',
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'estudio_id' => 'required|exists:estudios,id',
        ]);

        // Guardar imagen en el disco "public"
        $imagenPath = $request->file('imagen')->store('animaciones', 'public');
        $validated['imagen'] = $imagenPath;

        Animacion::create($validated);

        return redirect()->route('animaciones.index')->with('success', 'Animación creada con éxito.');
    }

    // Mostrar formulario para editar animación
    public function edit(Animacion $animacion)
    {
        $estudios = Estudio::all();
        return view('animaciones.edit', compact('animacion', 'estudios'));
    }

    // Actualizar animación existente
    public function update(Request $request, Animacion $animacion)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'duracion' => 'required|string|max:50',
            'estudio_id' => 'required|exists:estudios,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Si se sube nueva imagen, borrar la anterior y guardar la nueva
        if ($request->hasFile('imagen')) {
            if ($animacion->imagen && Storage::disk('public')->exists($animacion->imagen)) {
                Storage::disk('public')->delete($animacion->imagen);
            }

            $imagenPath = $request->file('imagen')->store('animaciones', 'public');
            $validated['imagen'] = $imagenPath;
        }

        $animacion->update($validated);

        return redirect()->route('animaciones.index')->with('success', 'Animación actualizada con éxito.');
    }

    // Eliminar animación
    public function destroy(Animacion $animacion)
    {
        // Eliminar imagen si existe
        if ($animacion->imagen && Storage::disk('public')->exists($animacion->imagen)) {
            Storage::disk('public')->delete($animacion->imagen);
        }

        $animacion->delete();

        return redirect()->route('animaciones.index')->with('success', 'Animación eliminada con éxito.');
    }
}
