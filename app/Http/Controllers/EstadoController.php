<?php
namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::all();
        return view('estados.index', compact('estados'));
    }

    public function create()
    {
        return view('estados.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Estado::create($request->all());

        return redirect()->route('estados.index')->with('success', 'Estado creado exitosamente');
    }

    public function edit(Estado $estado)
    {
        return view('estados.form', compact('estado'));
    }

    public function update(Request $request, Estado $estado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $estado->update($request->all());

        return redirect()->route('estados.index')->with('success', 'Estado actualizado exitosamente');
    }

    public function destroy(Estado $estado)
    {
        $estado->delete();

        return redirect()->route('estados.index')->with('success', 'Estado eliminado exitosamente');
    }
}
