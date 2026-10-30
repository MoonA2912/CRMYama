<?php

namespace App\Http\Controllers;

use App\Exceptions\CloudinaryUploadException;
use App\Models\Product;
use App\Support\CloudinaryUploader;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    public function catalog(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $products = Product::where('is_active', true)
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->when($category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->orderBy('name')
            ->get();

        $categories = Product::where('is_active', true)
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('catalog.index', compact(
            'products',
            'search',
            'category',
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CloudinaryUploader $cloudinaryUploader)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            try {
                $validated['image'] = $cloudinaryUploader->upload(
                    $request->file('image')
                );
            } catch (CloudinaryUploadException $exception) {
                return back()
                    ->withErrors(['image' => $exception->getMessage()])
                    ->withInput();
            }
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function customerShow(Product $product)
    {
        abort_unless($product->is_active, 404);

        return view('catalog.show', compact('product'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Product $product,
        CloudinaryUploader $cloudinaryUploader
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            try {
                $validated['image'] = $cloudinaryUploader->upload(
                    $request->file('image')
                );
            } catch (CloudinaryUploadException $exception) {
                return back()
                    ->withErrors(['image' => $exception->getMessage()])
                    ->withInput();
            }
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
