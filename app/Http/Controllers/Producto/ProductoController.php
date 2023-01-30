<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::paginate(5);
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,svg1|max:1024'
        ]);

        $producto = $request->all();

        if ($image = $request->file('image')) {
            $rutaGuardarImg = 'image/';
            $imageProducto = date('YmdHis'). "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imageProducto);
            $producto['image'] = "$imageProducto";
        }

        Product::create($producto);
        return redirect()->route('productos.index');
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
    public function edit( Product $producto)
    {
        return view('productos.editar',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $producto)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $prod = $request->all();


        if ($image = $request->file('image')) {
            $rutaGuardarImg = 'image/';
            $imageProducto = date('YmdHis'). "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $imageProducto);
            $prod['image'] = "$imageProducto";
        }

            else {
                unset($prod['image']);
            }

        $producto->update($prod);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
