<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'bio' => 'nullable|string',
        ]);

        return response()->json(Author::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(Author::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $id,
            'bio' => 'nullable|string',
        ]);

        $author->update($request->all());
        return response()->json($author, 200);
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}