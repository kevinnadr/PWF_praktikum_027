<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $category = Category::create($validated);

            Log::info('Menambah data kategori', ['category' => $category]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!!',
                'data' => $category,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Category retrieved successfully',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diupdate!!',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $category->delete();

            return response()->json([
                'message' => 'Kategori berhasil dihapus!!'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat hapus kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }
}
