<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use Illuminate\Http\Request;

class EstudioController extends Controller
{
    public function index()
    {
        $estudios = Estudio::all();
        return view('estudios.index', compact('estudios'));
    }

    public function create()
    {
        return view('estudios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'anio_fundacion' => 'required|integer',
        ]);

        Estudio::create($request->all());

        return redirect()->route('estudios.index')->with('success', 'Estudio creado.');
    }

    public function edit(Estudio $estudio)
    {
        return view('estudios.edit', compact('estudio'));
    }

    public function update(Request $request, Estudio $estudio)
    {
        $request->validate([
            'nombre' => 'required|string',
            'anio_fundacion' => 'required|integer',
        ]);

        $estudio->update($request->all());

        return redirect()->route('estudios.index')->with('success', 'Estudio actualizado.');
    }

    public function destroy(Estudio $estudio)
    {
        $estudio->delete();
        return redirect()->route('estudios.index')->with('success', 'Estudio eliminado.');
    }
}
