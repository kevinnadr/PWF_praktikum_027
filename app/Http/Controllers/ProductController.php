<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'user')->paginate(10);

        return view('product.index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        
        $validated['user_id'] = auth()->id();

        try {
            Product::create($validated);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product created successfully.');

        } catch (QueryException $e) {
            Log::error('Product store database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while creating product.');

        } catch (\Throwable $e) {
            Log::error('Product store unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('product.create', compact('categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        \Illuminate\Support\Facades\Gate::authorize('update', $product);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'qty'   => 'required|integer',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'name.max'       => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required'   => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer'    => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric'  => 'Harga produk harus berupa angka yang valid.',
            'price.min'      => 'Harga produk tidak boleh negatif.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak valid.',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        \Illuminate\Support\Facades\Gate::authorize('update', $product);
        $categories = \App\Models\Category::all();

        return view('product.create-edit', compact('product', 'categories'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        \Illuminate\Support\Facades\Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}