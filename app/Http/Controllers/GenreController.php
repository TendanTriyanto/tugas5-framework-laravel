<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        return response()->json(Genre::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(Genre::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $id,
        ]);

        $genre->update($request->all());
        return response()->json($genre, 200);
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}