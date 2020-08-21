<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorito;

class FavoritoController extends Controller
{
    public function index()
    {
        return Favorito::all();
    }

    public function store(Request $request)
    {
        Favorito::create($request->all());
    }

    public function show($id)
    {
        return Favorito::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $favorito = Favorito::findOrFail($id);
        $favorito->update($request->all());
    }

    public function destroy($id)
    {
        $favorito = Favorito::findOrFail($id);
        $favorito->delete();
    }
}
