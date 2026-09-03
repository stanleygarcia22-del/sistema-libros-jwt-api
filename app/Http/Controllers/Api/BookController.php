<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * GET /api/books
     * Listar todos los libros.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'data'    => $books
        ], 200);
    }

    /**
     * POST /api/books
     * Crear un nuevo libro.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'autor'       => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio'      => 'required|numeric|min:0',
            'disponible'  => 'nullable|boolean',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Libro creado exitosamente.',
            'data'    => $book
        ], 201);
    }

    /**
     * GET /api/books/{id}
     * Obtener un libro específico.
     */
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Libro no encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $book
        ], 200);
    }

    /**
     * PUT/PATCH /api/books/{id}
     * Actualizar un libro existente.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Libro no encontrado.'
            ], 404);
        }

        $validated = $request->validate([
            'titulo'      => 'sometimes|required|string|max:255',
            'autor'       => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'precio'      => 'sometimes|required|numeric|min:0',
            'disponible'  => 'sometimes|boolean',
        ]);

        $book->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Libro actualizado correctamente.',
            'data'    => $book
        ], 200);
    }

    /**
     * DELETE /api/books/{id}
     * Eliminar un libro.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Libro no encontrado.'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Libro eliminado del catálogo exitosamente.'
        ], 200);
    }
}