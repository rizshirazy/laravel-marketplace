<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('pages.dashboard-product-create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth::user()->id;
        $product = Product::create($data);

        if ($request->image) {
            $gallery = [
                'product_id' => $product->id,
                'image' => $request->file('image')->store('assets/products', 'public')
            ];

            ProductGallery::create($gallery);
        }

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['galleries', 'user', 'category'])
            ->findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('pages.dashboard-product-details', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth::user()->id;

        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('assets/products', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard.products.edit', $request->product_id);
    }

    public function removeGallery($id)
    {
        $gallery = ProductGallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('dashboard.products.edit', $gallery->product_id);
    }
}
