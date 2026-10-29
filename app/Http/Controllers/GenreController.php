<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // Read All Data Genre
    public function index()
    {
        $genres = Genre::all();
        
        if ($genres->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource data not found',
                'data' => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all resources',
            'data' => $genres
        ], 200);
    }

    // Create Data Genre
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $genre = Genre::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Resource added successfully',
            'data' => $genre
        ], 201);
    }
}